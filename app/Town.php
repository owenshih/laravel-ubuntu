<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
	protected $table = 'towns';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id', 'postal', 'chinese_name', 'engilsh_name', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}