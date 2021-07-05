@extends('admin.layout.app')

    @section('content')            
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Coupons List
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6"> {{-- @dd($coupons) --}}
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Coupon Management</li>
                                <li class="breadcrumb-item active">Coupons List</li>
                            </ol>
                        </div>
                    </div>
                </div>

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                               <form class="form-horizontal" action="{{ action('Admin\CouponController@index') }}" method="get">
                                  <div class="form-row">
                                     <div class="form-group col-md-3">
                                      <label for="">Date Range</label>
                                      <input type="text" class="form-control" id="daterange" name="date" placeholder="Enter Date Range" value="{{ Request::get('date') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="">Coupon Title</label>
                                      <input type="text" class="form-control" id="" name="title" placeholder="Enter Coupon Title" value="{{ Request::get('title') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="">Coupon Code</label>
                                      <input type="text" class="form-control" id="" name="coupon_code" placeholder="Enter Coupon Code"  value="{{ Request::get('coupon_code') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="" {{ Request::get('status') == null ? 'selected' : '' }}>All</option>
                                            <option value="1" {{ Request::get('status') == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ ((Request::get('status') == 0) AND (Request::get('status') != null))  ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex align-items-end col-md-3">
                                        <button class="btn btn-primary mr-2" type="submit">Search</button>
                                        <a href="{{ url('admin/coupon') }}" class="btn btn-secondary" type="button">Reset</a>
                                    </div>
                                  </div>
                                </form>
                            </div>
                            <div class="card-body order-datatable">
                                <div class="btn-popup pull-right">
                                    <button href="#" data-href="{{ action('Admin\CouponController@create') }}" class="btn btn-primary add_model"  data-toggle="modal" data-target="add_model" data-container=".add_model">Add Coupon
                                </button>   
                                   
                                </div>
                                <div class="clearfix"></div>
                                    <table class="display table jsgrid" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Title</th>
                                            <th>Coupon Code</th>
                                            <th>Discount</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
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
                                            $sort = $coupons->perPage();
                                        @endphp
                                       @foreach($coupons as $coupon)
                                        <tr>
                                            <td>{{$sr++}}</td>
                                            <td>{{$coupon->title}}</td>
                                            <td>{{$coupon->coupon_code}}</td>
                                            <td>{{$coupon->discount_amount}} %</td>
                                            <td>{{$coupon->start_date}}</td>
                                            <td>{{$coupon->end_date}}</td>
                                           <td>
                                                @if($coupon->status == 1)
                                                <span class="text-success">Active</span>
                                                @else
                                                <span class="text-danger">Inactive</span>
                                                @endif
                                            </td>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                      {{-- use edit  --}}
                                                <a type="button" data-href="{{ action('Admin\CouponController@update',[$coupon->id]) }}" class="mr-2 edit_model" data-toggle="modal" data-target="#edit_model"><i class="fa fa-edit text-success"></i></a>

                                                {{-- <button class="jsgrid-button jsgrid-delete-button" type="button" title="Delete"></button> --}}

                                                {{-- Change status --}}
                                                @if($coupon->status == 1)
                                                   <button type="button" id="deactivate" href="{{ action('Admin\CouponController@status',[$coupon->id]) }}" class="btn btn-primary btn-xs">InActive</button>
                                                @else
                                                    <button type="button" id="activate" href="{{ action('Admin\CouponController@status',[$coupon->id]) }}" class="btn btn-primary btn-xs">Active</button>
                                                @endif
                                                </div>
                                              

                                            </td>
                                        </tr>
                                        @endforeach    
                                    </tbody>
                                </table>
                                       {{--  <div class="row">
                                            <div class="col-md-6 text-left" style="margin: 20px 0px;">
                                                Showing  {{$coupons->firstItem()}} to {{$coupons->lastItem()}} of {{$coupons->total()}} entries
                                            </div>
                                            <div class="col-md-6 text-right paginationBlock">
                                                {!! $coupons->appends(request()->input())->links() !!}
                                            </div>
                                        </div> --}}
                                    </div>  
                                </div>  
                            </div>  
                        </div>  
                    </div>  
            <!-- Container-fluid Ends-->    
    @endsection

