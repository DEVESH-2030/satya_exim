    
@extends('admin.layout.app')

    @section('content')    
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Banner List
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Banner Management</li>
                        <li class="breadcrumb-item active">Banner List</li>
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
                               
                                <button href="#" data-href="{{ action('Admin\BannerController@create') }}" class="btn btn-primary add_model"  data-toggle="modal" data-target="add_model" data-container=".add_model">Add Banner
                                </button>   

                              
                                
                            </div>
                            <div class="clearfix"></div>
                               <div class="table-responsive">
                                   <table class="table jsgrid table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
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
                                     $sort = $banners->perPage();
                                   @endphp
                                   @forelse($banners as $banner)
                                            <tr>
                                                 <td>{{ $sr++ }}</td>
                                                <td>
                                                    <img src="{{ url($banner->image ?? '')}}" class="blur-up lazyloaded" style="height: 50px; width: 50px;">
                                                </td>
                                                <td>
                                                    @if($banner->status == 1)
                                                    <span class="text-success">Active</span>
                                                    @else
                                                    <span class="text-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- use edit  --}}
                                                    <a type="button" data-href="{{ action('Admin\BannerController@update',[$banner->id]) }}" class="edit_model mr-2" data-toggle="modal" data-target="#edit_model"><i class="fa fa-edit text-success"></i></a>

                                                    @if($banner->status == 1)
                                                       <button type="button" id="deactivate" href="{{ action('Admin\BannerController@status',[$banner->id]) }}" class="btn btn-primary btn-xs">InActive</button>
                                                    @else
                                                        <button type="button" id="activate" href="{{ action('Admin\BannerController@status',[$banner->id]) }}" class="btn btn-primary btn-xs">Active</button>
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
                             Showing  {{$banners->firstItem()}} to {{$banners->lastItem()}} of {{$banners->total()}} entries
                           </div>
                           <div class="col-md-6 text-right paginationBlock">
                             {!! $banners->appends(request()->input())->links() !!}
                           </div>
                         </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Container-fluid Ends-->
    @endsection