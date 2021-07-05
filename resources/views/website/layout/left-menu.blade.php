  @php 
    $setting = App\Models\Settings::where('status', 1)->first();
    $socialMedia = App\Models\SocialMedia::first();
  @endphp
<div class="menu-left">
    <div class="navbar">
        <!-- <a href="javascript:void(0)" onclick="openNav()">
            <div class="bar-style"><i class="fa fa-bars sidebar-bar" aria-hidden="true"></i>
            </div>
        </a> -->
       
    </div>
    <div class="brand-logo">
        <a href="{{url('/')}}"><img src="{{asset($setting->logo ?? '')}}"
                class="img-fluid blur-up lazyload" alt=""></a>
    </div>
</div>