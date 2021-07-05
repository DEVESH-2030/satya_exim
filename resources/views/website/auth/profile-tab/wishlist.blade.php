<div class="tab-pane fade" id="wishlist">
    <div class="row">
        <div class="col-12">  {{-- @dd($wishlist) --}}
            <div class="card mt-0">
                <div class="card-body wishlist-section">
                    <div class="dashboard-box">
                        <div class="">
                            <h4>Wishlist</h4>
                        </div>
                        <div class="row pt-3">
                            <div class="col-sm-12 table-responsive">
                                <table class="table cart-table table-responsive-xs">
                                    <thead>
                                        <tr >
                                            <th scope="col">image</th>
                                            <th scope="col">product name</th>
                                            <th scope="col">price</th>
                                            <th scope="col">availability</th>
                                            <th scope="col">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($wishlist as $wishlists)
                                        <tr>
                                            <td>
                                                <a href="{{url('product-details', [$wishlists->product->first()->slug])}}">
                                                    <img src="{{url($wishlists->product ? ($wishlists->product->first()->productImage ? ($wishlists->product->first()->productImage->first()->image ?? 'img/product/1.jpg') : 'img/product/1.jpg') : 'img/product/1.jpg')}}" alt="Product Image" class="img-fluid blur-up lazyload" style="width: 50px; height: 50px;"> 
                                                </a>
                                            </td>
                                            <td><a href="{{action('Website\HomeController@productDetails', [$wishlists->product->first()->slug] ??'')}}">{{$wishlists->product->first()->title ??''}}</a>
                                                <div class="mobile-cart-content row">
                                                    <div class="col-xs-3">
                                                        <p>{{$wishlists->product->first()->remaning_stock ??''}}</p>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <h2 class="td-color">₹{{$wishlists->product->first()->selling_price ??''}}</h2>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <h2 class="td-color"><a href="#" class="icon mr-1"><i class="ti-close"></i>
                                                            </a><a href="#" class="cart"><i class="ti-shopping-cart"></i></a></h2>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h2>₹{{$wishlists->product->first()->selling_price ??''}}</h2>
                                            </td>
                                            <td>
                                                <p>{{$wishlists->product->first()->remaning_stock ??''}}</p>
                                            </td>
                                            <td>
                                                <!-- <a href="#" class="icon mr-3"><i class="ti-close"></i> </a> -->

                                                <i class="ti-close" onclick="removeWishlist({{$wishlists->id}})" style="margin-right: 10px;"></i>
                                                @php 
                                                $cart =     App\Models\Cart::where('product_id',$wishlists->product_id ??'')->first(); 
                                                @endphp
                                                @if($wishlists->product->first()->remaning_stock == 0)
                                                    <span style="color: red; margin-right: 2px;
                                                    position: relative;"><b>Out of Stock</b></span>        
                                                @else
                                                <a class="cart" id="add-to-cart-wishlist" data-toggle="modal" data-target="#addtocart" title="Add to cart" data-value="{{ $wishlists->product_id }}" data-wishlist="{{ $wishlists->id }}" action="{{ url('add-cart-wish-list') }}" method='POST'><i class="ti-shopping-cart" style="font-size: 17px" ></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row wishlist-buttons">
                            <div class="col-12">
                                <a href="{{url('/')}}" class="btn btn-solid">continue shopping</a> 
                                @php
                                    $priceArray = [];
                                    $cartItems = App\Models\Wishlist::where([
                                                                        'user_id' => (Auth::user()->id ?? ''), 
                                                                        'status' => '1'
                                                              ])->get()->unique('product_id');
                                @endphp
                                @if(count($cartItems) > 0)
                                <!-- <a href="{{url('checkout')}}" class="btn btn-solid">checkout</a> -->
                              
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function removeWishlist(id)
    { 
    
      swal({
      title: "Are you sure",
      text: "You want to remove item from wishlist ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Item remove from the wishlist successfully.", {
          title: "Good Job!",
          icon: "success",
        });

        var token='{{csrf_token()}}';
        var gallery_id = id;
        $.ajax({
          url: "{{url('/remove-wishlist')}}",
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
