<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
	protected $table 	= 'settings';
	
    protected $fillable = [
					    	'mobile',
							'location',
							'address',
							'fax',
							'status',
							'email',
							'logo',
							'favicon',
							'description',
							'facebook',
							'gmail',
							'twitter',
							'instagram'
					    ];
}
