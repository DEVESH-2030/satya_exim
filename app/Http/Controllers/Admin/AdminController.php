<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Response;
use Validator;
use File;
use Hash;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Http\Traits\MessageStatusTrait;

class AdminController extends Controller
{
    # use message status trait.
    use MessageStatusTrait;

    #Bind the Admin Model.
    protected $admin;

    # Bind view path.
    protected $view = 'admin.auth.';

    # Bind the message variable name.
    protected $type  =  'Admin ';

    /**
     *
     * Define the constructor of controller.
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin   =  $admin;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->check() ) {
           return redirect()->route('home');
        }else{
        # redirect to login page.
        return view($this->view.'login');
       } 
    }

    /**
     * Do login user with his username name and password.
     * 
     * @param Request $request.
     */
    public function login(Request $request)
    {
        # check validation of credentials.
        $validatedData  =   $request->validate([
                                        'email'     => 'required',
                                        'password'      => 'required',
                                    ]);

        # get user name password credentials
        $credentials = $request->only('email', 'password');

        if (!Auth::guard('admin')->attempt($credentials)) {
            # redirect back to login page with session message.
           return  redirect()->back()
                            ->withErrors([$this->credentialNotMatchKey => $this->credentialNotMatch()])->withInput();
        } else {
            # get Login User
            $user = Auth::guard('admin')->user();

            # Check login user is active or not.
            if($user != '') {
                # redirect to home page with success message inside session.
                return  redirect()->route('home')
                                    ->withErrors([$this->signInSuccessfullyKey => $this->signInMessaage()]);
            } else {
                
                Auth::guard('admin')->logout();
                # redirect back to login page with session message.
                return  redirect()->back()
                                ->withErrors([$this->userNotActiveKey => $this->userNotAciveMessage()]);
            } // end else of status.
        } // End Else of credentials.
    }
    
    /**
     *
     * Logout login admin user.
     * @param 
     */
    public function logout()
    { 
        # Authenticate user logout! Session flush.
        Auth::guard('admin')->logout();
        # redirect to login page.
        return $this->index();
    }



/** update profile */
    public function Profile(Request $request)
    {
        $auth_id = Auth::guard('admin')->user()->id;
        $getInfo = Admin::where('id', $auth_id)->first();
        return view('admin.profile')->with(['getInfo' => $getInfo]);
        
    }

    public function Update_Profile(Request $request)
    {
        $auth_id = Auth::guard('admin')->user()->id;
        $dataa = ['name' => 'required','email' => 'required','radio2' => 'required'];
        # validation check
        $validator1 = \Validator::make($request->all() , $dataa);
        if ($validator1->fails())
        {
            return Response::json(array(
                'error' => '0',
                'message' => 'Required Fields are missing.'
            ));
        }

        $emailCheck = Admin::where('email',$request->email)
                ->where('id', '!=',$auth_id)
                ->first();
            if ($emailCheck)
            {
                return Response::json(array(
                    'error' => '0',
                    'message' => 'Sorry,This Email Already Exist.'
              ));
            }

        $pro = Admin::where('id', $auth_id)->first();
        try
        {
            $pro->name   = $request->name;
            $pro->gender = $request->radio2;
            $pro->mobile = $request->phone_number;
            $pro->email  = $request->email;

            if ($request->hasfile('image'))
            {
                $data = ['image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'];
                $validator = \Validator::make($request->all() , $data);
                if ($validator->fails())
                {
                    return Response::json(array(
                        'error' => '0',
                        'message' => 'chosse Photo on valid format.'
                    ));    
                }
                $file = $request->file('image');
                $name = $file->getClientOriginalName(); // getting image name
                $date = date('y-m-d');
                $randNumber = rand(0000, 9999);
                $filename = $date . '_' . $randNumber . '_' . $name;
                File::delete($pro->image);
                $file->move('assets/image/admin_image/', $filename);
                $image = 'assets/image/admin_image/' . $filename;
                $pro->image = $image;
            }
            $pro->save();
                   return Response::json(array(
                        'success' => '200',
                        'message' => 'profile updated Successfully.'
                    ));     
        }
        catch(\Exception $e)
        {
           dd($e);
            return Response::json(array(
                    'error' => '0',
                    'message' => 'something went wrong'
                ));
        }
    }

   /**
     * Change password 
     */
    public function post_change_password(Request $request)
    {
       $data = ['old_password' => 'required', 'new_password' => 'required' , 'conf_password' => 'required'];
        $validator = \Validator::make($request->all() , $data);
        if ($validator->fails())
        {
            return Response::json(array(
                        'error' => '0',
                        'message' => 'Required Fields is missing'
                    )); 
        }else{
            if ($request->new_password != $request->conf_password)
            {
                return Response::json(array(
                        'error' => '0',
                        'message' => 'Password Not Matched'
                    ));
            }
            $usernameCheck = Admin::where('id', Auth::guard('admin')->user()
                ->id)
                ->first();
            if ($usernameCheck)
            {
                if (Hash::check($request->old_password, $usernameCheck->password))
                {
                    $usernameCheck->password = \Hash::make($request->new_password);
                    $usernameCheck->save();
                     return Response::json(array(
                        'success' => '200',
                        'message' => 'Password Update Successfully'
                    ));
                }else{
                     return Response::json(array(
                        'error' => '0',
                        'message' => 'Incorrect Old Password'
                     ));   
                }

            }else{
                return Response::json(array(
                        'error' => '0',
                        'message' => 'user not found'
                     ));   
            }
        }
    }


/////////////////////////////
}
