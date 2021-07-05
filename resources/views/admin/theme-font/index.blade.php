
@extends('admin.layout.app')

    @section('content')
        <!-- Container-fluid starts-->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Theme & Font Management
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Theme & Font Management</li>
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
                            <!-- <h5>Pages List</h5> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table jsgrid table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Title</th>
                                        <th>Theme</th>
                                        <th>Fonts</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Website</td>
                                        <td>Ecommerce</td>
                                        <td>Lato, sans-serif</td>
                                        <td><span class="text-success">Active</span>
                                        </td>
                                        <td>
                                            <!-- <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editabout" type="button" title="Edit"></button> -->
                                            <button class="fa-icon fa fa-toggle-on ml-2 text-success" title="Active"></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Admin</td>
                                        <td>Ecommerce Admin</td>
                                        <td>work-Sans, sans-serif</td>
                                        <td><span class="text-success">Active</span>
                                        </td>
                                        <td>
                                            <!-- <button class="jsgrid-button jsgrid-edit-button" data-toggle="modal" data-target="#editterm" type="button" title="Edit"></button> -->
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
    @endsection