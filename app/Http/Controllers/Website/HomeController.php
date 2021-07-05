<?php
namespace App\Http\Controllers\Website;

use File;
use Session; 
use App\User;
use Validator;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Color;
use App\Models\Variant;
use App\Models\RatingReview;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\UserAddress; 
use App\Models\Settings;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Content;
use App\Models\Category;
use App\Models\NewsAlert;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class HomeController extends Controller
{
    use MessageStatusTrait;

    # Bind Type
    protected $type = 'Banner ';

    # Bind location
    protected $view = 'website.';

    # Bind banner
    protected $wishlist;
    protected $user;

    protected $order;

    protected $content;

    protected $banner;

    protected $brand;

    protected $category;

    protected $subcategory;

    protected $productimage;
    
    protected $variant;
    
    protected $color;

    protected $product;

    protected $newsalert;

    protected $settings;

    protected $useraddress;

    protected $ratingreview;

    protected $orderdetail;

    /**
     * default constructor
     * @param
     * @return
     */
    function __construct(
                          WishList  $wishlist,
                        User $user,
                        Order $order,   
                        RatingReview $ratingreview,
                        Content $content, 
                        Product $product,
                        Banner $banner, 
                        Brand $brand,
                        Color $color, 
                        Variant $variant, 
                        Category $category, 
                        NewsAlert $newsalert,
                        SubCategory $subcategory,
                        UserAddress $useraddress,
                        Settings $settings,
                        OrderDetail $orderdetail,
                        ProductImage $productimage
                    ) 
    {
        $this->wishlist     = $wishlist;
        
        $this->user 	    = $user;
        
        $this->order         = $order;

        $this->content      = $content;

        $this->banner       = $banner;
        
        $this->brand        = $brand;

        $this->category     = $category;
        
        $this->subcategory  = $subcategory;
        
        $this->variant      = $variant;
        
        $this->color        = $color;
        
        $this->product      = $product;

        $this->newsalert    = $newsalert;   

        $this->settings     = $settings;

        $this->useraddress  = $useraddress; 

        $this->productimage = $productimage;

        $this->ratingreview = $ratingreview;

        $this->orderdetail  = $orderdetail;

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
        $relations = [
            'productImage',
            'variant',
            'color',
            'brand',
            'category',
            'subCategory',
            'ratingAndReview',
        ];
        $relation = [
            'userData',
            'productData',
            'productData.productImage',
            'productData.variant',
            'productData.color',
            'productData.brand',
            'productData.category',
            'productData.subCategory',
        ];
        
        $OrderRelations = [
                            'orderDetail', 
                            'cartDetail', 
                            'orderDetail.cartDetail', 
                            'orderDetail.cartDetail.products', 
                            'orderDetail.cartDetail.products.productImage'
                        ];
        # Featured product   
        $featureProduct     = $this->product->with($relations)
                                            ->where('feature_status', '1')
                                            ->where('status', '1')
                                            ->take(4)
                                            ->get();
        # Best Selling Product   
        $bestSellingProductIds = $this->orderdetail
                                        ->with('orders')
                                        // ->where('order_status', '3')
                                        ->orderBy('id', 'DESC')
                                        // ->distinct()
                                        // ->unique('product_id')
                                        ->take(4)
                                        ->get()
                                        ->unique('product_id')->pluck('product_id')
                                        ->toArray();

        $bestSellingProducts = $this->product->whereIn('id', $bestSellingProductIds)->get();
       
        # Best Rating Product                                    
        $bestRatingProductid  = $this->ratingreview->with($relation)
                                            ->where('status', '1')
                                            ->orderBy('id', 'DESC')
                                            ->take(4)
                                            ->get()
                                            ->unique('product_id')->pluck('product_id')
                                            ->toArray();

        $bestRatingProduct = $this->product->whereIn('id', $bestRatingProductid)->get();

        $product        = $this->product->with($relations)->where('status', '1')->get();
        $brand          = $this->brand->where('status', 1)->get();  
        $banner 		    = $this->banner->where('status', 1)->get(); 
        $subcategory	  = $this->subcategory->where('status', 1)->get(); 
        $category 		  = $this->category->where('status', 1)->get();
        $setting        = $this->settings->where('status', 1)->first();

        # if nothing is given in input then return all 
        # return to index page
        return view($this->view . 'index')->with([
                                                   
                                                   'bestSellingProduct' => $bestSellingProducts ?? '',
                                                   'featureProduct'     => $featureProduct ?? '',
                                                   'bestRatingProduct'  => $bestRatingProduct ?? '',
                                                   'product'            => $product ?? '',
                                                   'brand'              => $brand ?? '',
                                                   'banner'             => $banner ?? '',
                                                   'category' 		    => $category ?? '',
                                                   'subcategory' 	    => $subcategory ?? '',
                                                   'setting'            => $setting ?? '',
                                                   // 'sold_products'      => $sold_products ?? '',
                                                   // 'rated_products'     => $rated_products ?? '',
                                                ]);
    }

    /**
     * index page of banner
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function newsalert()
    {
        // dd($request->all());
        # Validate requests
        
        $newsalert      = $this->newsalert->where('status', 1)->get();
        # if nothing is given in input then return all
        return view($this->view . 'index')->with([                                                   
                                                   'newsalert' => $newsalert
                                                ]);
    }

    public function newsalertAdd(Request $request)  
    {
        // dd($request->all());
        $data = ['email' => 'required'];

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
          
           $query = $this->newsalert;
           
           # check the requested newsalert already exist or not
           $checknewsalert = $query->where('email', $request->email)
                               ->first();

           if($checknewsalert)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this email already exist.'
                                      ]);  
            }  

            # request param
            $arrayData = [
                           'email'     => $request->email ?? null, 
                         ];     

            #store
            $createnewsalert = $query->create($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Thanks for subscribe'
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
     * index page of content management
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function contentMangement()
    {
        # Validate requests
        $contentMangement      = $this->content
                                                ->where(['title'=>'About Us'])
                                                ->where('status', 1)
                                                ->first();
        # if nothing is given in input then return all
        return view($this->view . 'about')->with([                                                   
                                                   'contentMangement' => $contentMangement
                                                ]);
    }

    /**
    * view details product page
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function productDetails(Request $request,$slug)
    {
        # Relation with product
        $relations = [
            'productImage',
            'variant',
            'color',
            'brand',
            'category',
            'subCategory',
            'ratingAndReview',
        ];

        $relation = [
            'userData',
            'productData',
        ];
        #get all active product                   
        $productsDetails = $this->product
                          ->with($relations)
                          ->where('slug',$slug)
                          ->first();
        // $newProduct = $this->product
        //                   ->with($relations)
        //                   ->get();
        $product        = $this->product
                                        ->with($relations)
                                        ->where('status', '1')
                                        ->take('4')
                                        ->get();

        $ratingreviews  = $this->ratingreview
                               ->with($relation)
                               ->orderBy('id', 'DESC')
                               ->where('status', '1')
                               ->where('product_id', $productsDetails->id)
                               ->get();
        return view($this->view.'product.product-details')->with([ 
                                                                    'product'           => $product ?? '',
                                                                    'ratingreviews'     => $ratingreviews ?? '',
                                                                    'productRating'     => $productRating ?? '',
                                                                    // 'newProduct'        => $newProduct,
                                                                    'productsDetails'   => $productsDetails
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

    # Add Review and Rating
    public function reviewAndRating(Request $request, $id)
    {   
        $data = [
                    'name'           => 'required',
                    'email'          => 'required',
                    'rating'         => 'required',
                    'review'         => 'required',
                    // 'product_id'     => $request->product_id,
                ];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
            // return response()->json([
            //                           (string)$this->errorKey=>(string)$this->errorStatus, 
            //                           'message' => 'Required field is missing.'
            //                         ]);
            return redirect()->back()->with([ 'error' => 'Required field is missing.']);                  

         }

        try {
          
             $user_id = Auth::user()->id ?? 0;
             $product_id = $this->product->where('id',$id)->first();
              
             $query = $this->ratingreview;
           
            # request param
            $arrayData = [
                           'name'           => $request->name ?? '', 
                           'email'          => $request->email ?? '' ,
                           'rating'         => $request->rating ?? '',
                           'review'         => $request->review ?? '',
                           'user_id'        => $user_id ?? '', 
                           'product_id'     => $product_id->id ?? '', 
                           'status'         => 1, 
                         ];     

            #store
            $createReiew = $query->create($arrayData); 

            // return response()->json([
            //                           (string)$this->successKey=>(string)$this->successStatus, 
            //                           'message' => 'Thanks for Rating.'
            //                         ]);    
            if($createReiew){

            return redirect()->back()->with([ 'success' => 'Thanks for Rating.']);                  
            } else{
                return redirect()->back()->with([ 'error' => 'Something wrong.']);                  
            }

        } catch (Exception $e) {
           // dd($e);
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Something went wrong.'
                                    ]);  
        }
       
    }

    # Add wishlist
    public function wishList()
    {   
        $wishlist = $this->wishlist->with('product')
                                    ->where('status', 1)
                                    ->get();
       // dd($wishlist);
        return view($this->view.'cart-checkout-vendor.wishlist')->with([
                                                'wishlist'     => $wishlist ?? [],
                                            ]);
       
    }
}

