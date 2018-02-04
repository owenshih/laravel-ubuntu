<?php

namespace App\Repositories\Funding;

interface FundingInterface {
	public function getAll($request);

	public function getById($id);

	public function create($request);
 
	public function update($id, $request);

	public function delete($id);
}