<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
                            'title',
                            'sub_title',
                            'slug',
                            'product_type',
                            'category_id',
                            'sub_category_id',
                            'brand_id',
                            'variant_id',
                            'color_id',
                            'original_price',
                            'selling_price',
                            'total_stock',
                            'remaning_stock',
                            'short_description',
                            'long_description',
                            'key_feature',
                            'feature_status',
                            'status',
                            'discount_product_percentage',
                        ];

    # Relation with Sub Category
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
    } 

    # Relation with Category
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    } 

    # Relation with Brand
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }

   # Relation with Color
    public function color()
    {
        return $this->belongsTo('App\Models\Color', 'color_id', 'id');
    }

    # Relation with Variant
    public function variant()
    {
        return $this->belongsTo('App\Models\Variant', 'variant_id', 'id');
    }

    # Relation with Product Image
    public function productImage()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id');
    } 

    # Relation Rating and review
    public function ratingAndReview()
    {
        return $this->belongsTo('App\Models\RatingReview', 'product_id', 'id');
    }


    /**
   * define the scope variable to get category title and status
   * 
   * @param Query bulider, $product id.
   */
    public function scopeproductAddedBetween($query, $product_id, $category_id, $sub_category_id, $status, $name)
    {
   // dd($product_id);
     # if status is not empty
     if ($status != '') {
       # return by status
       $query = $query->where('status', $status);
     }
    
    # if product_id is not empty
    if ($product_id != '') {
       # return by product_id          
       $query = $query->where('id', $product_id);
    }
   
    # if category_id is not empty
    if ($category_id != '') {
       # return by category_id          
       $query = $query->where('category_id', $category_id);
    }

    # if sub_category_id is not empty
    if ($sub_category_id != '') {
       # return by sub_category_id          
       $query = $query->where('sub_category_id', $sub_category_id);
    }

    # if name is not empty
    if ($name != '') {
       # return by category          
       $query = $query->where('title','LIKE','%'. $name .'%');
    }


   return $query;  
  } 


}
