@extends("website.layout.app")
@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>ORDER DETAILS</h2>
                    </div>
                </div>
                               
                <div class="col-sm-6"> 
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('user-profile?#profile')}}">Profile</a></li>
                            <li class="breadcrumb-item"><a href="{{url('user-profile?#orders')}}">Orders</a></li>
                            <li class="breadcrumb-item active"><a href="#">ORDER DETAILS</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div> 
    </div>
    <!-- breadcrumb End -->

    <!-- order-detail section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row order-success-sec">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-3">
                            <h4>summery</h4>
                            <ul class="order-detail">
                                <li>order ID: {{$orders->order_id ?? ''}}</li>
                                <li>
                                    
                                </li>
                                <li>Order Total: ₹ {{$orders->order_amount ?? ''}}</li>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            @php 
                                $address = App\Models\UserAddress::first();
                            @endphp 
                            <h4>shipping address</h4>
                            <ul class="order-detail">
                                <li>
                                    {{$address->address ??''}}
                                </li>
                                <li>{{$address->house_no_or_building_name ??''}}, {{$address->landmark ??''}}</li>
                                <li>{{$address->landmark ??''}}, {{$address->pincode ??''}}</li>
                                <li>
                                Contact No. {{$address->mobile ??''}}
                                </li>
                            </ul>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product-order" style="border-top: 1px solid #dddddd;overflow-x: auto;">

                       {{-- @dd($orderDetails->pluck('product.id')) --}}
                        <!-- <h3>your order details</h3> -->
                        @foreach($orderDetails as $orderList)
                        
                        <div class="row product-order-detail">
                            <div class="col-3">
                                <a href="{{url('product-details', [$orderList->product->slug])}}">
                                    <img src="{{url(isset($orderList->product) ? ($orderList->product->productImage->first()->image ?? '') : '')}}" alt="">
                                </a>
                            </div>
                            <div class="col-3 order_detail">
                                <div>
                                    <h4>product name</h4>
                                    <h5>{{$orderList->product ? $orderList->product->title : ''}}</h5>
                                </div>
                            </div>
                            <div class="col-2 order_detail">
                                <div>
                                    <h4>quantity</h4>
                                    <h5>{{$orderList->quantity ??''}}</h5>
                                </div>
                            </div>
                            <div class="col-2 order_detail">
                                <div>
                                    <h4>price</h4>
                                    <h5>₹ {{$orderList->order_amount ??''}}</h5>
                                </div>
                            </div>
                            @php
                                $review = App\Models\RatingReview::where('order_id', $orderList->order_id)
                                                                 ->where('user_id', Auth::user()->id)
                                                                 ->where('product_id', $orderList->product->id)
                                                                 ->first(); 
                            @endphp
                            <div class="col-2 order_detail">
                                @if($orders->order_status == '3')
                                    @if(!isset($review->id))
                                    <button data-href="{{action('Website\UserProfileController@addRating', [$orderList->product->id, $orderList->order_id])}}" data-toggle="modal" data-target="add_review" class="btn btn-sm btn-dark add_review">Add Review
                                    </button>
                                    @else
                                    @php
                                        $value = $review->rating; 
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
                                    @endif
                                @endif
                            </div>
                        </div>
                        @endforeach
                            
                       
                        <div class="total-sec">
                            <ul>

                                <li>subtotal <span>₹ {{$orders->order_amount ?? ''}}</span></li>
                                <!-- <li>shipping <span>₹ 00.00</span></li>
                                <li>tax(GST) <span>₹ 00.00</span></li> -->

                            </ul>
                        </div>
                        <div class="final-total">
                            <h3>total <span>₹ {{$orders->order_amount ?? ''}}</span></h3>
                        </div>
                        <div class="text-center pt-5 order-status-ec">
                            <h2>Order Status: @if($orders->order_status == '1' ??'')
                                            <span>In Progress</span>
                                            @elseif($orders->order_status == '2' ??'')
                                            <span>Pending</span>
                                            @elseif($orders->order_status == '3' ??'')
                                            <span>Delivered</span>
                                            @else
                                            <span>Cancelled</span>
                                        @endif</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


<!-- <div class="modal add_review" id="add_review" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
      
</div> -->
<div class="modal fade add_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true"></div>

@endsection
@section('js')
<script type="text/javascript">
    $(document).on('click', 'button.add_review', function() {
      $( "div.add_review" ).load( $(this).data('href'), function() { 
          $('div.add_review').modal('show');
      });
});
</script>
@endsection