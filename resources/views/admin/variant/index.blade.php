    
@extends('admin.layout.app')

    @section('content')    
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Variant List
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Variant Management</li>
                        <li class="breadcrumb-item active">Variant List</li>
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
                            <form class="form-horizontal" action="{{ action('Admin\VariantController@index') }}" method="get">
                              <div class="form-row">
                                <div class="form-group col-md-3">
                                  <label for="">Variant</label>
                                  <input type="text" name="name" class="form-control" placeholder="Enter Variant" value="<?php echo $name??''; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="">Status</label>
                                  <select class="form-control" name="status">
                                    <option value="" >All</option>
                                    <option value="1" <?php echo $status=='1'?'selected':'' ?>>Active</option>
                                    <option value="0" <?php echo $status=='0'?'selected':'' ?>>Inactive</option>
                                 </select>
                                </div>
                                <div class="form-group d-flex align-items-end col-md-3">
                                    <button class="btn btn-primary mr-2">Search</button>
                                    <a href="{{route('variant')}}" class="btn btn-secondary">Reset</a>
                                </div>
                              </div>
                            </form>
                        </div>
                        <div class="card-body"> 
                            <div class="btn-popup pull-right">
                               
                                <button href="#" data-href="{{ action('Admin\VariantController@create') }}" class="btn btn-primary add_model"  data-toggle="modal" data-target="add_model" data-container=".add_model">Add Variant
                                </button>   

                              
                                
                            </div>
                            <div class="clearfix"></div>
                            <div class="table-responsive">
                              <table class="table jsgrid table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Variant</th>
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
                                     $sort = $variants->perPage();
                                   @endphp
                                   @forelse($variants as $variant)
                                            <tr>
                                                 <td>{{ $sr++ }}</td>
                                                
                                                <td>{{$variant->name}}</td>
                                                <td>
                                                    @if($variant->status == 1)
                                                    <span class="text-success">Active</span>
                                                    @else
                                                    <span class="text-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                  <div class="d-flex">
                                                    {{-- use edit  --}}
                                                    <a type="button" data-href="{{ action('Admin\VariantController@update',[$variant->id]) }}" class="mr-2 edit_model" data-toggle="modal" data-target="#edit_model"><i class="fa fa-edit text-success"></i></a>


                                                    @if($variant->status == 1)
                                                       <button type="button" id="deactivate" href="{{ action('Admin\VariantController@status',[$variant->id]) }}" class="btn btn-primary btn-xs">InActive</button>
                                                    @else
                                                        <button type="button" id="activate" href="{{ action('Admin\VariantController@status',[$variant->id]) }}" class="btn btn-primary btn-xs">Active</button>
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
                             Showing  {{$variants->firstItem()}} to {{$variants->lastItem()}} of {{$variants->total()}} entries
                           </div>
                           <div class="col-md-6 text-right paginationBlock">
                             {!! $variants->appends(request()->input())->links() !!}
                           </div>
                          </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Container-fluid Ends-->
    @endsection