<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortMessageServiceExample extends Model
{
	protected $table = 'short_message_service_examples';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
