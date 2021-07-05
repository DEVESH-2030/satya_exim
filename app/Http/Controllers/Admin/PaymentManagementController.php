<?php

namespace App\Http\Controllers\Admin;

use DB;
use File;
use Validator;
use App\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;


class PaymentManagementController extends Controller
{
    use MessageStatusTrait;

    # bind view of order management
    protected $view = 'admin.payment.';

    # bind Order model
    protected $order;

    protected $user;

    # bind OrderDetail model
    protected $orderDetail;

    protected $orderstatus;

    /**
     * constructor
     * @param
     * @return
     */
    function __construct(User $user, Order $order, OrderDetail $orderDetail, OrderStatus $orderstatus)
    {
    	$this->order       	= $order;
    	$this->user       	= $user;
    	$this->orderDetail 	= $orderDetail;
      $this->orderstatus 	= $orderstatus;

      #initilize pafination from config
      $this->page = config('paginate.pagination');    

    }

    /**
     * all order page
     * @param
     * @return
     */  

    public function payment(Request $request)
    {
      // dd($request->all());
    	try {
    		$relations = [
    						'userDetail', 
    						'orderDetail', 
                			'cartDetail', 
    						'orderDetail.cartDetail', 
                			'orderDetail.cartDetail.products', 
    						'orderDetail.cartDetail.products.productImage'
    		];
    		

        $query = $this->order;

        if (($request->order_id  == '') AND ($request->user_id == '') AND ($request->user_name == '') AND ($request->email == '')) {
        # if nothing is given in input then return all
        $searchPayment = $query->orderBy('id','desc')
                             ->with($relations)
                             ->where('payment_status', '1')
                             ->orderBy('id', 'DESC')
                             ->paginate(10);
        } else {

        # Search by User Name/ Customer Name
        $user_name = $request->user_name;
        # Search by User Email/ Customer Email
        $email = $request->email;
        
        # Filtered Output
        $searchPayment = $query->paymentAddedBetween($request->order_id, $request->user_id, $user_name, $email)
                              ->with($relations)
                              ->where('payment_status', '1')

                              ->whereHas('userDetail', function($search) use ($user_name){
                                 $search->where('first_name','LIKE','%'. $user_name .'%');
                               }) 

                              ->whereHas('userDetail', function($search) use ($email){
                                 $search->where('email','LIKE','%'. $email .'%');
                               })
                              ->orderBy('id','desc')
                              ->paginate(10);
         }
    		return view($this->view.'.index')->with([
                                                  'query'           => $query ?? [],
                                                  'searchPayment'   => $searchPayment ?? [],
                                                  'order_id'        => $request->order_id ?? '',
                                                  'user_id'         => $request->user_id ?? '',
                                                  'user_name'       => $user_name ?? '',
                                                  'email'           => $email ?? '',
                                                ]);

    	} catch (\Exception $e) {
    		dd($e);
    	}

    }
    
    /**
    * View Reports
    * @param Illuminate\Http\Request; 
    * @return Illuminate\Http\Response;
    */
    public function viewPayment($id)
    {
       	$relations = [
						'userDetail', 
						'orderDetail', 
	        			'cartDetail', 
						'orderDetail.cartDetail', 
	        			'orderDetail.cartDetail.products', 
						'orderDetail.cartDetail.products.productImage'
    				];
            
        # fetch all orders
        $viewPaymentDetail = $this->order
                              ->with($relations)
                              ->where('id', $id)->first();
        // dd($viewPaymentDetail);                        
        return view($this->view.'.view-payment')->with(['viewPaymentDetail'=> $viewPaymentDetail]);
    }

    /**
    * Update Orders Status 
    * @param Illuminate\Http\Request; 
    * @return Illuminate\Http\Response;
    */
    public function orderstatus(Request $request, $id)
    {
      // dd($request->all());
        $data = ['status' => 'required','comments' => 'required'];

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
            
              $query = $this->orderstatus->where('id', $id);
              
              $relation = [
                  'orderStatus'
              ];
              $allOrders = $this->order->where('id',$id)
                                      ->with($relation)
                                      ->first();

              # request param
              $arrayData = [
                             'order_id'   => $allOrders->id ?? '', 
                             'status_id'  => $request->status ?? '', 
                             'comments'   => $request->comments ?? '', 
                           ];  

              $arrayData2 = [
                             'status'   => '1', 
                           ];     

                  $OrderStatus = $query->create($arrayData);  
                  $status_id = $this->orderstatus->where('order_id',$allOrders->id)->first();
                  $this->order->where('id', $id)  
                              ->where('order_status','1')   
                              ->update(['status'=> $request->status ?? '']);    
            

              return response()->json([
                                        (string)$this->successKey=>(string)$this->successStatus, 
                                        'message' => 'Order Status Updated Successfully.'
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
    * Recent Orders List 
    * @param Illuminate\Http\Request; 
    * @return Illuminate\Http\Response;
    */
    public function recentOrder(Request $request)
    {
      // dd($request->all());
      try {
        $relations = [
                'orderDetail', 
                'cartDetail', 
                'orderDetail.cartDetail', 
                'orderDetail.cartDetail.products', 
                'orderDetail.cartDetail.products.productImage'
        ];
        
        $recentOrderList = $this->order
                                ->with($relations)
                                ->where('payment_status', '1')
                                ->orderBy('id', 'DESC')
                                ->paginate(10);

        $query = $this->order;
        
        if (($request->order_id  == '') AND ($request->payment_status  == '') AND ($request->status == '')) {
        # if nothing is given in input then return all
        $searchOrder = $query->orderBy('id','desc')
                              ->paginate($this->page);
        } else {
        # Filtered Output
        $searchOrder = $query->allOrderAddedBetween($request->order_id, $request->payment_status, $request->status)
                              ->orderBy('id','desc')
                              ->paginate($this->page);
        }
        return view($this->view.'.recent-order')->with([
                                                        'recentOrderList' => $recentOrderList ?? [],
                                                        'query'           => $query ?? [],
                                                        'searchOrder'     => $searchOrder ?? [],
                                                        'order_id'        => $order_id ?? '',
                                                        'payment_status'  => $payment_status ?? '',
                                                        'status'          => $status ?? '',
                                                      ]);

      } catch (\Exception $e) {
        dd($e);
      }
    }

    /**
    * Completed Orders List
    * @param Illuminate\Http\Request; 
    * @return Illuminate\Http\Response;
    */
    public function completeOrder(Request $request)
    {
        try {
          $relations = [
                'orderDetail', 
                'cartDetail', 
                'orderDetail.cartDetail', 
                'orderDetail.cartDetail.products', 
                'orderDetail.cartDetail.products.productImage'
          ];
          
          $completedOrder = $this->order
                                  ->with($relations)
                                  ->where('payment_status', '1')
                                  ->where('status', '3')
                                  ->orderBy('id', 'DESC')
                                  ->paginate(10);

          $query = $this->order;
          
          if (($request->order_id  == '') AND ($request->payment_status  == '') AND ($request->status == '')) {
          # if nothing is given in input then return all
          $searchOrder = $query->orderBy('id','desc')
                                ->paginate($this->page);
          } else {
          # Filtered Output
          $searchOrder = $query->allOrderAddedBetween($request->order_id, $request->payment_status, $request->status)
                                ->orderBy('id','desc')
                                ->paginate($this->page);
          }
          return view($this->view.'.completed-order')->with([
                                                          'completedOrder'  => $completedOrder ?? [],
                                                          'query'           => $query ?? [],
                                                          'searchOrder'     => $searchOrder ?? [],
                                                          'order_id'        => $order_id ?? '',
                                                          'payment_status'  => $payment_status ?? '',
                                                          'status'          => $status ?? '',
                                                        ]);

        } catch (\Exception $e) {
          dd($e);
        }
    }

    /**
   * delete report
   * @param $id
   * @return \Illuminate\Http\Response
   */
   public function delete(Request $request)
    {
        $status =   $this->order::where('id',$request->id)->delete();
        return  ['status'  =>  200];
    }

}
