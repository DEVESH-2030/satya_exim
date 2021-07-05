  @php 
    $setting = App\Models\Settings::where('status', 1)->first();
    $socialMedia = App\Models\SocialMedia::first();
  @endphp  

    <!-- loader start -->
<div class="loader_skeleton">
    <div class="top-header">
        <div class="container"> 
            <div class="row">
                <div class="col-lg-6">
                    @php 
                        $setting = App\Models\Settings::where('status', 1)->first();
                    @endphp   
                    <div class="header-contact">
                        <ul>
                            <li>Welcome to Our E-Commerce</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>Call Us: {{$setting->mobile ?? ''}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-right">
                    <ul class="header-dropdown">
               
                    @if(Auth::check())
                     @php
                            $user = App\User::where('id',Auth::user()->id)->first();
                        @endphp
                     <li class="onhover-dropdown mobile-account">
                        <img src="{{url($user->image ??'')}}" style="width: 25px;height: 25px;border-radius: 50%;border:1px solid #f2f2f2; margin-right:4px;">{{ $user->first_name ??'' }}
                        <ul class="onhover-show-div">
                            <li><a href="{{url('user-logout')}}" data-lng="es">Logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li class=" mobile-account">
                        <img src="{{url('img/dummy.png')}}"  style="width: 22px;height: 22px;border-radius: 50%;border:1px solid #f2f2f2;margin-right:5px"><a href="{{url('login')}}" data-lng="en">Login</a>
                        <!-- <ul class="onhover-show-div">
                            <li><a href="{{url('login')}}" data-lng="en">Login</a></li>
                        </ul> -->
                    </li>
                    @endif
                </ul>
                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="navbar">
                                <!-- <a href="javascript:void(0)">
                                    <div class="bar-style"><i class="fa fa-bars sidebar-bar" aria-hidden="true"></i>
                                    </div>
                                </a> -->
                            </div>
                            <div class="brand-logo">
                                <a href="{{url('/')}}"><img src="{{asset($setting->logo ?? '')}}"
                                        class="img-fluid blur-up lazyload" alt=""></a>
                            </div>
                        </div>
                        <div class="menu-right pull-right">
                            <div>
                                <nav>
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul class="sm pixelstrap sm-horizontal">
                                        <li>
                                            <div class="mobile-back text-right">Back<i
                                                    class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                                        </li>
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


                                    @php $product = App\Models\Product::where('category_id',$category->id)->where('sub_category_id',$subCategory->id)->first(); @endphp
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
                                <div class="icon-nav d-none d-sm-block">
                                    <ul>
                                        <li style="width:45px">
                                           <!--  <div><img src="{{url('assets/images/icon/search.png')}}" onclick="openSearch()"
                                                    class="img-fluid blur-up lazyload" alt=""> <i class="ti-search"
                                                    onclick="openSearch()"></i></div> -->
                                        </li>
                                        <li style="width:45px">
                                           <!--  <div><img src="{{url('assets/images/icon/setting.png')}}"
                                                    class="img-fluid blur-up lazyload" alt=""> <i
                                                    class="ti-settings"></i></div> -->
                                        </li>
                                        <li style="width:45px">
                                            <!-- <div><img src="{{url('assets/images/icon/cart.png')}}"
                                                    class="img-fluid blur-up lazyload" alt=""> <i
                                                    class="ti-shopping-cart"></i></div> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="home-slider">
        <div class="home"></div>
    </div>
    <section class="collection-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="ldr-bg">
                        <div class="contain-banner">
                            <div>
                                <h4></h4>
                                <h2></h2>
                                <h6></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ldr-bg">
                        <div class="contain-banner">
                            <div>
                                <h4></h4>
                                <h2></h2>
                                <h6></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    <!-- loader end -->


    <!-- header start -->
    <header>
        <div class="mobile-fix-option"></div>
        
        @include("website.layout.top-menu")
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-menu">
                        @include("website.layout.left-menu")
                        @include("website.layout.right-menu")

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->