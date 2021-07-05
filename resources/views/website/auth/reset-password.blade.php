@extends("website.layout.app")
  {{-- @include("website.layout.header") --}}
@section('content')
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>Reset password</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('login')}}">login</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reset password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
   <!--  @if (\Session::has('success'))
	    <div class="alert alert-success alert-dismissible">
	      <button type="button" class="close" data-dismiss="alert">&times;</button>
	      <p>
	        {!! \Session::get('success') !!}
	      </p>
	    </div>
	  @endif

	  @if (\Session::has('error'))
	    <div class="alert alert-danger alert-dismissible">
	      <button type="button" class="close" data-dismiss="alert">&times;</button>
	      <p>
	        {!! \Session::get('error') !!}
	      </p>
	    </div>
	  @endif -->

    <section class="pwd-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h2>Reset Password</h2>
                    <form class="theme-form" action="{{url('/reset-password-submit')}}" method="post" enctype="multipart/data-form">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12">
                            	 <input type="hidden" class="form-control" name="email" value="{{$email}}" required="">
                                <input type="password" class="form-control" name="newpassword" id="newpassword"  placeholder="New Password" required="">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password"  placeholder="Confirm Password" required="">
                            </div><button type="submit" class="btn btn-solid">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection