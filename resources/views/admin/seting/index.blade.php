
@extends('admin.layout.app')
    
    @section('content')            
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Contact Us Management</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Contact Us Management</li>
                        <li class="breadcrumb-item active">Contact Us</li>
                    </ol>
                </div>
            </div>
        </div>
           
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Contact Us</h5>
                        </div>

                        <div class="card-body">
                            <div class="btn-popup pull-right">
                                <button href="#" data-href="{{ action('Admin\ContactUsController@create') }}" class="btn btn-primary add_model"  data-toggle="modal" data-target="add_model" data-container=".add_model">Add Contact Us
                                </button>   
                            </div> 
                            <div class="table-responsive">
                                <table class="table jsgrid table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Mobile</th>
                                        <th>Location</th>
                                        <th>Address</th>
                                        <th>Fax</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $sr = 1; 
                                    $page=1;
                                    if(Request::input('page'))
                                    $page=Request::input('page');
                                    $sort = $contactus->perPage();
                                    @endphp
                                    @foreach($contactus as $contactusData)
                                        <tr>
                                            <td>{{$sr++}} </td>
                                            <td>{{ $contactusData->mobile }}</td>
                                            <td>{{ $contactusData->location }}</td>
                                            <td>{{ $contactusData->address }}</td>
                                            <td>{{ $contactusData->fax }}</td>
                                            <td>
                                                @if($contactusData->status == 1)
                                                <span class="text-success">Active</span>
                                                @else
                                                <span class="text-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div  class="d-flex">
                                                    {{-- use edit  --}}
                                                    <button type="button" data-href="{{ action('Admin\ContactUsController@update',[$contactusData->id]) }}" class="btn btn-success btn-xs edit_model" data-toggle="modal" data-target="#edit_model"><i class="fa fa-edit"></i></button>
                                                
                                                @if($contactusData->status == 1)
                                                    <button type="button" id="deactivate" href="{{ action('Admin\ContactUsController@status',[$contactusData->id]) }}" class="btn btn-primary btn-xs">InActive</button>
                                                    @else
                                                    <button type="button" id="activate" href="{{ action('Admin\ContactUsController@status',[$contactusData->id]) }}" class="btn btn-primary btn-xs">Active</button>
                                                @endif
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                </table>
                                
                            </div>
                                <div class="row">
                                    <div class="col-md-6 text-left" style="margin: 20px 0px;">
                                        Showing  {{$contactus->firstItem()}} to {{$contactus->lastItem()}} of {{$contactus->total()}} entries
                                    </div>
                                    <div class="col-md-6 text-right paginationBlock">
                                        {!! $contactus->appends(request()->input())->links() !!}
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    @endsection             