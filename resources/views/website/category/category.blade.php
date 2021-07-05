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
                            <li class="breadcrumb-item active" aria-current="page">category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->




    <!-- category 2 -->
    <section class="p-0 ratio2_1">
        <div class="container-fluid">
            <div class="row category-border">
                <div class="col-sm-4 border-padding">
                    <div class="category-banner">
                        <div>
                            <img src="{{url('img/cat1.jpg')}}" class="img-fluid blur-up lazyload bg-img" alt="">
                        </div>
                        <div class="category-box">
                            <a href="#">
                                <h2>Android</h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 border-padding">
                    <div class="category-banner">
                        <div>
                            <img src="{{url('img/cat2.jpg')}}" class="img-fluid blur-up lazyload bg-img" alt="">
                        </div>
                        <div class="category-box">
                            <a href="#">
                                <h2>I-Phone</h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 border-padding">
                    <div class="category-banner">
                        <div>
                            <img src="{{url('img/cat1.jpg')}}" class="img-fluid blur-up lazyload bg-img" alt="">
                        </div>
                        <div class="category-box">
                            <a href="#">
                                <h2>Smart Phone</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- category 3 -->
    <div class="container category-button">
        <section class="section-b-space">
            <div class="row partition1">
                <div class="col"><a href="{{{url('sub-category')}}}" class="btn btn-outline btn-block">Samsung</a></div>
                <div class="col"><a href="{{{url('sub-category')}}}" class="btn btn-outline btn-block">Redmi</a></div>
                <div class="col"><a href="{{{url('sub-category')}}}" class="btn btn-outline btn-block">Oppo</a></div>
                <div class="col"><a href="{{{url('sub-category')}}}" class="btn btn-outline btn-block">Vivo</a></div>
                <div class="col"><a href="{{{url('sub-category')}}}" class="btn btn-outline btn-block">I-Phone</a></div>
                <div class="col"><a href="{{{url('sub-category')}}}" class="btn btn-outline btn-block">Nokia</a></div>
            </div>
        </section>
    </div>

    <!-- category 4 -->
    <div class="category-bg ratio_square">
        <div class="container-fluid p-0">
            <div class="row order-section">
                <div class="col-sm-4 p-0">
                    <a href="#" class="image-block">
                        <img alt="" src="{{url('img/collection/450-2.jpg')}}" class="img-fluid blur-up lazyload bg-img">
                    </a>
                </div>
                <div class="col-sm-4 p-0">
                    <div class="contain-block even">
                        <div>
                            <h6>new products</h6>
                            <a href="{{url('product')}}">
                                <h2>Android Phone</h2>
                            </a><a href="{{url('product')}}" class="btn btn-solid category-btn">20%-80% off</a>
                            <a href="{{url('product')}}">
                                <h6><span>shop now</span></h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 p-0">
                    <a href="{{url('product')}}" class="image-block"><img alt="" src="{{url('img/collection/450-2.jpg')}}"
                            class="img-fluid blur-up lazyload bg-img"></a>
                </div>
                <div class="col-sm-4 p-0">
                    <div class="contain-block">
                        <div>
                            <h6>on sale</h6>
                            <a href="{{url('product')}}">
                                <h2>Android Smartphone</h2>
                            </a> <a href="{{url('product')}}" class="btn btn-solid category-btn">save upto 30% off</a>
                            <a href="{{url('product')}}">
                                <h6><span>shop now</span></h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 p-0">
                    <a href="{{url('product')}}" class="image-block even"><img alt="" src="{{url('img/collection/450-1.jpg')}}"
                            class="img-fluid blur-up lazyload bg-img"></a>
                </div>
                <div class="col-sm-4 p-0">
                    <div class="contain-block">
                        <div>
                            <h6>summer sale</h6>
                            <a href="{{url('product')}}">
                                <h2>get check collection</h2>
                            </a> <a href="{{url('product')}}" class="btn btn-solid category-btn">10%-50% off</a>
                            <a href="{{url('product')}}">
                                <h6><span>shop now</span></h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- service section -->
    <div class="container about-cls section-b-space pt-5">
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