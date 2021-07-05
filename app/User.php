<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'first_name',
                            'last_name',
                            'mobile_no',
                            'email',
                            'password',
                            'show_password',
                            'country_id', 
                            'state_id',
                            'city_id',
                            'pincode',
                            'otp',
                            'address',
                            'email_verify',
                            'image',
                            'status',
                        ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password',
    ];

    #Relation with otp Table
    public function otp()
    {
        return $this->belongsTo('App\Models\UsersOtp', 'user_id', 'id');
    } 

    #Relation with Country Table
    public function country()
    {
        return $this->belongsTo('App\Models\Countries', 'country_id', 'id');
    } 
    
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

    #Relation with contact us mail Table
    public function ContactUsMail()
    {
        return $this->hasOne('App\Models\ContactUsMail', 'user_id', 'id');
    }   

    #Relation with user address Table
    public function userAddress()
    {
        return $this->belongsTo('App\Models\UserAddress', 'user_id', 'id');
    }   
    /**
    * define the scope variable to get first name, mobile nomber and status
    * 
    * @param Query bulider, $user id.
    */
    public function scopeUserAddedBetween($user, $query, $status, $first_name, $mobile_no)
    {
  
      #if status is not empty
      if ($status != '') {
        #return by status
        $query = $query->where('status', $status);
      }
    
      #if first_name is not empty
      if ($first_name != '') {
        #return by first_name          
        $query = $query->where('first_name','LIKE','%'. $first_name .'%');
      }

      #if mobile_no is not empty
      if ($mobile_no != '') {
        #return by mobile_no          
        $query = $query->where('mobile_no','LIKE','%'. $mobile_no .'%');
      }

      return $query;  
    }


}
