
@extends('admin.layout.app')

    @section('content')
        <!-- Container-fluid starts-->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Orders
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Order Management</li>
                        <li class="breadcrumb-item active">Returned Orders</li>
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
                                  <label for="">Order Status</label>
                                  <select class="form-control">
                                      <option>Select Order Status</option>
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
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Payment Method</th>
                                    <th>Order Status</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>#51240</td>
                                    <td>
                                        <div class="d-flex">
                                            <img src="{{url('admin/assets/images/electronics/product/25.jpg')}}" alt="" class="img-fluid img-30 mr-2 blur-up lazyloaded">
                                            <img src="{{url('admin/assets/images/electronics/product/13.jpg')}}" alt="" class="img-fluid img-30 mr-2 blur-up lazyloaded">
                                            <img src="{{url('admin/assets/images/electronics/product/16.jpg')}}" alt="" class="img-fluid img-30 blur-up lazyloaded">
                                        </div>
                                    </td>
                                    <td>$54671</td>
                                    <td><span class="badge badge-secondary">Cash On Delivery</span></td>
                                    <td>Paypal</td>
                                    <td><span class="badge badge-success">Delivered</span></td>
                                    <td>Dec 10,18</td>
                                    <td>
                                        <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editorderstatus" type="button" title="Edit Status"></button>
                                    </td>
                                </tr>
                                <tr><td>2</td>
                                    <td>#51241</td>
                                    <td>
                                        <div class="d-flex">
                                            <img src="{{url('admin/assets/images/electronics/product/12.jpg')}}" alt="" class="img-fluid img-30 mr-2 blur-up lazyloaded">
                                            <img src="{{url('admin/assets/images/electronics/product/3.jpg')}}" alt="" class="img-fluid img-30 blur-up lazyloaded">
                                        </div>
                                    </td>
                                    <td>$2136</td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td>Master Card</td>
                                    <td><span class="badge badge-primary">Shipped</span></td>
                                    <td>Feb 15,18</td>
                                    <td>
                                        <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editorderstatus" type="button" title="Edit Status"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>#51242</td>
                                    <td><img src="{{url('admin/assets/images/electronics/product/14.jpg')}}" alt="" class="img-fluid img-30 blur-up lazyloaded"></td>
                                    <td>$8791</td>
                                    <td><span class="badge badge-warning">Awaiting Authentication</span></td>
                                    <td>Debit Card</td>
                                    <td><span class="badge badge-warning">Processing</span></td>
                                    <td>Mar 27,18</td>
                                    <td>
                                        <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editorderstatus" type="button" title="Edit Status"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>#51243</td>
                                    <td>
                                        <div class="d-flex">
                                            <img src="{{url('admin/assets/images/electronics/product/6.jpg')}}" alt="" class="img-fluid img-30 mr-2 blur-up lazyloaded">
                                            <img src="{{url('admin/assets/images/furniture/8.jpg')}}" alt="" class="img-fluid img-30 blur-up lazyloaded">
                                        </div>
                                    </td>
                                    <td>$139</td>
                                    <td><span class="badge badge-danger">Payment Failed</span></td>
                                    <td>Master Card</td>
                                    <td><span class="badge badge-danger">Cancelled</span></td>
                                    <td>Sep 1,18</td>
                                    <td>
                                        <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editorderstatus" type="button" title="Edit Status"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>#51244</td>
                                    <td>
                                        <div class="d-flex">
                                            <img src="{{url('admin/assets/images/jewellery/pro/18.jpg')}}" alt="" class="img-fluid img-30 mr-2 blur-up lazyloaded">
                                            <img src="{{url('admin/assets/images/fashion/pro/06.jpg')}}" alt="" class="img-fluid img-30 blur-up lazyloaded">
                                        </div>
                                    </td>
                                    <td>$4678</td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td>Paypal</td>
                                    <td><span class="badge badge-primary">Shipped</span></td>
                                    <td>May 18,18</td>
                                    <td>
                                        <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editorderstatus" type="button" title="Edit Status"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>#51245</td>
                                    <td>
                                        <div class="d-flex">
                                            <img src="{{url('admin/assets/images/electronics/product/19.jpg')}}" alt="" class="img-fluid img-30 mr-2 blur-up lazyloaded">
                                            <img src="{{url('admin/assets/images/electronics/product/20.jpg')}}" alt="" class="img-fluid img-30 mr-2 blur-up lazyloaded">
                                            <img src="{{url('admin/assets/images/electronics/product/23.jpg')}}" alt="" class="img-fluid img-30 blur-up lazyloaded">
                                        </div>
                                    </td>
                                    <td>$6791</td>
                                    <td><span class="badge badge-success">Paid</span></td>
                                    <td>Visa</td>
                                    <td><span class="badge badge-success">Delivered</span></td>
                                    <td>Jan 14,18</td>
                                    <td>
                                        <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editorderstatus" type="button" title="Edit Status"></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- edit category -->
       <div class="modal fade" id="editorderstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Update Order Status</h5>
                        <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation">
                            <div class="form">
                                <div class="form-group">
                                    <label for="validationCustom01" class="mb-1">Select Status :</label>
                                    <select class="form-control">
                                        <option>Pending</option>
                                        <option>Deliverd</option>
                                        <option>In progress</option>
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom02" class="mb-1">Comment:</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    <button class="btn btn-outline-primary waves-effect cancel-model" type="button" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end edit category -->

    @endsection 
    