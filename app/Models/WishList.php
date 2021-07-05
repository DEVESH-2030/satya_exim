<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WishList extends Model
{
      # Define softdelete trait.
    use SoftDeletes;

    protected $table = 'wishlist';

    protected $fillable = [
                        	'user_id',
                        	'product_id',
                            'status'
                        ];

     /**
     * belongs relation to product table
     * @param
     * @return
     */
    public function product()
    {
        return $this->hasMany('App\Models\Product', 'id', 'product_id');
    }

}
