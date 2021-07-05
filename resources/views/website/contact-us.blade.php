@extends("website.layout.app")
  {{-- @include("website.layout.header") --}}
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">  
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>contact us</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">contact us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="contact-page section-b-space">
        <div class="container">
            <div class="row section-b-space">
                <div class="col-lg-7 map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d448181.163741622!2d76.81306442366602!3d28.64727993557044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x37205b715389640!2sDelhi!5e0!3m2!1sen!2sin!4v1614841687494!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-lg-5">
                    <div class="contact-right">
                        <ul>   
                            <li>
                                <div class="contact-icon"><img src="{{url('img/icon/phone.png')}}"
                                        alt="Generic placeholder image">
                                    <h6>Contact Us</h6>
                                </div>
                                <div class="media-body">
                                    <p>{{$setting->mobile}}</p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <h6>Address</h6>
                                </div>
                                <div class="media-body">
                                    {!! $setting->address !!}
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon"><img src="{{url('img/icon/email.png')}}"
                                        alt="Generic placeholder image">
                                    <h6>Address</h6>
                                </div>
                                <div class="media-body">
                                    {!! $setting->email !!}
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon"><i class="fa fa-fax" aria-hidden="true"></i>
                                    <h6>Fax</h6>
                                </div>
                                <div class="media-body">
                                    <p>{{$setting->fax}}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form class="theme-form" method="post" action="{{url('contact-us-mail')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" id="name" name="first_name" placeholder="Enter first name" required="" onkeypress="return alphaonly(event)">
                            </div>
                            <div class="col-md-6">
                                <label for="email">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" required="" onkeypress="return alphaonly(event)">
                            </div>
                            <div class="col-md-6">
                                <label for="review">Phone number</label>
                                <input type="text" class="form-control" id="review" name="mobile" placeholder="Enter your number" required="" maxlength="10" onkeypress="return numbersonly(event)">
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$">
                            </div>
                            <div class="col-md-12">
                                <label for="review">Write Your Message</label>
                                <textarea class="form-control" placeholder="Write message"
                                    id="exampleFormControlTextarea1" name="message" rows="6"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-solid" type="submit">Send Your Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->
@endsection