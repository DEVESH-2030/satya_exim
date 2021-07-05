<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    protected $table = 'social_media';

    protected $fillable = [
						    'facebook',
							'gmail',
							'twitter',
							'instagram'
						];		
}
