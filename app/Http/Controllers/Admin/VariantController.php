<?php
namespace App\Http\Controllers\Admin;
use Validator;
use App\Models\Variant;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class VariantController extends Controller
{
    use MessageStatusTrait;

    # Bind Type
    protected $type = 'variant ';

    # Bind location
    protected $view = 'admin.variant.';

    # Bind variant
    protected $variant;

    /**
     * default constructor
     * @param
     * @return
     */
    function __construct(Variant $variant)
    {
        $this->variant = $variant;
         #initilize pafination from config
        $this->page = config('paginate.pagination');
    }

    /**
     * index page of variant
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function index(Request $request)
    {
        # Validate requests
        $query = $this->variant;

        if (($request->status == '') and ($request->name == ''))
        {
            # if nothing is given in input then return all
            $variants = $query->orderBy('id', 'desc')
                              ->paginate(10);
        }else{
            # Filtered Output
            $variants = $query->variantAddedBetween($request->status, $request->name)
                              ->orderBy('id', 'desc')
                              ->paginate(10);
                              // ->paginate($this->page);
        }

        # return to index page
        return view($this->view . 'index')->with([
                                                   'variants'  => $variants,
                                                   'status' => $request->status ?? '', 
                                                   'name'  => $request->name ?? ''
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
     * create size
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function store(Request $request)
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
          
           $query = $this->variant;
           
           # check the requested size already exist or not
           $checkVariant = $query->where('name', $request->name)
                                 ->first();
           
           if($checkVariant)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this name already exist.'
                                      ]);  
            }  

            # request param
            $arrayData = [
                           'name'  => $request->name ?? null
                         ];     

            #store
            $createVariant = $query->create($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Variant Added Successfully.'
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
        # Fetch variant by id
        $variant = $this->variant
                        ->where('id', $id)
                        ->first();
        # code...
        return view($this->view . 'edit')->with(['variant' => $variant]);
    }

    /**
     * edit variant
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
          
           $query = $this->variant->where('id', $id)->first();
           
           # check the requested variant already exist or not
           $checkVariant = $query->where('name', $request->name)
                               ->where('id', '!=', $id)
                               ->first();

           
           if($checkVariant)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this name already exist.'
                                      ]);  
            }  

            
            # request param
            $arrayData = [
                           'name'          => $request->name ?? null
                         ];     

            #update
            $updateVariant = $query->update($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Variant Updated Successfully.'
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
     * delete variant
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $query = $this->variant;
       
        # delete variant by id
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
        $query = $this->variant;

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

