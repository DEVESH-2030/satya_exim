<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';

    protected $fillable = [
                            'user_id',
                            'order_id',
                            'transection_id',
                            'cart_id',
                            'address_id',
                            'order_amount',
                            'order_status',
                            'payment_status',
                            'status',
    ];

    /**
     * belongs top relation with cart
     * @param
     * @return
     */
    public function cartDetail()
    {
        return $this->belongsTo('App\Models\Cart', 'cart_id', 'id');
    }

    /**
     * belongs top relation with user
     * @param
     * @return
     */
    public function userDetail()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * belongs top relation with order status
     * @param
     * @return
     */
    public function orderStatus()
    {
        return $this->belongsTo('App\Models\OrderStatus', 'id', 'order_id');
    }
    

    /**
     * has many relation to order table
     * @param
     * @return
     */
    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_unique_id', 'order_id');
    }

    /**
    * define the scope variable to get all order 
    * 
    * @param Query bulider.
    */
    public function scopeallOrderAddedBetween($query, $order_id, $status)
    {
        # if status is not empty 
        if ($status != '') {
           # return by status
           $query = $query->where('order_status', $status);
        }

        # if order_id is not empty
        if ($order_id != '') {
           # return by order_id          
           $query = $query->where('order_id', $order_id);
        }

       
        return $query;  
    }





    /**
    * define the scope variable to get all order 
    * 
    * @param Query bulider.
    */
    public function scopepaymentAddedBetween($query, $order_id, $user_id)
    {
        # if order_id is not empty
        if ($order_id != '') {
           # return by order_id          
           $query = $query->where('order_id', $order_id);
        }

        # if user_id is not empty 
        if ($user_id != '') {
           # return by user_id
           $query = $query->where('user_id', $user_id);
        }

       // // if user_name is not empty 
       //  if ($user_name != '') {
       //     # return by user_name
       //     $query = $query->where('first_name','LIKE','%'. $user_name .'%');
       //  }

        // # if email is not empty 
        // if ($email != '') {
        //    # return by email
        //    $query = $query->where('email','LIKE','%'. $email.'%');
        // }
       
        return $query;  
    }


    /**
    * define the scope variable to get Reports
    * 
    * @param Query bulider.
    */
    public function scopereportAddedBetween($query,  $order_id, $user_id)
    {
       # if order_id is not empty
        if ($order_id != '') {
           # return by order_id          
           $query = $query->where('order_id', $order_id);
        }

        # if user_id is not empty 
        if ($user_id != '') {
           # return by user_id
           $query = $query->where('user_id', $user_id);
        }

        # if user_name is not empty
        // if ($user_name != '') {
        //    # return by user_name          
        //   $query = $query->where('user_id','LIKE','%'. $user_name .'%');

        // }

        # if purchaseDate is not empty
        // if ($purchaseDate != '') {
        //    # return by purchaseDate          
        //    $query = $query->where('created_at', $purchaseDate);
        // }

        # if completedDate is not empty
        // if ($completedDate != '') {
        //    # return by completedDate          
        //    $query = $query->where('updated_at', $completedDate);
        // }
       
        return $query;  
    }
    
}
