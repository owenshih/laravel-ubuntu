<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundingItem extends Model
{
	protected $table = 'funding_items';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial_number', 'invoice', 'date', 'title', 'amount', 'compiled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
