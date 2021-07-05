<?php

namespace App\Http\Controllers\Website;

use File;   
use Validator;  
use App\User;   
use App\Models\ContactUsMail;  
use App\Models\Settings;  
use App\Mail\EmailVerification;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;    
use App\Http\Controllers\Controller;    
use Illuminate\Support\Facades\Hash;     
use Illuminate\Support\Facades\Input;   
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

use App\Http\Traits\MessageStatusTrait; 
    
class ContactUsMailController extends Controller
{
 	use MessageStatusTrait;

 	# Bind Type
 	protected $type = 'User';


 	# Bind location
 	protected $view = 'website.';


 
	#Bind User
 	protected $user;
 	protected $contactusmail;
  protected $settings;
 
 	/**
  	* default constructor
  	* @param
  	* @return
  	*/
   	function __construct(User $user, ContactUsMail $contactusmail, Settings $settings)
    {
        $this->user         		= $user;
        $this->contactusmail    = $contactusmail;
        $this->settings         = $settings;

        #initilize pafination from config
        $this->page = config('paginate.pagination');
    	}
 
 	
 	/**
  	* index page of contactusmail
  	* @param Illuminate\Http\Request;
  	* @return Illuminate\Http\Response;
  	*/
 	public function index(Request $request)
 	{  
      	# fetch contactusmail list 
      	$query = $this->contactusmail->where('email_verify', 1)
                         		   ->first();
      	if (($request->status  == '') AND ($request->first_name == '')) {
        	# if nothing is given in input then return all
        	$contactusmail = $query->orderBy('id','desc')
                     ->paginate($this->page);
      	} else {
        	# Filtered Output
        	$contactusmail = $query->contactusmailAddedBetween($query, $request->status, $request->first_name, $request->mobile)
                              ->orderBy('id','desc')
                              ->paginate($this->page);
      	}
        
    	return view($this->view.'contact-us')->with([
                                            'query'         	=> $query ?? [],
                                            'contactusmail' 	=> $contactusmail ?? [],
                                            'status'        	=> $request->status ?? '',
                                            'mobile'    		  => $request->mobile ?? '',
                                        ]);
  }



    /**
    * create subcategory
    * @param Illuminate\Http\Request; 
    * @return Illuminate\Http\Response;
    */
    public function store(Request $request)
    {
// dd($request->all());
      $data = [
                'first_name'   => 'required',
                'last_name'    => 'required',
                'mobile'       => 'required',
                'email'        => 'required',
                'message'      => '',
            ];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
         
            return redirect()->back()->with('error', 'Required field is missing.');                                             
            
         }

        try {
            $relation = [
            	'ContactUsMail'
            ];
            
            $user = $this->user->with($relation)->first();
            $setting = $this->settings->first();
            $query = $this->contactusmail->where('user_id',$user->id);

            # request param     
            $arrayData = [  
                            'first_name'        => $request->first_name ?? '',
                            'last_name'         => $request->last_name ?? '',
                            'mobile'         	  => $request->mobile ?? '',
                            'email'             => $request->email ?? '',
                            'message'           => $request->message ?? '',
                            // 'user_id'           => $user->id ?? '', 
                            'status'            => 1, 
                         ];  
                            
            $subject = 'Request For Enquery';
            // $url = url('/send-mail').'/'.base64_encode($request->email);
            // $contactusmail = $this->contactusmail->save();

            $contactusmail = $query->create($arrayData); 


            Mail::to($setting->email)->send(new EmailVerification($contactusmail, $subject, $arrayData));
           
            return redirect()->back()->with('success', 'Send Your Mail Successfully.');                                             
        } catch (Exception $e) {    
           // dd($e);
            // return response()->json([
            //                           // (string)$this->errorKey=>(string)$this->errorStatus, 
            //                           'message' => 'Something went wrong.'
            //                         ]);
            return redirect()->back()->with('error', 'Something went wrong.');                                             

        }
       
  }


}
