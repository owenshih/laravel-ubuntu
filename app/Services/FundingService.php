<?php
namespace App\Services;

use Carbon\Carbon;

use App\Repositories\Funding\FundingInterface;
use App\Repositories\FundingItem\FundingItemInterface;

class FundingService
{
    protected $funding;
    protected $funding_item;
    
    /**
     * FundingService constructor.
     * @param 
     */
    public function __construct(FundingInterface $funding, FundingItemInterface $funding_item)
    {
        $this->funding = $funding;
        $this->funding_item = $funding_item;
    }

    /**
     *  取得所有資料(不包含細項)
     */
    public function getAll($request)
    {
        return $this->funding->getAll($request);
    }

    /**
     *  新增資料
     */
    public function create($request)
    {
        $request['serial_number']=Carbon::now()->timestamp.rand(101,999);
        return $this->funding->create($request);
    }

    /**
     *  取得單一資料(包含細項)
     */
    public function show($id)
    {
        $data = $this->funding->getById($id);
        if ($data['status'] == -1 || $data['status'] === NULL) {
            return abort(404);
        }else{
            if ($data['item_lists'] == null) {
                $data['items'] = [];
            }else{
                $items_array = explode(",", $data['item_lists']);
                $result = [];
                for ($i=0; $i < count($items_array); $i++) { 
                    $result[] = $this->funding_item->getByItemLists($items_array[$i]);
                };
                $data['items'] = $result;
            }
        }
        return $data;
    }

    /**
     *  更新資料
     *  status == -1 判斷為 刪除資料
     */
    public function update($id, $request)
    {
        if($request['status'] == -1){
            return $this->funding->delete($id);
        }else{
            // 針對每筆項目做處理
            $result = [];
            for ($i=0; $i < count($request['items']); $i++) {
                $update_result = $this->funding_item->updateOrCreate($request['serial_number'], $request['items'][$i]);
                $result[] = $update_result->id;
            };
            $request['item_array'] = $result;
            $request['item_array'] = implode(",", $request['item_array']);
            return $this->funding->update($id, $request);
        }
    }
}