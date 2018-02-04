<?php

namespace App\Repositories\HotelReturn;

interface HotelReturnInterface {

	public function getAll($request);

	public function getById($id);

	public function create($request);
}