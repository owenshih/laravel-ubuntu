<?php

namespace App\Repositories\FundingItem;

interface FundingItemInterface {
	public function getByItemLists($id);
 
	public function updateOrCreate($id, $attributes);
}