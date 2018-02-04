<?php
namespace App\Services;

use App\Repositories\ShortMessageServiceHistory\ShortMessageServiceHistoryInterface;

class ShortMessageServiceHistoryService
{
    protected $history;
    
    /**
     * FundingService constructor.
     * @param 
     */
    public function __construct(ShortMessageServiceHistoryInterface $history)
    {
        $this->history = $history;
    }

    public function getAll()
    {
        return $this->history->getAll();
    }


    public function create($request)
    {
        return $this->history->create($request);
    }


}