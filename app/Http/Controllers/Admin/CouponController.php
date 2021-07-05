<?php
namespace App\Http\Controllers\Admin;
use Validator;
use App\Models\Coupon;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class CouponController extends Controller
{
    use MessageStatusTrait;

    # Bind Type
    protected $type = 'coupon';

    # Bind location
    protected $view = 'admin.coupon.';

    # Bind Coupon
    protected $coupon;

    /**
     * default constructor
     * @param
     * @return
     */
    function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
         #initilize pafination from config
        $this->page = config('paginate.pagination');
    }

    /**
     * index page of coupon
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function index(Request $request)
    {

        # Validate requests
        $query = $this->coupon;
        if (($request->status == '') and ($request->title == '') and ($request->coupon_code == '') and ($request->date == '') )
        {
            # if nothing is given in input then return all
            $coupons = $query->orderBy('id', 'desc')
                              ->paginate(10);
        }else{  
            # Filtered Output
            $coupons = $query->couponAddedBetween($request->status, $request->title, $request->coupon_code, $request->date)
                              ->orderBy('id', 'desc')
                              ->paginate(10);
        }

        # return to index page
        return view($this->view . 'index')->with([
                                                   	'coupons'  		=> $coupons,
                                                   	'status' 			=> $request->status ?? '', 
                                                   	'title'  			=> $request->title ?? '',
                                                   	'coupon_code' => $request->coupon_code ?? '',
									      			                      'date' 				=> $request->date ?? ''
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

        $data = [
      			'title' 			=> 'required',
      			'coupon_code' 		=> 'required',
      			'discount_amount'	=> 'required',
      			'start_date' 		=> 'required',
      			'end_date' 			=> 'required'
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
          
           $query = $this->coupon;
           
           # check the requested size already exist or not
           $checkCoupon = $query->where(['title'=> $request->title,'coupon_code'=> $request->coupon_code,'discount_amount'=> $request->discount_amount,'start_date'=> $request->start_date,'end_date'=> $request->end_date])->first();
           
           if($checkCoupon)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this title and coupon code already exist.'
                                      ]);  
            }  

            # request parameter
            $arrayData = [
                           'title'  			=> $request->title ?? '',
                           'coupon_code'  		=> $request->coupon_code ?? '',
                           'discount_amount'  	=> $request->discount_amount ?? '',
                           'start_date'  		=> $request->start_date ?? '',
                           'end_date'  			=> $request->end_date ?? ''
                         ];     	

            #store
            $createcoupon = $query->create($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Coupon Added Successfully.'
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
        # Fetch coupon by id
        $coupon = $this->coupon
                        ->where('id', $id)
                        ->first();
        # code...
        return view($this->view . 'edit')->with(['coupon' => $coupon]);
    }

    /**
     * edit coupon
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */

   public function edit(Request $request, $id)
    {

      	$data = [
      			'title' 			=> 'required',
      			'coupon_code' 		=> 'required',
      			'discount_amount'	=> 'required',
      			'start_date' 		=> 'required',
      			'end_date' 			=> 'required'
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
          
           $query = $this->coupon->where('id', $id)->first();
           
           # check the requested coupon already exist or not
           $checkCoupon = $query->where(['title'=> $request->title,'coupon_code'=> $request->coupon_code,'discount_amount'=> $request->discount_amount,'start_date'=> $request->start_date,'end_date'=> $request->end_date])->where('id', '!=', $id)
                        ->first();
           
            if($checkCoupon)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this title and coupon code already exist.'
                                      ]);  
            }  			
            
            # request param
            $arrayData = [
                           'title'  			=> $request->title ?? '',
                           'coupon_code'  		=> $request->coupon_code ?? '',
                           'discount_amount'  	=> $request->discount_amount ?? '',
                           'start_date'  		=> $request->start_date ?? '',
                           'end_date'  			=> $request->end_date ?? ''
                        ];     

            #update
            $updatecoupon = $query->update($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Coupon Updated Successfully.'
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
     * delete coupon
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $query = $this->coupon;
       
        # delete coupon by id
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
        $query = $this->coupon;

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

