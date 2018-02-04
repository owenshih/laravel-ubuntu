<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortMessageServiceHistory extends Model
{
	protected $table = 'short_message_service_histories';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'title', 'content', 'response', 'response_c', 'business','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
