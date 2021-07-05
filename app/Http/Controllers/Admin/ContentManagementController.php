<?php

namespace App\Http\Controllers\Admin;

use File;
use Validator;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class ContentManagementController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'content';

 # Bind location
 protected $view = 'admin.content.';

 # Bind Category
 protected $content;

 /**
  * default constructor
  * @param
  * @return
  */
   function __construct(Content $content )
     {
        $this->content    = $content;
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
    
    # fetch sub category lists
    $query = $this->content;

        if (($request->status  == '') AND ($request->slug  == '') AND ($request->title == '')) {
            # if nothing is given in input then return all
            $content = $query->orderBy('id','desc')->take('10')
                              ->paginate($this->page);
        } else {
            # Filtered Output
            $content = $query->contentAddedBetween($request->status,$request->slug,$request->title)
                              ->orderBy('id','desc')->take('10')
                              ->paginate($this->page);
        }

    return view($this->view.'index')->with([
                                            'content'       => $content ?? [],
                                            'status'        => $request->status ?? '',
                                            'slug'          => $request->slug?? '',
                                            'title'         => $request->title?? ''
                                        ]);
 }


    /**
    * Create page
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function create(Request $request)
    {
        $contentCreate = $this->content
                      ->where('status','1')
                      ->orderBy('id','desc')
                      ->select('id', 'title')
                      ->get();      
        return view($this->view.'create')->with(['contentCreate' => $contentCreate]);
    }


 /**
  * create content
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
 public function store(Request $request)
    {

        $data = [
                'title'         => 'required',
                'description'   => 'required',
                'image'         => 'required'
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

        try {
          
           $query = $this->content;
           
           # check the requested sub category already exist or not
           $checkContent = $query->where('description', $request->description)
                                     ->where('title', $request->title)
                                     ->first();

           if($checkContent)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this content already exist.'
                                      ]);  
            }  

             # upload banner
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filetitle =((string)(microtime(true)*10000)).'.'.$extension;
                $file->move(public_path('images/content/'), $filetitle);
                $banner='images/content/'.$filetitle;
            }else{
                $banner = null;
            }

                      
            # request param
            $arrayData = [
                           'description'    => $request->description ?? 0,
                           'title'           => $request->title ?? null, 
                           'status'         => 1, 
                           'image'          => $banner,
                         ];     

            #store
            $createContent = $query->create($arrayData); 

            $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->title));

            $final_slug = preg_replace('/_+/', '_', $slug).'_'.$createContent->id;
            #update 
            $query->where('id', $createContent->id)->update(['slug' => $final_slug]); 
            
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
        $content = $this->content
                      ->where('id', $id)
                      ->first(); 
        # code...
        return view($this->view.'edit')->with(['content' => $content]);
    }

 /**
  * edit subcategory
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function edit(Request $request, $id)
    {

      
        $data = [
                'title'         => 'required',
                'description'   => 'required',
                // 'image'         => 'required'
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

        try {
          
            $query = $this->content->where('id', $id)->first();
           
            # check the requested category already exist or not
            $checkContent = $query->where('description', $request->description)
                                     ->where('title', $request->title)
                                     ->first();

           
           if($checkContent)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this content already exist above content.'
                                      ]);  
            }  

             # upload image
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filetitle =((string)(microtime(true)*10000)).'.'.$extension;
                File::delete(public_path($query->image));
                $file->move(public_path('images/content/'), $filetitle);
                $banner='images/content/'.$filetitle;
            }else{
                $banner = $query->image;
            }

            # request param
            $arrayData = [
                           'description'        => $request->description ?? 0,
                           'title'              => $request->title ?? null, 
                           'status'             => 1, 
                           'image'              => $banner,
                         ];       

            #update
            $updateContent = $query->update($arrayData);  

            $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->title));

            $final_slug = preg_replace('/_+/', '_', $slug).'_'.$id;
            #update 
            $query->where('id', $id)->update(['slug' => $final_slug]);
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Content Updated Successfully.'
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
   $query = $this->content;

   #update deleted by
   $query->where('id', $id)->update(['deleted_by' => Auth::user()->id]);

   # delete content by id
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
   $query =  $this->content;

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
  * json responce of content by category id by ajax for dependent dropdown respons
  * @param
  * @return \Illuminate\Http\Response in json
  */
  public function jsoncontent(Request $request)
  {
    # fetch content 
    $content = $this->content
                   ->where('status', '1')
                   ->select('id', 'title')
                   ->get();

    # return json responce
    return response()->json($subcategory);
  } 






}
