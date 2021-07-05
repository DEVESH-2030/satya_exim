
@extends('admin.layout.app')
    
    @section('content')   
<style>
    .alert{
        /* border-color: #f5c6cb; */
        text-align: right;
        width: max-content;
        float: right;
    }
</style>         
        <div class="page-header"> 
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Website Settings</h3>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Website Settings</li>
                    </ol>
                </div>
            </div>
        </div>
           
        <!-- Address section-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add/Update Settings </h5>
                        </div>
    
                        <div class="card-body"> 
                           <form class="needs-validation" action="{{ action('Admin\SettingController@saveSettings', [$settings->id ??'']) }}" method="post" enctype="multipart/form-data"> 
                            @csrf
                                <input type="hidden" name="id" value="{{$settings->id ??'' }}">
                                <div class="form">
                                    <div class="form-group">  
                                        <label for="validationCustom01" class="mb-1">Mobile Number:<span style="color: red">*</span></label>
                                        <input class="form-control" name="mobile" id="validationCustom01" type="text" value="{{$settings->mobile ??''}}" maxlength="15"  minlength="10" required onkeypress="return numbersonly(event)">
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom02" class="mb-1">Address:<span style="color: red">*</span></label>
                                        <textarea class="form-control" id="editor1" name="address" cols="30" rows="10" required>{{$settings->address ??''}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom02" class="mb-1">Email:<span style="color: red">*</span></label>
                                        <input class="form-control" name="email" id="validationCustom01" type="email" value="{{$settings->email ??''}}" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$">
                                    </div> 
                                    <div class="form-group">
                                        <label for="validationCustom03" class="mb-1">Fax:<span style="color: red">*</span></label>
                                        <input class="form-control" name="fax" id="validationCustom03" type="text" value="{{$settings->fax ??''}}" required>
                                    </div>
                                    <!-- logo and favicon -->
                                    <div class="form-group">  
                                        <label for="validationCustom01" class="mb-1">Logo:<span style="color: red">*</span></label>
                                        <input class="form-control" name="logo" id="validationCustom01" type="file" accept=".png,.jpg,.jpeg" @if(empty($settings->logo)) @endif>
                                        @if(!empty($settings->logo))
                                         <img src="{{asset($settings->logo ??'')}}" class="img-circle mt-2" style="margin-top: 5px; width:150px; height:100px;" alt="website logo">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom02" class="mb-1">Favicon:<span style="color: red">*</span></label>
                                        <input class="form-control" type="file" id="favicon" name="favicon" accept=".png,.jpg,.jpeg" @if(empty($settings->logo)) @endif> 
                                       @if(!empty($settings->favicon))
                                         <img src="{{asset($settings->favicon ??'')}}" class="img-circle mt-2" style="margin-top: 5px; width:150px; height:100px;" alt="website favicon">
                                        @endif
                                    </div>
                                     <div class="form-group">
                                        <label for="validationCustom02" class="mb-1">Description:<span style="color: red">*</span></label>
                                        <textarea class="form-control" id="editor1" name="description" cols="30" rows="10" required>{{$settings->description ??''}}</textarea>
                                    </div>

                                    <!-- Social Media -->
                                    <div class="form-group">  
                                        <label for="validationCustom01" class="mb-1">Facebook:<span style="color: red">*</span></label>
                                        <input class="form-control" name="facebook" id="validationCustom01" type="text" value="{{$settings->facebook ??''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom02" class="mb-1">Gmail:<span style="color: red">*</span></label>
                                        <input class="form-control"  type="text" id="gmail" name="gmail" required value="{{$settings->gmail ??''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom02" class="mb-1">Twitter:<span style="color: red">*</span></label>
                                        <input class="form-control" name="twitter" id="validationCustom01" type="text" value="{{$settings->twitter ??''}}" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for="validationCustom03" class="mb-1">Instagram:<span style="color: red">*</span></label>
                                        <input class="form-control" name="instagram" id="validationCustom03" type="text" value="{{$settings->instagram ??''}}" required>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                                        <a href="{{route('setting')}}" class="btn btn-secondary" type="button" data-dismiss="modal">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>  
        <!-- address Ends-->    

@endsection             