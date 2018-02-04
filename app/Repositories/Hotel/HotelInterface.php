<?php

namespace App\Repositories\Hotel;

interface HotelInterface {
	public function getAll($request);

	public function getById($id);

	public function create($attributes);
 
	public function update($id, $attributes);
}