<?php

namespace App\Http\Controllers\Admin;

use File;
use Validator;
use App\Models\Settings;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\MessageStatusTrait;
use App\Http\Controllers\Controller;
            
class SettingController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'Settings';

 # Bind location
 protected $view = 'admin.setting.';

 # Bind Category
 protected $settings;

 protected $socialmedia;

 /**
  * default constructor
  * @param
  * @return
  */
   function __construct(Settings $settings, SocialMedia $socialmedia )
     {
        $this->settings       = $settings;
        $this->socialmedia    = $socialmedia;
        #initilize pafination from config
        $this->page = config('paginate.pagination');
     }
 


   /**
     *
     * Function to Settings
     *
     */
    public function settings()
    {
        $settings     = $this->settings->first();
        $socialmedia  = $this->socialmedia->first();
        return view($this->view.'.index')->with([
                                                  'settings'    => $settings ?? '', 
                                                  'socialmedia' => $socialmedia ?? ''
                                                ]);   
    }

    # Save Settings
    public function saveSettings(Request $request)
    {   
        $query = $this->settings->first();
        $input = $request->all();
        if(empty($input['id']) && $input['id'] == null){
            # validate the input fields
            $validation = Validator::make($request->all(), [
                                                            'mobile'      => 'required',
                                                            'email'       => 'required',
                                                            'address'     => 'required',
                                                            'fax'         => 'required',
                                                            'logo'        => 'required',
                                                            'favicon'     => 'required',
                                                            'description' => 'required',
                                                            'facebook'    => 'required',
                                                            'gmail'       => 'required',
                                                            'twitter'     => 'required',
                                                            'instagram'   => 'required',
                                                          ]);

            if($validation->fails()) {  
                return redirect()->back()->withErrors($validation);
            }
        }

        if ($request->hasfile('logo'))
        {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension(); // getting logo extension
            $filename =((string)(microtime(true)*10000)).'.'.$extension;
            $file->move(public_path('images/logo_favicon/'), $filename);
            $logo='images/logo_favicon/'.$filename;
        }else{
            $logo = $query->logo;
        }

        if ($request->hasfile('favicon'))
        {
            $file = $request->file('favicon');
            $extension = $file->getClientOriginalExtension(); // getting favicon extension
            $filename =((string)(microtime(true)*10000)).'.'.$extension;
            $file->move(public_path('images/logo_favicon/'), $filename);
            $favicon='images/logo_favicon/'.$filename;
        }else{
             $favicon = $query->favicon;
        }

        $update_data = [
                          'mobile'          => $input['mobile']??'',
                          'email'           => $input['email']??'',
                          'address'         => $input['address']??'',
                          'fax'             => $input['fax']??'',
                          'logo'            => $logo ?? null,
                          'favicon'         => $favicon ?? null,
                          'description'     => $input['description']??'',
                          'facebook'        => $input['facebook']??'',
                          'gmail'           => $input['gmail']??'',
                          'twitter'         => $input['twitter']??'',
                          'instagram'       => $input['instagram']??'',
                        ];

        if(isset($input['id']) && $input['id'] > '0'){
            $data = $this->settings::find($input['id']);
            $data->update($update_data);
        }else{
            $data = $this->settings::create($update_data);
        }

        if($data){
            //return redirect()->back()->with(['success' => 'Settings updated successfully...']);
            return redirect()->back()->with('success', 'Settings updated successfully....');
        }else{
            //return redirect()->back()->withErrors(['warning' => 'Something went wrong.']);
             return redirect()->back()->with('error', 'Something went wrong.');
        }
        
    }


 /**
  * index page of contact us
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function index(Request $request)
 {
    
    # fetch contact us lists
    // $query = $this->settings;

    //     if (($request->status  == '') AND ($request->mobile  == '')) {
    //         # if nothing is given in input then return all
    //         $settings = $query->orderBy('id','desc')
    //                           ->paginate($this->page);
    //     } else {
    //         # Filtered Output
    //         $settings = $query->contentAddedBetween($request->status,$request->mobile)
    //                           ->orderBy('id','desc')
    //                           ->paginate($this->page);
    //     }

    // return view($this->view.'index')->with([
    //                                         'query'         => $query ?? [],
    //                                         'settings'      => $settings ?? [],
    //                                         'mobile'        => $request->mobile ?? '',
    //                                         'location'      => $request->location ?? '',
    //                                         'address'       => $request->address ?? '',
    //                                         'fax'           => $request->fax ?? ''
    //                                     ]);
 }


    /**
    * Create page
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function create(Request $request)
    {
        $create = $this->settings
                      ->where('status','1')
                      ->orderBy('id','desc')
                      ->get();   
        return view($this->view.'index')->with(['create' => $create]);
    }


  /**
  * create settings
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function store(Request $request)
  {
        $data = [
                'mobile'    => 'required',
                'email'     => 'required',
                'address'   => 'required',
                'fax'       => 'required',
            ];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
        {
            // return response()->json([
            //                           (string)$this->errorKey=>(string)$this->errorStatus, 
            //                           'message' => 'Required field is missing.'
            //                         ]);
            return redirect()->back()->with('error', 'Required field is missing.');
        }

        try {
          
           $query = $this->settings;
           
           # check the requested settings already exist  or not
            $checksettings = $query->where(['email'=> $request->email,'address' => $request->address])
                                    ->where(['mobile'=> $request->mobile,'fax'=> $request->fax])
                                    ->first();

           if($checksettings)
            {   
              // return response()->json([
              //                           (string)$this->errorKey=>(string)$this->errorStatus, 
              //                           'message' => 'Sorry, this settings already exist.'
              //                         ]);  
               return redirect()->back()->with('error', 'Sorry, this settings already exist.');
            }  
            
            # request param
            $arrayData = [
                           'mobile'        => $request->mobile ?? '',
                           'email'         => $request->email ?? '', 
                           'address'       => $request->address ?? '', 
                           'fax'           => $request->fax ?? '', 
                        ];    
            #store
            $settings = $query->create($arrayData); 

            $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->mobile));

            $final_slug = preg_replace('/_+/', '_', $slug).'_'.$settings->id;
            #update 
            $query->where('id', $settings->id)->update(['slug' => $final_slug]); 
            
            // return response()->json([
            //                           (string)$this->successKey=>(string)$this->successStatus, 
            //                           'message' => 'Contact Us Added Successfully.'
            //                         ]); 
            return redirect()->back()->with('success', 'Contact Us Added Successfully.');                                             
        } catch (Exception $e) {
            // dd($e);
            // return response()->json([
            //                           (string)$this->errorKey=>(string)$this->errorStatus, 
            //                           'message' => 'Something went wrong.'
            //                         ]);
             return redirect()->back()->with('error', 'Something went wrong.');                         
        }
       
  }



    /**
    * edit  page
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function update($id)
    {
        $settings = $this->settings
                      ->where('id', $id)
                      ->first(); 
        # code...
        return view($this->view.'edit')->with(['settings' => $settings]);
    }

 /**
  * edit subcategory
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function edit(Request $request, $id)
  {
    dd($requst->all());
      
        $data = [
                'mobile'    => 'required',
                'email'     => 'required',
                'address'   => 'required',
                'fax'       => 'required',
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
          
            $query = $this->settings->where('id', $id)->first();
           
            # check the requested settings already exist or not
            $checksettings = $query
                                    ->where(['email'=>$request->email,'address' => $request->address])
                                    ->where(['mobile'=> $request->mobile,'fax'=> $request->fax])
                                    ->first();

           
           if($checksettings)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this settings already exist above settings.'
                                      ]);  
            }  

            # request param
            $arrayData = [
                           'mobile'        => $request->mobile ?? '',
                           'email'         => $request->email ?? '', 
                           'address'       => $request->address ?? '', 
                           'fax'           => $request->fax ?? '', 
                           'status'        => 1, 
                         ];        

            #update
            $updatesettings = $query->update($arrayData);  

            $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->title));

            $final_slug = preg_replace('/_+/', '_', $slug).'_'.$id;
            #update 
            $query->where('id', $id)->update(['slug' => $final_slug]);
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Contact Us Updated Successfully.'
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
  * create settings
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
  public function addSocialMedia(Request $request)
  {
        $data = [
                'facebook'    => 'required',
                'gmail'       => 'required',
                'twitter'     => 'required',
                'instagram'   => 'required',
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
          
            $query = $this->socialmedia;
            # check the requested socialmedia already exist  or not
            $checksocialmedia = $query->where(['facebook'=> $request->facebook,'gmail' => $request->gmail])
                                    ->where(['instagram'=> $request->instagram,'twitter'=> $request->twitter])
                                    ->first();
            if($checksocialmedia)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this social media already exist.'
                                      ]);  
            }  
            # request param
            $arrayData = [
                           'facebook'    => $request->facebook ?? '',
                           'gmail'       => $request->gmail ?? '', 
                           'twitter'     => $request->twitter ?? '', 
                           'instagram'   => $request->instagram ?? '', 
                        ];    
            #store
            $socialmedia = $query->create($arrayData); 

            $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->mobile));

            $final_slug = preg_replace('/_+/', '_', $slug).'_'.$socialmedia->id;
            #update 
            $query->where('id', $socialmedia->id)->update(['slug' => $final_slug]); 
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Social Media Added Successfully.'
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
  * delete settings
  * @param $id
  * @return \Illuminate\Http\Response
  */
 public function delete($id)
 {
   $query = $this->settings;

   #update deleted by
   $query->where('id', $id)->update(['deleted_by' => Auth::user()->id]);

   # delete settings by id
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
   $query =  $this->settings;

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
  * json responce of settings id by ajax for dependent dropdown respons
  * @param
  * @return \Illuminate\Http\Response in json
  */
  public function jsoncontent(Request $request)
  {
    # fetch settings 
    $settings = $this->settings
                   ->where('status', '1')
                   ->select('id', 'title')
                   ->get();

    # return json responce
    return response()->json($settings);
  } 

}
