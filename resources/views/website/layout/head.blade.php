  @php 
    $setting = App\Models\Settings::where('status', 1)->first();
  @endphp  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="E-Commerce">
    <meta name="keywords" content="E-Commerce">
    <meta name="author" content="E-Commerce">
    <link rel="icon" href="{{asset($setting->favicon ?? '')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset($setting->favicon ?? '')}}" type="image/x-icon">
    <title>E-Commerce</title>

   @include("website.layout.css")

</head>

