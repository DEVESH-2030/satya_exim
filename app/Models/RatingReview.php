<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RatingReview extends Model
{
     # Define softdelete trait.
    use SoftDeletes;

    protected $table = 'rating_reviews';

    protected $fillable = [
                        	'product_id',
                        	'user_id',
                            'rating',
                            'review',
                            'status',
                            'name',
                            'order_id',
                            'email'
                        ];

    #Relation with user Table
    public function userData()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }  

    #Relation with product table
    public function productData()
    {
        return $this->hasMany('App\Models\Product', 'id', 'product_id');
    }  


     /**
    * define the scope variable to get first name, mobile nomber and status
    * 
    * @param Query bulider, $user id.
    */
    public function scopeRatingreviewAddedBetween($rating, $status, $product_id, $user_id)
    {
  
        #if status is not empty
        if ($status != '') {
          #return by status
          $rating = $rating->where('status', $status);
        }
        
        #if product_id is not empty
        if ($product_id != '') {
          #return by product_id          
          $rating = $rating->where('product_id','LIKE','%'. $product_id .'%');
        }
       
        #if user_id is not empty
        if ($user_id != '') {
          #return by user_id          
          $rating = $rating->where('user_id','LIKE','%'. $user_id .'%');
        }
            
        return $rating;      
    }

}
