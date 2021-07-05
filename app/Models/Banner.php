<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
     # Define softdelete trait.
    use SoftDeletes;

    protected $table = 'banners';

    protected $fillable = [
                        	'name',
                        	'image',
                            'status'
                        ];


}
