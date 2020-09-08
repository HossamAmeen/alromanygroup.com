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
                <h1 class="wow fadeInLeft"><i class="fa fa-hospital-o"></i> توكيلات السيراميك  <i class="fa fa-hospital-o"></i></h1>
            </div>
        </div>
        <div class="sub-head">
            <ul>
                <li><a href="{{url::to('/')}}"> الرئيسية </a></li> /
                <li><a href="{{url::to('agencies')}}">  توكيلات السيراميك  </a></li>
            </ul>
        </div>
    </section>


    <section id="bodys">
        <div class="container">
            <div class="col-sm-12 information">

                <div class="col-sm-12 featured">

                    <div class="col-sm-12 mgnet2">
                        <!-- item -->
                        <div class="col-sm-2 wow bounceInRight">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/klio.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInDown">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/66.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInLeft">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/67.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInDown">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/68.png')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInRight">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/69.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInLeft">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/70.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInDown">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/71.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInLeft">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/72.jpg')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInDown">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/75.png')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInLeft">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/76.png')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                        <div class="col-sm-2 wow bounceInLeft">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/78.png')}}" alt="">
                            </div>
                        </div>
                        <!-- //item -->

                        <!-- item -->
                       {{-- <div class="col-sm-2 wow bounceInLeft">
                            <div class="ziko">
                                <img src="{{url::asset('resources/assets/site/images/80.png')}}" alt="">
                            </div>
                        </div>--}}
                        <!-- //item -->


                    </div>

                </div>

            </div>
        </div>
    </section>





@stop