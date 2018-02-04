<?php

namespace App\Repositories\ShortMessageServiceExample;

interface ShortMessageServiceExampleInterface {
	public function getAll();

	public function getById($id);

	public function create($attributes);
 
	public function update($id, $attributes);

	public function delete($id);
}