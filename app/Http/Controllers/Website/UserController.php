<?php

namespace App\Http\Controllers\Website;

use File;   
use Validator;  
use App\User;   
use App\Models\States;  
use App\Models\Cities;  
use App\Models\UsersOtp;    
use App\Models\Countries;   
use Illuminate\Http\Request;    
use App\Mail\EmailVerification; 
use App\Mail\ForgotOtpVerification; 
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Mail;        
use App\Http\Controllers\Controller;    
use Illuminate\Support\Facades\Hash;     
use Illuminate\Support\Facades\Input;   
use App\Http\Traits\MessageStatusTrait; 
    
class UserController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'User';


 # Bind location
 protected $view = 'website.';


 
#Bind User
 protected $user;
 protected $states;
 protected $cities;
 protected $userotp;
 protected $countries;
 /**
  * default constructor
  * @param
  * @return
  */
   function __construct(
                          User      $user, 
                          States    $states, 
                          UsersOtp  $userotp,
                          Cities    $cities, 
                          Countries $countries
                        )
     {
        $this->user         = $user;
        $this->states       = $states;
        $this->cities       = $cities;
        $this->userotp      = $userotp;
        $this->countries    = $countries;
        #initilize pafination from config
        $this->page = config('paginate.pagination');
     }
 
 /**
  * index page of user
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function index(Request $request)
 {  
    
        $relation = [ 
                  'country',
                  'state',
                  'city',
                  'otp',
                ];
      # fetch sub user list 
      $query = $this->user->where('email_verify', 1)
                          ->with($relation)->first();
      if (($request->mobile_no  == '') AND ($request->status  == '') AND ($request->first_name == '')) {
        # if nothing is given in input then return all
        $user = $query->orderBy('id','desc')
                     ->paginate($this->page);   
      } else {
        # Filtered Output
        $user = $query->UserAddedBetween($query, $request->status, $request->first_name, $request->mobile_no)
                              ->orderBy('id','desc')
                              ->paginate($this->page);
      }
      // dd($user);                  

    return view($this->view.'index')->with([
                                            'query'         => $query ?? [],
                                            'user'          => $user ?? [],
                                            'status'        => $request->status ?? '',
                                            'first_name'    => $request->first_name ?? '',
                                            'mobile_no'     => $request->mobile_no ?? '',
                                        ]);
   }

   /**
    * login page
    * @param
    * @return
    */
   public function loginPage()
   {
      try {
        return view('website.auth.login');
      } catch (\Exception $e) {
        dd($e);
      }
   }
   

   /**
    * user login
    * @param
    * @return
    */
    public function login(Request $request)
    {
        # check validation of credentials.
        // $validatedData  =   $request->validate([
        //                                 'email'        => 'required',
        //                                 'password'      => 'required',
        //                             ]);



        # get user name password credentials
        $credentials = $request->only('email', 'password');

        if (!Auth::guard('web')->attempt($credentials)) {
          # redirect back to login page with session message.
          $output = ['error' => 100, 'message' => 'Something went wrong'];
        } else {

            # get Login User
            $user = Auth::guard('web')->user();

            # Check login user is active or not.
            if($user->deleted_at != null) {

                # redirect to home page with success message inside session.
                Auth::guard('web')->logout();
                $output = ['error' => 100, 'message' => 'Your account is deleted.'];

            } elseif ($user->status != 1) {

                Auth::guard('web')->logout();
                $output = ['error' => 100, 'message' => 'Your account is inactive.'];

            } else {
                
                # redirect back to login page with session message.
                $output = ['success' => 200];
            } // end else of status.
        } // End Else of credentials.

        return $output; 
    }
    
    /**
     *
     * Logout login admin user.
     * @param 
     */
    public function logout()
    { 
        # Authenticate user logout! Session flush.
        Auth::guard('web')->logout();
        # redirect to login page.
        return redirect('/');
    }
   


   /**
   * Create page
   * @param Illuminate\Http\Request;
   * @return Illuminate\Http\Response;
   */
   public function register(Request $request)
   {
        $country = $this->countries
                      ->where('status','0')
                      ->select('id', 'name')
                      ->get(); 

        # fetch state list 
        $states = $this->states->where('country_id', 101)->get();
                    
        // $city = $this->cities
        //               ->select('state_id','id', 'name')
        //               ->get();
        $relation = [ 
                  'country',
                  'state',
                  'city',
                  'otp',
                ];
        $register = $this->user->with($relation)
                               ->orderBy('id','desc')
                               ->get();  
        // dd($register);                           
      return view('website.auth.register')->with([
                                        'register' => $register, 
                                        'country' => $country, 
                                        'states' => $states,
                                        // 'city' => $city
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
                'first_name'        => 'required',
                'last_name'         => 'required',
                'mobile_no'         => 'required',
                'email'             => 'required',
                'password'          => 'required|same:confirm_password',
                // 'country_id'        => 'required',
                'state_id'          => 'required',
                'city_id'           => 'required',
                'pincode'           => 'required',
                'address'           => 'required',
                'image'             => 'required',
            ];

        # validation checks
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
            // return response()->json([
            //                           (string)$this->errorKey=>(string)$this->errorStatus, 
            //                           'message' => 'Required field is missing.'
            //                         ]);
            return redirect()->back()->with(['error'=>'Required field is missing']);


         }

        try {
            
            $relation = [ 
                  'country',
                  'state',
                  'city',
                  'otp',
                ];
            $query = $this->user->with($relation);
            # check the requested user already exist or not
            $checkuser = $query->where(['mobile_no' => $request->mobile_no, 'email'  => $request->email])
                                ->first();
            if($checkuser)
            {   
              return redirect()->back()->with(['error' => 'Sorry, this user already exist.']);

              // return response()->json([
              //                           (string)$this->errorKey=>(string)$this->errorStatus, 
              //                           'message' => 'Sorry, this user already exist.'
              //                         ]);  
            }    

            # upload userImage
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                $file->move(public_path('images/profile_image/'), $filename);
                $userImage='images/profile_image/'.$filename;
            }else{
                $userImage = null;
            } 
            $otp = rand('1111','9999');            
            # request param     
            $arrayData = [  
                            'first_name'        => $request->first_name ?? '',
                            'last_name'         => $request->last_name ?? '',
                            'mobile_no'         => $request->mobile_no ?? '',
                            'email'             => $request->email ?? '',
                            'password'          => Hash::make($request->password) ?? '',
                            'show_password'     => $request->password ?? '',
                            'state_id'          => $request->state_id ?? '',
                            'city_id'           => $request->city_id ?? '',
                            'pincode'           => $request->pincode ?? '',
                            'address'           => $request->address ?? '',
                            'country_id'        => 101,
                            'status'            => 1, 
                            'email_verify'      => 1, 
                            'otp'               => $otp ?? '',
                            'image'             => $userImage ?? '',
                         ];     
           
            $createUser = $query->create($arrayData); 
            if($createUser)
            {
              return redirect()->back()->with(['success'=>'User Registered Successfully']);

            } else{

              return redirect()->back()->with(['errors'=>'Sorry Not Register']);
            }
            // return response()->json([
            //                           (string)$this->successKey=>(string)$this->successStatus, 
            //                           'message' => 'User Registered Successfully.'
            //                         ]);                      
        } catch (Exception $e) {    
           // dd($e);
            // return response()->json([
            //                           (string)$this->errorKey=>(string)$this->errorStatus, 
            //                           'message' => 'Something went wrong.'
            //                         ]); 
              return redirect()->back()->with(['errors'=>'Something went wrong']);

        }
       
  }



  /**
  * edit  page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
  public function update($id)
  {
    $user = $this->user
                      ->where('id', $id)
                      ->first(); 
    # Return data on edit page
    return view($this->view.'view-detail')->with(['user' => $user]);
  }

  /**
  * edit  page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
  public function editAccount($id)
  {
      $user = $this->user->where('id', $id)
                          ->first(); 

      # fetch state list 
      $states = $this->states->where('country_id', 101)->get();
      # fetch city list 
      $cities = $this->cities->where('state_id', $user->state_id)->get();
      // dd($cities);

      return view($this->view.'auth.edit-account')->with([
                                                        'user'          => $user,
                                                        'cities'        => $cities ?? [],
                                                        'states'        => $states ?? []
                                                      ]);
  }

  /**
  * edit user 
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function edit(Request $request, $id)
  {
      $data = [
                'first_name'        => 'required',
                'last_name'         => 'required',
                'mobile_no'         => 'required',
                'email'             => 'required',
                'state_id'          => 'required',
                'city_id'           => 'required',
                'pincode'           => 'required',
                'address'           => 'required',
            ];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
              return redirect()->back()->with(['error'=>'Required field is missing.']);

         }

        try {
          
           $query = $this->user->where('id', $id)->first();
           
            # upload userImage
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                File::delete(public_path($query->image));
                $file->move(public_path('images/profile_image/'), $filename);
                $profile_image='images/profile_image/'.$filename;
            }else{
                $profile_image = $query->image;
            }

            # request param
             $otp = rand('1111','9999');            
            # request param     
            $arrayData = [  
                            'first_name'        => $request->first_name ?? '',
                            'last_name'         => $request->last_name ?? '',
                            'mobile_no'         => $request->mobile_no ?? '',
                            'email'             => $request->email ?? '',
                            'state_id'          => $request->state_id ?? '',
                            'city_id'           => $request->city_id ?? '',
                            'pincode'           => $request->pincode ?? '',
                            'address'           => $request->address ?? '',
                            'country_id'        => 101,
                            'status'            => 1, 
                            'email_verify'      => 1, 
                            'otp'               => $otp ?? null,
                            'image'             => $profile_image,
                         ];

            #update
            $updateUser = $query->update($arrayData);  

            if($updateUser)
            {
              return redirect('user-profile')->with(['success'=>'Profile Updated Successfully']);

            } else{

              return redirect()->back()->with(['error'=>'Sorry Not Update']);
            }

        } catch (Exception $e) {
           
              return redirect()->back()->with(['error'=>'Something went wrong.']);

        }
       
   }



   /**
   * delete subcategory
   * @param $id
   * @return \Illuminate\Http\Response
   */
   public function delete($id)
   {
      $query = $this->user;

      #update deleted by
      $query->where('id', $id)->update(['deleted_by' => Auth::user()->id]);

      # delete subcategory by id
      $query->where('id', $id)->delete();
      
      # return success
      return  [$this->successKey  =>  $this->successStatus,  $this->messageKey  => $this->deleteMessage($this->type)];
   }

  /**
  * active deactive
  * @param $id
  * @return \Illuminate\Http\Response
  */ 
   public function status($id)
   {
      # initiate constructor
      $query =  $this->user;

      # get the status 
      $status =  $query->where('id', $id)->first()->status;

      # check status, if active
      if ($status == '1') {
         #message
         $message = $this->inActiveMessage($this->type);

         # deactive( update status to zero)
         $statusCode = '0';
      } else {
         #message
         $message = $this->activeMessage($this->type);

         # active( update status to one)
         $statusCode = '1';
      }
     
         # update status code
         $query->where('id', $id)->update(['status' => $statusCode]);

      # return success
      return  [$this->successKey  =>  $this->successStatus,  $this->messageKey  => $message];
   }



   /**
   * json responce of subcategory by category id by ajax for dependent dropdown respons
   * @param
   * @return \Illuminate\Http\Response in json
   */
    public function jsonSubcategory(Request $request)
   {
      # fetch subcategory 
      $user = $this->user
                     ->where('category_id',$request->category_id)
                     ->where('status', '1')
                     ->select('id', 'name')
                     ->get();

      # return json responce
      return response()->json($user);
   } 


   /**
  * json responce of cities by state id by ajax for dependent dropdown respons
  * @param
  * @return \Illuminate\Http\Response in json
  */
  public function jsonCities(Request $request)
  {
    # fetch cities 
    $cities = $this->cities
                   ->where('state_id',$request->state_id)
                   ->select('id', 'name')
                   ->get();

    # return json responce
    return response()->json($cities);
  } 


  public function forgotPass()
  {
      return view('website.auth.forgot-password');
  }

  # Forgot Password
    public function forgotd(Request $request)
    { 
        $validator = Validator::make($request->all(), [
          'email'     => 'required',
          // 'mobile_no'     => 'required',
         
        ]);
        # If Validation fails
        if($validator->fails())
        { 
          // dd($validator);
          return redirect()->back()->withErrors($validator); 
        }
        # Createv Object of user table
        $user = new User();
        $user->email        = $request->email ?? '';
        $user->otp          = rand('1111','9999') ?? '';
        $user->update();
      // dd($user);
        $userData = $this->user::first()->id;

        # Save Requested Data 

        // $subject   = 'devesh';
        // $email     = base64_encode('bit.devesh2030@gmail.com');
        // $message   = base64_decode($email);
        // $url   = '/email_verification';

        // Mail::to($request->email)->send(new EmailVerification($user,$subject,$message,$url));

          //   $subject = 'Forgot Password';
          //   $url = url('/email_verification').'/'.base64_encode($request->email ??'');
          // dd($url);
          //   $otp = rand('1111','9999'); 
          //   $user->otp = $otp;
          //   $user->save(); 
          //   $otp = $this->verifyEmailUrl($request->email);
          //   // dd($otp);   
          //    Mail::to($request->email)->send(new EmailVerification($user, $url, $subject, $otp));
        if($user){
          return redirect()->back()->with(['success' => 'Send otp on your email ']);
          // return redirect('website.auth.forget-password')->with(['success' => 'Verification link/otp send on your email ', 'url'=> $url]);
        }else{
          return redirect('website.auth.forgot-password')->withErrors(['error'=> 'Something went wrong !']);
        }
    }


     # ------ Forgot Password ------
    public function forgot(Request $request)
    {
         $validator = Validator::make($request->all(), [
          'email'     => 'required',
         
        ]);
        # If Validation fails
        if($validator->fails())
        { 
          // dd($validator);
          return redirect()->back()->withErrors($validator); 
        }

        try{
            $email = $request->input('email');
            $count = User::where(['email'=>$email])->count();
            if($count > 0)
            {
                $user = $this->user->where(['email'=>$email])->first();
                if($user){   
                $mobo =$user->email;
                // $otp = $this->sendSms($mobo);    //--- This is use to send OTP on email Number (Phone)
                $subject   = 'Request for Forgot Passord please erify your otp and click on url';
                $email     = base64_encode($request->email);
                $message   = base64_decode($email);
                $url       = url('/email_verification').'/'.base64_encode($request->email ??'');
                $otp = rand('0000','9999');      
                $user->save();
                Mail::to($request->email)->send(new ForgotOtpVerification($user,$url,$subject,$otp));
                if($user){
                    User::where('email',$mobo)->update(['otp' => $otp]);
                    UsersOtp::create(['otp'=>$otp, 'user_id'=>$user->id]);

                    return redirect()->back()->with(['success' => 'Send otp on your email please check']);
                   
                }
              }
            }

        }catch(\Exception $e){
          dd($e);
          // return redirect()->back()->with(['error' => 'Something went wrong !']);
                   
        }
    }


     public function sendSms($email)
    {
        try
        {
            $curl = curl_init();
            $rand = rand('1111','9999');
            $message = $email.' OPT for verify your email'.$rand ;
            curl_setopt_array($curl, array(
            CURLOPT_URL             => "http://2factor.in/API/V1/1064bf98-02a9-11eb-9fa5-0200cd936042/SMS/$email/$rand",
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => "",
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => "GET",
            CURLOPT_POSTFIELDS      => "",
            CURLOPT_HTTPHEADER      => array("content-type: application/x-www-form-urlencoded"),));
            $response = curl_exec($curl);
            //print_r($response); exit;
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) 
            {
                return $err;
            }else {
                return $rand;
            }
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        } 
    } 



    public function verifyEmailUrl($email)
    {
      $email=  base64_decode($email);
      try {

        # fetch user detail
        $user = User::where('email', $email)->first();

        if ($user == null) {

          return ['error' => 100, 'message' => 'Email not registered'];

        } else { 
          if ($user->email_verify == 0) {

            $data = ['email_verify' => '1', 'email_verified_at' => date('Y-m-d')];
                    $data = ['status' => '1'];
                        
            $user->update($data);

            // return redirect('/reset-password')->with(['success' => 'Email verified Forgot Password', 'email' => base64_decode($email)]);
             return view('website.auth.reset-password')->with(['email'=>$email]);

          } else {

            return ['error' => 100, 'message' => 'User already verified'];
          }
        }

      } catch (\Exception $e) {

        return ['error' => 100, 'message' => $e];
      }
    }

    public function resetPasswordVerify()
    {
      return view('website.auth.reset-password');
    }
    
    #Reset Password 
    public function resetPasswordSubmit(Request $request)
    {
      $data = [
                'newpassword'   => 'min:6|required|same:confirm_password',
                // 'confirm_password'   => 'required',
            ];

        # validation check
        # if input less then 6 digit password then get this error    
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
        {
          return redirect()->back()->with(['error'=>'Please enter more than 6 digit password.']);
        }
         
      $user = $this->user->select('email')->count();

      if($user){

        if ($request->newpassword == $request->confirm_password) {
          $this->user
               ->where('status','1')
               ->where('email',$request->email)
               ->update([
                  'password'      => Hash::make($request->newpassword ??''),
                  'show_password' => $request->newpassword ??'',
               ]);

          return redirect('/login')->with(['success'=>'Reset your password successfully.']);
        } else {

            return redirect('/login')->with('Error : Password and Confirm Password was not same.');
        }

        return redirect()->back()->with(['success'=>'Email verified ']);
      }else{

        return redirect()->back()->with(['error'=>'Your email not verified ']);
      }
  }

}
