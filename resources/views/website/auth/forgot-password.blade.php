@extends("website.layout.app")
  {{-- @include("website.layout.header") --}}
@section('content')
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>forgot password</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('login')}}">login</a></li>
                            <li class="breadcrumb-item active" aria-current="page">forgot password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="pwd-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h2>Forgot Password</h2>
                    <form class="theme-form" action="{{url('/password-submit')}}" method="post" enctype="multipart/data-form">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$" placeholder="Enter Your Email" required="">
                            </div><button type="submit" class="btn btn-solid">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection