<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
     # Define softdelete trait.
    use SoftDeletes;

    protected $table = 'colors';

    protected $fillable = [
                        	'name',
                        	'color_code',
                            'status'
                        ];


}
