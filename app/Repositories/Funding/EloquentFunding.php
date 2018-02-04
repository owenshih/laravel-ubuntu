<?php
namespace App\Repositories\Funding;
use App\Repositories\Funding\FundingInterface as FundingInterface;
use App\Funding;

class EloquentFunding implements FundingInterface
{
    /**
     * @var $model
     */
    private $model;

    /**
     * EloquentTask constructor.
     *
     * @param App\Funding $model
     */
    public function __construct(Funding $model)
    {
        $this->model = $model;
    }

    /**
     * Get all tasks.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAll($request)
    {
        return $this->model
        ->where('status', '>=', 0)
        ->where(function($q) use ($request) {
            if($request['business'] != ''){
                $q->Where('business', 'like', '%'.$request['business'].'%');
            }
            if($request['title'] != ''){
                $q->Where('title', 'like', '%'. $request['title'].'%');
            }
            if($request['serial_number'] != ''){
                $q->Where('serial_number', 'like', '%'.$request['serial_number'].'%');
            }
            if($request['apply_date'] != ''){
                $q->Where('apply_date', $request['apply_date']);
            }
            if($request['status'] != ''){
                $q->Where('status', $request['status']);
            }
        })->paginate(10);
    }

    /**
     * Get task by id.
     *
     * @param integer $id
     *
     * @return App\Task
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new task.
     *
     * @param array $attributes
     *
     * @return App\Task
     */
    public function create($request)
    {
        return $this->model->create($request->all());
    }

    /**
     * Update a task.
     *
     * @param integer $id
     * @param array $attributes
     *
     * @return App\Task
     */
    public function update($id, $request)
    {
       return $this->model->where('id', $id)->update([
            'title' => $request['title'],
            'content' => $request['content'],
            'date_start' => $request['date_start'],
            'date_end' => $request['date_end'],
            'total' => $request['total'],
            'status' => $request['status'],
            'apply_date' => $request['apply_date'],
            'item_lists' => $request['item_array'],
        ]); 
    }


    /**
     * Create a new task.
     *
     * @param array $attributes
     *
     * @return App\Task
     */
    public function delete($id)
    {
        return $this->model->where('id', $id)->update([
            'status' => -1
        ]); 
    }
}