
@extends('admin.layout.app')

    @section('content')
        <!-- Container-fluid starts-->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Rating & Review Management
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6"> {{--  @dd($query) --}}
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Rating & Review Management</li>
                        <li class="breadcrumb-item active">Ratings & Reviews</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                   <form class="form-horizontal" action="{{ action('Admin\RatingReviewController@index') }}" method="get">
                      <div class="form-row">
                      
                        <div class="form-group col-md-3">
                          <label for="">Product ID</label>
                          <input type="text" class="form-control" id="" name="product_id" placeholder="Enter Product ID" value="{{ Request::get('product_id') }}">
                        </div>
                      
                        <div class="form-group col-md-3">
                          <label for="">Customer ID</label>
                          <input type="text" class="form-control" id="" name="user_id" placeholder="Enter Customer ID" value="{{ Request::get('user_id') }}">
                        </div>
                       
                        <div class="form-group col-md-3">
                            <label for="">Status</label>
                            <select class="form-control" name="status">
                               <option value="" >All</option>
                                    <option value="1" <?php echo $status=='1'?'selected':'' ?>>Active</option>
                                    <option value="0" <?php echo $status=='0'?'selected':'' ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group d-flex align-items-end col-md-3">
                            <button class="btn btn-primary mr-2" type="submit">Search</button>
                            <a href="{{route('rating-review')}}" class="btn btn-secondary" type="button">Reset</a>
                        </div>
                      </div>
                    </form>
                </div>
                <div class="card-body order-datatable">
                <table class="display table jsgrid" id="basic-1">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                           $sr = 1; 
                           $page=1;
                           if(Request::input('page'))
                           $page=Request::input('page');
                           $sort = $ratingreview->perPage();
                           @endphp
                           @forelse($ratingreview as $ratingreviewData)
                        <tr>
                            <td>{{ $sr++ }}</td>
                            <td>{{$ratingreviewData->product_id}}</td>
                            <td>{{$ratingreviewData->productData->first()->title}}</td>
                            <td>{{$ratingreviewData->user_id}}</td>
                            <td>{{$ratingreviewData->name}}</td>
                            <td>
                                @php
                              $rating = App\Models\RatingReview::where('product_id', $ratingreviewData->id)->get();
                              $value = $rating->avg('rating'); 
                              $final_rating = $value*(100/5);
                              @endphp
                              <span class="score" style="display: block;">
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
                            </td>
                            <td><span class="maxline2">{{$ratingreviewData->review}}</span></td>
                            <td>
                                @if($ratingreviewData->status==1)
                                    <span class="text-success">Active</span>
                                    @else
                                    <span class="text-danger">InActive</span>
                                @endif
                            </td>
                            <td>
                              <div class="d-flex">
                                 <!-- view details -->
                                  <!-- <button type="button" data-href="" class="fa-icon fa fa-eye mr-2 view_model" data-toggle="modal" data-target="#view_model"></button>   -->

                                  {{-- view details  --}}
                                 <button type="button" data-href="{{ action('Admin\RatingReviewController@viewRating',[$ratingreviewData->id] ?? '') }}" class="fa-icon fa fa-eye mr-2 view_model" data-toggle="modal" data-target="#view_model"></button>

                                 @if($ratingreviewData->status == 1)
                                    <button type="button" id="deactivate" href="{{ action('Admin\RatingReviewController@status',[$ratingreviewData->id]) }}" class="btn btn-primary btn-xs">InActive</button>
                                    @else
                                    <button type="button" id="activate" href="{{ action('Admin\RatingReviewController@status',[$ratingreviewData->id]) }}" class="btn btn-primary btn-xs">Active</button>
                                  @endif
                              </div>
                               
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    @endsection