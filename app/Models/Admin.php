<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_logins';  

    protected $fillable = [
    	'name',
    	'mobile',
    	'email',
        'gender',
    	'email_verified_at',
    	'image',
    	'password',
    	'password_plain_text',
    	'forgot_password',
    	'otp',
    	'status',
    	'deleted_at'
    	
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
