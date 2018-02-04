<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelReturn extends Model
{
	protected $table = 'hotel_returns';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business', 'hotel_id', 'content'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
