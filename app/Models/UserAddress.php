<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserAddress extends Model
{
    protected $table = 'user_address';

    protected $fillable = [
						    	'user_id', 
								'name',
								'mobile',
								'state_id',
								'city_id',
								'pincode',
								'house_no_or_building_name',
								'landmark',
								'address',
                                'address_type',
								'status',
						    ];

    #Relation with state Table
    public function state()
    {
        return $this->belongsTo('App\Models\States', 'state_id', 'id');
    } 

    # Relation with city Table
    public function city()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id', 'id');
    }
    
	#Relation with user address Table
    public function userData()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }						    
}
