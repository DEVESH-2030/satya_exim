<?php

namespace App\Http\Controllers\Admin;

use File;
use Validator;
use App\Models\Category;
use App\Models\SubCategory;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class SubCategoryController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'Sub-Category ';

 # Bind location
 protected $view = 'admin.subcategory.';

 # Bind Category
 protected $category;

 # Bind SubCategory
 protected $subcategory;

 /**
  * default constructor
  * @param
  * @return
  */
   function __construct(Category $category,SubCategory $subcategory)
     {
     	$this->category    = $category;
      $this->subcategory = $subcategory;
      #initilize pafination from config
      $this->page = config('paginate.pagination');    
     }
 
  /**
  * index page of subcategory
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
  public function index(Request $request)
  {
    $categories = $this->category
                      ->where('status','1')
                      ->orderBy('id','desc')
                      ->select('id', 'name')
                      ->get();  

 	  # fetch sub category list
    $query = $this->subcategory;

      if (($request->category_id  == '') AND ($request->status  == '') AND ($request->name == '')) {
       # if nothing is given in input then return all
       $subcategories = $query->orderBy('id','desc')
                              ->paginate(10);
      } else {
       # Filtered Output
       $subcategories = $query->subCategoryAddedBetween($request->category_id,$request->status,$request->name)
                              ->orderBy('id','desc')
                              ->paginate(10);
      }

 	    return view($this->view.'index')->with([
                                        'query'         => $query ?? [],
                                        'subcategories' => $subcategories ?? [],
                                        'status'        => $request->status??'',
                                        'name'          => $request->name??'',
                                        'category_id'   => $request->category_id??'',
                                        'categories'    => $categories ?? [],
                                         ]);
  }


/**
  * Create page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function create(Request $request)
 {
   $categories = $this->category
                      ->where('status','1')
                      ->orderBy('id','desc')
                      ->select('id', 'name')
                      ->get();      
  return view($this->view.'create')->with(['categories' => $categories]);
 }


 /**
  * create subcategory
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
 public function store(Request $request)
    {

      $data = ['name' => 'required','category_id' => 'required','image' => 'required'];

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
          
           $query = $this->subcategory;
           
           # check the requested sub category already exist or not
           $checkSubCategory = $query->where('category_id', $request->category_id)
                                     ->where('name', $request->name)
                                     ->first();

           if($checkSubCategory)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this sub category already exist.'
                                      ]);  
            }  

            # upload banner
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                $file->move(public_path('images/subcategory/'), $filename);
                $banner='images/subcategory/'.$filename;
            }else{
                $banner = null;
            }

                      
            # request param
            $arrayData = [
                           'category_id'    => $request->category_id ?? 0,
                           'name'           => $request->name ?? null, 
                           'status'         => 1, 
                           'image'          => $banner,
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
  # Fetch subcategory by id
   $categories = $this->category
                      ->where('status','1')
                      ->orderBy('id','desc')
                      ->select('id', 'name')
                      ->get();  

  $subcategory = $this->subcategory
                      ->where('id', $id)
                      ->first(); 
 	# code...
 	return view($this->view.'edit')->with(['subcategory' => $subcategory,
                                         'categories' => $categories]);
 }

 /**
  * edit subcategory
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function edit(Request $request, $id)
    {
      // dd($request->all());
      
      $data = ['name' => 'required','category_id' => 'required'];

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
          
           $query = $this->subcategory->where('id', $id)->first();
           
           # check the requested category already exist or not
           $checkSubCategory = $this->subcategory->where('name', $request->name)
                                                 ->where('category_id', $request->category_id)
                                                 ->where('id', '!=', $id)
                                                 ->first();

           
           if($checkSubCategory)
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
                $file->move(public_path('images/subcategory/'), $filename);
                $banner='images/subcategory/'.$filename;
            }else{
                $banner = $query->image;
            }

            # request param
            $arrayData = [
                           'category_id'    => $request->category_id ?? 0,
                           'name'           => $request->name ?? null, 
                           'image'          => $banner,
                         ];     

            #update
            $updateSubCategory = $query->update($arrayData);  

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
   $query = $this->subcategory;

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
   $query =  $this->subcategory;

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
    $subcategory = $this->subcategory
                   ->where('category_id',$request->category_id)
                   ->where('status', '1')
                   ->select('id', 'name')
                   ->get();

    # return json responce
    return response()->json($subcategory);
  } 






}
