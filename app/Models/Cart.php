<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    
    # define table
    protected $table = 'cart';

    # define fillable
    protected $fillable = [
                           'user_id',
                           'product_id',
                           'quantity',
                           'cart_status',
                           'status'
    ];

    /**
     * belongs to relation with product model
     * @param
     * @return
     */
    public function products()
    {
    	return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    } 

    /**
     * has many relation with self
     * @param
     * @return
     */
    public function numberOfProduct()
    {
      return $this->hasMany('App\Models\Cart', 'product_id', 'product_id');
    }
          
}
