
@extends('admin.layout.app')

    @section('content')    
        <div class="page-header"> 
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Users List
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Users Management</li>
                        <li class="breadcrumb-item active">Users List</li>
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
                        <form class="form-horizontal" action="{{ action('Admin\UserController@index') }}" method="get">
                           <div class="form-row">
                           	<div class="form-group col-md-3">
                                 <label for="">User Name</label>
                                 <input type="text" name="first_name" class="form-control" placeholder="Enter Name" value="<?php echo $first_name??''; ?>" onkeypress="return alphaonly(event)">
                              </div>
                              <div class="form-group col-md-3">
                                 <label for="">Mobile</label>
                                 <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile" value="<?php echo $mobile_no ?? ''; ?>" onkeypress="return numbersonly(event)">
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
                                 <a href="{{url('admin/user')}}" class="btn btn-secondary" type="reset">Reset</a>
                              </div>
                           </div>
                        </form>
                     </div>
                     <div class="card-body">
                      <div class="table-responsive">
                        <table class="table jsgrid table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                          <tr>
                            <th>Sr. No.</th>
                            <th>Image </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
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
                           $sort = $user->perPage();
                           @endphp
                           @forelse($user as $userData)
                           <tr>
                               <td>{{ $sr++ }}</td>  
                               <td>
                                   <img src="{{ url($userData->image ?? '')}}" class="blur-up lazyloaded" style="height: 50px; width: 50px;">
                               </td>
                               <td> {{ $userData->first_name ?? '' }} {{ $userData->last_name ?? '' }}  </td>
                               <td> {{ $userData->email ?? '' }}       </td>
                               <td> {{ $userData->mobile_no ?? '' }}   </td>
                           
                               <td>
                                   @if($userData->status== 1)
                                   <span class="text-success"> Active</span>
                                   @else
                                   <span class="text-danger"> Inactive</span>
                                   @endif
                               </td>
                             <td>
                              <div class="d-flex">
                                {{-- use details  --}}
                                 <button type="button" data-href="{{ action('Admin\UserController@viewDetail',[$userData->id] ?? '') }}" class="fa-icon fa fa-eye mr-2 view_model" data-toggle="modal" data-target="#view_model"></button>

                                 @if($userData->status == 1)
                                    <button type="button" id="deactivate" href="{{ action('Admin\UserController@status',[$userData->id]) }}" class="btn btn-primary btn-xs"> Inactive </button>
                                 @else
                                     <button type="button" id="activate" href="{{ action('Admin\UserController@status',[$userData->id]) }}" class="btn btn-primary btn-xs"> Active </button>
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
                           Showing  {{$user->firstItem()}} to {{$user->lastItem()}} of {{$user->total()}} entries
                        </div>
                        <div class="col-md-6 text-right paginationBlock">
                           {!! $user->appends(request()->input())->links() !!}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>  
        <!-- Container-fluid Ends-->
    @endsection




