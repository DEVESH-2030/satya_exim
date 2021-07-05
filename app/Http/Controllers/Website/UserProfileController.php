<?php

namespace App\Http\Controllers\Website;

use File;   
use Validator;  
use App\Models\WishList;
use App\Models\RatingReview;
use App\User;   
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\UserAddress;  
use App\Models\States;  
use App\Models\Cities;  
use App\Models\UsersOtp;    
use App\Models\Countries;   
use Illuminate\Http\Request;    
use App\Mail\EmailVerification; 
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Mail;        
use App\Http\Controllers\Controller;    
use Illuminate\Support\Facades\Hash;     
use Illuminate\Support\Facades\Input;   
use App\Http\Traits\MessageStatusTrait; 
    
class UserProfileController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'Profile';


 # Bind location
 protected $view = 'website.auth.';


 
#Bind User
 protected $wishlist;
 protected $user;
 protected $states;
 protected $cities;
 protected $userotp;
 protected $countries;
 protected $useraddress;
 protected $cart;
 protected $order;
 protected $product;
 protected $orderdetail;
 protected $ratingreview;
 /**
  * default constructor
  * @param
  * @return
  */
   function __construct(
                          Cart          $cart,
                          Order         $order,
                          Product       $product,
                          OrderDetail   $orderdetail,
                          User      $user, 
                          States    $states, 
                          UsersOtp  $userotp,
                          Cities    $cities, 
                          WishList  $wishlist,
                          Countries $countries,
                          UserAddress $useraddress,
                          RatingReview $ratingreview

                        )
     {
        $this->wishlist     = $wishlist;
        $this->user         = $user;
        $this->states       = $states;
        $this->cities       = $cities;
        $this->userotp      = $userotp;
        $this->countries    = $countries;
        $this->useraddress  = $useraddress;
        $this->cart         = $cart;
        $this->order        = $order;
        $this->product      = $product;
        $this->orderdetail  = $orderdetail;
        $this->ratingreview = $ratingreview;
        #initilize pafination from config
        // $this->page = config('paginate.pagination');
     }
 
  /**
  * index page of user
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
    public function index(Request $request)
    {  

        
        # fetch all orders
        $ordersList = $this->order
                        ->where('payment_status', '1')
                        ->orderBy('id', 'DESC')
                        ->get();
       
        $relation = [ 
                        'userAddress',
                        'country',
                        'state',
                        'city',
                        'otp',
                    ];
        $relations = [
                        'state',
                        'city',
                      ];        
       
        # fetch user detail when login 
        $user = $this->user->where('id',Auth::user()->id)
                                                    ->with($relation)
                                                    ->first();
             
        # Get User Address data                                            
        $userAddress = $this->useraddress->with($relations)
                                          ->where('status', 1)
                                          ->where('user_id', Auth::user()->id)
                                          ->get();
        #Get Wishlist                                   
        $wishlist = $this->wishlist->with('product')
                                    ->with('product.productImage')
                                    ->where('status', 1)
                                    ->get();

        return view($this->view.'profile')->with([
                                                'user'         => $user ?? [],
                                                'ordersList'   => $ordersList ?? [],
                                                'userAddress'  => $userAddress ?? [],
                                                'wishlist'     => $wishlist ?? [],
                                            ]);
    }

    /**
    * create brand page
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function create(Request $request)
    { 
        # fetch state list 
        $states = $this->states->where('country_id', 101)->get();
        // return response()->json($states);

        return view($this->view. 'profile-tab.add-address-model')->with([
                                                                          'states'    => $states ?? []
                                                                        ]);
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


    /**
    * create user Address
    * @param Illuminate\Http\Request; 
    * @return Illuminate\Http\Response;
    */
    public function storeAddress(Request $request)
    {
      // dd($request->all());
        $data = [ 
                    'name'                        => 'required', 
                    'mobile'                      => 'required', 
                    'pincode'                     => 'required', 
                    'state_id'                    => 'required', 
                    'city_id'                     => 'required', 
                    'house_no_or_building_name'   => 'required', 
                    'landmark'                    => 'required', 
                    'address'                     => 'required', 
                    'address_type'                => 'required', 
                ];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
        {
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Required field is missing.'
                                    ]);
        }
        $user = $this->user
                          ->where('email_verify', 1)
                          ->where('id',Auth::user()->id)
                          ->first();  
                         // dd($user); 
        try {
            # request param     
            $arrayData = [  
                            'user_id'                     => $user->id ?? '',
                            'name'                        => $request->name ?? '', 
                            'mobile'                      => $request->mobile ?? '', 
                            'pincode'                     => $request->pincode ?? '', 
                            'state_id'                    => $request->state_id ?? '', 
                            'city_id'                     => $request->city_id ?? '', 
                            'house_no_or_building_name'   => $request->house_no_or_building_name ?? '', 
                            'landmark'                    => $request->landmark ?? '', 
                            'address'                     => $request->address ?? '', 
                            'address_type'                => $request->address_type ?? '', 
                         ];    

            $createUser = $this->useraddress->create($arrayData); 
          
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Add Address Successfully.'
                                    ]);                      
        } catch (Exception $e) {    
           // dd($e);
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Something went wrong.'
                                    ]);  
        }
    }

    /**
  * edit  page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
  public function update($id)
  {
        $useraddress = $this->useraddress
                                        ->where('id', $id)
                                        ->first(); 
        # fetch state list 
        $states = $this->states->where('country_id', 101)->get();
        $cities = $this->cities->where('state_id', $useraddress->state_id ??'')->get();
        return view($this->view. 'profile-tab.edit-address-model')->with([
                                                                        'cities'        => $cities ?? [],
                                                                        'useraddress'   => $useraddress ?? [],
                                                                        'states'        => $states ?? []
                                                                      ]); 
  }

    /**
  * edit user 
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function editAddress(Request $request, $id)
  {
       $data = [ 
                    'name'                        => 'required', 
                    'mobile'                      => 'required', 
                    'pincode'                     => 'required', 
                    'state_id'                    => 'required', 
                    'city_id'                     => 'required', 
                    'house_no_or_building_name'   => 'required', 
                    'landmark'                    => 'required', 
                    'address'                     => 'required', 
                    'address_type'                => 'required', 
                ];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
        {
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Required field is missing.'
                                    ]);
        }

            // $user = $this->user->where('id', $id)->first();
            $userid = $this->useraddress->where('user_id', $id)->first();
            $user = $this->user
                          ->where('email_verify', 1)
                          ->where('id',Auth::user()->id)
                          ->first();   
            # request param
        try {
            # request param     
            $arrayData = [  
                            'user_id'                     => $user->id ?? '',
                            'name'                        => $request->name ?? '', 
                            'mobile'                      => $request->mobile ?? '', 
                            'pincode'                     => $request->pincode ?? '', 
                            'state_id'                    => $request->state_id ?? '', 
                            'city_id'                     => $request->city_id ?? '', 
                            'house_no_or_building_name'   => $request->house_no_or_building_name ?? '', 
                            'landmark'                    => $request->landmark ?? '', 
                            'address'                     => $request->address ?? '', 
                            'address_type'                => $request->address_type ?? '', 
                         ];     
            $createUser = $this->useraddress->where('id', $id)->update($arrayData); 
          
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Address Updated Successfully.'
                                    ]);   
                                                       
        } catch (Exception $e) {    
           // dd($e);
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Something went wrong.'
                                    ]);  
        }
       
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
        return redirect('/profile');
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
                      // ->orderBy('id','desc')
                      ->select('id', 'name')
                      ->get(); 

        $state = $this->states
                      // ->where(['country_id'=>$country])
                      // ->orderBy('id','desc')
                      ->select('country_id','id', 'name')
                      ->get(); 
                    
        $city = $this->cities
                      // ->where(['state_id'=>'id'])
                      // ->orderBy('id','desc')
                      ->select('state_id','id', 'name')
                      ->get();
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
        return view('website.auth.register')->with(['register' => $register, 'country' => $country, 'state' => $state,'city' => $city]);
    }

    /**
    * create subcategory
    * @param Illuminate\Http\Request; 
    * @return Illuminate\Http\Response;
    */
    public function store(Request $request)
    {

        $data = [
                'first_name'        => 'required',
                'last_name'         => 'required',
                'mobile_no'         => 'required',
                'email'             => 'required',
                'password'          => 'required|same:confirm_password',
                'country'           => 'required',
                'state'             => 'required',
                'city'              => 'required',
                'pincode'           => 'required',
                'address'           => 'required',
                'image'             => 'required',
            ];

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

        try {
            
            $relation = [ 
                  'country',
                  'state',
                  'city',
                  'otp',
                ];
            $query = $this->user->with($relation);
            # check the requested sub category already exist or not
            $checkuser = $query->where('mobile_no',$request->mobile_no)
                               ->where('email',$request->email)
                                ->first();
            if($checkuser)
            {   
              // return response()->json([
              //                           (string)$this->errorKey=>(string)$this->errorStatus, 
              //                           'message' => 'Sorry, this user already exist.'
              //                         ]);  
              return redirect()->back()->with('error', 'Sorry, this user already exist');
            }    

             # upload userImage
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                $file->move(public_path('images/user_image/'), $filename);
                $userImage='images/user_image/'.$filename;
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
                            'confirm_password'  => $request->password ?? '',
                            'country_id'        => $request->country ?? '',
                            'state_id'          => $request->state ?? '',
                            'city_id'           => $request->city ?? '',
                            'pincode'           => $request->pincode ?? '',
                            'address'           => $request->address ?? '',
                            'status'            => 1, 
                            'email_verify'      => 1, 
                            'otp'               => $otp ?? '',
                            'image'             => $userImage ?? '',
                         ];     
            
            $createUser = $query->create($arrayData); 
            // $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->name));

            // $final_slug = preg_replace('/_+/', '_', $slug).'_'.$createUser->id;
            // #update 
            // $query->where('id', $createUser->id)->update(['slug' => $final_slug]); 
        
            // return response()->json([
            //                           (string)$this->successKey=>(string)$this->successStatus, 
            //                           'message' => 'User Registered Successfully.'
            //                         ]); 
             return redirect()->back()->with('success', 'User Registered Successfully');                                            
        } catch (Exception $e) {    
           // dd($e);
            // return response()->json([
            //                           (string)$this->errorKey=>(string)$this->errorStatus, 
            //                           'message' => 'Something went wrong.'
            //                         ]);  
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


  /**
  * edit user 
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function edit(Request $request, $id)
  {
      $data = ['name' => 'required','image' => 'required'];

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

        try {
          
           $query = $this->user->where('id', $id)->first();
           
           # check the requested category already exist or not
           $checkUser = $this->user->where('name', $request->name)->first();

           
           if($checkUser)
            {   
              // return response()->json([
              //                           (string)$this->errorKey=>(string)$this->errorStatus, 
              //                           'message' => 'Sorry, this name already exist above category.'
              //                         ]); 
              return redirect()->back()->with('error', 'Sorry, this name already exist above category');                         
            }  

             # upload image
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                File::delete(public_path($query->image));
                $file->move(public_path('images/user/'), $filename);
                $banner='images/user/'.$filename;
            }else{
                $banner = $query->image;
            }

            # request param
            $arrayData = [
                           'name'           => $request->name ?? null, 
                           'image'          => $banner,
                         ];     

            #update
            $updateUser = $query->update($arrayData);  

            $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->name));

            $final_slug = preg_replace('/_+/', '_', $slug).'_'.$id;
            #update 
            $query->where('id', $id)->update(['slug' => $final_slug]);
            
            // return response()->json([
            //                           (string)$this->successKey=>(string)$this->successStatus, 
            //                           'message' => 'SubCategory Updated Successfully.'
            //                         ]); 
            return redirect()->back()->with('error', 'SubCategory Updated Successfully');                                             

        } catch (Exception $e) {
           // dd($e);
            // return response()->json([
            //                           (string)$this->errorKey=>(string)$this->errorStatus, 
            //                           'message' => 'Something went wrong.'
            //                         ]);  
           return redirect()->back()->with('error', 'Something went wrong'); 
        }
       
   }



   /**
   * delete subcategory
   * @param $id
   * @return \Illuminate\Http\Response
   */
   public function delete(Request $request)
    {
        $status =   UserAddress::where('id', $request->id)->delete();
        return  ['status'  =>  200];
        
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



    public function forgotPassword(Request $request, $id)
    {   
        
       $data = [ 
                    'password'          => 'required',
                    'newpassword'       => 'min:6|required|same:confirmpassword', 
                    // 'confirmpassword'   => 'required', 

                ];

          # validation check
          $validator = Validator::make($request->all() , $data);
          if($validator->fails())
          {
              return redirect()->back()->with('error', 'New password/Comfirm password should be same'); 
          }

            $user = $this->user->where('status', 1)->first();

          try {
              # request param
              if(Hash::check($request->password, $user->password))
              {

               if($request->newpassword == $request->confirmpassword){

                $arrayData = [  
                              'password'          => Hash::make($request->newpassword) ?? '',
                              'show_password'     => $request->newpassword ?? '',
                           ];     
                $createUser = $this->user->where('id',$id)->update($arrayData); 
            
                return redirect()->back()->with('success', 'Change your password successfully');                                            
               } else{
                  return redirect()->back()->with('error', 'New password / Comfirm password must be same'); 

               }

              }else{
                  
                  return redirect()->back()->with('error', 'Please enter old password should be correct'); 

              }  
          } 
          catch (Exception $e) {    
            
              return redirect()->back()->with('error', 'Something went wrong');
          }
    } 

   /**
  * index page of user
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
    public function orderDetail(Request $request, $id)
    {  
         $orders = $this->order
                        ->where('payment_status', '1')
                        ->where('id', $id)
                        ->with('orderStatus')
                        ->first();

        #get all active product                   
        $orderDetails = $this->orderdetail
                             ->where('payment_status', '1')
                             ->where('order_id',$id)
                             ->get(); 
                                       #get all active product                   
        $rating = $this->orderdetail
                             ->where('payment_status', '1')
                             ->where('order_id',$id)
                             ->first();                            
       return view($this->view.'order-detail')->with([
                                                        'orderDetails'   => $orderDetails ?? [],
                                                        'rating'         => $rating ?? [],
                                                        'orders'         => $orders,
                                                      ]);
    } 


        # Add Review and Rating
    public function reviewAndRating(Request $request, $id, $orderId)
    {
      // dd($request->all());
        $data = [
                    'rating'         => 'required',
                    'name'           => 'required',
                    'email'          => 'required',
                    'review'         => 'required',
                    // 'product_id'     => $request->product_id,
                ];


        # validation check
        // $validator = Validator::make($request->all() , $data);
        // if($validator->fails())
        //  {
        //     // return response()->json([
        //     //                           (string)$this->errorKey=>(string)$this->errorStatus, 
        //     //                           'message' => 'Required field is missing.'
        //     //                         ]);
        //     return redirect()->back()->with([ 'error' => 'Required field is missing.']);                  

        //  }
          $user = $this->user->where('id',Auth::user()->id)
                           ->where('email',$request->email)
                           ->first();

        try {
          if(empty($request->rating) )
          {
            return redirect()->back()->with([ 'error' => 'Sorry please give your rate %.']);  

          }elseif(!isset($user->email)){

            return redirect()->back()->with([ 'error' => 'Sorry does not match your name or email our records.']);
          }
          else{

             $user_id = Auth::user()->id ?? 0;
             $product_id = $this->orderdetail->where('id',$id)->first();
             $query = $this->ratingreview;
           
            # request param
            $arrayData = [
                           'name'           => $request->name ?? '', 
                           'email'          => $request->email ?? '' ,
                           'rating'         => $request->rating ?? '',
                           'review'         => $request->review ?? '',
                           'user_id'        => $user_id, 
                           'product_id'     => $id ?? 0, 
                           'status'         => 1, 
                           'order_id'       => $orderId, 
                         ];    
            #store
            $createReiew = $query->create($arrayData); 

            if($createReiew){

            return redirect()->back()->with([ 'success' => 'Thanks for Rating.']);                  
            } else{
                return redirect()->back()->with([ 'error' => 'Something wrong.']);                  
            }
          }

        } catch (Exception $e) {
           // dd($e);
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Something went wrong.'
                                    ]);  
        }
       
    }

    /**
     * edit  page
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function addRating($id, $orderId)
    {
        # Fetch banner by id
        // $addRating = $this->orderdetail->where('id',$id)->first();
        # code...
        return view($this->view . 'profile-tab.rating')->with(['id' => $id, 'orderId' => $orderId]);
    }

    /**
     * checkout page
     * @param
     * @return
     */ 
    public function address($id)
    {
      try {
        # fetch user addresses
        $userAddresses = $this->useraddress
                              ->with('state', 'city', 'userData')
                              ->where('user_id' , Auth::user()->id)
                              ->get();

        # fetch cart items
        $cartItems = $this->cart
                          ->where('user_id', Auth::user()->id)
                          ->where('cart_status', '1')
                          ->with('products', 'numberOfProduct', 'products.productImage')
                          ->get()->unique('product_id');        

        return view($this->view.'order-detail')->with([
                                                        'userAddresses' => $userAddresses, 
                                                        'cartItems'     => $cartItems
                                                      ]);

      } catch (\Exception $e) {
        dd($e);
      }
    }  
    
  }
