<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
	protected $table = 'hotels';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_number', 'account_type', 'chinese_name', 'engilsh_name', 'type', 'postal','city', 'town', 'address','map_api_lat', 'map_api_lng', 'phone','fax', 'website', 'facebook','main_name', 'main_title', 'main_tel','main_phone', 'main_fax', 'main_email','admin_name', 'admin_title', 'admin_tel','admin_phone', 'admin_fax', 'admin_email','bank_name', 'bank_branch', 'bank_account','bank_title', 'pay_type', 'invoice_number','invoice_title', 'status', 'signing_date','signing_business', 'e_contract', 'p_contract','dev_level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
