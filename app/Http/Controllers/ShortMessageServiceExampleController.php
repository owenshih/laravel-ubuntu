<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ShortMessageServiceExampleService;

class ShortMessageServiceExampleController extends Controller
{
    /**
     * @var Repository
     */
    private $SMSExampleService;

    /**
     * ModelController constructor
     * @param HotelController $model
     */
    public function __construct(ShortMessageServiceExampleService $SMSExampleService)
    {
        $this->SMSExampleService = $SMSExampleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->SMSExampleService->getAll();
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->SMSExampleService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->SMSExampleService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->SMSExampleService->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }

    public function getMessageQuota()
    {
        return $this->SMSExampleService->getMessageQuota();
    }
}
