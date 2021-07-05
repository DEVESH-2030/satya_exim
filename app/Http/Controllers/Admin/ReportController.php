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


class ReportController extends Controller
{
    use MessageStatusTrait;

    # bind view of order management
    protected $view = 'admin.report.';

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

    public function repostList(Request $request)
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
        if (($request->order_id  == '') AND ($request->user_id == '') AND ($request->user_name == '') AND ($request->purchaseDate  == '') AND ($request->completedDate == '')) {
        # if nothing is given in input then return all
        $reports = $query->orderBy('id','desc')
                             ->with($relations)
                             ->where('payment_status', '1')
                             ->orderBy('id', 'DESC')
                             ->paginate(10);
        } else {

         # Search by User Name/ Customer Name
        $user_name = $request->user_name;

        // $date1 = date('Y-m-d', strtotime($request->purchaseDate));
        // $purchaseDate = $date1;
        
        // $date2 = date('Y-m-d', strtotime($request->completedDate));
        // $completedDate = $date2;
        

        # Filtered Output
        $query = $query->reportAddedBetween($request->order_id, $request->user_id, $user_name)
                              ->with($relations)
                              ->where('payment_status', '1')
 
                              ->whereHas('userDetail', function($search) use ($user_name){
                                 $search->where('first_name','LIKE','%'. $user_name .'%');
                               });

                              // if ($request->purchaseDate != '') {
                              //    $query = $query->where('created_at', $request->purchaseDate);
                              //  } 

                              //  if ($request->completedDate != '') {
                              //    $query = $query->where('updated_at', $request->completedDate);
                              //  } dd('updated_at', $request->completedDate);

                       
                               $reports = $query->orderBy('id','desc')
                                                ->paginate(10);
        }
    		return view($this->view.'.index')->with([
                                                  'reports'         => $reports ?? [],
                                                  'query'           => $query ?? [],
                                                  'searchOrder'     => $searchOrder ?? [],
                                                  'order_id'        => $request->order_id ?? '',
                                                  'user_id'         => $request->user_id ?? '',
                                                  'user_name'       => $user_name ?? '',
                                                  // 'purchaseDate'    => $request->purchaseDate ?? '',
                                                  // 'completedDate'   => $request->completedDate ?? '',
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
    public function viewReport($id)
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
        $viewReport = $this->order
                              ->with($relations)
                              ->where('id', $id)->first();
        // dd($viewReport);                        
        return view($this->view.'.view-report')->with(['viewReport'=> $viewReport]);
    }

    /**
    * delete Order
    * @param $id
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request)
    {
        $status =   Order::where('id', $request->id)->delete();
        if($status)
        {

          return  ['status'  =>  200];
                
        } else{

          return  ['error'  =>  100];

        }
    }

}
