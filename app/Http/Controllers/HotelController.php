<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HotelService;
use App\Services\HotelCooperationService;

class HotelController extends Controller
{
    /**
     * @var Repository
     */
    private $hotel;
    private $hotelCooperation;

    /**
     * HotelController constructor
     * @param HotelController $hotel
     */
    public function __construct(HotelService $hotel, HotelCooperationService $hotelCooperation)
    {
        $this->hotel = $hotel;
        $this->hotelCooperation = $hotelCooperation;
    }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->hotel->getAll($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create_data = $this->hotel->create($request);

        // 新增完成後把資料放入該業務追蹤清單
        $result = [];
        $result['cooperation_item'] = $create_data->id;
        $result['status'] = 1;
        return $this->hotelCooperation->update($request['add_business'], $result);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->hotel->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->hotel->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }
}
