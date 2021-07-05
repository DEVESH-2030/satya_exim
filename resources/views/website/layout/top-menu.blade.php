@php 
    $setting = App\Models\Settings::where('status', 1)->first();
    $socialMedia = App\Models\SocialMedia::first();
  @endphp 
<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="header-contact">
                    <ul>
                        <li>Welcome to Our E-Commerce</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i>Call Us: {{$setting->mobile ?? ''}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 text-right">
                <ul class="header-dropdown">
               
                    @if(Auth::check())
                        @php
                            $user = App\User::where('id',Auth::user()->id)->first();
                        @endphp
                     <li class="onhover-dropdown mobile-account">
                        <img src="{{url($user->image ??'')}}" style="width: 25px;height: 25px;border-radius: 50%;border:1px solid #f2f2f2; margin-right:4px;">{{ $user->first_name ??'' }}
                        <ul class="onhover-show-div">
                            <li><a href="{{url('user-logout')}}" data-lng="es">Logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li class=" mobile-account">
                        <img src="{{url('img/dummy.png')}}"  style="width: 22px;height: 22px;border-radius: 50%;border:1px solid #f2f2f2;margin-right:5px"><a href="{{url('login')}}" data-lng="en">Login</a>
                        <!-- <ul class="onhover-show-div">
                            <li><a href="{{url('login')}}" data-lng="en">Login</a></li>
                        </ul> -->
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>