<?php
namespace App\Http\Controllers\Website;

use File;
use Validator;

use App\Models\Color;
use App\Models\Variant;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\NewsAlert;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class ProductController extends Controller
{
    use MessageStatusTrait;

    # Bind Type
    protected $type = 'Banner ';

    # Bind location
    protected $view = 'website.product.';

    # Bind banner
    protected $banner;

    protected $brand;

    protected $category;

    protected $subcategory;

    protected $productimage;
    
    protected $variant;
    
    protected $color;

    protected $product;

    protected $newsalert;

    /**
     * default constructor
     * @param
     * @return
     */
    function __construct(
                        Product $product,
                        Banner $banner, 
                        Brand $brand, 
                        Color $color, 
                        Variant $variant, 
                        Category $category, 
                        NewsAlert $newsalert,
                        SubCategory $subcategory,
                        ProductImage $productimage
                    ) 
    {
        $this->banner       = $banner;

        $this->brand        = $brand;

        $this->category     = $category;
        
        $this->subcategory  = $subcategory;
        
        $this->variant      = $variant;
        
        $this->color        = $color;
        
        $this->productimage = $productimage;

        $this->product      = $product;

        $this->newsalert    = $newsalert;


        
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
        
        $brand          = $this->brand->where('status', 1)->get();  
        $color          = $this->color->where('status', 1)->get();  
        $variant        = $this->variant->where('status', 1)->get();  
        $category       = $this->category->where('status', 1)->get();
        $products       = $this->product->with($relations)->where('status', '1');
        
        # Use Search Product by product name
        if(isset($request->name))
        {
            $products   = $products->where('title','LIKE','%'. $request->name .'%');
        }   

        # Filter by Category
        if(isset($request->category) AND ($request->category != null))
        { 
            $product = $products->whereIn('category_id', $request->category); 
        }

        # Filter by main_category
        if(isset($request->main_category) AND ($request->main_category != null))
        { 
            $product = $products->where('category_id', $request->main_category); 
        }

         # Filter by subcategory
        if(isset($request->subcategory) AND ($request->subcategory != null))
        { 
            $product = $products->where('sub_category_id', $request->subcategory); 
        }
        
        #Filter by Brand  
        if(isset($request->brand) AND ($request->brand != null))
        { 
            $product = $products->whereIn('brand_id', $request->brand); 
        }

        # Filter by variant
        if(isset($request->variant) AND ($request->variant != null))
        { 
            $product = $products->whereIn('variant_id', $request->variant); 
        }

        # Filter by color 
        if(isset($request->color) AND ($request->color != null))
        { 
            $product = $products->whereIn('color_id', $request->color); 
        }
        
        # Filter By Product Price       
        $min_price = $request->min_value;
        $max_price = $request->max_value;
        if (isset($request->min_value) && isset($request->max_value)) {
            $product = $products->where(function ($q) use ($min_price, $max_price) {
                //$q->whereBetween('selling_price1', [$min_price, $max_price]);
                 $q->where('selling_price', '>', $min_price);
                 $q->where('selling_price', '<', $max_price);
            });
        }
        # Fetch All data by search / filter       
        $products = $products->orderBy('id','desc')
                                  ->paginate(12);

 
        $newProduct = $this->product->with($relations)
                                    ->orderBy('id','DESC')
                                    ->where('status', '1')
                                    ->take('4')
                                    ->get();
        // dd($newProduct);
        # return to index page  
        return view($this->view . 'product')->with([
                                                     'color'        => $color ?? '',
                                                     'brand'        => $brand ?? '',
                                                     'variant'      => $variant ?? '',
                                                     'newProduct'   => $newProduct ?? '',
                                                     'products'     => $products ?? '',
                                                     'category'     => $category ?? ''
                                                    ]);
    }

    /**
     * index page of banner
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function productDetails()
    {
        # Validate requests
        $productDetails  = $this->product->where('status', 1)->get();
        # if nothing is given in input then return all
        return view($this->view . 'product-details')->with([                                                   
                                                   'productDetails' => $productDetails
                                                ]);
    }

    public function newsalertAdd(Request $request)
    {
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
    * view details product page
    * @param Illuminate\Http\Request;
    * @return Illuminate\Http\Response;
    */
    public function viewProductDetails(Request $request,$id)
    {
      
         #get all active product                   
         $productsDetails = $this->product
                          ->with(['productImage'])
                          ->where('id',$id)
                          ->first(); 
      return view($this->view.'product.product-details')->with([
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


}

