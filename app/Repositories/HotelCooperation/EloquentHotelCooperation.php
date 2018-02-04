<?php
namespace App\Repositories\HotelCooperation;
use App\Repositories\HotelCooperation\HotelCooperationInterface as HotelCooperationInterface;
use App\HotelCooperation;

class EloquentHotelCooperation implements HotelCooperationInterface
{
    /**
     * @var $model
     */
    private $model;

    /**
     * EloquentTask constructor.
     *
     * @param App\HotelCooperation $model
     */
    public function __construct(HotelCooperation $model)
    {
        $this->model = $model;
    }

    /**
     * 依據businessid取得追蹤旅宿列表
     */
    public function getById($id)
    {
        return $this->model->where('business', $id)->first();
    }

    /**
     * 更新新的追蹤列表
     */
    public function updateOrCreate($id, $request)
    {
        return $this->model->updateOrCreate([
            'business'          => $id,
        ],[
            'cooperation_item'  => $request['cooperation_item'],
        ]);
    }
}