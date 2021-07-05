@extends("website.layout.app")
  {{-- @include("website.layout.header") --}}
@section('content')
<style type="text/css">
	
</style>
<!-- breadcrumb start -->
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="page-title">
					<h2>Products</h2>
				</div>
			</div>
			<div class="col-sm-6">
				<nav aria-label="breadcrumb" class="theme-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Products</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- breadcrumb End -->
<!-- section start -->
<section class="section-b-space ratio_asos">  
	<div class="collection-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 collection-filter">
					<!-- side-bar colleps block stat -->
					<form action="{{url('/product')}}" method="get">
						<div class="collection-filter-block">
							<!-- brand filter start -->
							<div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"
	                                        aria-hidden="true"></i> back</span>
							</div>
							<div class="collection-collapse-block open">
								<h3 class="collapse-block-title">Categories</h3> 
								<div class="collection-collapse-block-content">
									<div class="collection-brand-filter h-180-y mt-30">
										@foreach($category as $categories)
										<div class="custom-control custom-checkbox collection-filter-checkbox">
											<input type="checkbox" class="custom-control-input" id="zara{{$categories->id}}" name="category[]" value="{{$categories->id}}" {{ in_array($categories->id, request()->get('category') ?? []) ? 'checked' : '' }}	>
											<label class="custom-control-label" for="zara{{$categories->id}}">{{$categories->name}}</label>
										</div>
										@endforeach
									</div>
								</div>
							</div>
							<!-- color filter start here -->
							<div class="collection-collapse-block open">
								<h3 class="collapse-block-title">colors</h3>
								<div class="collection-collapse-block-content h-180-y mt-30">
									<div class="color-selector">
										<div style="position: relative;">
											@foreach($color as $colors)
											<div class="color" style="background-color: {{$colors->color_code ?? ''}}" >
											  <input type="checkbox" name="color[]" id="{{$colors->id}}" value="{{$colors->id}}" {{ in_array($colors->id, request()->get('color') ?? []) ? 'checked' : '' }}	>
											  <i class="checkbox-icon"></i>

											</div>
										 	<p class="position-colorname">{{$colors->name ?? ''}}</p>
										 	@endforeach
										 </div>
									</div>
								</div>
							</div>

							<!-- brand filter start here -->
							<div class="collection-collapse-block border-0 open">
								<h3 class="collapse-block-title">brands</h3>
								<div class="collection-collapse-block-content">
									<div class="collection-brand-filter h-180-y mt-30">
										@foreach($brand as $brands)
										<div class="custom-control custom-checkbox collection-filter-checkbox">
											<input type="checkbox" class="custom-control-input" id="brand{{$brands->id}}" name="brand[]" value="{{$brands->id}}" {{ in_array($brands->id, request()->get('brand') ?? []) ? 'checked' : '' }}> 
											<label class="custom-control-label" for="brand{{$brands->id}}">{{$brands->name}}</label>
										</div>
										@endforeach
									</div>
								</div>
							</div>

							<!-- size filter start here -->
							<div class="collection-collapse-block border-0 open">
								<h3 class="collapse-block-title">size</h3>
								<div class="collection-collapse-block-content">
									<div class="collection-brand-filter mt-30">
										@foreach($variant as $variants)
										<div class="custom-control custom-checkbox collection-filter-checkbox">
											<input type="checkbox" class="custom-control-input" id="hundred{{$variants->id}}" name="variant[]" value="{{$variants->id}}" {{ in_array($variants->id, request()->get('variant') ?? []) ? 'checked' : '' }}> 
											<label class="custom-control-label" for="hundred{{$variants->id}}">{{$variants->name}}</label>
										</div>
										@endforeach
									</div>
								</div>
							</div>

							<!-- price filter start here -->
							<div class="collection-collapse-block border-0 open">
								<h3 class="collapse-block-title">price</h3>
								<div class="collection-collapse-block-content">
									<div class="row pt-4">
									    <div class="col-sm-12">
									      	<div id="slider-range"></div>
									    </div>
									</div>
									<div class="row slider-labels">
									    <div class="col-6 caption">
									      	<strong>Min:</strong> <span id="slider-range-value1"></span>
									        <input type="hidden" name="min_value" id="min_value" value="{{ request()->min_value }}">
									    </div>
									    <div class="col-6 text-right caption pl-0">
									      	<strong>Max:</strong> <span id="slider-range-value2"></span>
									        <input type="hidden" name="max_value" id="max_value" value="{{ request()->max_value }}">
									    </div>
									</div>
									<div class="row">
									    <div class="col-sm-12">
									      	<!-- <form action="" method="post"> -->
									      		<!-- @csrf -->
									      	<!-- </form> -->
									    </div>
									</div>
								</div>
							</div>

							<div class="pb-4">
								<a href="{{url('product')}}" type="reset" class="btn btn-sm btn-solid mr-2" >Clear</a>
								<button type="submit" href="#" class="btn btn-sm btn-solid">Filter</button>
							</div>
						</div>
					</form>

					<!-- silde-bar colleps block end here -->
					<!-- side-bar single product slider start -->
					<div class="theme-card">
						<h5 class="title-border">new product</h5>
						<div class="offer-slider ">
                             @foreach($newProduct as $newProducts)
                            <div class="media">
                                <a href="{{action('Website\HomeController@productDetails', [$newProducts->slug])}}">
                                    <img src="{{ url($newProducts->productImage->first()->image ?? '' ) }}"
                                    class="img-fluid blur-up lazyload image_zoom_cls-0" alt="">
                                </a>
                                <div class="media-body align-self-center">
                                    <!-- <div class="rating">
                                    	<span class="score score-wrap stars-inactive">
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star" aria-hidden="true"></i> 
                                        <i class="fa fa-star"></i>
                                    	</span>
                                    </div> -->

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

                                    <a href="{{action('Website\HomeController@productDetails', [$newProducts->slug])}}">
                                        <h6>{{$newProducts->title}}</h6>
                                    </a>
                                    <h4>₹ {{$newProducts->selling_price}} <del>₹ {{$newProducts->original_price}}</del></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
					</div>
				</div>

				<!-- Product List -->
				<div class="collection-content col">
					<div class="page-main-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="collection-product-wrapper">
									<div class="product-wrapper-grid product-load-more">
										<div class="row margin-res">
											@if(count($products) > 0)
												@foreach($products as $productList)
													<div class="col-xl-3 col-6 col-grid-box">
							                            <div class="product-box">
							                                <div class="img-wrapper">
							                                    <div class="front">
							                                        <a href="{{action('Website\HomeController@productDetails', [$productList->slug])}}"><img src="{{url(isset($productList->productImage) ? ($productList->productImage->first()->image ?? '') : '')}}"
							                                                class="img-fluid blur-up lazyload bg-img" alt=""></a>
							                                    </div>
							                                    <div class="back">
							                                        <a href="{{action('Website\HomeController@productDetails', [$productList->slug])}}"><img src="{{url(isset($productList->productImage) ? ($productList->productImage->first()->image ?? '') : '')}}"
							                                                class="img-fluid blur-up lazyload bg-img" alt=""></a>
							                                    </div>
							                                    <div class="cart-info cart-wrap">
							                                    	@if($productList->remaning_stock == 0)
							                                    	<span style="color: red; margin-right: 2px;
																	    position: relative;"><b>Out of Stock</b></span>
							                                    	@elseif(Auth::check())
						                                        		<button id="add-to-cart" data-toggle="modal" data-target="#addtocart" title="Add to cart" data-value="{{ $productList->id }}" action="{{ url('add-to-cart') }}" method='POST'><i class="ti-shopping-cart"></i>
							                                        	</button>
						                                        	@else
								                                        <a href="{{ url('login') }}" title="Add to cart">
								                                            <i class="ti-shopping-cart"></i>
								                                        </a>
							                                   	    @endif

							                                   	    @if(Auth::check())
						                                        		<a id="add-to-wishlist" title="Add to Wishlist" data-value="{{ $productList->id }}" action="{{ url('add-to-wishlist') }}" method='POST'>
						                                        		<i class="ti-heart"></i>
							                                        	</a>
						                                        	@else
								                                        <a href="{{ url('login') }}" title="Add to Wishlist">
								                                            <i class="ti-heart" aria-hidden="true"></i>
								                                        </a>
							                                   	    @endif
							                                        <!-- <a href="javascript:void(0)" title="Add to Wishlist"> -->
	                                            						<!-- <i class="ti-heart" aria-hidden="true" style="color:red"></i> -->
							                                        <!-- </a> -->
							                                        <!-- <i class="ti-heart" aria-hidden="true"></i> -->
							                                    </div>
							                                </div>
							                                <div class="p-3">
							                                    <!-- <div class="rating">
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

							                                    <a href="{{action('Website\HomeController@productDetails', [$productList->slug])}}" class="text-center">
							                                        <h6 class="text-center">{{$productList->title}}</h6>
							                                    </a>
							                                    <h4 class="text-center">₹ {{$productList->selling_price}}</h4>
							                                    <ul class="color-variant pt-2 text-center">
							                                    	
							                                    <h5 class="text-center"><strong>Color:</strong> <li data-toggle="tooltip" data-placement="top" title="{{$productList->color ? $productList->color->name : ''}}"    style="background-color: {{$productList->color ? $productList->color->color_code : ''}}; height: 22px; width: 22px; border-radius: 50%;    vertical-align: bottom;"></li>
	                                							</h5>
							                                    </ul>
							                                </div>
							                            </div>
													</div>
												@endforeach
											@else
											<div class="w-100 text-center">
                                     			<h3 colspan="8" class="text-center" >Data Not Available</h3>
                                     		</div>
                                     		@endif

										</div>
										@php 
				                             $page=1;
				                             if(Request::input('page'))
				                             $page=Request::input('page');
				                             $sort = $products->perPage();
				                        @endphp  
							            @if(count($products) > 0)            
										<div class="row">  
				                           <div class="col-md-6 text-left" style="margin: 20px 0px;">
				                             Showing  {{$products->firstItem()}} to {{$products->lastItem()}} of {{$products->total()}} entries
				                           </div>
				                           <div class="col-md-6 text-right paginationBlock">
				                             {!! $products->appends(request()->input())->links() !!}
				                           </div>
				                        </div>
				                        @endif
										<!-- <div class="load-more-sec mt-1">
											<a href="javascript:void(0)" class="loadMore">load more</a>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end product list -->

		</div>
	</div>
</section>

@endsection
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
	$('a#add-to-wishlist').on('click', function () { 
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
<!-- section End -->
