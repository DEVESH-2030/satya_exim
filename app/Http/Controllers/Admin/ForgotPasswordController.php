<?php

namespace App\Http\Controllers\Admin;

use File;   
use Validator;  
use App\Models\Admin;
use Illuminate\Http\Request;    
use App\Mail\EmailVerification; 
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Mail;        
use App\Http\Controllers\Controller;    
use Illuminate\Support\Facades\Hash;     
use Illuminate\Support\Facades\Input;   
use App\Http\Traits\MessageStatusTrait; 
    
class ForgotPasswordController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'Forgot';


 # Bind location
 protected $view = 'admin.auth.';


 
#Bind User
 protected $admin;

 /**
  * default constructor
  * @param
  * @return
  */
  function __construct(Admin $admin)
  {
    $this->admin  = $admin;
       
  }

  public function index()
  {
    return view($this->view.'forgot');
  }

  public function resetPage()
  {
    $admin = $this->admin
                        ->where('status','1')
                        ->first();
    return view($this->view.'reset')->with(['admin'=>$admin]);
  }


  public function forgotPasswordAdmin(Request $request)
  {   
      $data = [ 'email'  => 'required' ];
      # validation check
      $validator = Validator::make($request->all() , $data);
      if($validator->fails())
      {
          // return response()->json([
          //                           (string)$this->errorKey=>(string)$this->errorStatus, 
          //                           'message' => 'Required field is missing.'
          //                         ]);
          return redirect()->back()->with('error', 'Required field is missing'); 
      }
      
      $email = $request->input('email');
      $admin = $this->admin->where('email',$email)->first();
      try {
        # request param  
        if(isset($admin->email))
        {
          $adminId = $this->admin->where('email',$request->email)->first();
          if($adminId){
            
              $otp    = rand('1111','9999');
              $sendOtp = $this->admin->where('email',$request->email)->update(['otp'=> $otp, 'status'=> '1']); 

            }else{

                  $sendOtp = $this->admin->where('email',$request->email)->create(['otp'=> $otp, 'status'=> '1']); 
            }

            return redirect('/admin/reset-password')->with('success', 'Email verified please reset your password.', ['email'=>$email]);                                            
          }else {

            return redirect()->back()->with('error', 'Email not registered.');                                            
          }   
        }catch (Exception $e) { 

            return redirect()->back()->with('error', 'Something went wrong');
        }
  } 

  # Reset Admin Password
  public function resetPasswordSubmit(Request $request)
  {
      $admin = $this->admin->select('email')->count();
      if($admin){

        if ($request->newpassword == $request->confirm_password) {
          $this->admin
               ->where('status','1')
               ->update([
                  'password'            => Hash::make($request->newpassword ??''),
                  'password_plain_text' => $request->newpassword ??'',
                  'forgot_password'     => 1
               ]);

          return redirect('admin/admin-login')->with(['success'=>'Reset your password successfully please login ']);
        } else {

            return redirect()->back()->with(['error'=>'New password and Confirm password was not same']);
        }
      }
  }
     
}
