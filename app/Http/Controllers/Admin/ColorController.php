<?php
namespace App\Http\Controllers\Admin;
use Validator;
use App\Models\Color;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class ColorController extends Controller
{
    use MessageStatusTrait;

    # Bind Type
    protected $type = 'Color ';

    # Bind location
    protected $view = 'admin.color.';

    # Bind color
    protected $color;

    /**
     * default constructor
     * @param
     * @return
     */
    function __construct(Color $color)
    {
        $this->color = $color;
         #initilize pafination from config
        $this->page = config('paginate.pagination');
    }

    /**
     * index page of color
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function index(Request $request)
    {


        # Validate requests
        $query = $this->color;

        if (($request->status == '') and ($request->name == ''))
        {
            # if nothing is given in input then return all
            $colors = $query->orderBy('id', 'desc')
                              ->paginate(10);
        }else{
            # Filtered Output
            $colors = $query->colorAddedBetween($request->status, $request->name)
                            ->orderBy('id', 'desc')
                              ->paginate(10);
        }

        # return to index page
        return view($this->view . 'index')->with([
                                                   'colors' => $colors,
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
     * create color
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function store(Request $request)
    {

      $data = ['name' => 'required','color_code' => 'required'];

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
          
           $query = $this->color;
           
           # check the requested color already exist or not
           $checkColor = $query->where('name', $request->name)
                               ->first();
           
           if($checkColor)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this name already exist.'
                                      ]);  
            }  

            # request param
            $arrayData = [
                           'name'          => $request->name ?? null, 
                           'color_code'     => $request->color_code ?? null
                         ];     

            #store
            $createColor = $query->create($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Color Added Successfully.'
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
        # Fetch color by id
        $color = $this->color
                      ->where('id', $id)
                      ->first();
        # code...
        return view($this->view . 'edit')->with(['color' => $color]);
    }

    /**
     * edit color
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */

   public function edit(Request $request, $id)
    {

      $data = ['name' => 'required','color_code' => 'required'];

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
          
           $query = $this->color->where('id', $id)->first();
           
           # check the requested color already exist or not
           $checkColor = $query->where('name', $request->name)
                               ->where('id', '!=', $id)
                               ->first();

           
           if($checkColor)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this name already exist.'
                                      ]);  
            }  

            
            # request param
            $arrayData = [
                           'name'          => $request->name ?? null, 
                           'color_code'     => $request->color_code ?? null
                         ];     

            #update
            $updateColor = $query->update($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Color Updated Successfully.'
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
     * delete color
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $query = $this->color;
       
        # delete color by id
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
        $query = $this->color;

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

