<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="author" content="">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Viewport metatags -->
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- iOS webapp metatags -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

{{--@include('admin._masters.favicons')--}}
<link rel="icon" href="{{URL::asset('resources/assets/site/images/logo-3.png')}}" type="image/x-icon">
<title>{{$pageTitle}} | {{\App\Models\PrefsModel::get_title_value()}} </title>

<!--Page loading plugin Start -->
<link rel="stylesheet" href="{{URL::asset('resources/assets/admin/css/rtl-css/plugins/pace-rtl.css')}}">
<script src="{{URL::asset('resources/assets/admin/js/pace.min.js')}}"></script>
<!--Page loading plugin End   -->

<!-- Plugin Css Put Here -->
<link href="{{URL::asset('resources/assets/admin/css/bootstrap-rtl.css')}}" rel="stylesheet">

<!-- Plugin Css End -->
<!-- Custom styles Style -->
<link href="{{URL::asset('resources/assets/admin/css/rtl-css/style-rtl.css')}}" rel="stylesheet">
<!-- Custom styles Style End-->

<!-- Responsive Style For-->
<link href="{{URL::asset('resources/assets/admin/css/rtl-css/responsive-rtl.css')}}" rel="stylesheet">
<link href="{{URL::asset("https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css")}}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- Responsive Style For-->
<script src="{{URL::asset('resources/assets/site/js/jquery.min.js')}}"></script>

<!-- Custom styles for this template -->


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

