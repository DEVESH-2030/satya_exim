
@extends('admin.layout.app')

  @section('content')
    <!-- Container-fluid starts-->
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Order Delivery
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Order Delivery Management</li>
                    <li class="breadcrumb-item active">Order Delivery</li>
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
                        <form>
                          <div class="form-row">
                             <div class="form-group col-md-3">
                              <label for="">Date Range</label>
                              <input type="text" class="form-control" id="daterange" placeholder="Enter Date Range">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Order ID</label>
                              <input type="text" class="form-control" id="" placeholder="Enter Order ID">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Order Date</label>
                              <input type="date" class="form-control" id="" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Order Status</label>
                              <select class="form-control">
                                  <option>Select Order Status</option>
                                  <option>Delivered</option>
                                  <option>Shipped</option>
                                   <option>Processing</option>
                                    <option>Cancelled</option>
                              </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Payment Status</label>
                              <select class="form-control">
                                  <option>Select Payment Status</option>
                                  <option>Paid</option>
                                  <option>Pending</option>
                              </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Payment Method</label>
                              <select class="form-control">
                                  <option>Select Payment Method</option>
                                  <option>COD</option>
                                  <option>Online</option>
                              </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Payment Mode</label>
                              <select class="form-control">
                                  <option>Select Payment Mode</option>
                                  <option>Cash</option>
                                  <option>Paytm</option>
                              </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="">Delivery Status</label>
                              <select class="form-control">
                                  <option>Select Delivery Status</option>
                                  <option>Delivered</option>
                                  <option>Shipped</option>
                                   <option>Processing</option>
                                    <option>Cancelled</option>
                              </select>
                            </div>
                            <div class="form-group d-flex align-items-end col-md-3">
                                <button class="btn btn-primary mr-2" type="submit">Search</button>
                                <button class="btn btn-secondary" type="button">Reset</button>
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
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Payment Mode</th>
                                <th>Payment Status</th>
                                <th>Delivery Address</th>
                                <th>Delivery Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>#51240</td>
                                <td>01-03-2021</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td>$300</td>
                                <td><span class="badge badge-secondary">Cash On Delivery</span></td>
                                <td>Paytm</td>
                                <td><span class="badge badge-success">Paid</span></td>
                                <td>Lorem Ipsum is simply dummy text of the</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                            </tr>
                            <tr><td>2</td>
                                <td>#51240</td>
                                <td>01-03-2021</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td>$300</td>
                                <td><span class="badge badge-secondary">Cash On Delivery</span></td>
                                <td>Paytm</td>
                                <td><span class="badge badge-success">Paid</span></td>
                                <td>Lorem Ipsum is simply dummy text of the</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>#51240</td>
                                <td>01-03-2021</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td>$300</td>
                                <td><span class="badge badge-secondary">Cash On Delivery</span></td>
                                <td>Paytm</td>
                                <td><span class="badge badge-success">Paid</span></td>
                                <td>Lorem Ipsum is simply dummy text of the</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>#51240</td>
                                <td>01-03-2021</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td>$300</td>
                                <td><span class="badge badge-secondary">Cash On Delivery</span></td>
                                <td>Paytm</td>
                                <td><span class="badge badge-success">Paid</span></td>
                                <td>Lorem Ipsum is simply dummy text of the</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
  @endsection          
