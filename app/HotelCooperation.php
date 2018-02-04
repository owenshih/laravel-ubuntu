<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelCooperation extends Model
{
	protected $table = 'hotel_cooperations';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business', 'cooperation_item'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
