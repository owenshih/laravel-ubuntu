<?php

namespace App\Repositories\ShortMessageServiceHistory;

interface ShortMessageServiceHistoryInterface {
	public function getAll();

	public function create($attributes);
}