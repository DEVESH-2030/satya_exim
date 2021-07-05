<?php

namespace App\Http\Controllers\Auth;

use App\User;
Use Validator;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
	protected $user;

	function __construct(User $user){
		$this->user = $user;
	}

 	/**
    * View Index 
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
	public function index()
	{	
		#return user login page
		return view('website.auth.user-login');
	}
    


    # Login user
    /**
    * login
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function login(Request $request, $id)
    {
        # Validate request param      
        $validator = Validator::make($request->all(), [
           'email'    => 'required',
           'password' => 'required',
        ]);
        # if failed
        if ($validator->fails()) {  
         return redirect()->back();
        }
        # otherwise
        $userLogin = $request->only('email', 'password');
        $verify = $this->user::where(['status'=> 0])->first();

        # Check email 
        if($verify->email == $request->email && Hash::check($request->password, $verify->password))
        {  
          # check Password
         
            # Attempt Login
            if (!Auth::guard('web')->attempt($userLogin)) {   
              return redirect('/user-login')->with(['success' => 'Login successfully', 'userLogin'=> $userLogin]);
            } else {
              # if login
              return redirect('/user-login')->with(['error' => 'Somethin went wrong !']);
            }
        }else{
          	return redirect('/user-login')->with(['error' => 'Invalid email or password !']);
        }
    }
}
