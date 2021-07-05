    <div class="menu-right pull-right">
    <div>
        <nav id="main-nav">
            <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
            <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                <li>
                    <div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2"
                            aria-hidden="true"></i></div>
                </li>
                <li class="active">
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('about-us')}}">About Us</a>
                </li>
                @php 
                   $categories = App\Models\Category::where('status', 1)->get();
                @endphp
                <li><a href="#">Category</a>
                    <ul>
                        @foreach($categories as $category)

                        @php $subCategories = App\Models\SubCategory::where('category_id',$category->id)->get(); @endphp
                        <li>
                            <a href="#">{{$category->name}}</a>
                            <ul>
                                <li> 
                                    @foreach($subCategories as $subCategory)

                                        @php $product = App\Models\Product::where('category_id',$category->id ??'')->where('sub_category_id',$subCategory->id ??'')->first(); @endphp
                                    <a href="{{url('/product?main_category='.$category->id.'&subcategory='.$subCategory->id)}}">{{$subCategory->name}}</a>
                                    @endforeach
                                </li>
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{action('Website\ProductController@index')}}">Products</a>
                </li>
                <li>
                    <a href="{{ url('contact-us') }}">Contact Us</a>
                </li>
            </ul>
        </nav>
    </div>
    <div>
        <div class="icon-nav">
            @php 
                $product  = App\Models\Product::where('status', '1')->first();
            @endphp
            <ul>
                <li class="onhover-div mobile-search">
                    <div><img src="{{url('img/icon/search.png')}}" onclick="openSearch()"
                            class="img-fluid blur-up lazyload" alt=""> <i class="ti-search"
                            onclick="openSearch()"></i></div>
                    <div id="search-overlay" class="search-overlay">
                        <div> 
                            <div class="overlay-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <form action="{{url('/product')}}" method="get">
                                                {{-- @csrf --}}
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control"                  id="name" placeholder="Search a Product">
                                                </div>
                                                <button type="submit" class="btn btn-primary search-submit-btn" >Search</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="closebtn" onclick="closeSearch()"
                                title="Close Overlay">×</span>
                        </div>
                    </div>
                </li>
                 @php 
                   $user = App\User::where('status',1)->first();
                @endphp 
                    @if(Auth::check())
                <li class="onhover-div mobile-setting">
                    <div><img src="{{url('img/icon/setting.png')}}"
                            class="img-fluid blur-up lazyload" alt=""> <i
                            class="ti-settings"></i></div>
                    <div class="show-div setting">
                        <h6>Profile Setting</h6>
                        <ul>
                            <li><a href="{{action('Website\UserProfileController@index')}}">View Profile</a></li>
                            @if(!Auth::check())
                            <li><a href="{{url('register')}}">Create Account</a></li>
                            @php 
                               $user = App\User::where('status',1)->first();
                            @endphp 
                            <li><a href="{{url('edit-account', [$user->id])}}">Manage Account</a></li>
                            @endif
                        </ul><!-- 
                        <h6>Profile Setting</h6>
                        <ul class="list-inline">
                            <li><a href="#">Add Profile</a></li>
                        </ul> -->
                    </div>
                </li>
                @endif
                
                <li class="onhover-div mobile-cart">
                    @php
                        $priceArray = [];
                        $countCart = App\Models\Cart::where([
                                                            'user_id' => (Auth::user()->id ?? ''), 
                                                            'cart_status' => '1'
                                                  ])->count();
                        @endphp
                    <div><img src="{{url('img/icon/cart.png')}}" class="img-fluid blur-up lazyload" alt=""> <span class="items-number">{{$countCart ??''}}</span><i
                            class="ti-shopping-cart"></i>
                    </div>
                        @if(Auth::check())        
                        @php
                            $priceArray = [];
                            $cartItems = App\Models\Cart::where([
                                                                'user_id' => (Auth::user()->id ?? ''), 
                                                                'cart_status' => '1'
                                                      ])->with('products', 'products.productImage')
                                                        ->get()->unique('product_id');
                        @endphp
                            @if(count($cartItems) > 0)    
                            <ul class="show-div shopping-cart">
                               
                                @foreach($cartItems as $cartItem)
                                <li>
                                    @php
                                        //$numberOfItem = App\Models\Cart::where([
                                        //                                'cart_status' => '1', 'product_id' => $cartItem->product_id])->count();
                                        $numberOfItem = $cartItem->quantity;
                                    @endphp
                                    <div class="media">
                                        <a href="{{url('product-details', [$cartItem->products ? ($cartItem->products->slug ?? '') : ''])}}">
                                            <img alt="" class="mr-3"
                                                src="{{url($cartItem->products ? ($cartItem->products->productImage ? ($cartItem->products->productImage->first()->image ?? 'img/product/1.jpg') : 'img/product/1.jpg') : 'img/product/1.jpg')}}">
                                        </a>
                                        <div class="media-body">
                                            <a href="#">
                                                <h4>{{ $cartItem->products ? $cartItem->products->title : '' }}</h4>
                                            </a>
                                            <h4><span> {{$numberOfItem != 0 ? $numberOfItem : 1}} x ₹{{ $cartItem->products ? ($cartItem->products->selling_price ?? '') : '' }} </span></h4>
                                        </div>
                                    </div>
                                    <div class="close-circle"><a href="#"><i class="fa fa-times"
                                                aria-hidden="true" onclick="removeCart({{$cartItem->id}})"></i></a></div>
                                </li>
                                @php
                                    $priceArray[] = ($numberOfItem != 0 ? $numberOfItem : 1) *  ($cartItem->products ? ($cartItem->products->selling_price ?? '1') : '1');
                                @endphp
                                @endforeach
                                
                                <li>
                                    <div class="total">
                                        <h5>subtotal : <span>₹ {{ array_sum($priceArray) }} </span></h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="buttons">
                                        <a href="{{url('cart')}}" class="view-cart">view
                                            cart</a> 
                                        <a href="{{url('checkout')}}" class="checkout">checkout</a>
                                    </div>
                                </li>
                            </ul>
                            @endif
                        @else 
                    @endif                  
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    function removeCart(id)
    { 
    
      swal({
      title: "Are you sure",
      text: "You want to remove cart item ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Remove cart item successfully...", {
          title: "Good Job!",
          icon: "success",
        });

        var token='{{csrf_token()}}';
        var gallery_id = id;
        $.ajax({
          url: "{{url('/remove-to-cart')}}",
          method: "POST",
          dataType: "json",
          data:{'id':id, '_token':token},
          success: function(response) {
            if(response.status == 200){
              // alert('Data deleted successfully !');
              setTimeout(function () { location.reload(1); }, 2000);
            }
          }
        }); 


      } else {
        // swal("Your imaginary file is safe!");
      }
    }); 


    }

</script>
