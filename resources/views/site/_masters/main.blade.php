<!DOCTYPE html>
<html>
<head>
    @include('site._masters.header')
    @yield('header')
</head>

<body>
<div class="page-wrapper">

    <!-- Main Header / Header Style Two-->
    <header class="main-header header-style-two">
        <!-- <div id="grad1"></div> -->
        <!-- Header Top -->
        <div class="header-top" style="display: block;">
            <div class="auto-container clearfix">

                <!-- Top Right -->
                <div class="top-right col-sm-6">

                    <!--Info-->
                    <ul class="info pull-left clearfix">
                        <li class="phone" style="padding-left: 8px;border-right: 0;">
                            <a href="#">
                                <span><img src="{{url::asset('resources/assets/site/images/social.png')}}"> </span> {{\App\Models\PrefsModel::get_tel_value()}}
                            </a>
                        </li>
                        <li class="email" style="border-right: 0;">
                            <a href=""> {{\App\Models\PrefsModel::get_email_value()}} <span><i class="fa fa-envelope"></i></span>
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="top-right col-sm-6">
                    <div class="social-links pull-right clearfix">
                        <a href="{{\App\Models\PrefsModel::get_facebook_value()}}"><span class="fa fa-facebook"></span></a>
                        <a href="{{\App\Models\PrefsModel::get_twitter_value()}}"><span class="fa fa-twitter"></span></a>
                        <a href="{{\App\Models\PrefsModel::get_instagram_value()}}"><span class="fa fa-instagram"></span></a>
                        <a href="{{--{{\App\Models\PrefsModel::get_youtube_value()}}--}}"><span class="fa fa-youtube"></span></a>
{{--
                        <a href="#"><span class="fa fa-android"></span></a>
--}}
                    </div>
                </div>

            </div>
        </div>


        <!-- Header Lower -->
        <div class="header-lower">
            <div class="auto-container">
                <div class="lower-outer clearfix">
                    <!--Logo-->
                    <div class="logo">
                        <a href="#"><img src="{{url::asset('resources/assets/site/images/logo-3.png')}}"></a>
                    </div>

                    <!--Right Container-->

                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation">
                                <li class="current"><a href="{{url::to('/')}}"><i class="fa fa-home"></i> الرئيسية</a></li>
                                <li><a href="{{url::to('products')}}"> المنتجات</a></li>
                                <li><a href="{{url::to('offers')}}">الأحدث والعروض</a></li>
                                <li><a href="{{url::to('agencies')}}">التوكيلات</a></li>
                                <li><a href="{{url::to('about-us')}}">من نحن ؟</a></li>
                                <li><a href="{{url::to('contact')}}">تواصل معنا</a></li>
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->
                    <!-- Top Right -->

                </div>
            </div>

        </div>


    </header>
    <!--End Main Header -->









    @yield('content')
</div>

    @include('site._masters.footer')
    @yield('footer')

</body>
</html>
