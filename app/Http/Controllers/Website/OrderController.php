<?php

namespace App\Http\Controllers\Website;

use Stripe;
use App\Models\WishList;
use Session;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\UserAddress;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    # bind cart model
    protected $cart;
    protected $wishlist;

    # bind Product model
    protected $product;

    # bind UserAddress model
    protected $userAddress;
    
    protected $orderstatus;

    function __construct(WishList $wishlist, Cart $cart, Product $product, UserAddress $userAddress, Order $order, OrderDetail $orderDetail, OrderStatus $orderstatus)
    {
      $this->wishlist    = $wishlist;
      $this->cart        = $cart;
    	$this->order       = $order;
      $this->product     = $product;
      $this->orderDetail = $orderDetail;
      $this->userAddress = $userAddress;
      $this->orderstatus = $orderstatus;
    }

    /**
     * add to cart product from user
     * @param
     * @return
     */
    public function addToCart(Request $request)
    {
    	try { 
    		$cartData = [
    						'user_id'    => Auth::user()->id,
    						'product_id' => $request->product_id,
                'quantity'   => isset($request->quantity) ? $request->quantity : '1',
    		];
        $cartExist = $this->cart
                          ->where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id, 'cart_status' => '1'])
                          ->first();

        if (isset($cartExist->id)) {

          return ['error' => 100, 'message' => 'Already added into cart.'];
          // return redirect()->back()->with(['error'=>'Already added into cart.']);

        } else {

    		  $this->cart->create($cartData);
    		  return ['success' => 200, 'message' => 'Added into cart successfully.'];
          // return redirect()->back()->with(['success'=>'Added to cart this product successfully.']);
        }

    	} catch (\Exception $e) { 
    		return ['error' => 100, 'message' => $e];
              // return redirect()->back()->with(['error'=>'Something went wrong.']);

    	}
    }


    /**
     * view cart
     * @param
     * @return
     */
    public function viewCart(Request $request)
    {
        try {
            # fetch cart items of current user
            $cartItems = $this->cart
                              ->where('user_id', Auth::user()->id)
                              ->where('cart_status', '1')
                              ->where('status', '1')
                              ->with('products', 'numberOfProduct', 'products.productImage')
                              ->get()->unique('product_id');

            return view('website.cart-checkout-vendor.cart')->with(['cartItems' => $cartItems]);
        } catch (\Exception $e) {
            dd($e);
        }        
    }
    

    

    /**
     * remove item from cart
     * @param
     * @return
     */
    public function removeItemFromCart(Request $request, $slug)
    {
        try { 
            # get cart id
            $cartId = explode('_',$slug);
            
            # get the cart and remove it
            $cartItem =  $this->cart
                              ->where('id', $cartId[0])
                              ->delete();

            if ($cartItem) {
                return redirect()->back();
            } else {
                return redirect()->back()->with(['error' => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            dd($e);            
        }
    }

    /**
     * increase product quantity
     * @param product id
     * @param
     */
    public function increaseDecreaseCartItem(Request $request, $cartId, $slug, $type)
    {
        try { 


            $product = $this->product->where('slug', $slug)->first();

            $cartData = [
                            'user_id'    => Auth::user()->id,
                            'product_id' => $product->id,
                            'cart_status'=> '1'
            ];

            $fetchStock = $this->product::where('id',$product->id)->first();
            $currentstock =  $fetchStock->remaning_stock;
            if ($type == 'add') {

                $data = $this->cart->where($cartData)->first();// 
                $requestStock = $data->quantity + 1;
                if($currentstock >= $requestStock)
                { 
                  $increaseCartQuantity = ['quantity' => $data->quantity + 1];
                  $data->update($increaseCartQuantity);

                } else{

                  return redirect()->back()->with(['error'=> 'Maximum quantity exceed']);

                }
                  return redirect()->back();

            } elseif ($type == 'remove') {

                $data = $this->cart->where($cartData)->first();//

                if (isset($data->quantity) AND $data->quantity > 1) {

                  $increaseCartQuantity = ['quantity' => $data->quantity - 1];

                  $data->update($increaseCartQuantity);
                }

                return redirect()->back();
            } else {
                return 'Undefined type';
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        try {
            # fetch user addresses
            $userAddresses = $this->userAddress
                                ->with('state', 'city', 'userData')
                                ->where('user_id' , Auth::user()->id)
                                ->get();  
                                
            if(count($userAddresses) == 0){

              return redirect()->back()->with(['error'=> 'Please select your delivery address.']);

            } 
            else{
              $orderId = $this->order->orderBy('id', 'desc')->first();

              if (isset($orderId->id)) {

                $getOrderId = $orderId->id + 1;

              } else {

                $getOrderId = 1;

              }

              $uniqueOrderId = '#'.$getOrderId.date('Ymd');

              $cartItems = $this->cart
                                ->where('user_id', Auth::user()->id)
                                ->where('cart_status', '1')
                                ->where('status', '1')
                                ->get();

              $this->order
                   ->where('user_id', Auth::user()->id)
                   ->where('status', '2')
                   ->where('order_status', '0')
                   ->where('payment_status', '0')
                   ->forceDelete();
                   
              // foreach ($cartItems as $key => $value) {

                # create array
                $checkoutArray = [
                                  'order_id'    => $uniqueOrderId,
                                  'user_id'     => Auth::user()->id,
                                  'address_id'  => $request->address_id ?? 0,
                                  'order_amount'=> $request->total_price ?? 0,
                                  // 'cart_id'     => $value->id ?? 0,
                                  'status'      => '2',
                ];

                $order = $this->order->create($checkoutArray);

                // $orderId[] = $order->id;
              // }

              return view('website.cart-checkout-vendor.stripe')->with([
                                                                    'total_price' => ($request->total_price ?? ''), 
                                                                    'orderId'     => $uniqueOrderId,
                                                                    'order'       => $order->id
              ]);
          }                      


        } catch (\Exception $e) {
          dd($e);
        }
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey('sk_test_51IY2AxSCH5l2UsWXmuzK8ibXilqvTxzdlUI0t0yBDE5lMO56Hhz08opb1Db4BXJ2u2FU7mgw6tDDyJ7ZmpSXh0NF00Sp5Ltmmc');
      try
      {
        $response = \Stripe\Token::create(array(
          "card" => array(
            "number"    => $request->card_number ?? '',
            "exp_month" => $request->expiration_month ?? '',
            "exp_year"  => $request->expiration_year ?? '',
            "cvc"       => $request->csv ?? '',
            "name"      => $request->name ?? ''
        ))); 

        $data = Stripe\Charge::create ([
                "amount"      => $request->total_price,
                "currency"    => "INR",
                "source"      => $response['id'],
                "description" => "Test payment from itsolutionstuff.com." 
        ]);

        $orderId = $request->orderIds ?? '';

        if ($data['status'] == 'succeeded') {

          $cartItems = $this->cart
                            ->where('user_id', Auth::user()->id)
                            ->where('cart_status', '1')
                            ->where('status', '1')
                            ->get();

          foreach ($cartItems as $key => $value) {

           $product_price =  Product::where('id',$value->product_id)->first();

            $storePaymentDetail = [
                                  'order_unique_id' => $request->orderIds ?? null,
                                  'order_id'        => $request->orderid ?? 0,
                                  'cart_id'         => $value->id ?? 0,
                                  'product_id'      => $value->product_id ?? 0,
                                  'quantity'        => $value->quantity ?? 0,
                                  'transection_id'  => $data['balance_transaction'] ?? null,
                                  'order_status'    => '2',
                                  'order_amount'    => $product_price->selling_price*$value->quantity ?? 0,
                                  'payment_status'  => '1',
                                  'status'          => '1',
            ];
            
            # Remaining Stock  
            $remainingStock = $product_price->remaning_stock ?? 0;
            # Order Quantity  
            $orderQuantity  = $value->quantity ?? 0;
            # Check Remaining Stock Grater then Order Quantity
            if($orderQuantity != 0 && $remainingStock >= $orderQuantity)
            {

              # Subtract Remaining stock to order stock
              $currentStock   = $remainingStock-$orderQuantity; 

              $update = $this->product
                                     ->where('id',$value->product_id)
                                     ->where('status', '1')
                                     ->update(['remaning_stock' => $currentStock]);
          
            }   
              
            $this->orderDetail->create($storePaymentDetail); 
          }

          $this->order
               ->where('id', ($request->orderid ?? ''))
               ->update([
                         'payment_status' => '1', 
                         'transection_id' => $data['balance_transaction'] ?? null, 
                         'order_status'   => '2',
                         'status'         => '3'
               ]);

          $this->cart
               ->where('user_id', Auth::user()->id)
               ->where('cart_status', '1')
               ->update(['cart_status' => '2']);

             
          return redirect('payment-success');
          // Session::flash('success', 'Payment successful!');

        } else {
          Session::flash('error', 'Payment Failed!');
        }
       } catch(\Stripe\Exception\CardException $e) {
          // Since it's a decline, \Stripe\Exception\CardException will be caught
          // echo 'Status is:' . $e->getHttpStatus() . '\n';
          // echo 'Type is:' . $e->getError()->type . '\n';
          // echo 'Code is:' . $e->getError()->code . '\n';
          // // param is '' in this case
          // echo 'Param is:' . $e->getError()->param . '\n';
          // echo 'Message is:' . $e->getError()->message . '\n';
           Session::flash('error', $e->getError()->message);
        
        } catch (\Stripe\Exception\InvalidRequestException $e) {
          // Invalid parameters were supplied to Stripe's API
             Session::flash('error', $e->getError()->message);
        } catch (\Stripe\Exception\AuthenticationException $e) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
           Session::flash('error', $e->getError()->message);
        } catch (Exception $e) {
          // Something else happened, completely unrelated to Stripe
           Session::flash('error', $e->getError()->message);
        }
          
        return back();
    }

    /**
     * checkout page
     * @param
     * @return
     */
    public function checkout()
    {
      try {
        # fetch user addresses
        $userAddresses = $this->userAddress
                              ->with('state', 'city', 'userData')
                              ->where('user_id' , Auth::user()->id)
                              ->get();

        # fetch cart items
        $cartItems = $this->cart
                          ->where('user_id', Auth::user()->id)
                          ->where('cart_status', '1')
                          ->with('products', 'numberOfProduct', 'products.productImage')
                          ->get()->unique('product_id');        

        return view('website.cart-checkout-vendor.checkout')->with([
                                                                    'userAddresses' => $userAddresses, 
                                                                    'cartItems'     => $cartItems
        ]);

      } catch (\Exception $e) {
        dd($e);
      }
    }  

    /**
     * add to wishlist product from user
     * @param
     * @return
     */
    public function wishList(Request $request)
    {
      try { 
        $wishlistData = [
                          'user_id'     => Auth::user()->id,
                          'product_id'  => $request->product_id,
                          'status'      => '1',
                        ];

        $wishlistExist = $this->wishlist
                          ->where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id, 'status' => '1'])
                          ->first();

        if (isset($wishlistExist->id)) {
          return ['error' => 100, 'message' => 'Already added into wishList.'];

              // return redirect()->back()->with(['error'=>'Already added into wishlist.']);


        } else {

          $this->wishlist->create($wishlistData);
          return ['success' => 200, 'message' => 'Added into wishList successfully.'];

          // return redirect()->back()->with(['success'=>'Product added to wishlist Successfully.']);


        }

      } catch (\Exception $e) { 
        return ['error' => 100, 'message' => $e];

          // return redirect()->back()->with(['error'=>'Something went wrong.']);

      }
    }

  /**
   * delete widhlist
   * @param $id
   * @return \Illuminate\Http\Response
   */
   public function removeWishList(Request $request)
    {
        $status =   WishList::where('id', $request->id)->delete();
          if($status)
          {

            return  ['status'  =>  200];

          } else{

            return  ['error'  =>  100];

          }


    }


    /**
    * delete cart
    * @param $id
    * @return \Illuminate\Http\Response
    */
    public function removeToCart(Request $request)
    {
        $status =   Cart::where('id', $request->id)->delete();
          if($status)
          {

            return  ['status'  =>  200];

          } else{

            return  ['error'  =>  100];

          }


    }


    /**
     * add to cart product from user
     * @param
     * @return
     */
    public function addCartFromProductDetail(Request $request)
    {

      // dd($request->all());
      try { 
        $cartData = [
                'user_id'    => Auth::user()->id,
                'product_id' => $request->product_id,
                'quantity'   => isset($request->quantity) ? $request->quantity : '1',
        ];
        
        $fetchStock = $this->product::where('id',$request->product_id)->first();
        $currentstock =  $fetchStock->remaning_stock;
        // dd($request->quantity);
        $cartExist = $this->cart
                          ->where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id, 'cart_status' => '1'])
                          ->first();
        # Chesk Stock Available
        if($currentstock >= $request->quantity)
        {

          if (isset($cartExist->id)) {

            // return ['error' => 100, 'message' => 'Already added into cart.'];
                return redirect()->back()->with(['error'=>'Already added into cart.']);


          } else {

            $this->cart->create($cartData);
            // return ['success' => 200];
                return redirect()->back()->with(['success'=>'Product added to cart successfully.']);
          }
        }else{
           
            return redirect()->back()->with(['error'=>'Maximum quantity exceed.']);
        }

      } catch (\Exception $e) { 
        // return ['error' => 100, 'message' => $e];
              return redirect()->back()->with(['error'=>'Something went wrong.']);

      }
    }


    /**
     * add to cart product from wish list
     * @param
     * @return
     */
    public function addCartFromWishList(Request $request)
    {
      try { 
        $cartData = [
                'user_id'    => Auth::user()->id,
                'product_id' => $request->product_id,
                'quantity'   => isset($request->quantity) ? $request->quantity : '1',
        ];
        $cartExist = $this->cart
                          ->where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id, 'cart_status' => '1'])
                          ->first();

        if (isset($cartExist->id)) {

          return ['error' => 100, 'message' => 'Already added into cart.'];
          // return redirect()->back()->with(['error'=>'Already added into cart.']);

        } else {

          $this->cart->create($cartData);
          
          $this->wishlist->where('id',$request->wish_list_id)->delete();

          return ['success' => 200, 'message' => 'Added into cart successfully.'];
          // return redirect()->back()->with(['success'=>'Added to cart this product successfully.']);
        }

      } catch (\Exception $e) { 
        return ['error' => 100, 'message' => $e];
              // return redirect()->back()->with(['error'=>'Something went wrong.']);

      }
    }


    /**
     * add to wishlist product from user
     * @param
     * @return
     */
    public function addWishList(Request $request)
    {
      try { 
        $wishlistData = [
                          'user_id'     => Auth::user()->id,
                          'product_id'  => $request->product_id,
                          'status'      => '1',
                        ];

        $wishlistExist = $this->wishlist
                          ->where(['user_id' => Auth::user()->id, 'product_id' => $request->product_id, 'status' => '1'])
                          ->first();

        if (isset($wishlistExist->id)) {
          // return ['error' => 100, 'message' => 'Already added into wishList.'];

              return redirect()->back()->with(['error'=>'Already added into wishlist.']);


        } else {

          $this->wishlist->create($wishlistData);
          // return ['success' => 200];

          return redirect()->back()->with(['success'=>'Product added to wishlist successfully.']);


        }

      } catch (\Exception $e) { 
        // return ['error' => 100, 'message' => $e];

          return redirect()->back()->with(['error'=>'Something went wrong.']);

      }
    }

}
