
@extends('admin.layout.app')

    @section('content')
        <!-- Container-fluid starts-->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Profile
                            <small>E-Commerce Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-details text-center">
                                <img src="{{url($getInfo->image ?? 'admin/assets/images/dashboard/designer.jpg')}}" alt="" class="img-fluid img-90 rounded-circle blur-up lazyloaded">
                                <h5 class="f-w-600 mb-0">{{ $getInfo->name ?? '' }}</h5>
                                <span>{{ $getInfo->email ?? '' }}</span>
                            </div>
                            <hr>
                            <div class="project-status">
                                <h5 class="f-w-600">Admin Details</h5>
                                <div class="table-responsive profile-table">
                                    <table class="table table-responsive">
                                        <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td>{{ $getInfo->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>{{ $getInfo->email ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td>{{ $getInfo->gender ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Number:</td>
                                            <td>{{ $getInfo->mobile ?? '' }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="card tab2-card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="top-profile-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><i data-feather="user" class="mr-2"></i>Edit Profile</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="settings" class="mr-2"></i>Change Password</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="top-tabContent">
                                <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab">
                                    <form class="needs-validation" method="post" action="{{ url('admin/update-profile') }}"  enctype="multipart/form-data" name="edit_model" id="edit_model">
                                        @csrf
                                        <div class="form">
                                            <div class="form-group">
                                                <label for="validationCustom01" class="mb-1">Name :</label>
                                                <input class="form-control" id="validationCustom01" type="text"  onkeypress="return alphaonly(event)" value="{{ $getInfo->name ?? '' }}" name="name" required>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label for="file" class="mb-1">Image :</label>
                                                <input class="form-control" id="file" type="file"  onchange="return imgValidation(event)" accept=".png,.jpg,.jpeg" name="image" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustom01" class="mb-1">Email :</label>
                                                <input class="form-control" id="validationCustom01" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$" value="{{ $getInfo->email ?? '' }}" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustom01" class="mb-1">Gender :</label>
                                                <select class="form-control" id="validationCustom01" type="text" name="radio2" required>
                                                    <option value="">Select</option>
                                                    <option value="Male" {{ $getInfo->gender == 'Male' ? 'selected' : ''
                                                     }}>Male</option>
                                                    <option value="Female" {{ $getInfo->gender == 'Female' ? 'selected' : ''
                                                     }}>Female</option>
                                                    <option value="Other" {{ $getInfo->gender == 'Other' ? 'selected' : ''
                                                     }}>Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustom01" class="mb-1">Mobile :</label>
                                                <input class="form-control" id="validationCustom01" type="text"  onkeypress="return numbersonly(event)"  value="{{ $getInfo->mobile ?? '' }}" name="phone_number" required>
                                            </div>
                                            <div class="form-group">
                                                 <button class="btn btn-primary" type="submit">Update</button>
                                                <a class="btn btn-outline-primary" href="{{ url('admin/profile') }}" type="button" data-dismiss="modal">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                    <form class="needs-validation" method="post" action="{{ url('admin/update-admin-password') }}" name="edit_model" id="edit_model">
                                        <div class="form">
                                            <div class="form-group">
                                                <label for="validationCustom01" class="mb-1">Old Password :</label>
                                                <input class="form-control" id="validationCustom01" type="password" name="old_password" required>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label for="validationCustom02" class="mb-1">New Password :</label>
                                                <input class="form-control" id="validationCustom02" type="password" name="new_password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustom01" class="mb-1">Confirm Password :</label>
                                                <input class="form-control" id="validationCustom01" type="password" name="conf_password" required>
                                            </div>
                                            <div class="form-group">
                                                 <button class="btn btn-primary" type="submit">Update</button>
                                                <a class="btn btn-outline-primary" href="{{ url('admin/profile') }}" type="button" data-dismiss="modal">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    @endsection