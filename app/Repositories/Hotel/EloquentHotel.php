<?php
namespace App\Repositories\Hotel;
use App\Repositories\Hotel\HotelInterface as HotelInterface;
use App\Hotel;

class EloquentHotel implements HotelInterface
{
    /**
     * @var $model
     */
    private $model;

    /**
     * EloquentTask constructor.
     *
     */
    public function __construct(Hotel $model)
    {
        $this->model = $model;
    }

    /**
     * Get all tasks.
     *
     */
    public function getAll($request)
    {
        return $this->model
        ->where(function($q) use ($request) {
            if($request['account_number'] != ''){
                $q->where('hotels.account_number', 'like', '%'.$request['account_number'].'%');
            }
            if($request['status'] != ''){
                $q->where('hotels.status', $request['status']);
            }
            if($request['chinese_name'] != ''){
                $q->where('hotels.chinese_name', 'like', '%'.$request['chinese_name'].'%');
            }
            if($request['city'] != ''){
                $q->where('hotels.city', $request['city']);
            }
            if($request['town'] != ''){
                $q->where('hotels.town', $request['town']);
            }
            if($request['signing_business'] != ''){
                $q->where('hotels.signing_business', $request['signing_business']);
            }
        })
            ->leftJoin('cities', 'hotels.city', '=', 'cities.id')
            ->leftJoin('towns', 'hotels.town', '=', 'towns.id')
            ->select('hotels.*', 'cities.chinese_name as city_chinese_name', 'towns.chinese_name as town_chinese_name')
            ->paginate(10);
    }

    /**
     * Get task by id.
     *
     * @param integer $id
     *
     */
    public function getById($id)
    {
        return $this->model
            ->leftJoin('cities', 'hotels.city', '=', 'cities.id')
            ->leftJoin('towns', 'hotels.town', '=', 'towns.id')
            ->select('hotels.*', 'cities.chinese_name as city_chinese_name', 'towns.chinese_name as town_chinese_name')
            ->find($id);
    }

    /**
     * Create a new task.
     *
     * @param array $attributes
     *
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
     */
    public function update($id, $attributes)
    {
        return $this->model->where('id', $id)->update($attributes->all());
    }

}