<?php

use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentSeered extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$contentData =[
					[	'title' => 'About Us',      		'slug' => 'about_us',    		],
					[	'title' => 'Privacy Policy',     	'slug' => 'privacy_policy',    	],
					[	'title' => 'Term Condition',    	'slug' => 'term_condition',    	],
					                      
					
    	];	

		foreach ($contentData as $data) {
   		 							$arrayData=	[
   		 										'title'       	=> $data['title'],
                                     			'slug'       	=> $data['slug'],
                                    ]; 
			$check = Content::where('title', $data['title'])->first();
			if (isset($check->id)) {
				
        		$check->update($arrayData);
			} else {
				Content::create($arrayData);
			}
		}
 	} 

}
