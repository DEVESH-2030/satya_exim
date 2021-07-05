<?php

namespace App\Http\Controllers\Admin;

use DB;
use File;
use Validator;
use App\Models\Cart;   
use App\Models\Color;   
use App\Models\Brand;
use App\Models\Variant;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;


class OrderManagementController extends Controller
{
    use MessageStatusTrait;

    # bind view of order management
    protected $view = 'admin.order.';

    # bind Order model
    protected $cart;

    protected $order;

    # bind OrderDetail model
    protected $orderDetail;

    protected $orderstatus;

    protected $subcategory;

    protected $products;
    
    protected $category;
    
    protected $productimage;
    
    protected $brand;
    
    protected $variant;
    
    protected $color;

    /**
     * constructor
     * @param
     * @return
     */
    function __construct( Cart $cart,
                          Brand $brand, 
                          Color $color, 
                          Order $order, 
                          Product $product, 
                          Variant $variant, 
                          Category $category, 
                          SubCategory $subcategory, 
                          ProductImage $productimage,  
                          OrderDetail $orderDetail, 
                          OrderStatus $orderstatus
                        )
    {
      $this->cart         = $cart;
      $this->brand        = $brand;
      $this->color        = $color;
      $this->product      = $product;
      $this->variant      = $variant;
      $this->category     = $category;
      $this->subcategory  = $subcategory;
      $this->productimage = $productimage;
    	$this->order        = $order;
    	$this->orderDetail  = $orderDetail;
      $this->orderstatus  = $orderstatus;

      #initilize pafination from config
      $this->page = config('paginate.pagination');    

    }

    /**
     * all order page
     * @param
     * @return
     */  

    public function allOrder(Request $request)
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
    		
    	  // $allOrders = $this->order
       //                          ->with($relations)
       //                          ->where('payment_status', '1')
       //                          ->orderBy('id', 'DESC')
       //                          ->paginate(10);

        $query = $this->order;

        if (($request->order_id  == '') AND ($request->status == '')) {
        # if nothing is given in input then return all
        $allOrders = $query->orderBy('id','desc')
                             ->with($relations)
                             ->where('payment_status', '1')
                             ->orderBy('id', 'DESC')
                             ->paginate(10); 
       } else {
        # Filtered Output
        $allOrders = $query->allOrderAddedBetween($request->order_id, $request->status)
                             ->with($relations)
                             ->where('payment_status', '1')
                              ->orderBy('id','desc')
                             ->paginate(10); 
        }
    		return view($this->view.'.index')->with([
                                                  'allOrders'       => $allOrders ?? [],
                                                  'order_id'        => $request->order_id ?? '',
                                                  'status'          => $request->status ?? '',
                                                ]);

    	} catch (\Exception $e) {
    		dd($e);
    	}

    }
    
    /**
    * Edit Orders 
    * @param Illuminate\Http\Request; 
    * @return Illuminate\Http\Response;
    */
    public function editOrder($id)
    {
       $relations = [
                'orderDetail', 
                'cartDetail', 
                'orderDetail.cartDetail', 
                'orderDetail.cartDetail.products', 
                'orderDetail.cartDetail.products.productImage'
        ];
            
        # fetch all orders
        $updateOrder = $this->order
                              ->with($relations)
                              ->where('id', $id)->first();
        // dd($updateOrder);                        
        return view($this->view.'.edit_order')->with(['updateOrder'=> $updateOrder]);
    }

    /**
    * Update Orders Status 
    * @param Illuminate\Http\Request; 
    * @return Illuminate\Http\Response;
    */
    public function orderstatus(Request $request, $id)
    {
      // dd($request->all());
        $data = ['status' => 'required','comments' => ''];

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

              // $arrayData2 = [
              //                'status'   => '1', 
              //              ];     

                  $OrderStatus = $query->create($arrayData);  
                  $status_id = $this->orderstatus->where('order_id',$allOrders->id)->first();
                  $this->order->where('id', $id)  
                              //->where('order_status','1')   
                              ->update(['order_status'=> $request->status ?? '']);    
            

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
        
        // $recentOrderList = $this->order
        //                         ->with($relations)
        //                         ->where('payment_status', '1')
        //                         ->orderBy('id', 'DESC')
        //                         ->paginate(10);

        $query = $this->order;
        
        if (($request->order_id  == '') AND ($request->status == '')) {
        # if nothing is given in input then return all
        $recentOrderList = $query->orderBy('id','desc')
                             ->with($relations)
                             ->where('payment_status', '1')
                             ->orderBy('id', 'DESC')
                             ->paginate(10);
        } else {
        # Filtered Output
        $recentOrderList = $query->allOrderAddedBetween($request->order_id, $request->status)
                              ->with($relations)
                              ->where('payment_status', '1')
                              ->orderBy('id','desc')
                             ->paginate(10);
         }
        return view($this->view.'.recent-order')->with([
                                                        'recentOrderList' => $recentOrderList ?? [],
                                                        'order_id'        => $request->order_id ?? '',
                                                        'status'          => $request->status ?? '',
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
          
          // $completedOrder = $this->order
          //                         ->with($relations)
          //                         ->where('payment_status', '1')
          //                         ->where('status', '3')
          //                         ->orderBy('id', 'DESC')
          //                         ->paginate(10);

        $query = $this->order;
          
        if (($request->order_id  == '') AND ($request->status == '')) {
        # if nothing is given in input then return all
        $completedOrder = $query->orderBy('id','desc')
                             ->with($relations)
                             ->where('payment_status', '1')
                             ->where('order_status', '3')
                             ->orderBy('id', 'DESC')
                             ->paginate(10);
        } else {
        # Filtered Output
        $completedOrder = $query->allOrderAddedBetween($request->order_id, $request->status)
                              ->with($relations)
                              ->where('payment_status', '1')
                              ->where('order_status', '3')
                              ->orderBy('id','desc')
                              ->paginate(10);
         }
          return view($this->view.'.completed-order')->with([
                                                              'completedOrder'  => $completedOrder ?? [],
                                                              'order_id'        => $request->order_id ?? '',
                                                              'status'          => $request->status ?? '',
                                                            ]);
        } catch (\Exception $e) {
          dd($e);
        }
    }


    /**
    * view details product page
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function view(Request $request, $id)
    {
      
       #get all active product                   
        $orders = $this->orderDetail
                          ->where('payment_status', '1')
                          ->where('order_id',$id)
                          ->get();
        // dd($products);                          
      return view($this->view.'view-order')->with([
                                            'orders'   => $orders
                                          ]);
    }

    # Total Count 
    public function totalCount(Request $request)
    {
      try {
        $relations = [
                'orderDetail', 
                'cartDetail', 
                'orderDetail.cartDetail', 
                'orderDetail.cartDetail.products', 
                'orderDetail.cartDetail.products.productImage'
        ];
        
        $query            = $this->order;
        $totalOrder       = $this->order->count();
        $totalProduct     = $this->product->count();
        $totalSoldProduct = $this->orderDetail->count();
        $totalStock       = $this->product->select('total_stock')->count();

        if (($request->order_id  == '') AND ($request->status == '')) {
        # if nothing is given in input then return all
        $orderList = $query->orderBy('id','desc')
                             ->with($relations)
                             ->where('payment_status', '1')
                             ->orderBy('id', 'DESC')
                             ->paginate(10);
        } else {
        # Filtered Output
        $orderList = $query->allOrderAddedBetween($request->order_id, $request->status)
                             ->with($relations)
                             ->where('payment_status', '1')
                             ->orderBy('id','desc')
                             ->paginate(10);
         }
        return view('admin.dashboard')->with([
                                                'orderList'           => $orderList ?? [],
                                                'totalOrder'          => $totalOrder ?? [],
                                                'totalSoldProduct'    => $totalSoldProduct ?? [],
                                                'totalProduct'        => $totalProduct ?? [],
                                                'totalStock'          => $totalStock ?? [],
                                                'order_id'            => $request->order_id ?? '',
                                                'status'              => $request->status ?? '',
                                              ]);

      } catch (\Exception $e) {
        dd($e);
      }
      
    }

}
