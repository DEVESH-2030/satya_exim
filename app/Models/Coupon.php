<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
     # Define softdelete trait.
    use SoftDeletes;

    protected $table = 'coupons';

    protected $fillable = [
                        	'title',
                        	'coupon_code',
                            'discount_amount',
                            'start_date',
                            'end_date',
                            'status',
                        ];

    /**
    * define the scope variable to get category title and status
    * 
    * @param Query bulider, $product id.
    */
    public function scopeCouponAddedBetween($query, $status, $title, $coupon_code, $date)
    {
        # if status is not empty
        if ($status != '') {
            # return by status
            $query = $query->where('status', $status);
        }
    
        # if name is not empty
        if ($title != '') {
            # return by category          
            $query = $query->where('title','LIKE','%'. $title .'%');
        } 

        # if name is not empty
        if ($coupon_code != '') {
            # return by category          
            $query = $query->where('coupon_code','LIKE','%'. $coupon_code .'%');
        }

        # if name is not empty
        if ($date != '') {
            $date = explode(' - ', $date);
            // dd($date);
            $start_date = date('Y-m-d', strtotime($date[0]));
            $end_date = date('Y-m-d', strtotime($date[1]));
            # return by category          
            $query = $query->where('start_date','>=',$start_date)->where('end_date','<=',$end_date);
        }
       
        return $query;  
    }                   

}
