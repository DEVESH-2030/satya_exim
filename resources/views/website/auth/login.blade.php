@extends("website.layout.app")
  {{-- @include("website.layout.header") --}}
@section('content')
   <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>login</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <section class="login-page section-b-space">
       <!--  @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <p>
            {!! \Session::get('success') !!}
          </p>
        </div>
      @endif
 
      @if (\Session::has('error'))
        <div class="alert alert-error alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <p>
            {!! \Session::get('error') !!}
          </p>
        </div>
      @endif -->
      
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Login</h3>
                    <div class="theme-card">
                        <form class="theme-form" method="post" action="{{ url('login-submit') }}" id="ajax-login-submit">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="review">Password</label>
                                <input type="password" class="form-control" name="password" id="review" placeholder="Enter your password" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{url('forgot-password')}}">Forgot Password</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-solid">Login</button>
                                </div>
                            </div>
                            <!-- <a href="#" class="btn btn-solid">Forget Password</a> -->
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3>New Customer</h3>
                    <div class="theme-card authentication-right">
                        <h6 class="title-font">Create An Account</h6>
                        <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be
                            able to order from our shop. To start shopping click register.</p>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{url('/register')}}" class="btn btn-solid">Create An Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 
@section('js')
<script type="text/javascript">
    $(document).on('submit', 'form#ajax-login-submit', function(e) { 
      e.preventDefault();
      var data = new FormData(this);

      $.ajax({
          cache:false,
          contentType: false,
          processData: false,
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          dataType: "json",
          data: data,
          success: function(response) { 
            if (response.success == 200) {
                window.location.href =  "{{ url('/') }}";
            } else {
                $('.error-message').empty();
                $('.error-message').append(response.message);
                $('#error-x-popup').modal('show');
            }
          }
      }); 
    });
</script>
@endsection