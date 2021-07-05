  @include("website.layout.header")

	<!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>elements</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('category')}}">category</a></li>
                            <li class="breadcrumb-item active" aria-current="page">sub-category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

<!-- collection banner --> 
    <section class="banner-padding banner-furniture ratio2_1">
        <div class="container-fluid">
            <div class="row partition4">
                @foreach($subcategories as $data)
                <div class="col-lg-3 col-md-6 p-1">
                    <a href="{{url('product-details')}}">
                        <div class="collection-banner p-right text-right">
                            <div class="img-part">
                                <img src="{{url($data->image)}}"
                                    class="img-fluid blur-up lazyload bg-img">
                            </div>
                            <div class="contain-banner banner-4">
                                <div>
                                    <h4>save 30%</h4>
                                    <h2>{{$data->name ??''}}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- collection banner end -->


    <!-- Paragraph-->
    <div class="title1 section-t-space">
        <h4>special offer</h4>
        <h2 class="title-inner1">today's deal</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="product-para">
                    <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Paragraph end -->


    <!-- Product section -->
    <section class="pt-0 section-b-space ratio_asos">
        <div class="container">
            <div class="row game-product grid-products">
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/1.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 1</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/2.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 2</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/3.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 3</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/5.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 4</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/1.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 1</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/2.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 2</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/3.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 3</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/5.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 4</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/1.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 1</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/2.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 2</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/3.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 3</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="{{url('product-details')}}"><img src="{{url('img/today-deals/5.jpg')}}"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="{{url('product-details')}}">
                            <h6>Mobile Name 4</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product section end -->


    <!-- Parallax banner -->
    <section class="p-0">
        <div class="full-banner parallax text-center p-right">
            <img src="{{url('img/28.jpg')}}" alt="" class="bg-img blur-up lazyload">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="banner-contain">
                            <h2>sale</h2>
                            <h3>on season</h3>
                            <h4>special offer</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Parallax banner end -->


    <!-- product section start -->
    <section class="tools_product bg-title section-b-space">
        <div class="container">
            <div class="row multiple-slider">
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="theme-card">
                        <h5 class="title-border">Under $20 | Free delivery</h5>
                        <div class="offer-slider slide-1">
                            <div>
                                <div class="media">
                                    <a href="{{url('product-details')}}"><img class="img-fluid blur-up lazyload"
                                            src="{{url('img/under-free-delivery/1.jpg')}}" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="{{url('product-details')}}">
                                            <h6>Mobile Phone Name</h6>
                                        </a>
                                        <h4>$500.00 <del>$600.00</del></h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="{{url('product-details')}}"><img class="img-fluid blur-up lazyload"
                                            src="{{url('img/under-free-delivery/3.jpg')}}" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="{{url('product-details')}}">
                                            <h6>Mobile Phone Name</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="{{url('product-details')}}"><img class="img-fluid blur-up lazyload"
                                            src="{{url('img/under-free-delivery/2.jpg')}}" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="{{url('product-details')}}">
                                            <h6>Mobile Phone Name</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="{{url('product-details')}}"><img class="img-fluid blur-up lazyload"
                                            src="{{url('img/under-free-delivery/4.jpg')}}" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="{{url('product-details')}}">
                                            <h6>Mobile Phone Name</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="media">
                                    <a href="{{url('product-details')}}"><img class="img-fluid blur-up lazyload"
                                            src="{{url('img/under-free-delivery/1.jpg')}}" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="{{url('product-details')}}">
                                            <h6>Mobile Phone Name</h6>
                                        </a>
                                        <h4>$500.00 <del>$600.00</del></h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="{{url('product-details')}}"><img class="img-fluid blur-up lazyload"
                                            src="{{url('img/under-free-delivery/3.jpg')}}" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="{{url('product-details')}}">
                                            <h6>Mobile Phone Name</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="{{url('product-details')}}"><img class="img-fluid blur-up lazyload"
                                            src="{{url('img/under-free-delivery/2.jpg')}}" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="{{url('product-details')}}">
                                            <h6>Mobile Phone Name</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="{{url('product-details')}}"><img class="img-fluid blur-up lazyload"
                                            src="{{url('img/under-free-delivery/4.jpg')}}" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="{{url('product-details')}}">
                                            <h6>Mobile Phone Name</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <div class="theme-tab">
                        <div class="bg-title-part">
                            <h5 class="title-border">RECOMMENDATIONS FOR YOU</h5>
                           
                        </div>
                        <div class="tab-content-cls ratio_asos">
                            <div id="tab-4" class="tab-content active default">
                                <div class="product-4 game-product product-m no-arrow">

                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="{{url('product-details')}}"><img
                                                        src="{{url('img/today-deals/3.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                                        class="ti-heart" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                                                cart</div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="{{url('product-details')}}">
                                                <h6>Mobile Phone Name</h6>
                                            </a>
                                            <h4>$500.00</h4>
                                        </div>
                                    </div>

                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="{{url('product-details')}}"><img
                                                        src="{{url('img/today-deals/2.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                                        class="ti-heart" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                                                cart</div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="{{url('product-details')}}">
                                                <h6>Mobile Phone Name</h6>
                                            </a>
                                            <h4>$500.00</h4>
                                        </div>
                                    </div>

                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="{{url('product-details')}}"><img
                                                        src="{{url('img/today-deals/1.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                                        class="ti-heart" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                                                cart</div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="{{url('product-details')}}">
                                                <h6>Mobile Phone Name</h6>
                                            </a>
                                            <h4>$500.00</h4>
                                        </div>
                                    </div>

                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="{{url('product-details')}}"><img
                                                        src="{{url('img/today-deals/3.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                                        class="ti-heart" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                                                cart</div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="{{url('product-details')}}">
                                                <h6>Mobile Phone Name</h6>
                                            </a>
                                            <h4>$500.00</h4>
                                        </div>
                                    </div>

                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="{{url('product-details')}}"><img
                                                        src="{{url('img/today-deals/5.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                                        class="ti-heart" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                                                cart</div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="{{url('product-details')}}">
                                                <h6>Mobile Phone Name</h6>
                                            </a>
                                            <h4>$500.00</h4>
                                        </div>
                                    </div>

                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="{{url('product-details')}}"><img
                                                        src="{{url('img/today-deals/2.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                                        class="ti-heart" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="add-button" data-toggle="modal" data-target="#addtocart">add to
                                                cart</div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                    class="fa fa-star"></i></div>
                                            <a href="{{url('product-details')}}">
                                                <h6>Mobile Phone Name</h6>
                                            </a>
                                            <h4>$500.00</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="banner-tools">
                        <img src="{{url('img/offer-banner1.jpg')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product section end -->



    <!-- service section -->
    <div class="container about-cls section-b-space">
        <section class="service border-section small-section svg-icon-40">
            <div class="row">
                <div class="col-md-4 service-block">
                    <div class="media">
                        <img src="{{url('img/svg-icon/shipping.svg')}}">
                        <div class="media-body pl-2">
                            <h4>free shipping</h4>
                            <p>free shipping world wide</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 service-block">
                    <div class="media">
                        <img src="{{url('img/svg-icon/24-hours.svg')}}">
                        <div class="media-body pl-2">
                            <h4>24 X 7 service</h4>
                            <p>online service for new customer</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 service-block">
                    <div class="media">
                       <img src="{{url('img/svg-icon/offers.svg')}}">
                        <div class="media-body pl-2">
                            <h4>festival offer</h4>
                            <p>new online special festival offer</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- service section end -->



  @include("website.layout.footer")