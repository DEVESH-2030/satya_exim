
@extends('admin.layout.app')

    @section('content')
            <!-- Container-fluid starts-->
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Sub Categories List
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Sub Category Management</li>
                            <li class="breadcrumb-item active">Sub Categories List</li>
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
                              <form class="form-horizontal" action="{{ action('Admin\SubCategoryController@index') }}" method="get">
                                  <div class="form-row">
                                   
                                    <div class="form-group col-md-3">
                                      <label for="">Category</label>
                                      <select class="form-control" name="category_id">
                                          <option value="">Selecet Category</option>
                                           @foreach($categories as $category)
                                           <option value="{{$category->id}}" {{$category->id==$category_id?'selected':''}}>{{$category->name}}</option>
                                           @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label for="">Sub Category</label>
                                      <input type="text" name="name" class="form-control" placeholder="Enter Sub Category" value="<?php echo $name??''; ?>">
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
                                        <button class="btn btn-primary mr-2" type="submit">Search</button>
                                        <a href="{{route('subcategory')}}" class="btn btn-secondary" type="reset">Reset</a>
                                    </div>
                                  </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="btn-popup pull-right">
                                   <button href="#" data-href="{{ action('Admin\SubCategoryController@create') }}" class="btn btn-primary add_model"  data-toggle="modal" data-target="add_model" data-container=".add_model">Add Sub Category
                                </button>
                                   
                                </div>
                                <div class="clearfix"></div>
                                <div class="table-responsive">
                                  <table class="table jsgrid table-striped table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                          <th>Sr. No.</th>
                                          <th>Image </th>
                                          <th>Category</th>
                                          <th>Sub category</th>
                                          <th>Status</th>
                                          <th>Actions </th>
                                       </tr>
                                    </thead>
                                    <tbody> 
                                       @php 
                                       $sr = 1; 
                                       $page=1;
                                       if(Request::input('page'))
                                       $page=Request::input('page');
                                       $sort = $subcategories->perPage();
                                       @endphp
                                       @forelse($subcategories as $subcategory)
                                       <tr>
                                          <td>{{ $sr++ }}</td>
                                          <td>
                                             <img src="{{ url($subcategory->image ?? '')}}" class="blur-up lazyloaded" style="height: 50px; width: 50px;">
                                          </td>
                                          <td> {{ $subcategory->category->name ?? '' }} </td>
                                          <td> {{ $subcategory->name ?? '' }}</td>
                                        
                                          <td>
                                             @if($subcategory->status==1)
                                             <span class="text-success">Active</span>
                                             @else
                                             <span class="text-danger">InActive</span>
                                             @endif
                                          </td>
                                          <td>
                                            <div class="d-flex">
                                              {{-- use edit  --}}
                                                    <a type="button" data-href="{{ action('Admin\SubCategoryController@update',[$subcategory->id]) }}" class="edit_model mr-2" data-toggle="modal" data-target="#edit_model"><i class="fa fa-edit text-success"></i></a>
                                                   
                                                    @if($subcategory->status == 1)
                                                       <button type="button" id="deactivate" href="{{ action('Admin\SubCategoryController@status',[$subcategory->id]) }}" class="btn btn-primary btn-xs">InActive</button>
                                                    @else
                                                        <button type="button" id="activate" href="{{ action('Admin\SubCategoryController@status',[$subcategory->id]) }}" class="btn btn-primary btn-xs">Active</button>
                                                    @endif
                                            </div>
                                                   
                                          </td>
                                       </tr>
                                       @empty
                                       <tr>
                                          <td colspan="8" class="text-center" >Data Not Available</td>
                                       </tr>
                                       @endforelse         
                                    </tbody>
                                </table>
                                </div>
                                <div class="row">
                           <div class="col-md-6 text-left" style="margin: 20px 0px;">
                             Showing  {{$subcategories->firstItem()}} to {{$subcategories->lastItem()}} of {{$subcategories->total()}} entries
                           </div>
                           <div class="col-md-6 text-right paginationBlock">
                             {!! $subcategories->appends(request()->input())->links() !!}
                           </div>
                         </div>
                    </div>
                        </div>
                    </div>
                </div>  
            </div>  
    @endsection 