<!DOCTYPE html>
<html>
	
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    {{-- CSRF Token --}} 
        <meta name="csrf-token" content="{{ csrf_token() }}">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="E-Commerce admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
	    <meta name="keywords" content="admin template, E-Commerce admin template, dashboard template, flat admin template, responsive admin template, web app">
	    <meta name="author" content="pixelstrap">
	    <title>E-Commerce | Admin </title>
	    <link rel="icon" href="{{url('img/favicon.png')}}" type="image/x-icon">
	    <link rel="shortcut icon" href="{{url('img/favicon.png')}}" type="image/x-icon">
	    

	   @include("admin.layout.css") 
	</head>
	
	<body>
		<div class="page-wrapper">
		
		{{-- start header	 --}}
		@include('admin.layout.header')		
		{{-- end header --}}
		
		<div class="page-body-wrapper">
		
			{{-- start sidebar --}}
			@include('admin.layout.sidebar')
			{{-- end sidebar --}}
		
			<div class="page-body"> 

				 @if(session()->has('success') || session()->has('error')) 
		       @include('admin.layout.alertify_message') 
		    @endif

					{{-- start content --}}
					@yield('content')
					{{-- end content --}}
					
			</div>

			{{-- start footer --}}
			@include('admin.layout.footer')
			{{-- end footer --}}

		</div>

		{{-- start java script --}}
		@include('admin.layout.js')
		{{-- end jaa script --}}

		{{-- start popup model --}}
		@include('admin.layout.modal_popup')
		{{-- end popup model --}}
		
		@yield('js')


	</body>

</html>