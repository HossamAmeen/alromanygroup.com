<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="ITM, Infinite Creative">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- iOS webapp metatags -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <link rel="icon" href="{{URL::asset('resources/assets/site/images/icon.png')}}" type="image/x-icon">

    <title>تغير كلمة المرور - {{\App\Models\PrefsModel::get_ar_title_value()}}</title>

    <!--Page loading plugin Start -->
    <link rel="stylesheet" href="{{URL::asset('resources/assets/admin/css/plugins/pace.css')}}">
    <script src="{{URL::asset('resources/assets/admin/js/pace.min.js')}}"></script>
    <!--Page loading plugin End   -->

    <!-- Plugin Css Put Here -->
    <link href="{{URL::asset('resources/assets/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('resources/assets/admin/css/plugins/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('resources/assets/admin/css/plugins/ladda-themeless.min.css')}}">

    <link href="{{URL::asset('resources/assets/admin/css/plugins/humane_themes/bigbox.css')}}" rel="stylesheet">
    <link href="{{URL::asset('resources/assets/admin/css/plugins/humane_themes/libnotify.css')}}" rel="stylesheet">
    <link href="{{URL::asset('resources/assets/admin/css/plugins/humane_themes/jackedup.css')}}" rel="stylesheet">

    <!-- Plugin Css End -->
    <!-- Custom styles Style -->
    <link href="{{URL::asset('resources/assets/admin/css/rtl-css/style-rtl.css')}}" rel="stylesheet">
    <!-- Custom styles Style End-->

    <!-- Responsive Style For-->
    <link href="{{URL::asset('resources/assets/admin/css/rtl-css/responsive-rtl.css')}}" rel="stylesheet">
    <!-- Responsive Style For-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-screen">
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="login-box">
                    <div class="login-content">
                        <div class="login-user-icon">
                            <i class="glyphicon glyphicon-user"></i>

                        </div>
                        <h3>كلمة المرور الجديدة</h3>

                        <div class="col-xs-12">
                            <img class="img img-responsive" src="{{URL::asset('resources/assets/admin/images/logo.png')}}">
                        </div>
                        <div class="clearfix"></div>

                        <div class="login-form">

                            {!! Form::open(array('url' => 'password/reset', 'class' => 'form-horizontal ls_form','method'=>'POST')) !!}
                            {!! Form::hidden("token",$token) !!}

                            @include('admin._masters.validation_errors')

                            <div class="input-group ls-group-input">
                                <input class="form-control" type="text" name="email" placeholder="البريد الالكتروني">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>


                            <div class="input-group ls-group-input">

                                <input type="password" placeholder="كلمة المرور الجديدة" name="password"
                                       class="form-control" required >
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>

                            <div class="input-group ls-group-input">

                                <input type="password" placeholder="تأكيد كلمة المرور" name="password_confirmation"
                                       class="form-control" required >
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>


                            <div class="input-group ls-group-input login-btn-box">
                                <button class="btn ls-dark-btn ladda-button col-md-12 col-sm-12 col-xs-12" data-style="slide-down">
                                    <span class="ladda-label"><i class="fa fa-key"></i></span>
                                </button>

                            </div>
                            {!!Form::close()!!}
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<p class="copy-right big-screen hidden-xs hidden-sm">
    {{\App\Models\PrefsModel::get_en_title_value()}} <span class="footer-year">2017</span> <span>&#169;</span>
</p>
</section>

</body>
<script src="{{URL::asset('resources/assets/admin/js/lib/jquery-2.1.1.min.js')}}"></script>
<script src="{{URL::asset('resources/assets/admin/js/lib/jquery.easing.js')}}"></script>
<script src="{{URL::asset('resources/assets/admin/js/bootstrap-switch.min.js')}}"></script>
<!--Script for notification start-->
<script src="{{URL::asset('resources/assets/admin/js/loader/spin.js')}}"></script>
<script src="{{URL::asset('resources/assets/admin/js/loader/ladda.js')}}"></script>
<script src="{{URL::asset('resources/assets/admin/js/humane.min.js')}}"></script>
<!--Script for notification end-->

<script src="{{URL::asset('resources/assets/admin/js/pages/login.js')}}"></script>
</html>