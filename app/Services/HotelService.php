<?php
namespace App\Services;

use App\Repositories\Hotel\HotelInterface;

class HotelService
{
    protected $hotel;
    
    /**
     * FundingService constructor.
     * @param 
     */
    public function __construct(HotelInterface $hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     *  
     */
    public function getAll($request)
    {
        return $this->hotel->getAll($request);
    }

    /**
     *  
     */
    public function create($request)
    {
        return $this->hotel->create($request);
    }

    /**
     * 
     */
    public function show($id)
    {
        return $this->hotel->getById($id);
    }

    /**
     * 
     */
    public function update($id, $request)
    {
        return $this->hotel->update($id, $request);
    }
}