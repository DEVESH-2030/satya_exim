@extends('admin.layout.app')

    @section('content')
            <!-- Container-fluid starts-->  
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Discount
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Discount Management</li>
                                <li class="breadcrumb-item active">Discount</li>
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
                                      <label for="">Product ID</label>
                                      <input type="text" class="form-control" id="" placeholder="Enter Product ID">
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="">Product Name</label>
                                      <input type="text" class="form-control" id="" placeholder="Enter Product Name">
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="">Discount Type</label>
                                      <select class="form-control">
                                          <option>Select Discount Type</option>
                                          <option>Percentage</option>
                                          <option>Prefixed</option>
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
                                <div class="btn-popup pull-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adddiscount">Add Discount</button>
                                   
                                </div>
                                <div class="clearfix"></div>
                                <div class="table-responsive">
                                    <table class="display table jsgrid" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Product Id</th>
                                            <th>Product Name</th>
                                            <th>Discount Type</th>
                                            <th>Discount Value</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>#001</td>
                                            <td>Samsung Galaxy f41</td>
                                            <td>Percentage</td>
                                            <td>10%</td>
                                            <td>$190</td>
                                            <td><span class="text-success">Active</span>
                                            </td>
                                            <td>
                                                <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editdiscount" type="button" title="Edit"></button>
                                                <button class="jsgrid-button jsgrid-delete-button" type="button" title="Delete"></button>
                                                <button class="fa-icon fa fa-toggle-on ml-2 text-success" title="Active"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>#002</td>
                                            <td>Samsung Galaxy M31</td>
                                            <td>Percentage</td>
                                            <td>10%</td>
                                            <td>$190</td>
                                            <td><span class="text-success">Active</span>
                                            </td>
                                            <td>
                                                <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editdiscount" type="button" title="Edit"></button>
                                                <button class="jsgrid-button jsgrid-delete-button" type="button" title="Delete"></button>
                                                <button class="fa-icon fa fa-toggle-on ml-2 text-success" title="Active"></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- add category -->
            <div class="modal fade" id="adddiscount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Discount</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="needs-validation">
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Product</label>
                                                                <select class="form-control">
                                                                    <option value="">Select Product</option>
                                                                    <option value="1">Product 1</option>
                                                                    <option value="2">Product 2</option>
                                                                    <option value="3">Product 3</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Discount Type</label>
                                                                <select class="form-control">
                                                                    <option value="">Percentage</option>
                                                                    <option value="">Prefixed</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Discount Value</label>
                                                                <input type="text" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Status</label>
                                                                <select class="form-control">
                                                                    <option value="">Active</option>
                                                                    <option value="">Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <button class="btn btn-primary" type="submit">Save</button>
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
            </div>

            <!-- edit category -->  
            <div class="modal fade" id="editdiscount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Discount</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                        <form class="needs-validation">
                                <div class="form">
                                    <div class="form-group">
                                        <label for="validationCustom01" class="mb-1">Product</label>
                                        <select class="form-control">
                                            <option value="">Select Product</option>
                                            <option value="1">Product 1</option>
                                            <option value="2">Product 2</option>
                                            <option value="3">Product 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom02" class="mb-1">Discount Type</label>
                                        <select class="form-control">
                                            <option value="">Percentage</option>
                                            <option value="">Prefixed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom02" class="mb-1">Discount Value</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom02" class="mb-1">Status</label>
                                        <select class="form-control">
                                            <option value="">Active</option>
                                            <option value="">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    @endsection 
