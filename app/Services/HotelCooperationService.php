<?php
namespace App\Services;

use App\Repositories\HotelCooperation\HotelCooperationInterface;
use App\Repositories\Hotel\HotelInterface;

class HotelCooperationService
{
    protected $hotel_cooperation;
    protected $hotel;
    
    /**
     * HotelCooperationService constructor.
     * @param 
     */
    public function __construct(HotelCooperationInterface $hotel_cooperation, HotelInterface $hotel)
    {
        $this->hotel_cooperation = $hotel_cooperation;
        $this->hotel = $hotel;
    }

    /**
     *  取得個人追蹤列表
     */
    public function show($id)
    {
        $item_lists = $this->hotel_cooperation->getById($id);
        if ($item_lists == NULL) {
            return abort(404);
        } else {
            if ($item_lists->cooperation_item == NULL) {
                return [];
            } else {
                $items_array = explode(",", $item_lists->cooperation_item);
                $result = [];
                for ($i=0; $i < count($items_array); $i++) { 
                    $result[] = $this->hotel->getById($items_array[$i]);
                };
                return $data['items'] = $result;
            }
        }
    }

    /**
     *  判斷 status 是要移除還是新增
     *  傳進來是 -1 代表刪除
     *  傳進來是 1 代表新增
     */
    public function update($id, $request)
    {
        $item_lists = $this->hotel_cooperation->getById($id);
        //---------判斷是否已經有存在該使用者的清單row，否則新增一條
        if($item_lists == NULL){
            $result['cooperation_item'] = NULL;
            $this->hotel_cooperation->updateOrCreate($id, $result);
            $item_lists = $this->hotel_cooperation->getById($id);
        }

        //---------判斷清單內是否有此旅宿
        $items_array = explode(",", $item_lists->cooperation_item);
        $has_this_hotel = false;
        if(in_array($request['cooperation_item'], $items_array)){
            $has_this_hotel = true;
        }

        //---------執行刪除或是新增旅宿
        if ($request['status'] == -1 && $has_this_hotel == true) {
            // 如果執行刪除指令，且目前有該旅宿，將該旅宿從陣列移除
            $items_array = array_diff($items_array, [$request['cooperation_item']]);
        }else if($request['status'] == 1 && $has_this_hotel == false){
            // 如果執行新增指令，且目前沒有該旅宿，將該旅宿推入陣列
            if ($items_array[0] == NULL) {
                //如果這是第一筆資料，不用array push的方式，不然會變成,開頭
                 $items_array[0] = $request['cooperation_item'];
             } else {
                array_push($items_array, $request['cooperation_item']);
             }
        }else{
            return 'true';
        }
        
        //---------把處理完的陣列文字重組後丟進DB      
        $request['cooperation_item'] = implode(",", $items_array);
        return $this->hotel_cooperation->updateOrCreate($id, $request);
    }
}