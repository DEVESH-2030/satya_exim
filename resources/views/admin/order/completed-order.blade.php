
@extends('admin.layout.app')
@section('content')
    <!-- Container-fluid starts-->
    <div class="page-header"> 
        <div class="row">   {{-- @dd($completedOrder) --}}
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Completed Orders
                    </h3>
                </div>   
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Order Management</li>
                    <li class="breadcrumb-item active">Completed Orders</li>
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
                         <form class="form-horizontal" action="{{ action('Admin\OrderManagementController@completeOrder') }}" method="get">
                          <div class="form-row">
                            <div class="form-group col-md-3">
                              <label for="">Order ID</label>
                              <input type="text" class="form-control" name="order_id" id="order_id" placeholder="Enter Order ID" value="<?php echo $order_id ??''; ?>">
                            </div>
                           
                            <div class="form-group col-md-3">
                              <label for="">Order Status</label>
                              <select class="form-control" name="status">
                                  <option value="">All</option>
                                  <option value="2" <?php echo $status=='2'?'selected':'' ?>> Pending     </option>
                                  <option value="1" <?php echo $status=='1'?'selected':'' ?>> In Progress </option>
                                  <option value="3" <?php echo $status=='3'?'selected':'' ?>> Delivered   </option>
                                  <option value="4" <?php echo $status=='4'?'selected':'' ?>> Cancelled     </option>
                              </select>
                            </div>
                            <div class="form-group d-flex align-items-end col-md-3">
                                <button class="btn btn-primary mr-2" type="submit">Search</button>
                                <a href="{{url('/admin/complete-order')}}" class="btn btn-secondary" type="button">Reset</a>
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
                                      $sort = $completedOrder->perPage();
                                  $count = (($completedOrder->currentpage()-1)* $completedOrder->perpage() + 1); 
                                @endphp                                    
                                @foreach($completedOrder as $completedOrders)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $completedOrders->order_id ?? '' }}</td>
                                    <td>{{ $completedOrders->order_amount ?? '' }} ₹</td>
                                    <td><span class="badge badge-success">{{ $completedOrders->payment_status == '1' ? 'Paid' : '' }}</span></td>
                                    <!-- <td><span class="badge badge-secondary">Cash On Delivery</span></td> -->
                                    <td>Online</td>
                                    <td>
                                        @if($completedOrders->order_status == '1' ??'')
                                            <span class="badge badge-danger" style="background-color: #dc3545;">In Progress</span>
                                            @elseif($completedOrders->order_status == '2' ??'')
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($completedOrders->order_status == '3' ??'')
                                            <span class="badge badge-success">Delivered</span>
                                            @else
                                            <span class="badge badge-primary">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $orderDate = date('Y-m-d', strtotime($completedOrders->created_at));
                                        @endphp
                                        {{ $orderDate ??'' }}</td>
                                    <td>
                                          <a href="{{ action('Admin\OrderManagementController@view',[$completedOrders->id] ?? '') }}" class="fa-icon fa fa-eye mr-2 "></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $completedOrder->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
