<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    protected $table = 'sub_categories';

    protected $fillable = [
                          	'category_id',
                          	'name', 
                            'slug', 
                          	'image', 
                          	'description', 
                          	'status'
                          ];

    
    # Relation with Category
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    } 

   /**
   * define the scope variable to get category title and status
   * 
   * @param Query bulider, $product id.
   */
    public function scopesubCategoryAddedBetween($query, $category_id, $status, $name)
    {
  
     # if status is not empty
     if ($status != '') {
       # return by status
       $query = $query->where('status', $status);
     }
    
    # if category_id is not empty
    if ($category_id != '') {
       # return by category_id          
       $query = $query->where('category_id', $category_id);
    }

    # if name is not empty
    if ($name != '') {
       # return by category          
       $query = $query->where('name','LIKE','%'. $name .'%');
    }


   return $query;  
  } 
}
