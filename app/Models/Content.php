<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    protected $table = 'content_managements';

    protected $fillable = [
    	'title',
    	'slug',
    	'image',
    	'description',
    	'status',
    ];
}
