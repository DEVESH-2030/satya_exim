@extends("website.layout.app")
@section('content') 
<style type="text/css">
    .tap-top {
        padding: 12px;
    }

    @media (max-width:1199px){
        .tap-top {
            padding: 7px;
        }
    }
</style>
    <!-- Home slider -->
    <section class="p-0">   
        <div class="slide-1 home-slider">
            @foreach($banner as $banners)
                <div>
                    <div class="home  text-center">  
                        <img src="{{url($banners->image ?? '')}}" alt="" class="bg-img blur-up lazyload">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="slider-contain">
                                        <div>
                                            <h4>welcome to Our Studio</h4>
                                            <h1>Photos</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Home slider end -->
    <div class="title1 section-t-space ">
        <h4>category</h4>
        <h2 class="title-inner1">top category</h2>
    </div>

    <!-- category 2 -->
    <section class="p-0 ratio2_1">
        <div class="container-fluid">
            <div class="row category-border">
                <div class="col">
                    <div class="top-collection-slider product-m no-arrow">

                        @foreach($category as $categories)
                        <div class="product-box">
                            <div class="category-banner">
                               
                                <div class="bg-size blur-up lazyloaded" style="background-image: url(&quot;http://alobhatech.com/ecommerce/public/img/cat1.jpg&quot;); background-size: cover; background-position: center center; display: block;">

                                    <img src="{{$categories->image ??''}}" class="img-fluid blur-up lazyload bg-img" alt="" data-pagespeed-url-hash="2819818188" onload="pagespeed.CriticalImages.checkImageForCriticality(this);" style="display: none;">
                                </div>
                                <div class="category-box">
                                    <a href="{{url('/product?main_category='.$categories->id)}}">
                                        <h2>{{$categories->name}}</h2>
                                    </a>
                                </div>  
                            </div>
                        </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Paragraph-->
    <div class="title1 section-t-space">
        <h4>top collection</h4>
        <h2 class="title-inner1">NEW PRODUCTS</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="product-para">
                        {{-- {!! $product->first()->long_description !!} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Paragraph end -->   

    <!-- Product slider --> 
    <section class="section-b-space p-t-0 ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="product-4 product-m no-arrow">

                        @foreach($product as $productList)
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="front">
                                        <a href="{{url('product-details', [$productList->slug])}}"><img src="{{url(isset($productList->productImage) ? ($productList->productImage->first()->image ?? '') : '')}}"
                                                class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                    </div>
                                    <div class="back">
                                        <a href="{{url('product-details', [$productList->slug])}}"><img src="{{url(isset($productList->productImage) ? ($productList->productImage->first()->image ?? '') : '')}}"
                                                class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                    </div>
                                    <div class="cart-info cart-wrap">
                                        @if($productList->remaning_stock == 0)
                                            <span style="color: red; margin-right: 2px;
                                                position: relative;"><b>Out of Stock</b></span>
                                            @elseif(Auth::check())
                                                <button id="add-to-cart" data-toggle="modal" data-target="#addtocart" title="Add to cart" data-value="{{ $productList->id }}" action="{{ url('add-to-cart') }}" method='POST'>
                                                    <i class="ti-shopping-cart"></i>
                                                </button>
                                            @else
                                                <a href="{{ url('login') }}" title="Add to cart">
                                                    <i class="ti-shopping-cart"></i>
                                                </a>
                                            @endif
                                       
                                        @if(Auth::check())
                                            <button id="add-to-wishlist" title="Add to Wishlist" data-value="{{ $productList->id }}" action="{{ url('add-to-wishlist') }}" method='POST'>
                                                <i class="ti-heart" style="color:"></i>
                                            </button>
                                        @else
                                            <a href="{{ url('login') }}" title="Add to Wishlist">
                                                <i class="ti-heart"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class=" p-3">
                                   <!--  <div class="rating">
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i>
                                    </div> -->

                                    @php
                                        $newProductQuery = App\Models\RatingReview::where('product_id', $productList->id)->get();
                                        $value = $newProductQuery->avg('rating'); 
                                        $final_rating = $value*(100/5);
                                        @endphp
                                     <span class="score" style="margin-left: 30%">
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

                                    <a href="{{url('product-details', [$productList->slug])}}" class="text-center">
                                        <h6 class="text-center">{{$productList->title}}</h6>
                                    </a>
                                    <h4 class="text-center">₹{{$productList->selling_price}}</h4>
                                   <!--  <ul class="color-variant">
                                        <li class="bg-light0"></li>
                                        <li class="bg-light1"></li>
                                        <li class="bg-light2"></li>
                                    </ul> -->
                                   <ul class="color-variant pt-2 text-center">
                                    <h5><strong>Color:</strong>
                                    <li data-toggle="tooltip" data-placement="top" title="{{$productList->color ? $productList->color->name : ''}}"    style="background-color: {{$productList->color ? $productList->color->color_code : ''}}; height: 20px; width: 20px; border-radius: 50%;    vertical-align: bottom;">
                                    </li></h5>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product slider end -->


    <!-- Parallax banner -->
    <section class="p-0">
        <div class="full-banner parallax text-center p-left">
            <img src="{{url('img/home-banner/trend-banner.jpg')}}" alt="" class="bg-img blur-up lazyload">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="banner-contain">
                            <h2>2021</h2>
                            <h3>New mobile</h3>
                            <h4>special offer</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Parallax banner end -->


    <!-- Tab product -->
    <div class="title1 section-t-space">
        <h4>exclusive products</h4>
        <h2 class="title-inner1">special products</h2>
    </div>
    
        <!--four row product slider -->
    <section class="pt-3">
        <div class="container"> 
            <div class="row multiple-slider">

                <div class="col-lg-4 col-sm-6">
                    <div class="theme-card">
                        <h5 class="title-border">feature product</h5>
                        <div class="offer-slider ">
                            @foreach($featureProduct as $featuredProducts)
                            <div class="media">
                                <a href="{{action('Website\HomeController@productDetails', [$featuredProducts->slug])}}">
                                    <img src="{{ url($featuredProducts->productImage->first()->image ?? '' ) }}"
                                    class="img-fluid blur-up lazyload" alt="">
                                </a>
                                <div class="media-body align-self-center">
                                    <!-- <div class="rating">
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i>
                                    </div> -->

                                    @php
                                        $featuredQuery = App\Models\RatingReview::where('product_id', $featuredProducts->id)->get();
                                        $value = $featuredQuery->avg('rating'); 
                                        $final_rating = $value*(100/5);
                                        @endphp
                                     <span class="score">
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

                                    <a href="{{action('Website\HomeController@productDetails', [$featuredProducts->slug])}}">
                                        <h6>{{$featuredProducts->title}}</h6>
                                    </a>
                                    <h4>₹{{$featuredProducts->selling_price}} <del>₹{{$featuredProducts->original_price}}</del></h4>
                                </div>
                            </div>
                            @endforeach
                          
                        </div>
                    </div>
                </div>
                <!-- Best Seller --> 
                <div class="col-lg-4 col-sm-6"> 
                    <div class="theme-card">
                        <h5 class="title-border">Best Seller</h5>
                        <div class="offer-slider "> 
                            @foreach($bestSellingProduct as $bestSelling)
                            <div class="media">
                                <a href="{{action('Website\HomeController@productDetails', [isset($bestSelling) ? ($bestSelling->slug ?? '') : ''])}}">

                                    <img src="{{ url(isset($bestSelling->productImage) ? ($bestSelling->productImage->first()->image ?? '') : '')  }}"
                                    class="img-fluid blur-up lazyload" alt="">
                                   
                                </a>
                                <div class="media-body align-self-center">
                                    @php
                                        $ratingQuery = App\Models\RatingReview::where('product_id', $bestSelling->id)->get();
                                        $value = $ratingQuery->avg('rating'); 
                                        $final_rating = $value*(100/5);
                                    @endphp
                                    <span class="score">
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

                                    <a href="{{action('Website\HomeController@productDetails', [isset($bestSelling) ? ($bestSelling->slug ?? '') : ''])}}">

                                        <h6>{{isset($bestSelling)? ($bestSelling->title ?? '') : ''}}</h6> 
                                    </a>
                                    <h4>₹{{isset($bestSelling) ? ($bestSelling->selling_price ?? '') : ''}} <del>₹{{isset($bestSelling) ?  ($bestSelling->original_price ?? ''): ''}}</del></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- end best seller -->

                <!-- Best Rating -->{{-- @dd($bestRatingProduct) --}}
                <div class="col-lg-4 col-sm-6"> 
                    <div class="theme-card">
                        <h5 class="title-border">best rating</h5>
                        <div class="offer-slider ">
                            @foreach($bestRatingProduct as $bestRating)
                            <div class="media">
                                <a href="{{action('Website\HomeController@productDetails', [isset($bestRating) ? ($bestRating->slug ?? '') : ''])}}">
                                    <img src="{{ url(isset($bestRating->productImage) ? ($bestRating->productImage->first()->image ?? '') : '')  }}"
                                    class="img-fluid blur-up lazyload image_zoom_cls-0" alt="">
                                </a>

                                {{--<a href="{{action('Website\HomeController@productDetails', [$bestRating->productData->first()->slug] ??'')}}">
                                    <img src="{{ url($bestRating->productData->first()->productImage->first()->image ?? '' ) }}"
                                    class="img-fluid blur-up lazyload image_zoom_cls-0" alt="">
                                </a> --}}
                                <div class="media-body align-self-center">
                                    @php
                                        $bestRatingQuery = App\Models\RatingReview::where('product_id', $bestRating->id)->get();
                                        $value = $bestRatingQuery->avg('rating'); 
                                        $final_rating = $value*(100/5);
                                        @endphp
                                    <span class="score">
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

                                    <a href="{{action('Website\HomeController@productDetails', [isset($bestRating) ? ($bestRating->slug ?? '') : ''])}}">
                                        <h6>{{isset($bestRating)? ($bestRating->title ??'') : ''}}</h6>
                                    </a>
                                    <h4>₹{{isset($bestRating) ? ($bestRating->selling_price ??'') : ''}} <del>₹{{isset($bestRating) ? ($bestRating->original_price ?? '') : ''}}</del></h4>


                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- end best rating -->
               
            </div>
        </div>
    </section>
    <!-- product slider end -->
    
    <!--  Brand List section -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="slide-6 no-arrow">
                        @foreach($brand as $brandImage)
                        <div>
                            <div class="logo-block">
                                <a href="#"><img src="{{url($brandImage->image)}}" alt="" width="120" height="120"></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- alert error message -->
    <div class="modal delete-cart-item-popup fade" id="error-x-popup" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{url('img/x-mark.png')}}" width="100px">
                    <p class="mt-3 error-message">Are you sure ?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <!-- <a href="#" class="btn btn-solid btn-custom">OK</a> -->
                    <a href="#" class="btn btn-dark btn-custom" data-dismiss="modal">OK</a>
                </div>
            </div>
        </div>
    </div>

@endsection    
    <!--  logo section end-->
   
    <!--modal popup start-->


  {{-- @include("website.layout.footer") --}}


@section('js')
    <script type="text/javascript">
        $('button#add-to-cart').on('click', function () { 
            var productId = $(this).data('value'); 
            var token='{{csrf_token()}}';
            $.ajax({
                url: $(this).attr("action"),
                method: $(this).attr("method"),
                dataType: "json",
                data: {'product_id' : productId,'_token':token},
                success: function(response) { 
                  if (response.success == 200) {
                    location.reload();
                  } else {
                    $('.error-message').empty();
                    $('.error-message').append(response.message);
                    $('#error-x-popup').modal('show');
                  }
                }
            }); 
        });
    </script>

    <!-- add to wishlist -->
    <script type="text/javascript">
        $('button#add-to-wishlist').on('click', function () { 
            var productId = $(this).data('value'); 
            var token='{{csrf_token()}}';
            $.ajax({
                url: $(this).attr("action"),
                method: $(this).attr("method"),
                dataType: "json",
                data: {'product_id' : productId,'_token':token},
                success: function(response) { 
                  if (response.success == 200) {
                    location.reload();
                  } else {
                    $('.error-message').empty();
                    $('.error-message').append(response.message);
                    $('#error-x-popup').modal('show');
                  }
                }
            }); 
        });
    </script>


@endsection
<script>
    $(window).on('load', function () {
        setTimeout(function () {
            $('#exampleModal').modal('show');
        }, 2500);
    });
    
</script>