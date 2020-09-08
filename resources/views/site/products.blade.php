@extends('site._masters.main')

@section('header')
    <meta property="og:image" content="{{URL::asset('resources/assets/site/images/fav.png')}}"/>


@stop


@section('footer')
    <script>
        $(document).ready(function(){
            $('#home').addClass('current');
        });
    </script>
    <script type="text/javascript">
        var _rys = jQuery.noConflict();
        _rys("document").ready(function(){

            _rys(window).scroll(function () {
                if (_rys(this).scrollTop() > 0) {
                    _rys('.dez').addClass("dc3");
                } else {
                    _rys('.dez').removeClass("dc3");
                }
            });
        });
    </script>
@stop


@section('content')
    <section class="head-tool" style="background:url({{url::asset('resources/assets/site/images/cd8.jpg')}}) center fixed; background-size: cover;">
        <div class="container">
            <div class="col-sm-12 text-center">
                <h1 class="wow fadeInLeft"><i class="fa fa-hospital-o"></i> معرض المنتجات <i class="fa fa-hospital-o"></i></h1>
            </div>
        </div>
        <div class="sub-head">
            <ul>
                <li><a href="{{url::to('/')}}"> الرئيسية </a></li> /
                <li><a href="{{url::to('products')}}">  معرض المنتجات  </a></li>
            </ul>
        </div>
    </section>

    <section id="bodys">
        <div class="container">
            <div class="col-sm-12 information">

                <div class="col-sm-12 featured">

                    <div class="col-sm-12 mgnet2">
                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInRight">
                            <div class="serv1">
                                <a href="">
                                    <img src="{{url::asset('resources/assets/site/images/ad1.png')}}" class="center-block" alt="">
                                    <p> السيراميك </p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="">
                                    <img src="{{url::asset('resources/assets/site/images/ad2.png')}}" class="center-block" alt="">
                                    <p> البورسلين</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInLeft">
                            <div class="serv1">
                                <a href="">
                                    <img src="{{url::asset('resources/assets/site/images/ad3.png')}}" class="center-block" alt="">
                                    <p> أطقم المطبخ</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInRight">
                            <div class="serv1">
                                <a href="">
                                    <img src="{{url::asset('resources/assets/site/images/ad4.png')}}" class="center-block" alt="">
                                    <p>بانيوهات</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="">
                                    <img src="{{url::asset('resources/assets/site/images/ad5.png')}}" class="center-block" alt="">
                                    <p> بلاط الديكور</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="">
                                    <img src="{{url::asset('resources/assets/site/images/ad6.png')}}" class="center-block" alt="">
                                    <p>خلاطات</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="">
                                    <img src="{{url::asset('resources/assets/site/images/ad7.png')}}" class="center-block" alt="">
                                    <p> أحجار زينة</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="">
                                    <img src="{{url::asset('resources/assets/site/images/ad8.png')}}" class="center-block" alt="">
                                    <p>أحواض</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ads15.jpg')}}" class="center-block" alt="">
                                    <p> وحدات رخام</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInLeft">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ads14.jpg')}}" class="center-block" alt="">
                                    <p>وحدات موبيلياء</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ads13.png')}}" class="center-block" alt="">
                                    <p> الجاكوزي</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInRight">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/asd.jpg')}}" class="center-block" alt="">
                                    <p>أطقم حمامات</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                    </div>

                </div>

            </div>
        </div>
    </section>




@stop