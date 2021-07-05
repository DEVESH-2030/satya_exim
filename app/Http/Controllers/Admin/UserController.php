<?php

namespace App\Http\Controllers\Admin;

use File;
use Validator;
use App\User;
use App\Models\States;
use App\Models\Cities;
use App\Models\UsersOtp;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class UserController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'User';


 # Bind location
 protected $view = 'admin.user.';


 
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
                          ->with($relation);
      if (($request->mobile_no  == '') AND ($request->status  == '') AND ($request->first_name == '')) {
        # if nothing is given in input then return all
        $user = $query->orderBy('id','desc')
                      ->paginate(10);

      } else {
        # Filtered Output
        $user = $query->UserAddedBetween($query, $request->status, $request->first_name, $request->mobile_no)
                              ->orderBy('id','desc')
                              ->paginate(10);
      }
                     

    return view($this->view.'index')->with([
                                        'query'         => $query ?? [],
                                        'user'          => $user ?? [],
                                        'status'        => $request->status ?? '',
                                        'first_name'    => $request->first_name ?? '',
                                        'mobile_no'     => $request->mobile_no ?? '',
                                         ]);
   }


   /**
   * Create page
   * @param Illuminate\Http\Request;
   * @return Illuminate\Http\Response;
   */
   public function create(Request $request)
   {
      $create = $this->user
                      ->where('status','1')
                      ->orderBy('id','desc')
                      ->select('id', 'name')
                      ->get();      
      return view($this->view.'create')->with(['create' => $create]);
   }

  /**
  * Create page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
  public function viewDetail($id)
  {
      $relation = [ 
                  'country',
                  'state',
                  'city',
                  'otp',
                ];
      $user = $this->user->with($relation)
                        ->where('id', $id)
                        // ->where(['status'=>'1', 'email_verify'=>'1'])
                        ->first(); 
      # Return data on edit page
      return view($this->view.'view-detail')->with(['user' => $user]);
 }


 /**
  * create subcategory
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function store(Request $request)
  {

      $data = ['first_name' => 'required','image' => 'required'];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Required field is missing.'
                                    ]);
         }

        try {
          
            $query = $this->user;
           
            # check the requested sub category already exist or not
            $checkuser = $query->where('category_id', $request->category_id)
                                     ->where('first_name', $request->first_name)
                                     ->first();

            if($checkuser)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this sub category already exist.'
                                      ]);  
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

                      
            # request param
            $arrayData = [
                           'category_id'    => $request->category_id ?? 0,
                           'name'           => $request->name ?? null, 
                           'status'         => 1, 
                           'image'          => $userImage,
                         ];     

            #store
            $createSubCategory = $query->create($arrayData); 

            $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->name));

            $final_slug = preg_replace('/_+/', '_', $slug).'_'.$createSubCategory->id;
            #update 
            $query->where('id', $createSubCategory->id)->update(['slug' => $final_slug]); 
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'SubCategory Added Successfully.'
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
    $user = $this->user
                      ->where('id', $id)
                      ->first(); 
    # Return data on edit page
    return view($this->view.'view-detail')->with(['user' => $user]);
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
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Required field is missing.'
                                    ]);
         }

        try {
          
           $query = $this->user->where('id', $id)->first();
           
           # check the requested category already exist or not
           $checkUser = $this->user->where('name', $request->name)->first();

           
           if($checkUser)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this name already exist above category.'
                                      ]);  
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
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'SubCategory Updated Successfully.'
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
         $message = 'User Inactive Successfully';

         # deactive( update status to zero)
         $statusCode = '0';
      } else {
         #message
         $message = 'User Active Successfully';

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






}
