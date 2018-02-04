<?php
namespace App\Repositories\HotelReturn;
use App\Repositories\HotelReturn\HotelReturnInterface as HotelReturnInterface;
use App\HotelReturn;

class EloquentHotelReturn implements HotelReturnInterface
{
    /**
     * @var $model
     */
    private $model;

    /**
     * EloquentTask constructor.
     *
     * @param App\HotelReturn $model
     */
    public function __construct(HotelReturn $model)
    {
        $this->model = $model;
    }

    /**
     * 依據hotelid取得追蹤旅宿列表
     */
    public function getAll($request)
    {
        return $this->model
        ->where(function($q) use ($request){
            if($request['business'] != ''){
                $q->Where('hotel_returns.business', $request['business']);
            }            
            if($request['date_start'] != ''){
                $q->Where('hotel_returns.created_at', '>=', $request['date_start']);
            }
            if($request['date_end'] != ''){
                $request['date_end'] = $request['date_end'].' 23:59:59';
                $q->Where('hotel_returns.created_at', '<=', $request['date_end']);
            }
        })
        ->join('hotels', 'hotel_returns.hotel_id', '=', 'hotels.id')
        ->select('hotel_returns.hotel_id','hotels.chinese_name','hotel_returns.business','hotel_returns.content','hotel_returns.created_at')
        ->orderBy('hotel_returns.created_at','desc')
        ->paginate(10);
    }

    /**
     * 依據hotelid取得追蹤旅宿列表
     */
    public function getById($id)
    {
        return $this->model->where('hotel_id', $id)->get();
    }

    /**
     * 更新新的追蹤列表
     */
    public function create($request)
    {
        return $this->model->create($request->all());
    }
}