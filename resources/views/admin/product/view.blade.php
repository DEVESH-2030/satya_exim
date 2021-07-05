
@extends('admin.layout.app')

    @section('content')
        <!-- Container-fluid starts-->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Product Detail
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Product Management</li>
                        <li class="breadcrumb-item active">Product Detail</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="row product-page-main card-body">
                    <div class="col-xl-4">
                        <div class="product-slider owl-carousel owl-theme" id="sync1">
                            @foreach($products->productImage as $product_image)
                            <div class="item"><img src="{{ url($product_image->image ?? '' ) }}" alt="" class="blur-up lazyloaded"></div>
                            @endforeach
                        </div>
                        <div class="owl-carousel owl-theme" id="sync2">
                            @foreach($products->productImage as $product_image)
                            <div class="item"><img src="{{ url($product_image->image ?? '' ) }}" alt="" class="blur-up lazyloaded"></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="product-page-details product-right mb-0">
                                <h2>{{$products->title ?? ''}}</h2>
                                <h5><strong>Category:</strong>{{$products->category ? $products->category->name : ''}}</h5>
                                <h5><strong>Sub Category:</strong>{{$products->subCategory ? $products->subCategory->name : ''}}</h5>
                                
                                <h5><strong>Brand:</strong>{{$products->brand ? $products->brand->name : ''}}</h5>

                                <h5><strong>Color:</strong> <li data-toggle="tooltip" data-placement="top" title="{{$products->color ? $products->color->name : ''}}"    style="background-color: {{$products->color ? $products->color->color_code : ''}}; height: 22px; width: 22px; border-radius: 50%;    vertical-align: bottom;"></li>
                                </h5>
                                
                                <h5><strong>Variant:</strong>{{$products->variant ? $products->variant->name : ''}}</h5>
                                
                                <div class="add-product-form d-flex align-items-center">
                                    <h6 class="product-title">In Stock:</h6>
                                    <p class="ml-3">{{$products->remaning_stock}}</p>
                                </div>
                                <div class="add-product-form d-flex align-items-center">
                                    <h6 class="product-title">Status:</h6>
                                    <p class="ml-3">
                                        @if($products->status == 1)
                                            <span>Active</span>
                                            @else
                                            <span>Inactive</span>
                                        @endif
                                    </p>
                                </div>

                                @php
                                  $rating = App\Models\RatingReview::where('product_id', $products->id)->get();
                                  $value = $rating->avg('rating'); 
                                  $final_rating = $value*(100/5);
                                @endphp
                                <span class="score" style="display: block;">
                                    <div class="score-wrap">
                                        <span class="stars-active" style="width:{{ $final_rating }}%">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </span>
                                        <span class="stars-inactive">
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </span>
                                <hr>
                                <h6 class="product-title">product details</h6>
                                <p><h5><strong>Short Description:</strong></h5>{{$products->short_description}}</p>
                                <p><h5><strong>Long Description:</strong></h5>{!! $products->long_description !!}</p>
                                <p><h5><strong>Key & Features:</strong></h5>{!! $products->key_feature !!}</p>
                                <div class="product-price digits mt-2">
                                    <h3>₹{{$products->selling_price}} <del>₹{{$products->original_price}}</del></h3>
                                </div>
                                <!-- <ul class="color-variant">
                                    <li class="bg-light0"></li>
                                    <li class="bg-light1"></li>
                                    <li class="bg-light2"></li>
                                </ul> -->
                                
                                
                                
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    @endsection