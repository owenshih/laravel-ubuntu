<?php
namespace App\Services;

use App\Repositories\HotelReturn\HotelReturnInterface;

class HotelReturnService
{
    protected $hotel_return;
    
    /**
     * FundingService constructor.
     * @param 
     */
    public function __construct(HotelReturnInterface $hotel_return)
    {
        $this->hotel_return = $hotel_return;
    }

    /**
     *  
     */
    public function getAll($request)
    {
        return $this->hotel_return->getAll($request);
    }

    /**
     * 
     */
    public function show($id)
    {
        return $this->hotel_return->getById($id);
    }

    /**
     *  
     */
    public function create($request)
    {
        return $this->hotel_return->create($request);
    }

}