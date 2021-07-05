<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsMail extends Model
{
	protected $table = 'contact_us_mail';

    protected $fillable = [
					    	'user_id',
							'first_name',
							'last_name',
							'mobile',
							'email',
							'message',
							'status'
						];

	#Relation with contact us mail Table
    public function ContactUsMail()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }  						
}
