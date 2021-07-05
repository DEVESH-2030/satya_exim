
@extends('admin.layout.app')
@section('content')
    <!-- Container-fluid starts-->
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>All Orders   
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Order Management</li>
                    <li class="breadcrumb-item active">All Orders</li>
                </ol>
            </div>
        </div>  
    </div>
    <!-- Container-fluid Ends-->    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                       <form class="form-horizontal" action="{{ action('Admin\OrderManagementController@allOrder') }}" method="get">
                          <div class="form-row">
                             <!-- <div class="form-group col-md-3">
                              <label for="">Date Range</label>
                              <input type="text" class="form-control" name="daterange" id="daterange" placeholder="Enter Date Range">
                            </div> -->
                            <div class="form-group col-md-3">
                              <label for="">Order ID</label>
                              <input type="text" class="form-control" name="order_id" id="order_id" placeholder="Enter Order ID" value="<?php echo $order_id ??''; ?>">
                            </div>
                           
                            <div class="form-group col-md-3">
                              <label for="">Order Status</label>
                              <select class="form-control" name="status">
                                  <option value="">All</option>
                                  <option value="1" <?php echo $status=='2'?'selected':'' ?>> Pending     </option>
                                  <option value="2" <?php echo $status=='1'?'selected':'' ?>> In Progress </option>
                                  <option value="3" <?php echo $status=='3'?'selected':'' ?>> Delivered   </option>
                                  <option value="4" <?php echo $status=='4'?'selected':'' ?>> Cancelled   </option>
                              </select>
                            </div>
                            <div class="form-group d-flex align-items-end col-md-3">
                                <button class="btn btn-primary mr-2" type="submit">Search</button>
                                <a href="{{url('/admin/all-order')}}" class="btn btn-secondary" type="button">Reset</a>
                            </div>
                          </div>
                        </form>
                    </div>
                    <div class="card-body order-datatable">
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
                                      $sort = $allOrders->perPage();
                                  $count = (($allOrders->currentpage()-1)* $allOrders->perpage() + 1); 
                                @endphp                                    
                                @foreach($allOrders as $allOrder)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $allOrder->order_id ?? '' }}</td>
                                    <td>{{ $allOrder->order_amount ?? '' }} ₹</td>
                                    <td><span class="badge badge-success">{{ $allOrder->payment_status == '1' ? 'Paid' : '' }}</span></td>
                                    <!-- <td><span class="badge badge-secondary">Cash On Delivery</span></td> -->
                                    <td>Online</td>
                                    <td>
                                        @if($allOrder->order_status == '1' ??'')
                                            <span class="badge badge-danger" style="background-color: #dc3545;">In Progress</span>
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
                        {{ $allOrders->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
