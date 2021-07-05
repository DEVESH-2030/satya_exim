<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersOtp extends Model
{
    protected $table = 'user_otp';
    
    protected $fillable = [
    	'user_id',
    	'otp', 
    ];
}
