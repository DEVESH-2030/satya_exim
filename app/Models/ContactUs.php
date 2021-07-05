<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
    						'mobile',
							'location',
							'address',
							'fax',
							'status'
						];

}
 