@extends("website.layout.app")
@section('content')
     <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container"> 
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>Profile</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard-sidebar">
                        <div class="profile-top">
                            <div class="profile-image">
                                <!-- <img src="{{url('img/logos/17.png')}}" alt="" class="img-fluid"> -->
                                <img src="{{url($user->image ?? '')}}" alt="" class="img-fluid">
                            </div>
                            <div class="profile-detail">
                                <h5>{{$user->first_name}} {{$user->last_name}}</h5>   
                            </div>
                        </div>
                        <div class="faq-tab">
                            <ul class="nav nav-tabs" id="top-tab" role="tablist">
                                
                                <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#profile">profile</a>
                                </li>
                                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#change-password">change password</a>
                                </li>
                                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#change-address">Address</a>
                                </li>
                                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#orders">Orders</a>
                                </li>
                                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#wishlist">Wishlist</a>
                                </li>
                                @if(Auth::check())
                                <li class="nav-item"><a class="nav-link" href="{{url('user-logout')}}" data-lng="es">Logout</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="faq-content tab-content" id="top-tabContent">
                        
                        @include('website.auth.profile-tab.profile')
                        @include('website.auth.profile-tab.change-password')
                        @include('website.auth.profile-tab.address')
                        @include('website.auth.profile-tab.orders')
                        @include('website.auth.profile-tab.wishlist')
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  dashboard section end -->



    <!-- modal end -->

@endsection
@section('js')
    <script type="text/javascript">
        $('a#add-to-cart-wishlist').on('click', function () {
            var productId = $(this).data('value'); 
            var wishListId = $(this).data('wishlist'); 
            var token='{{csrf_token()}}';
            $.ajax({
                url: $(this).attr("action"),
                method: $(this).attr("method"),
                dataType: "json",
                data: {'product_id' : productId,'wish_list_id' : wishListId,'_token':token},
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

        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
                });
                var activeTab = localStorage.getItem('activeTab');
                if(activeTab){
                    $('#top-tab a[href="' + activeTab + '"]').tab('show');
                }
            });
    </script>
@endsection