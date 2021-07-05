
@extends('admin.layout.app')
  
  @section('content')
    <!-- start Container-fluid -->
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Payment List
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Payment Management</li>
                    <li class="breadcrumb-item active">Refund and Return List</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <form>
                  <div class="form-row">
                     <div class="form-group col-md-3">
                      <label for="">Date Range</label>
                      <input type="text" class="form-control" id="daterange" placeholder="Enter Date Range">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Customer ID</label>
                      <input type="text" class="form-control" id="" placeholder="Enter Customer ID">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Customer Name</label>
                      <input type="text" class="form-control" id="" placeholder="Enter Customer Name">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Email</label>
                      <input type="email" class="form-control" id="" placeholder="Enter Email">
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
                      <label for="">Payment Mode</label>
                      <select class="form-control">
                          <option>Select Payment Mode</option>
                          <option>Cash</option>
                          <option>Paytm</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Status</label>
                      <select class="form-control">
                          <option>Select Status</option>
                          <option>Active</option>
                          <option>Inactive</option>
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
            <table class="display table jsgrid" id="basic-1">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Payment Mode</th>
                        <th>Returned Amount</th>
                        <th>Refund Amount</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>#001</td>
                        <td>demo 1</td>
                        <td>demo1@gmail.com</td>
                        <td>ORD001</td>
                        <td>Online</td>
                        <td>Paytm</td>
                        <td>$20</td>
                        <td>$10</td>
                        <td>Completed</td>
                        <td><span class="text-success">Active</span></td>
                        <td>
                          <div class="d-flex">
                            <button class="fa-icon fa fa-eye mr-2" data-toggle="modal" data-target="#viewpayment" type="button" title="View"></button>
                            <button class="jsgrid-button jsgrid-delete-button mr-2" type="button" title="Delete"></button>
                            <button type="button" id="deactivate" href="" class="btn btn-primary btn-xs">InActive</button>
                          </div>
                        </td>
                    </tr>
                     <tr>
                        <td>2</td>
                        <td>#002</td>
                        <td>demo 2</td>
                        <td>demo2@gmail.com</td>
                        <td>ORD002</td>
                        <td>Online</td>
                        <td>UPI</td>
                        <td>$20</td>
                        <td>$10</td>
                        <td>Pending</td>
                        <td><span class="text-success">Active</span></td>
                        <td>
                          <div class="d-flex">
                            <button class="fa-icon fa fa-eye mr-2" data-toggle="modal" data-target="#viewpayment" type="button" title="View"></button>
                            <button class="jsgrid-button jsgrid-delete-button mr-2" type="button" title="Delete"></button>
                            <button type="button" id="deactivate" href="" class="btn btn-primary btn-xs">InActive</button>
                          </div>
                        </td>
                    </tr>
                     <tr>
                        <td>3</td>
                        <td>#003</td>
                        <td>demo 3</td>
                        <td>demo3@gmail.com</td>
                        <td>ORD002</td>
                        <td>COD</td>
                        <td>Cash</td>
                        <td>$20</td>
                        <td>$10</td>
                        <td>Pending</td>
                        <td><span class="text-success">Active</span></td>
                        <td>
                          <div class="d-flex">
                            <button class="fa-icon fa fa-eye mr-2" data-toggle="modal" data-target="#viewpayment" type="button" title="View"></button>
                            <button class="jsgrid-button jsgrid-delete-button mr-2" type="button" title="Delete"></button>
                            <button type="button" id="deactivate" href="" class="btn btn-primary btn-xs">InActive</button>
                          </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <div class="modal fade" id="viewpayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel">View Payment</h5>
                    <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                   <div class="table-responsive">
                       <table class="table">
                           <tr>
                               <td><b>Customer ID</b></td>
                               <td>C001</td>
                           </tr>
                           <tr>
                               <td><b>Customer Name</b></td>
                               <td>Demo</td>
                           </tr>
                           <tr>
                               <td><b>Email</b></td>
                               <td>demo1@gmail.com</td>
                           </tr>
                           <tr>
                               <td><b>Order ID</b></td>
                               <td>ORD001</td>
                           </tr>
                           <tr>
                               <td><b>Payment Method</b></td>
                               <td>Online</td>
                           </tr>
                           <tr>
                               <td><b>Payment Mode</b></td>
                               <td>Paytm</td>
                           </tr>
                           <tr>
                               <td><b>Returned Amount</b></td>
                               <td>$20</td>
                           </tr>
                           <tr>
                               <td><b>Refuned Amount</b></td>
                               <td>$10</td>
                           </tr>
                           <tr>
                               <td><b>Payment Status</b></td>
                               <td>Completed</td>
                           </tr>
                           <tr>
                               <td><b>Status</b></td>
                               <td>Active</td>
                           </tr>
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
  @endsection