<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
     # Define softdelete trait.
    use SoftDeletes;

    protected $table = 'variants';

    protected $fillable = [
                        	'name',
                            'status'
                        ];


  /**
   * define the scope variable to get category title and status
   * 
   * @param Query bulider, $product id.
   */
  public function scopevariantAddedBetween($query, $status, $name)
  {
  
     # if status is not empty
     if ($status != '') {
       # return by status
       $query = $query->where('status', $status);
     }
    
   # if name is not empty
    if ($name != '') {
       # return by category          
       $query = $query->where('name','LIKE','%'. $name .'%');
    }


   return $query;  
  }                        


}
