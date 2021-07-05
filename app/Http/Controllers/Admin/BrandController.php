<?php

namespace App\Http\Controllers\Admin;

use File;
use Validator;
use App\Models\Brand;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class BrandController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'Brand ';

 # Bind location
 protected $view = 'admin.brand.';

 # Bind brand
 protected $brand;


 /**
  * default constructor
  * @param
  * @return
  */
 function __construct(Brand $brand)
 {
 	$this->brand          = $brand;
   #initilize pafination from config
  $this->page = config('paginate.pagination');

 }
 
 /**
  * index page of brand
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function index(Request $request)
 {


 	# fetch brand list
 	$query = $this->brand;

 # Validate requests
   if (($request->status  == '') AND ($request->name == '')) {
     # if nothing is given in input then return all
     $brand = $query->orderBy('id','desc')->take('10')
                    ->paginate($this->page);
   } else {
     # Filtered Output
     $brand = $query->brandAddedBetween($request->status,$request->name)
                    ->orderBy('id','desc')->take('10')
                    ->paginate($this->page);
   }  
                    

 	# return to index page
 	return view($this->view.'index')->with([
                                        'brands' => $brand,
                                        'status' => $request->status??'',
                                        'name' => $request->name??''
                                         ]);
 }


/**
  * create brand page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function create(Request $request)
 {
  return view($this->view.'create');
 }


 /**
  * post create brand
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
 public function store(Request $request)
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
          
           $query = $this->brand;
           
           # check the requested brand already exist or not
           $checkBrand = $query->where('name', $request->name)
                               ->first();

           if($checkBrand)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this name already exist.'
                                      ]);  
            }  

             # upload banner
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                $file->move(public_path('images/brand/'), $filename);
                $banner='images/brand/'.$filename;
            }else{
                return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Please select image.'
                                    ]);
            }

            # request param
            $arrayData = [
                           'name'              => $request->name ?? null, 
                           'image'             => $banner
                         ];     

            #store
            $createBrand = $query->create($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Brand Added Successfully.'
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
  # Fetch brand by id
  $brand = $this->brand
                ->where('id', $id)
                ->first(); 
                     
  # code...
  return view($this->view.'edit')->with(['brand' => $brand]);
 }

 /**
  * edit subsubcategory
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
 public function edit(Request $request, $id)
 {
 
        $data = ['name' => 'required'];

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
          
           $query = $this->brand->where('id', $id)->first();
           
           # check the requested brand already exist or not
            $checkBrand = $this->brand->where('name', $request->name)
                                      ->where('id', '!=', $id)
                                      ->first();

           
           if($checkBrand)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this name already exist.'
                                      ]);  
            }  

             # upload image
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                File::delete(public_path($query->image));
                $file->move(public_path('images/brand/'), $filename);
                $banner='images/brand/'.$filename;
            }else{
                $banner = $query->image;
            }

            # request param
            $arrayData = [
                           'name'                => $request->name ?? null, 
                           'image'               => $banner
                         ];     

            #update
            $updateBanner = $query->update($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Brand Updated Successfully.'
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
  * delete brand
  * @param $id
  * @return \Illuminate\Http\Response
  */
 public function delete($id)
 {
   $query = $this->brand;
  
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
   $query =  $this->brand;

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



 

}












