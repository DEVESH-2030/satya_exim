
@extends('admin.layout.app')

    @section('content')
        <!-- Container-fluid starts-->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">   {{-- @dd($orders) --}}
                        <h3>Order Detail
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Order Management</li>
                        <li class="breadcrumb-item active">Order Detail</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
                <div class="row product-page-main">
            <div class="card">
            
                   <div class="card-body order-datatable">
                        <table class="display jsgrid" id="basic-1">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Order Id</th>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Amount</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>      
                                @php 
                                    $sr=1;
                                @endphp   
                                @foreach($orders as $ordersList)                                
                                <tr> 
                                    <td>{{ $sr++ }}</td>
                                    <td>{{$ordersList->order_unique_id ??''}}</td>
                                    <td>{{$ordersList->product_id ??''}}</td>
                                    <td>{{$ordersList->product ? $ordersList->product->title : ''}}</td>
                                    <td><img src="{{url(isset($ordersList->product) ? ($ordersList->product->productImage->first()->image ?? '') : '')}}" alt=""
                                    class="img-fluid blur-up lazyload" style="width: 60px; height: 60px;"></td>
                                    <td>{{$ordersList->order_amount ??''}}₹</td>
                                    <td>{{$ordersList->quantity ??''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    @endsection