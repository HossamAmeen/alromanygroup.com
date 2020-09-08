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
                <h1 class="wow fadeInLeft"><i class="fa fa-hospital-o"></i> معرض الروماني <i class="fa fa-hospital-o"></i></h1>
            </div>
        </div>
        <div class="sub-head">
            <ul>
                <li><a href="{{url::to('/')}}"> الرئيسية </a></li> /
                <li><a href="{{url::to('products')}}"> معرض الروماني   </a></li>
            </ul>
        </div>
    </section>


    <section id="bodys">
        <div class="container">
            <div class="col-sm-12 information">
                <div class="col-sm-12 about text-center">
                    <div class="col-sm-12 about text-center wow bounceInLeft">
                        <h1> الروماني جروب </h1>
                        <p style="text-align: center !important;color:#222;  ">إحنا الاصل عشان احنا اول معرض سيراميك وبورسلين فى اسيوط واول معرض يقدم خدماته سنة 1980م, السيراميك والبرورسلين وأطقم المطبخ واطقم الحمام وبلاط الديكور,تعدد التوكيلات المورده للرماني جروب مما يتيح لك حرية الاختيار بين العدد من الماركات العالمية,وتتميز الروماني جروب بالاسعار الخاصة والخصومات التي تصل الي 60% من قيمة المنتج وخصومات الكميات,وايضا اكبر مخازن للسيراميك في أسيوط,أخيراَ تقدر تشرفنا فيمعرضنا أسيوط شارع يسري راغب, الروماني جروب #احنا_الأصل   <br> <span style="font-size: 22px !important;color: #656D70;"> شاهد الفيديو <i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></span></p>
                    </div>
                    <div class="col-sm-8 col-sm-push-2 video wow bounceInRight">
                        <iframe width="100%" height="450" src="https://www.youtube.com/embed/ccfpq23HR9g" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>





@stop