<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsAlert extends Model
{
	protected $table = 'news_alerts';

    protected $fillable = [
						    'email',
							'status'
						];		
}
