    
@extends('admin.layout.app')

    @section('content')    
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Color List
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Color Management</li>
                        <li class="breadcrumb-item active">Color List</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        
                        <div class="card-body"> 
                            <div class="btn-popup pull-right">
                               
                                <button href="#" data-href="{{ action('Admin\ColorController@create') }}" class="btn btn-primary add_model"  data-toggle="modal" data-target="add_model" data-container=".add_model">Add Color
                                </button>   

                              
                                
                            </div>
                            <div class="clearfix"></div>
                            <div class="table-responsive">
                                <table class="table jsgrid table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Color Name</th>
                                        <th>Color</th>
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
                                     $sort = $colors->perPage();
                                   @endphp
                                   @forelse($colors as $color)
                                            <tr>
                                                 <td>{{ $sr++ }}</td>
                                               <td> {{ $color->name ?? '' }} </td>
                                              <td>
                                                 <span class="label label" style="background-color: {{ $color->color_code ?? '' }}; padding-left: 65px;"> </span>
                                              </td>
                                                <td>
                                                    @if($color->status == 1)
                                                    <span class="text-success">Active</span>
                                                    @else
                                                    <span class="text-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- use edit  --}}
                                                    <a type="button" data-href="{{ action('Admin\ColorController@update',[$color->id]) }}" class="mr-2 edit_model" data-toggle="modal" data-target="#edit_model"><i class="fa fa-edit text-success"></i></a>

                                                   
                                                    @if($color->status == 1)
                                                       <button type="button" id="deactivate" href="{{ action('Admin\ColorController@status',[$color->id]) }}" class="btn btn-primary btn-xs">InActive</button>
                                                    @else
                                                        <button type="button" id="activate" href="{{ action('Admin\ColorController@status',[$color->id]) }}" class="btn btn-primary btn-xs">Active</button>
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
                             Showing  {{$colors->firstItem()}} to {{$colors->lastItem()}} of {{$colors->total()}} entries
                           </div>
                           <div class="col-md-6 text-right paginationBlock">
                             {!! $colors->appends(request()->input())->links() !!}
                           </div>
                         </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Container-fluid Ends-->
    @endsection