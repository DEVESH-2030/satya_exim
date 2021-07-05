<?php
namespace App\Http\Controllers\Admin;
use File;
use Validator;
use App\Models\Banner;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class BannerController extends Controller
{
    use MessageStatusTrait;

    # Bind Type
    protected $type = 'Banner ';

    # Bind location
    protected $view = 'admin.banner.';

    # Bind banner
    protected $banner;

    /**
     * default constructor
     * @param
     * @return
     */
    function __construct(Banner $banner)
    {
        $this->banner = $banner;
         #initilize pafination from config
        $this->page = config('paginate.pagination');
    }

    /**
     * index page of banner
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function index(Request $request)
    {


        # Validate requests
        $query = $this->banner;
       
        # if nothing is given in input then return all
                              
        $banners = $query->orderBy('id', 'desc')->paginate(10);
       
        # return to index page
        return view($this->view . 'index')->with([
                                                   'banners' => $banners
                                                ]);
    }

    /**
     * Create page open
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function create(Request $request)
    {
        return view($this->view . 'create');
    }

    /**
     * create banner
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function store(Request $request)
    {

      $data = ['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:300',];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Image size should be maximum 300 kb and type are jpg,jpeg,png.'
                                    ]);
         }

        try {
          
           $query = $this->banner;
          
            # upload banner
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                $file->move(public_path('images/banner_image/'), $filename);
                $banner_image='images/banner_image/'.$filename;
            }else{
                return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Please select image.'
                                    ]);
            }

            # request param
            $arrayData = ['image'         => $banner_image];     

            #store
            $createBanner = $query->create($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Banner Added Successfully.'
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
        # Fetch banner by id
        $banner = $this->banner
                         ->where('id', $id)
                         ->first();
        # code...
        return view($this->view . 'edit')->with(['banner' => $banner]);
    }

    /**
     * edit banner
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */

   public function edit(Request $request, $id)
    {


        try {
          
           $query = $this->banner->where('id', $id)->first();
           
            # upload banner
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                File::delete(public_path($query->image));
                $file->move(public_path('images/banner_image/'), $filename);
                $banner_image='images/banner_image/'.$filename;
            }else{
                $banner_image = $query->image;
            }

            # request param
            $arrayData = ['image'         => $banner_image];     

            #update
            $updateBanner = $query->update($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Banner Updated Successfully.'
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
     * delete banner
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $query = $this->banner;

        # delete banner by id
        $query->where('id', $id)->delete();

        # return success
        return [$this->successKey => $this->successStatus, $this->messageKey => $this->deleteMessage($this->type) ];
    }

    /**
     * active deactive
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        # initiate constructor
        $query = $this->banner;

        # get the status
        $status = $query->where('id', $id)->first()->status;

        # check status, if active
        if ($status == '1')
        {
            #message
            $message = $this->inActiveMessage($this->type);

            # deactive( update status to zero)
            $statusCode = '0';
        }
        else
        {
            #message
            $message = $this->activeMessage($this->type);

            # active( update status to one)
            $statusCode = '1';
        }

        # update status code
        $query->where('id', $id)->update(['status' => $statusCode]);

        # return success
        return [$this->successKey => $this->successStatus, $this->messageKey => $message];
    }
}

