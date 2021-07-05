  @php 
    $setting = App\Models\Settings::where('status', 1)->first();
  @endphp
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="E-Commerce">
    <meta name="keywords" content="E-Commerce">
    <meta name="author" content="E-Commerce">
    <link rel="icon" href="{{asset($setting->favicon ?? '')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset($setting->favicon ?? '')}}" type="image/x-icon">
	<title>E-Commerce | Website</title>
	@include('website.layout.css')
	@yield('css')
</head>
	@include('website.layout.header')
	<body>
		<div class="page-wrapper">

			 @if(session()->has('success') || session()->has('error')) 
		       @include('website.layout.alertify_message') 
		    @endif
			
			@yield('content')
			

			@include('website.layout.footer')
		
		</div>
			
			@include('website.layout.modal-popup')
	</body>
	
		@include('website.layout.js')
		
		@include('website.layout.alert')
		
		@yield('js')

</html>