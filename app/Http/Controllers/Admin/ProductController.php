<?php

namespace App\Http\Controllers\Admin;

use DB;
use Validator;  
use App\Models\Color;   
use App\Models\Brand;
use App\Models\Variant;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  
use App\Http\Traits\MessageStatusTrait;

class ProductController extends Controller
{
    use MessageStatusTrait;
    # Bind Type
    protected $type = 'Product ';

    # Bind location
    protected $view = 'admin.product.';

    protected $subcategory;

    protected $products;
    
    protected $category;
    
    protected $productimage;
    
    protected $brand;
    
    protected $variant;
    
    protected $color;

    function __construct(
                          SubCategory $subcategory, 
                          Product $product, 
                          Category $category, 
                          Brand $brand, 
                          Color $color, 
                          Variant $variant, 
                          ProductImage $productimage)
    {
        $this->brand        = $brand;
        $this->color        = $color;
        $this->product      = $product;
        $this->variant      = $variant;
        $this->category     = $category;
        $this->subcategory  = $subcategory;
        $this->productimage = $productimage;
        
        #initilize pafination from config
        $this->page = config('paginate.pagination');

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      #get all active category                
      $categories = $this->category
                        ->where('status','1')
                        ->get(); 

                        #get all active category                
      $subcategory = $this->subcategory
                        ->where('status','1')
                        ->get();
      $query = $this->product;
     if (($request->product_id == '') AND ($request->category_id == '') AND ($request->sub_category_id == '') AND ($request->status == '') AND ($request->name == '')) {
       # if nothing is given in input then return all
        // $products = $this->product->orderByDesc('id')->paginate(10);
          $products = $query->orderBy('id','desc')
                            ->paginate(10);
      } else {
       # Filtered Output 
       $products = $query->productAddedBetween($request->product_id, $request->category_id, $request->sub_category_id, $request->status, $request->name)->orderBy('id','desc') 
                                ->paginate(10);
      }
        return view('admin.product.index')->with([
                                                    'query'           => $query ?? [] ,
                                                    'products'        => $products ?? [] ,
                                                    'categories'      => $categories ?? [],
                                                    'subcategory'     => $subcategory ?? [],
                                                    'product_id'      => $request->product_id ?? '',
                                                    'category_id'     => $request->category_id ?? '',
                                                    'sub_category_id' => $request->sub_category_id ?? '',
                                                    'status'          => $request->status ?? '',
                                                    'name'            => $request->name ?? ''

                                                  ]); 
    }

 //    /**
 //  * View Details page
 //  * @param Illuminate\Http\Request;
 //  * @return Illuminate\Http\Response;
 //  */
 //  public function viewDetail($id)
 //  {
 //      $productDetail = $this->product->with($relation)
 //                        ->where('id', $id)
 //                        ->first(); 
 //      # Return data on view detail page
 //      return view($this->view.'view')->with(['productDetail' => $productDetail]);
 // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     #get all active category                
     $categories = $this->category
                        ->where('status','1')
                        ->get();

     #get all active color                   
     $colors = $this->color
                    ->where('status','1')
                    ->get();
     #get all active variant                   
     $variants = $this->variant
                      ->where('status','1')
                      ->get();                   
     #get all active brand                   
     $brands = $this->brand
                    ->where('status','1')
                    ->get(); 

  return view($this->view.'add')->with([
                                                'categories' => $categories,
                                                'variants'   => $variants,
                                                'colors'     => $colors,
                                                'brands'     => $brands,
                                              ]);
    }


   /**
  * post create product
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
 public function store(Request $request)
    {

      $data = [
                'title'      => 'required',
                'category_id'        => 'required',
                'sub_category_id'    => 'required',
                'brand_id'           => 'required',
                'variant_id'         => 'required',
                'color_id'           => 'required',
                'product_type'       => 'required',
                'short_description'  => 'required',
                'long_description'   => 'required',
                'key_feature'        => 'required',
                'original_price'     => 'required',
                'discount_product_percentage'      => 'required',
                'total_stock'        => 'required',
                'status'             => 'required',
                'product_image'      => 'required|array'
              ];

//dd($request->all());
        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
            return response()->json([
                                      'code'=>$validator->errors(), 
                                      'message' => 'Required field is missing.'
                                    ]);
            // return redirect()->back()->with('error', 'Required field is missing');
         }
        try {
           
                   
            DB::beginTransaction();
            #product model
            $query = $this->product;
                    
            # check the requested product title already exist or not
            $checkProduct = $query->where('category_id', $request->category_id)
                                  ->where('sub_category_id', $request->sub_category_id)
                                  ->where('brand_id', $request->brand_id)
                                  ->where('color_id', $request->color_id)
                                  ->where('variant_id', $request->variant_id)
                                  ->where('title', $request->title)
                                  ->first();

            if($checkProduct)
            {   
              return response()->json([
                                        'code'=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this title exist above category.'
                                      ]);  
              // return redirect()->back()->with('error', 'Sorry, this title exist above category.');
            }  

           $selling_price = $request->original_price - number_format(($request->original_price*$request->discount_product_percentage)/100, 2, '.', '');
            # request param
            $primaryData = [
                           'title'              => $request->title,
                           'product_type'       => $request->product_type,
                           'category_id'        => $request->category_id,  
                           'sub_category_id'    => $request->sub_category_id ?? null,
                           'brand_id'           => $request->brand_id ?? null, 
                           'color_id'           => $request->color_id ?? null, 
                           'variant_id'         => $request->variant_id ?? null, 
                           'short_description'  => $request->short_description ?? null,
                           'total_stock'        => $request->total_stock ?? null, 
                           'remaning_stock'     => $request->total_stock ?? null, 
                           'original_price'     => $request->original_price ?? null, 
                           'selling_price'      => $selling_price ?? null, 
                           'discount_product_percentage'     => $request->discount_product_percentage ?? null, 
                           'status'             => $request->status ?? 1, 
                           'long_description'   => $request->long_description ?? null, 
                           'key_feature'        => $request->key_feature ?? null, 
                           'feature_status'     => 0, 
                         ];     
                        

            #store primary data
            $createPrimaryData = $query->create($primaryData);
            #product id
            $product_id=$createPrimaryData->id;

            $product_slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->title));

            $final_product_slug = preg_replace('/_+/', '_', $product_slug).'_'.$product_id;

            #update 
            $query->where('id', $product_id)->update(['slug' => $final_product_slug]);


                        if (isset($request->product_image)) 
                        {
                            foreach ($request->product_image as $image_key => $product_image) 
                              {
                                $addImageData = new ProductImage();
                                $extension = $product_image->getClientOriginalExtension(); // getting image extension
                                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                                $product_image->move(public_path('images/product/'), $filename);
                                $addImageData->image='images/product/'.$filename;
                                $addImageData->product_id = $product_id;   
                                $addImageData->save();

                              }
                        }
              DB::commit();
                        
            
            return response()->json([
                                      'code'=>(string)$this->successStatus, 
                                      'message' => 'Product Added Successfully.'
                                    ]); 
            // return redirect()->back()->with('success', 'Product Added Successfully.');                                             

        } catch (Exception $e) {
           // dd($e);
            return response()->json([
                                      'code'=>(string)$this->errorStatus, 
                                      'message' => 'Something went wrong.'
                                    ]);  
           // return redirect()->back()->with('error', 'Something went wrong.'); 
        }
       
    }


    
    /**
  * edit product page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function update(Request $request,$id)
 {
         #get all active category                
     $categories = $this->category
                        ->where('status','1')
                        ->get();

     #get all active color                   
     $colors = $this->color
                    ->where('status','1')
                    ->get();
     #get all active variant                   
     $variants = $this->variant
                      ->where('status','1')
                      ->get();                   
     #get all active brand                   
     $brands = $this->brand
                    ->where('status','1')
                    ->get();


     #get all active product                   
     $products = $this->product
                      ->with(['productImage'])
                      ->where('id',$id)
                      ->orderBy('id','desc')
                      ->first(); 


     #get all active sub category category wise   
     $subcategories  = $this->subcategory
                            ->where('category_id',$products->category_id)
                            ->where('status','1')
                            ->orderBy('id','desc')
                            ->select('id', 'name')
                            ->get(); 


  return view($this->view.'edit')->with([
                                          'products'          => $products,
                                          'categories'        => $categories,
                                          'subcategories'     => $subcategories,
                                          'brands'            => $brands,
                                          'colors'            => $colors,
                                          'variants'          => $variants,
                                        ]);
 }



   /**
  * post update product
  * @param Illuminate\Http\Request; 
  * @return Illuminate\Http\Response;
  */
 public function edit(Request $request)
    {
  // dd($request->all());
      $data = [
                'title'                       => 'required',
                'category_id'                 => 'required',
                'sub_category_id'             => 'required',
                'brand_id'                    => 'required',
                'variant_id'                  => 'required',
                'color_id'                    => 'required',
                'product_type'                => 'required',
                'short_description'           => 'required',
                'long_description'            => 'required',
                'key_feature'                 => 'required',
                'original_price'              => 'required',
                'discount_product_percentage' => 'required',
              ];


//dd($request->all());
        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
            return response()->json([
                                      'code'=>$validator->errors(), 
                                      'message' => 'Required field is missing.'
                                    ]);
             // return redirect()->back()->with('error', 'Required field is missing.');
         }


        try {

           DB::beginTransaction();
           #product model
           $query = $this->product->where('id',$request->product_id)->first();
           
           # check the requested product title already exist or not
           $checkProduct =$this->product->where('category_id', $request->category_id)
                                       ->where('sub_category_id', $request->sub_category_id)
                                       ->where('brand_id', $request->brand_id)
                                       ->where('color_id', $request->color_id)
                                       ->where('variant_id', $request->variant_id)
                                       ->where('title', $request->title)
                                       ->where('id', '!=', $request->product_id)
                                       ->first();                              

           if($checkProduct)
            {   
              return response()->json([
                                        'code'=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this title exist above category and brand.'
                                      ]);  
              // return redirect()->back()->with('error', 'Sorry, this title exist above category and brand.');
            }  


           $selling_price = $request->original_price - number_format(($request->original_price*$request->discount_product_percentage)/100, 2, '.', '');
            # request param
            $primaryData = [
                           'title'              => $request->title,
                           'product_type'       => $request->product_type,
                           'category_id'        => $request->category_id,  
                           'sub_category_id'    => $request->sub_category_id ?? null,
                           'brand_id'           => $request->brand_id ?? null, 
                           'color_id'           => $request->color_id ?? null, 
                           'variant_id'         => $request->variant_id ?? null, 
                           'short_description'  => $request->short_description ?? null,
                           'original_price'     => $request->original_price ?? null, 
                           'selling_price'      => $selling_price ?? null, 
                           'discount_product_percentage'     => $request->discount_product_percentage ?? null, 
                           'long_description'   => $request->long_description ?? null, 
                           'key_feature'        => $request->key_feature ?? null, 
                         ];    

            #store primary data
            $createPrimaryData = $query->update($primaryData);

            $product_slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->title));

            $final_product_slug = preg_replace('/_+/', '_', $product_slug).'_'.$request->product_id;

            #update 
            $query->where('id', $request->product_id)->update(['slug' => $final_product_slug]);
           

                         if (isset($request->product_image)) 
                         {
                            foreach ($request->product_image as $image_key => $product_image) 
                              {
                                    $addImageData                     = new ProductImage();
                                    $extension = $product_image->getClientOriginalExtension(); // getting image extension
                                    $filename =((string)(microtime(true)*10000)).'.'.$extension;
                                    $product_image->move(public_path('images/product/'), $filename);
                                    $addImageData->image='images/product/'.$filename;
                                   $addImageData->product_id         = $request->product_id;   
                                   $addImageData->save();

                              }
                          }

              DB::commit();
            
            return response()->json([
                                      'code'=>(string)$this->successStatus, 
                                      'message' => 'Product Updated Successfully.'
                                    ]); 
           // return redirect()->back()->with('success', 'Product Updated Successfully.');                                              

        } catch (Exception $e) {
           // dd($e);
            // return response()->json([
            //                           'code'=>(string)$this->errorStatus, 
            //                           'message' => 'Something went wrong.'
            //                         ]);  
            return redirect()->back()->with('error', 'Something went wrong.');
        }
       
    }



/**
  * view details product page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
 public function view(Request $request,$id)
 {
  
     #get all active product                   
     $products = $this->product
                      ->with(['productImage'])
                      ->where('id',$id)
                      ->first(); 
  // dd($products->productImage); 
  return view($this->view.'view')->with([
                                          'products'   => $products
                                        ]);
 }

    /**
     * active deactive
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        # initiate constructor
        $query = $this->product;

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

    /**
     * active deactive
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function featuredStatus($id)
    {
        # initiate constructor
        $query = $this->product;

        # get the status
        $status = $query->where('id', $id)->first()->feature_status;

        # check status, if active
        if ($status == '1')
        {
            #message
            $message = 'Product Unfeatured Successfully';

            # deactive( update status to zero)
            $statusCode = '0';
        }
        else
        {
            #message
            $message = 'Product Featured Successfully';

            # active( update status to one)
            $statusCode = '1';
        }

        # update status code
        $query->where('id', $id)->update(['feature_status' => $statusCode]);

        # return success
        return ['success' => 200, 'message' => $message];
    }


}
