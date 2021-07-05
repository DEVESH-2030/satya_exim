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


class SearchController extends Controller
{
    use MessageStatusTrait;

    # Bind Type
    protected $type = 'search ';

    # Bind location
    protected $view = 'website.';

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        # Validate requestss
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
        $subcategory    = $this->subcategory->where('status', 1)->get();
        
        $search       = $this->product->with($relations)
                                        ->where('status', '1');
        if(isset($request->title))
        {
            $search   = $search->where('title','LIKE','%'. $request->title .'%');
        }   

        $searchProduct = $search->get();
        # return to index page  s
        return view($this->view.'product.product')->with([
                                                   'searchProduct'      => $searchProduct ?? [],
                                                   'variant'            => $variant ?? [],
                                                   'color'              => $color ?? [],
                                                   'brand'              => $brand ?? [],
                                                   'category'           => $category ?? [],
                                                   'products'           => $products ?? []
                                                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
