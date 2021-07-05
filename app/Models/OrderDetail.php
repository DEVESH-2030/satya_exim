<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;

    protected $table = 'order_details';

    protected $fillable = [
                            'order_unique_id',
                            'order_id',
                            'product_id',
                            'cart_id',
                            'quantity',
                            'transection_id',
                            'order_status',
                            'order_amount',
                            'payment_status',
                            'status',
    ];

    /**
     * has many relation to order table
     * @param
     * @return
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'order_id', 'order_unique_id');
    }
    
     /**
     * belongs top relation with cart
     * @param
     * @return
     */
    public function cartDetail()
    {
        return $this->hasMany('App\Models\Cart', 'id', 'cart_id');
    }

    /**
     * belongs relation to order table
     * @param
     * @return
     */
    public function mainOrder()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

    /**
     * belongs relation to product table
     * @param
     * @return
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
