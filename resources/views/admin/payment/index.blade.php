
@extends('admin.layout.app')

  @section('content')
    <!-- Container-fluid starts-->
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Payment List
                    </h3>  {{-- @dd($payments) --}}
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Payment Management</li>
                    <li class="breadcrumb-item active">Payment List</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
               <form class="form-horizontal" action="{{ action('Admin\PaymentManagementController@payment') }}" method="get">
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
                              <label for="">Customer Id</label>
                              <input type="text" class="form-control" name="user_id" id="user_id" placeholder="Enter Customer ID" value="<?php echo $user_id ??''; ?>">
                            </div>

                            <div class="form-group col-md-3">
                              <label for="">Customer Name</label>
                              <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter Customer Name" value="<?php echo $user_name ??''; ?>">
                            </div>

                            <div class="form-group col-md-3">
                              <label for="">Customer Email</label>
                              <input type="text" class="form-control" name="email" id="email" placeholder="Enter Customer Email" value="<?php echo $email ??''; ?>">
                            </div>
                           

                            <div class="form-group d-flex align-items-end col-md-3">
                                <button class="btn btn-primary mr-2" type="submit">Search</button>
                                <a href="{{url('admin/payment')}}" class="btn btn-secondary" type="button">Reset</a>
                               
                            </div>
                          </div>
                        </form>
            </div>
            <div class="card-body order-datatable">
            <table class="display table jsgrid" id="basic-1">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Payment Mode</th>
                        <th>Payment Status</th>
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                      $serialNo = 1;
                    @endphp
                    @foreach($searchPayment as $paymentList)
                    <tr>
                        <td>{{ $serialNo++ }}</td>
                        <td>{{ $paymentList->userDetail->id ??'' }}</td>
                        <td>{{ $paymentList->userDetail->first_name ??'' }} {{ $paymentList->userDetail->last_name ??'' }}</td>
                        <td>{{ $paymentList->userDetail->email ??'' }}</td>
                        <td>{{ $paymentList->order_id ??'' }}</td>
                        <td>
                          @if($paymentList->payment_status == '1' ??'')
                            Online
                            @else
                            COD
                          @endif
                        </td>
                        <td>Stripe Payment</td>
                        <td>
                          @if($paymentList->payment_status == '1' ??'')
                            <span class="badge badge-success">Paid</span>
                            @else
                            <span class="badge badge-warning">Pending</span>
                          @endif
                        </td>
                        <td>
                          <div class="d-flex">
                             {{-- View Payment --}}
                            <button type="button" data-href="{{action('Admin\PaymentManagementController@viewPayment',[$paymentList->id] ?? '') }}" class="fa-icon fa fa-eye mr-2 view_model" data-toggle="modal" data-target="#view_model"></button>
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