@extends("website.layout.app")
  {{-- @include("website.layout.header") --}}
@section('content')

<style>
    .alert{
        border-color: #f5c6cb;
        text-align: right;
        width: max-content;
        float: right;
    }
</style>

<div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>Create an Account</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create an Account</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="register-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Create an Account</h3>
                    <div class="theme-card">
                        <form class="theme-form needs-validation" novalidate method="post" action="{{url('create-account')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                            
                                <div class="col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" onkeypress="return alphaonly(event)" maxlength="50" required="">
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" onkeypress="return alphaonly(event)" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="form-row">
                           
                                <div class="col-md-6">
                                    <label for="mobile_no">Contact Number</label>
                                    <input type="text" class="form-control"  name="mobile_no" placeholder="Contact Number" onkeypress="return numbersonly(event)" maxlength="10" required="">
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email Address</label>
                                    <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$" class="form-control" id="email" name="email" placeholder="Email" required="">
                                </div>
                            </div>
                            <div class="form-row">
                            
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control"  id="password" autocomplete="new-password" name="password" placeholder="Password" minlength="4" required="">
                                </div>
                                <div class="col-md-6">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control"  id="re-password"   name="confirm_password" placeholder="Confirm Password" minlength="4" maxlength="16" required="">
                                    <small class="error text-danger" style="position: absolute;bottom: 15px;"></small>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="file">Upload Image</label>
                                    <input class="form-control file-upload-input" name="image" type="file" required="" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                                </div>

                                <div class="col-md-6">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" onkeypress="return numbersonly(event)" maxlength="6" required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 select_input">
                                    <label for="state">Region/State</label>
                                    <select class="form-control state" size="1" name="state_id" required="">
                                        <option value="">Selecet State</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 select_input">
                                    <label for="state">City</label>
                                    <select class="form-control city" size="1" name="city_id" required="">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address" required=""></textarea>
                                    <button type="submit" class="btn btn-solid mt-4 float-right">Create Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
<script type="text/javascript">
      $(document).ready(function()
  {
         $('.state').on('change', function() {         
      var state_id = $(this).val(); 
      if(state_id) {
        $.ajax({
         url: '{{ url("/json-city") }}',
         type: "GET",
         data : {'state_id':state_id,"_token":"{{ csrf_token() }}"},
         dataType: "json",
         success:function(data) {
          if(data){ 
           $('.city').empty();
           $('.city').focus;
           $('.city').append('<option value="">Select City</option>'); 
           $.each(data, function(key, value){                         
           $('.city').append('<option value="'+ value.id +'">' + value.name + '</option>');
          });
          } else {
            $('.city').empty();
          }
         }
        });
      } else {
        $('.city').empty();
      }
  });
     });
</script>
@endsection