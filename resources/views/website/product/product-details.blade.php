@extends("website.layout.app")
  {{-- @include("website.layout.header") --}}
@section('content')
<style>
    .alert{
        /* border-color: #f5c6cb; */
        text-align: right;
        width: max-content;
        float: right;
    }
</style>
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">  
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>product details</h2>
                </div>
            </div>
            <div class="col-sm-6"> 
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">product details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->

<!-- section start -->
<section class="section-b-space">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 collection-filter">
                   
                    <div class="collection-filter-block">
                        <div class="product-service svg-icon-40">
                            <div class="media">
                                <img src="{{url('img/svg-icon/shipping.svg')}}">
                                <div class="media-body">
                                    <h4>free shipping</h4>
                                    <p>free shipping world wide</p>
                                </div>
                            </div>
                            <div class="media">
                                <img src="{{url('img/svg-icon/24-hours.svg')}}">
                                <div class="media-body">
                                    <h4>24 X 7 service</h4>
                                    <p>online service for new customer</p>
                                </div>
                            </div>
                            <div class="media">
                                <img src="{{url('img/svg-icon/offers.svg')}}">
                                <div class="media-body">
                                    <h4>festival offer</h4>
                                    <p>new online special festival offer</p>
                                </div>
                            </div>
                            <div class="media border-0 m-0">
                                <img src="{{url('img/svg-icon/online-payment.svg')}}">
                                <div class="media-body">
                                    <h4>online payment</h4>
                                    <p>Contrary to popular belief.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- side-bar single product slider start -->
                    <div class="theme-card">
                        <h5 class="title-border">new product</h5>
                        <div class="offer-slider ">
                            @foreach($product as $newProducts)
                            <div class="media">
                                <a href="{{action('Website\HomeController@productDetails', [$newProducts->slug])}}">
                                    <img src="{{ url($newProducts->productImage->first()->image ?? '' ) }}"
                                    class="img-fluid blur-up lazyload image_zoom_cls-0" alt="">
                                </a>
                                <div class="media-body align-self-center">
                                    <div class="rating mb20" style="display:flex;">
                                        @php
                                        $ratingQuery = App\Models\RatingReview::where('product_id', $newProducts->id)->get();
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
                                      </div>
                                    <a href="{{action('Website\HomeController@productDetails', [$newProducts->slug])}}">
                                        <h6>{{$newProducts->title}}</h6>
                                    </a>
                                    <h4>₹ {{$newProducts->selling_price}} <del>₹ {{$newProducts->original_price}}</del></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- side-bar single product slider end -->
                   
                    <!-- side-bar single product slider end -->
                </div>
                <div class="col-lg-9 col-sm-12 col-xs-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-slick">
                                     @foreach($productsDetails->productImage as $product_image)
                                    <div>
                                        <img src="{{ url($product_image->image ?? '' ) }}" alt="" class="img-fluid blur-up lazyload image_zoom_cls-0">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-12 p-0">
                                        <div class="slider-nav">
                                            @foreach($productsDetails->productImage as $product_image)
                                            <div>
                                                <img src="{{ url($product_image->image ?? '' ) }}" alt="" class="img-fluid blur-up lazyload">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 rtl-text">
                                <div class="product-right">
                                    <h2>{{$productsDetails->title}}</h2>
                                    <h4><del>₹ {{$productsDetails->original_price}}</del><span>{{$productsDetails->discount_product_percentage}}% off</span></h4>
                                    <h3>₹ {{$productsDetails->selling_price}}</h3>

                                    <h4 class="product-title size-text color-variant">Color: <li data-toggle="tooltip" data-placement="top" title="{{$productsDetails->color ? $productsDetails->color->name : ''}}" style="background-color: {{$productsDetails->color ? $productsDetails->color->color_code : ''}}; height: 22px; width: 22px; border-radius: 50%;    vertical-align: bottom;"></li>
                                    </h4>
                                    <h4 class="product-title size-text pb-3">size: {{$productsDetails->variant->name}} </h4>


                                    <form action="{{ url('add-cart') }}" method="post" id="add-to-cart">
                                        @csrf    
                                        <div class="product-description border-product">
                                            <h6 class="product-title">quantity</h6>
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <button type="button" class="btn quantity-left-minus" data-type="minus" data-field=""><i class="ti-minus"></i>
                                                        </button> 
                                                    </span>
                                                    <input type="hidden" name="product_id" value="{{ $productsDetails->id }}">
                                                    <input type="text" name="quantity" readonly class="form-control input-number" value="1"> 
                                                        <span class="input-group-prepend">
                                                            <button type="button" class="btn quantity-right-plus" data-type="plus" data-field=""><i class="ti-plus"></i>
                                                            </button>
                                                        </span>
                                                </div>
                                            </div>
                                        </div><!--  -->
                                        <div class="product-buttons">
                                           @if($productsDetails->remaning_stock == 0) 
                                            <span class="btn btn-solid"  style=" color: red;" disabled>Out of Stock</span>
                                           @elseif(Auth::check())
                                            <button type="submit" class="btn btn-solid" style="margin-left: 2px;">add to cart</button>
                                           @else
                                            <a href="{{ url('login') }}" class="btn btn-solid" style="margin-left: 2px;">add to cart</a>
                                           @endif
                                            <!-- <a href="{{url('cart')}}" class="btn btn-solid">buy now</a> -->
                                        </div>
                                    </form>
                                    <div class="border-product">
                                        <h6 class="product-title">product details</h6>
                                        <p>{{$productsDetails->short_description}}</p>
                                    </div>
                                      @php 
                                        $setting = App\Models\Settings::where('status', 1)->first();
                                      @endphp 
                                    <div class="border-product">
                                        <h6 class="product-title">share it</h6>
                                        <div class="product-icon">
                                            <ul class="product-social">
                                                <li><a href="{{$setting->facebook ?? ''}}"><i class="fa fa-facebook"></i></a>
                                                </li>
                                                <li><a href="{{$setting->gmail ?? ''}}"><i class="fa fa-google-plus"></i></a>
                                                </li>
                                                <li><a href="{{$setting->twitter ?? ''}}"><i class="fa fa-twitter"></i></a>
                                                </li>
                                                <li><a href="{{$setting->instagram ?? ''}}"><i class="fa fa-instagram"></i></a>
                                                </li>
                                                </li>
                                            </ul>
                                            <form action="{{ url('add-wishlist') }}" method="post" id="add-to-wishlist" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productsDetails->id }}">
                                                <button href="#" class="wishlist-btn"><i class="fa fa-heart"></i><span class="title-font">Add To WishList</span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="tab-product m-0">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-selected="true"><i
                                                    class="icofont icofont-ui-home"></i>Description</a>
                                        <div class="material-border"></div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-profile" role="tab" aria-selected="false"><i
                                                    class="icofont icofont-man-in-glasses"></i>Details</a>
                                        <div class="material-border"></div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-selected="false"><i
                                                    class="icofont icofont-contacts"></i>View Review</a>
                                        <div class="material-border"></div>
                                    </li>
                                   
                                </ul>
                                <div class="tab-content nav-material" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                        <p>{!! $productsDetails->long_description !!}</p>
                                    </div>
                                    <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                                        <p>{!! $productsDetails->key_feature !!}</p>
                                    </div>
                                    <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                        <section class="section-b-space blog-detail-page review-page py-3">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        @foreach($ratingreviews as $ratingreview)
                                                        <ul class="comment-section">
                                                            <li class="py-3">
                                                                <div class="media">
                                                                    <img src="{{url($ratingreview->userData->first()->image ??'')}}" alt="user image">
                                                                    <div class="media-body">
                                                                        <h6>{{$ratingreview->name ??''}} 
                                                                            <span>
                                                                            @php 
                                                                                $date = date('d M Y', strtotime($ratingreview->created_at ??'')); $time = date('h:m A', strtotime($ratingreview->created_at ??''));
                                                                            @endphp
                                                                            ( {{$date}} at {{$time}} )
                                                                            </span>
                                                                        </h6>
                                                                        <!-- <div class="rating three-star">
                                                                            
                                                                            <i class="fa fa-star"></i>  
                                                                            <i class="fa fa-star"></i>  
                                                                            <i class="fa fa-star"></i>  
                                                                            <i class="fa fa-star"></i>  
                                                                            <i class="fa fa-star"></i>
                                                                        </div> -->
                                                                            @php
                                                                            $value = $ratingreview->rating; 
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
                                                                        <p>{{$ratingreview->review}}</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    @if(Auth::check())
                                    <div class="tab-pane fade" id="top-review" role="tabpanel" aria-labelledby="review-top-tab">
                                        <form class="theme-form" action="{{url('/review-rating', [$productsDetails->id])}}" method="post" enctype="multipart/data-form">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="media">
                                                        <label>Rating</label>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                
                                                                <div id="half-stars-example">
                                                                    <div class="rating-group" required>
                                                                        <input class="rating__input rating__input--none" checked name="rating" id="rating2-0" value="0" type="radio" required="">
                                                                        <label aria-label="0 stars" class="rating__label" for="rating2-0">&nbsp;</label>
                                                                        <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-05" value="0.5" type="radio" required="">
                                                                        <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-10" value="1" type="radio" required="">
                                                                        <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-15" value="1.5" type="radio" required="">
                                                                        <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-20" value="2" type="radio" required="">
                                                                        <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-25" value="2.5" type="radio" checked required="">
                                                                        <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-30" value="3" type="radio" required="">
                                                                        <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-35" value="3.5" type="radio" required="">
                                                                        <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-40" value="4" type="radio" required="">
                                                                        <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-45" value="4.5" type="radio" required="">
                                                                        <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                        <input class="rating__input" name="rating" id="rating2-50" value="5" type="radio" required="">
                                                                    </div>
                                                                 </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your name" required="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$" class="form-control" name="email" id="email" placeholder="Email" required="" >
                                                </div>
                                                <!-- <div class="col-md-12">
                                                    <label for="review">Review Title</label>
                                                    <input type="text" class="form-control" name="review" id="review" placeholder="Enter your Review Subjects" required>
                                                </div> -->
                                                <div class="col-md-12">
                                                    <label for="review">Review Title</label>
                                                    <textarea class="form-control" placeholder="Wrire Your Testimonial Here" name="review" id="review" rows="6"></textarea>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-solid" type="submit">Submit Your Review</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->

<!-- related products -->
<section class="section-b-space pt-0 ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col-12 product-related">
                <h2>related products</h2>
            </div>
        </div>
        <div class="related-product-slider no-arrow">
            @foreach($product as $relatedProducts)
                <div class="product-box">
                        <div class="img-wrapper">
                            <div class="front">
                                <a href="{{action('Website\HomeController@productDetails', [$relatedProducts->slug])}}">
                                    <img class="img-fluid blur-up lazyload" src="{{url(isset($relatedProducts->productImage) ? ($relatedProducts->productImage->first()->image ?? '') : '')}}" alt="">
                                </a>
                            </div>
                            <div class="back">
                                <a href="{{action('Website\HomeController@productDetails', [$relatedProducts->slug])}}">
                                    <img class="img-fluid blur-up lazyload" src="{{url(isset($relatedProducts->productImage) ? ($relatedProducts->productImage->first()->image ?? '') : '')}}" alt="">
                                </a>
                            </div>
                            <div class="cart-info cart-wrap">
                                <button data-toggle="modal" data-target="#addtocart" title="Add to cart"><i class="ti-shopping-cart"></i>
                                </button> <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>  
                            </div>
                        </div>
                        <div class=" p-3">
                            <!-- <div class="rating">
                                <i class="fa fa-star"></i>  
                                <i class="fa fa-star"></i>  
                                <i class="fa fa-star"></i>  
                                <i class="fa fa-star"></i>  
                                <i class="fa fa-star"></i>
                            </div> -->

                            @php
                                $relatedProducRating = App\Models\RatingReview::where('product_id', $relatedProducts->id)->get();
                                $value = $relatedProducRating->avg('rating'); 
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

                            <a href="{{action('Website\HomeController@productDetails', [$relatedProducts->slug])}}" class="text-center">
                                <h6 class="text-center">{{$relatedProducts->title}}</h6>
                            </a>
                            <h4 class="text-center">₹ {{$relatedProducts->selling_price}}</h4>
                            <ul class="product-title size-text color-variant pt-2 text-center">
                                <h5 class="text-center"><strong>Color:</strong> <li data-toggle="tooltip" data-placement="top" title="{{$relatedProducts->color ? $relatedProducts->color->name : ''}}" style="background-color: {{$relatedProducts->color ? $relatedProducts->color->color_code : ''}}; height: 22px; width: 22px; border-radius: 50%;    vertical-align: bottom;"></li>

                            </ul></h5>
                        </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
<!-- related products -->{{-- @include("website.layout.footer") --}}
@section('js')
<script type="text/javascript">
    $('form#add-to-cart').on('submit', function () {  
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            cache:false,
            contentType: false,
            processData: false,
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            dataType: "json",
            data: data,
            success: function(response) { 
              if (response.success == 200) { alert(1);
                location.reload();
              } else { alert(1);
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
    $('#add-to-wishlist').on('submit', function () {  
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            cache:false,
            contentType: false,
            processData: false,
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            dataType: "json",
            data: data,
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