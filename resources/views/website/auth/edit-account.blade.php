@extends("website.layout.app")
  {{-- @include("website.layout.header") --}}
@section('content')
<style>
    .alert{
        color: #721c24;
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
                        <h2>Edit account</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit account</li>
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
                    <h3>Edit Account</h3>
                    <div class="theme-card">
                        <form class="theme-form" method="post" action="{{action('Website\UserController@edit', [$user->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                
                                <div class="col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"  value="{{$user->first_name ??''}}" onkeypress="return alphaonly(event)">
                                </div>                            
                            
                                <div class="col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{$user->last_name ?? ''}}" onkeypress="return alphaonly(event)" required=""> 
                                </div>
                            </div>
                            <div class="form-row">
                                
                                <div class="col-md-6">
                                    <label for="mobile_no">Contact Number</label>
                                    <input type="text" class="form-control"  name="mobile_no" placeholder="Contact Number" value="{{$user->mobile_no ?? ''}}" onkeypress="return numbersonly(event)" maxlength="10" required="">
                                </div>                         
                           
                                <div class="col-md-6">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$" id="email" name="email" placeholder="Email" value="{{$user->email ?? ''}}" required="">
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="col-md-4">
                                    <label for="file">Upload Image</label>
                                    <input class="form-control" id="file1" type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg"  @if(empty($user->image)) required @endif>
                                </div>
                                
                                @if(!empty($user->image))
                                <div class="col-md-2">
                                    <img src="{{url($user->image ?? '')}}" style=" border-radius: 50px; margin-top: 5px; width:100px; height:100px;" alt="user image">
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="{{$user->pincode ?? ''}}" onkeypress="return numbersonly(event)" maxlength="6" required="">
                                </div>
                            </div>
                            <div class="form-row">
                            
                                <div class="col-md-6 select_input">
                                    <label for="state">Region/State</label>
                                    <select class="form-control state" size="1" name="state_id" required="">
                                        <option value="">Selecet State</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->id}}" {{$state->id==$user->state_id?'selected':''}}>{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 select_input">
                                    <label for="state">City</label>
                                    <select class="form-control city" size="1" name="city_id" required="">
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{$city->id==$user->city_id?'selected':''}}>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                
                                
                                <div class="col-md-12">
                                    <label for="">Address</label>
                                    <textarea class="form-control" name="address" rows="3" required="">{{$user->address ??''}}</textarea>
                                    <button type="submit" class="btn btn-solid mt-4 float-right">Update Account</button>
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