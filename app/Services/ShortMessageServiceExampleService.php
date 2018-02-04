<?php
namespace App\Services;

use App\Repositories\ShortMessageServiceExample\ShortMessageServiceExampleInterface;

class ShortMessageServiceExampleService
{
    protected $example;
    
    /**
     * FundingService constructor.
     * @param 
     */
    public function __construct(ShortMessageServiceExampleInterface $example)
    {
        $this->example = $example;
    }

    /**
     *  取得所有資料
     */
    public function getAll()
    {
        return $this->example->getAll();
    }

    public function show($id)
    {
        return $this->example->getById($id);
    }

    public function create($request)
    {
        return $this->example->create($request);
    }

    public function update($id, $request)
    {
        if ($request['status'] == -1) {
            // 執行刪除
            return $this->example->delete($id);
        }else{
            // 執行更新
            return $this->example->update($id, $request);
        }
    }

    public function getMessageQuota(){
        $quota = file_get_contents('https://api.kotsms.com.tw/memberpoint.php?username=tripmatch&password=weare168');
        return $quota;
    }


}