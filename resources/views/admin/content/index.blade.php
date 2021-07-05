
@extends('admin.layout.app')
    
    @section('content')            
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Content Management</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Content Management</li>
                        <li class="breadcrumb-item active">Pages List</li>
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
                            <h5>Pages List</h5>
                        </div>

                        <div class="card-body">
                           <!--  <div class="btn-popup pull-right">
                                <button href="#" data-href="{{ action('Admin\ContentManagementController@create') }}" class="btn btn-primary add_model"  data-toggle="modal" data-target="add_model" data-container=".add_model">Add Content
                                </button>   
                            </div>  -->
                            <div class="table-responsive">
                                <table class="table jsgrid table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Title</th>
                                        <!-- <th>Status</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $sr = 1; 
                                    $page=1;
                                    if(Request::input('page'))
                                    $page=Request::input('page');
                                    $sort = $content->perPage();
                                    @endphp
                                    @foreach($content as $contentData)
                                        <tr>
                                            <td>{{$sr++}} </td>
                                            <td>{{ $contentData->title }}</td>
                                           <!--  <td>
                                                @if($contentData->status == 1)
                                                <span class="text-success">Active</span>
                                                @else
                                                <span class="text-danger">Inactive</span>
                                                @endif
                                            </td> -->
                                            <td>
                                                <div class="d-flex">
                                                    {{-- use edit  --}}
                                                    <a type="button" data-href="{{ action('Admin\ContentManagementController@update',[$contentData->id]) }}" class="mr-2 edit_model" data-toggle="modal" data-target="#edit_model"><i class="text-success fa fa-edit"></i></a>
                                                
                                                <!-- @if($contentData->status == 1)
                                                    <button type="button" id="deactivate" href="{{ action('Admin\ContentManagementController@status',[$contentData->id]) }}" class="btn btn-primary btn-xs">InActive</button>
                                                    @else
                                                    <button type="button" id="activate" href="{{ action('Admin\ContentManagementController@status',[$contentData->id]) }}" class="btn btn-primary btn-xs">Active</button>
                                                @endif -->
                                                </div>

                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                </table>

                            </div>
                                <div class="row">
                                    <div class="col-md-6 text-left" style="margin: 20px 0px;">
                                        Showing  {{$content->firstItem()}} to {{$content->lastItem()}} of {{$content->total()}} entries
                                    </div>
                                    <div class="col-md-6 text-right paginationBlock">
                                        {!! $content->appends(request()->input())->links() !!}
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- about -->
       {{--  <div class="modal fade" id="editabout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">About</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation">
                            <div class="form">
                                <div class="form-group">
                                    <label for="validationCustom01" class="mb-1">Title:</label>
                                    <input class="form-control" id="validationCustom01" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom02" class="mb-1">Description:</label>
                                    <textarea id="editor1" name="editor1" cols="30" rows="10"></textarea>
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
        </div> --}}

        {{-- <div class="modal fade" id="editterm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Terms & Conditions</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation">
                            <div class="form">
                                <div class="form-group">
                                    <label for="validationCustom01" class="mb-1">Title:</label>
                                    <input class="form-control" id="validationCustom01" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom02" class="mb-1">Description:</label>
                                    <textarea id="editor2" name="editor1" cols="30" rows="10"></textarea>
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
        <div class="modal fade" id="editprivacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Privacy Policy</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation">
                            <div class="form">
                                <div class="form-group">
                                    <label for="validationCustom01" class="mb-1">Title:</label>
                                    <input class="form-control" id="validationCustom01" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom02" class="mb-1">Description:</label>
                                    <textarea id="editor3" name="editor1" cols="30" rows="10"></textarea>
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
        </div> --}}

    @endsection 