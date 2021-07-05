@extends("website.layout.app")
  {{-- @include("website.layout.header") --}}
@section('content')   
    <div class="breadcrumb-section">  
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>about us</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- about section start -->
    <section class="about-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-section"><img src="{{url($contentMangement->image)}}"
                            class="img-fluid blur-up lazyload" alt=""></div>
                </div>
                <div class="col-sm-12">
                    {!! ($contentMangement->description) !!}
                </div>
            </div>
        </div>
    </section>
    <!-- about section end -->



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
@endsection



