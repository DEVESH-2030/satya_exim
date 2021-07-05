
@extends('admin.layout.app')
    
    @section('content')            
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Contact Us</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Contact Us</li>
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
                           
                            <div class="table-responsive">
                                <table class="table jsgrid table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $sr = 1; 
                                    $page=1;
                                    if(Request::input('page'))
                                    $page=Request::input('page');
                                    $sort = $contactusmail->perPage();
                                    @endphp
                                    @foreach($contactusmail as $contactusmailData)
                                        <tr>
                                            <td>{{$sr++}} </td>
                                            <td>{{ $contactusmailData->first_name }} {{ $contactusmailData->last_name }}</td>
                                            <td>{{ $contactusmailData->email }}</td>
                                            <td>{{ $contactusmailData->mobile }}</td>
                                            <td>{{ $contactusmailData->message }}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                </table>
                                
                            </div>
                                <div class="row">
                                    <div class="col-md-6 text-left" style="margin: 20px 0px;">
                                        Showing  {{$contactusmail->firstItem()}} to {{$contactusmail->lastItem()}} of {{$contactusmail->total()}} entries
                                    </div>
                                    <div class="col-md-6 text-right paginationBlock">
                                        {!! $contactusmail->appends(request()->input())->links() !!}
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    @endsection             