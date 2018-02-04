<?php

namespace App\Repositories\HotelCooperation;

interface HotelCooperationInterface {

	public function getById($id);

	public function updateOrCreate($id, $request);
}