<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
	protected $table = 'fundings';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial_number', 'title', 'content', 'date_start', 'date_end', 'total','item_lists', 'status', 'business','apply_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
