
@extends('admin.layout.app')

    @section('content')
        <!-- Container-fluid starts-->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Notification
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Notification Management</li>
                        <li class="breadcrumb-item active">Notification List</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5>Notification</h5>
                </div>
                <div class="card-body order-datatable">
                <ul class="notification-list">
                    <li>
                        <div class="d-flex align-items-center justify-content-between border-bottom p-3">
                            <img class="img-60 rounded-circle mr-3" src="{{url('admin/assets/images/dashboard/man.png')}}" alt="#">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                            <span>02 March 2021, 5:11 PM</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom p-3">
                            <img class="img-60 rounded-circle mr-3" src="{{url('admin/assets/images/dashboard/man.png')}}" alt="#">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                            <span>02 March 2021, 5:11 PM</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom p-3">
                            <img class="img-60 rounded-circle mr-3" src="{{url('admin/assets/images/dashboard/man.png')}}" alt="#">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                            <span>02 March 2021, 5:11 PM</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom p-3">
                            <img class="img-60 rounded-circle mr-3" src="{{url('admin/assets/images/dashboard/man.png')}}" alt="#">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                            <span>02 March 2021, 5:11 PM</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom p-3">
                            <img class="img-60 rounded-circle mr-3" src="{{url('admin/assets/images/dashboard/man.png')}}" alt="#">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                            <span>02 March 2021, 5:11 PM</span>
                        </div>
                    </li>
                </ul>
            </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    @endsection