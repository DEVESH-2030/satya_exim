<?php

namespace App\Http\Controllers\Admin;

use File;
use Validator;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Models\ContactUsMail;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\MessageStatusTrait;
use App\Http\Controllers\Controller;
			
class ContactUsController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'ContactUs';

 # Bind location
 protected $view = 'admin.contactus.';

 # Bind Category
 protected $contactus;

 protected $contactusmail;
 /**
  * default constructor
  * @param
  * @return
  */
   function __construct(ContactUsMail $contactusmail, ContactUs $contactus )
     {
        $this->contactus        = $contactus;
        $this->contactusmail    = $contactusmail;
        #initilize pafination from config
        $this->page = config('paginate.pagination');
     }
 
 /**
  * index page of contact us
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function index(Request $request)
 {
    
    # fetch contact us lists
    $query = $this->contactusmail;

        if (($request->status  == '') AND ($request->mobile  == '')) {
            # if nothing is given in input then return all
            $contactusmail = $query->orderBy('id','desc')
                              ->paginate(10);
        } else {
            # Filtered Output
            $contactusmail = $query->contentAddedBetween($request->status,$request->mobile)
                              ->orderBy('id','desc')
                              ->paginate(10);
        }

    return view($this->view.'index')->with([
                                            'query'      	  => $query ?? [],
                                            'contactusmail' => $contactusmail ?? [],
                                            'first_name'    => $request->first_name ?? '',
                                            'last_name'     => $request->last_name ?? '',
                                            'email'     	  => $request->email ?? '',
                                            'mobile'      	=> $request->mobile ?? '',
                                            'message'    	  => $request->message ?? ''
                                            
                                        ]);
 }


    /**
    * Create page
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function create(Request $request)
    {
       //
    }


  /**
  * create contactus
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function store(Request $request)
  {
    //       
  }



    /**
    * edit  page
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function update($id)
    {
      //
    }

 /**
  * edit subcategory
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function edit(Request $request, $id)
    {
      //
    }



 /**
  * delete contactus
  * @param $id
  * @return \Illuminate\Http\Response
  */
 public function delete($id)
 {
   $query = $this->contactusmail;

   #update deleted by
   $query->where('id', $id)->update(['deleted_by' => Auth::user()->id]);

   # delete contactusmail by id
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
   $query =  $this->contactusmail;

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
  * json responce of contactusmail id by ajax for dependent dropdown respons
  * @param
  * @return \Illuminate\Http\Response in json
  */
  public function jsoncontent(Request $request)
  {
    # fetch contactusmail 
    $contactusmail = $this->contactusmail
                   ->where('status', '1')
                   ->select('id', 'title')
                   ->get();

    # return json responce
    return response()->json($contactusmail);
  } 






}
