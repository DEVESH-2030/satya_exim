  
  @php 
    $setting = App\Models\Settings::where('status', 1)->first();
    $category = App\Models\Category::where('status', 1)->get();
    $content = App\Models\Content::where('status', 1)->get();
  @endphp   

<section class="section-b-space light-layout">
    <div class="container">
        <div class="row footer-theme partition-f">
            <div class="col-lg-4 col-md-6">
                <div class="footer-title footer-mobile-title">
                    <h4>about</h4>
                </div>
                <div class="footer-contant">
                    <div class="footer-logo"><img src="{{asset($setting->logo ?? '')}}" alt=""></div>
                    {!!$setting->description ?? '' !!}
                    <div class="footer-social">
                        <ul>
                            <li><a href="{{$setting->facebook ?? ''}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="{{$setting->gmail ?? ''}}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="{{$setting->twitter ?? ''}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="{{$setting->instagram ?? ''}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <!-- <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col offset-xl-1">
                <div class="sub-title">
                    <div class="footer-title">
                        <h4>Quick Links</h4>
                    </div>
                    <div class="footer-contant">
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('about-us')}}">About</a></li>
                            <li><a href="{{url('product')}}">Products</a></li>
                            <li><a href="{{url('category')}}">Category</a></li>
                            <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                            <!-- <li><a href="{{url('')}}">featured</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="sub-title">
                    <div class="footer-title">
                        <h4>Category</h4>
                    </div>
                    <div class="footer-contant">
                        <ul>
                            @foreach($category as $categories)
                            <li><a href="{{url('/product?main_category='.$categories->id)}}">{{$categories->name}}</a></li>
                            @endforeach
                           <!--  <li><a href="{{url('sub-category')}}">Category 2</a></li>
                            <li><a href="{{url('sub-category')}}">Category 3</a></li>
                            <li><a href="{{url('sub-category')}}">Category 4</a></li>
                            <li><a href="{{url('sub-category')}}">Category 5</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="sub-title">  
                    <div class="footer-title">
                        <h4>store information</h4>
                    </div>
                    <div class="footer-contant">
                        <ul class="contact-list">
                            <!-- <li><i class="fa fa-map-marker"></i>E-Commerce Demo Store, Demo store India 345-659</li> -->
                            <li class="address-ft"><i class="fa fa-map-marker"></i>{!! $setting->address ?? '' !!}</li>
                            <li><i class="fa fa-phone"></i>Call Us: {{ $setting->mobile ?? '' }}</li>
                            <li><i class="fa fa-envelope-o"></i>Email Us: <a href="#">{{ $setting->email ?? '' }}</a></li>
                            <li><i class="fa fa-fax"></i>Fax: {{ $setting->fax ?? '' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>