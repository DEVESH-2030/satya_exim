@extends('admin.layout.app')
{{-- @section('title')
     Dashbord
@endsection --}}

@section('content')
    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Dashboard
                                    <small>Ecommerce Admin Panel</small>
                                </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
        
        <!-- Container-fluid starts-->
        <div class="container-fluid">
             <form>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="">Order ID</label>
                  <input type="text" class="form-control" name="order_id" id="order_id" placeholder="Enter Order ID" value="<?php echo $order_id ??''; ?>">
                </div>
                <div class="form-group d-flex align-items-end col-md-3">
                    <button class="btn btn-primary mr-2" type="submit">Search</button>
                    <a href="{{url('admin/dashboard')}}" class="btn btn-secondary" type="button">Reset</a>
                </div>
              </div>
            </form>
            <div class="row">
                <div class="col-xl-3 col-md-6 xl-50">
                    <div class="card o-hidden widget-cards">
                        <div class="bg-warning card-body">
                            <div class="media static-top-widget row">
                                <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="navigation" class="font-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body col-8"><span class="m-0">Total Orders</span>
                                    <h3 class="mb-0"> <span class="counter">{{$totalOrder}}</span><!-- <small> This Month</small> -->
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 xl-50">
                    <div class="card o-hidden  widget-cards">
                        <div class="bg-secondary card-body">
                            <div class="media static-top-widget row">
                                <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="box" class="font-secondary"></i>
                                    </div>
                                </div>
                                <div class="media-body col-8"><span class="m-0">Total Products</span>
                                    <h3 class="mb-0">$ <span class="counter">{{$totalProduct}}</span><!-- <small> This Month</small> --></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 xl-50">
                    <div class="card o-hidden widget-cards">
                        <div class="bg-primary card-body">
                            <div class="media static-top-widget row">
                                <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="message-square" class="font-primary"></i>
                                    </div>
                                </div>
                                <div class="media-body col-8"><span class="m-0">Total Product Sold</span>
                                    <h3 class="mb-0">$ <span class="counter">{{$totalSoldProduct}}</span><!-- <small> This Month</small> --></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 xl-50">
                    <div class="card o-hidden widget-cards">
                        <div class="bg-danger card-body">
                            <div class="media static-top-widget row">
                                <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="users" class="font-danger"></i>
                                    </div>
                                </div>
                                <div class="media-body col-8"><span class="m-0">Stock of Product</span>
                                    <h3 class="mb-0">$ <span class="counter">{{$totalStock}}</span><!-- <small> This Month</small> --></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 xl-100">
                    <div class="card">
                        <div class="card-header">
                            <h5>Latest Orders</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="icofont icofont-simple-left"></i>
                                    </li>
                                    <li><i class="view-html fa fa-code"></i>
                                    </li>
                                    <li><i class="icofont icofont-maximize full-card"></i>
                                    </li>
                                    <li><i class="icofont icofont-minus minimize-card"></i>
                                    </li>
                                    <li><i class="icofont icofont-refresh reload-card"></i>
                                    </li>
                                    <li><i class="icofont icofont-error close-card"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-status table-responsive latest-order-table">
                                 <table class="display jsgrid" id="basic-1">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Order Id</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Payment Method</th>
                                <th>Order Status</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>      
                                @php 
                                      $page=1;
                                      if(Request::input('page'))
                                      $page=Request::input('page');
                                      $sort = $orderList->perPage();
                                  $count = (($orderList->currentpage()-1)* $orderList->perpage() + 1); 
                                @endphp                                    
                                @foreach($orderList as $allOrder)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $allOrder->order_id ?? '' }}</td>
                                    <td>{{ $allOrder->order_amount ?? '' }} ₹</td>
                                    <td><span class="badge badge-success">{{ $allOrder->payment_status == '1' ? 'Paid' : '' }}</span></td>
                                    <!-- <td><span class="badge badge-secondary">Cash On Delivery</span></td> -->
                                    <td>Online</td>
                                    <td>
                                        @if($allOrder->order_status == '1' ??'')
                                            <span class="badge badge-danger">In Progress</span>
                                            @elseif($allOrder->order_status == '2' ??'')
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($allOrder->order_status == '3' ??'')
                                            <span class="badge badge-success">Delivered</span>
                                            @else
                                            <span class="badge badge-primary">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $orderDate = date('Y-m-d', strtotime($allOrder->created_at));
                                        @endphp
                                        {{ $orderDate ??'' }}
                                      </td>
                                    <td>
                                         <a type="button" data-href="{{ action('Admin\OrderManagementController@editOrder',[$allOrder->id]) }}" class="mr-2 edit_model" data-toggle="modal" data-target="#edit_model"><i class="fa fa-edit text-success"></i></a>

                                          <a href="{{ action('Admin\OrderManagementController@view',[$allOrder->id] ?? '') }}" class="fa-icon fa fa-eye mr-2 "></a>
                                        <!-- <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editorderstatus" type="button" title="Edit Status"></button> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                                <a href="{{url('admin/all-order')}}" class="btn btn-primary">View All Orders</a>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
@endsection