<?php
namespace App\Repositories\FundingItem;
use App\Repositories\FundingItem\FundingItemInterface as FundingItemInterface;
use App\FundingItem;

class EloquentFundingItem implements FundingItemInterface
{
    /**
     * @var $model
     */
    private $model;

    /**
     * EloquentTask constructor.
     *
     * @param App\FundingItem $model
     */
    public function __construct(FundingItem $model)
    {
        $this->model = $model;
    }

    /**
     * 取得所有該編號流水號的細項
     */
    public function getByItemLists($id)
    {
        return $this->model->where('id',$id)->first();
    }


    /**
     * Update a task.
     *
     * @param integer $id
     * @param array $attributes
     *
     * @return App\Task
     */
    public function updateOrCreate($id, $attributes)
    {
        return $this->model->updateOrCreate([
            'id'            => $attributes['id'],
            'serial_number' => $id,
        ],[
            'serial_number' => $id,
            'invoice'       => $attributes['invoice'],
            'date'          => $attributes['date'],
            'title'         => $attributes['title'],
            'amount'        => $attributes['amount'],
            'compiled'      => $attributes['compiled'],
        ]);
    }

}

