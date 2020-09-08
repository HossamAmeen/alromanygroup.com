@extends('site._masters.main')

@section('header')
    <meta property="og:image" content="{{URL::asset('resources/assets/site/images/fav.png')}}"/>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];
            a.async=1;
            a.src=g;
            m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-64624560-1', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- head script -->
    <script   src="https://code.jquery.com/jquery-2.2.2.min.js"   integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="   crossorigin="anonymous"></script>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
@stop


@section('footer')
    <script>
    $(document).ready(function(){
        $('#home').addClass('current');
    });
</script>

    <script>
        var send = true;
        $('#contactForm').submit(function(e){

            if(send){
                send = false;
            }else{
                return;
            }
            e.preventDefault();
//            $('#loading-modal').modal();
            //        console.log('submitted');
            var data = {
                name: $("#name").val(),
                email: $("#email").val(),
                subject: $("#subject").val(),
                msg: $("#msg").val(),
                _token:"{{ csrf_token() }}"
            };
            $('#send-btn').hide();
//            $('#send-btn').prop('opacity','0.5')
            //       console.log(data);
            $.ajax({
                type: "POST",
                url: "{{URL::to('contact')}}",
                data: data,
                success: function(){
                    $('.success-contact').removeClass('hide');
                    $('.success-contact').fadeIn(1000);
                    $('#send-btn').show();
                    //                console.log('done');
                },
                error:function(){
                    $('.error-contact').removeClass('hide');
                    $('.error-contact').fadeIn(1000);
                    $('#loading-modal').modal();
                    $('#send-btn').show();
                    //                console.log('error');
                }
            });
        });
    </script>
    @stop


    @section('content')



        <div class="left dez">
            <a href="">
                <img src="{{url::asset('resources/assets/site/images/left.png')}}">
            </a>
            <div class="col-sm-4 named">
                <!-- facebook page here -->
            </div>
        </div>



        <div class="tp-fullscreen-container revolution" id="home">
            <div class="tp-fullscreen">
                <ul>

                    <li data-transition="fade">
                        <img src="{{url::asset('resources/assets/site/images/slider-bg1.jpg')}}" style="width:100% !important;"  alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
                        <div class="tp-caption large text-center sfl" data-x="center" data-y="283" data-speed="900" data-start="800" data-easing="Sine.easeOut" style="text-shadow:1px 1px 10px #000;color:#fff;font-size:60px;letter-spacing: 1px;">مرحباَ بكم</div>
                        <div class="tp-caption large text-center sfr" data-x="center" data-y="363" data-speed="900" data-start="1500" data-easing="Sine.easeOut" style="text-shadow:1px 1px 10px #000;color:#fff;font-size:60px;padding-top:30px !important;letter-spacing: 1px;">معرض الروماني للسيراميك والبورسلين</div>
                    </li>
                    <li data-transition="fade">
                        <img src="{{url::asset('resources/assets/site/images/slider-bg2.jpg')}}"  style="width:100% !important;" alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
                        <div class="tp-caption large text-center sfl" data-x="center" data-y="283" data-speed="900" data-start="800" data-easing="Sine.easeOut" style="text-shadow:1px 1px 10px #000;color:#fff;font-size:70px;letter-spacing: 1px;">الروماني جروب</div>
                        <div class="tp-caption large text-center sfr" data-x="center" data-y="363" data-speed="900" data-start="1500" data-easing="Sine.easeOut" style="text-shadow:1px 1px 10px #000;color:#fff;font-size:36px;padding-top:30px !important;">جميع انواع السيراميك والبورسلين باسعار خاصة</div>
                    </li>
                    <li data-transition="fade">
                        <img src="{{url::asset('resources/assets/site/images/slider-bg3.jpg')}}" style="width:100% !important;" alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
                        <div class="tp-caption large text-center sfl" data-x="center" data-y="283" data-speed="900" data-start="800" data-easing="Sine.easeOut" style="text-shadow:1px 1px 10px #000;color:#fff;font-size:70px;letter-spacing: 1px;">العروض الخاصة</div>
                        <div class="tp-caption large text-center sfr" data-x="center" data-y="363" data-speed="900" data-start="1500" data-easing="Sine.easeOut" style="text-shadow:1px 1px 10px #000;color:#fff;font-size:36px;padding-top:30px !important;letter-spacing: 1px;">خصومات تصل الي 60% علي السياميك والبورسلين</div>
                    </li>

                </ul>
                <div class="tp-bannertimer tp-bottom"></div>
            </div>
            <!-- /.tp-fullscreen-container -->
        </div>
        <!-- /.revolution -->


        <!-- about -->
        <section id="about">
            <div class="container">
                <div class="col-sm-12 about text-center">
                    <div class="col-sm-6 about text-right wow bounceInLeft">
                        <h1><i class="fa fa-users"></i> الروماني جروب </h1>
                        <p>إحنا الاصل عشان احنا اول معرض سيراميك وبورسلين فى اسيوط واول معرض يقدم خدماته سنة 1980م, السيراميك والبرورسلين وأطقم المطبخ واطقم الحمام وبلاط الديكور,تعدد التوكيلات المورده للرماني جروب مما يتيح لك حرية الاختيار بين العدد من الماركات العالمية,وتتميز الروماني جروب بالاسعار الخاصة والخصومات التي تصل الي 60% من قيمة المنتج وخصومات الكميات,وايضا اكبر مخازن للسيراميك في أسيوط,أخيراَ تقدر تشرفنا فيمعرضنا أسيوط شارع يسري راغب, الروماني جروب #احنا_الأصل   <br> <span style="font-size: 22px !important;color: #656D70;"> شاهد الفيديو <i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></span></p>
                    </div>
                    <div class="col-sm-6 video wow bounceInRight">
                        <iframe width="100%" height="295" src="https://www.youtube.com/embed/ccfpq23HR9g" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>
        <!-- //about -->

        <section id="products">
            <div class="container" style="width: 92%;">

                <div class="col-sm-12 featured">
                    <h3 class="wow swing text-center">منتجات المعرض </h3>
                    <div class="separator13 wow swing"></div>

                    <div class="col-sm-12 mgnet2">
                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInRight">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ad1.png')}}" class="center-block" alt="">
                                    <p> السيراميك </p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ad2.png')}}" class="center-block" alt="">
                                    <p> البورسلين</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInLeft">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ad3.png')}}" class="center-block" alt="">
                                    <p> أطقم المطبخ</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInRight">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ad4.png')}}" class="center-block" alt="">
                                    <p>بانيوهات</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ad5.png')}}" class="center-block" alt="">
                                    <p> بلاط الديكور</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInLeft">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ad6.png')}}" class="center-block" alt="">
                                    <p>خلاطات</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInDown">
                            <div class="serv1">
                                <a href="#">
                                    <img src="{{url::asset('resources/assets/site/images/ad7.png')}}" class="center-block" alt="">
                                    <p> أحجار زينة</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                        <!-- item -->
                        <div class="col-sm-3 serv text-center wow bounceInRight">
                            <div class="serv1">
                                <a href="#">
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
                                    <p>أطقم الحمامات</p>
                                </a>
                            </div>
                        </div>
                        <!-- item -->

                    </div>

                </div>
            </div>
        </section>


        <section id="location">
            <div class="container">
                <div class="col-sm-12">
                    <h2 class="wow swing">عروض خاصة</h2>
                    <div class="separator1 wow swing"></div>

                    <div class="categ col-sm-12">

                        <div class="cms col-sm-12 left-cs">

                            <div class="owl-carousel carousel-autoplay" style="direction:ltr;margin-right:-12px;">
                            @foreach($offers as $row)

                                <!-- item -->
                                <div class=" wow fadeInLeft">
                                    <div class="box-style-1 gray-bg">
                                        <div class="col-sm-12 fact1 wow fadeInRight">
                                            <div class="prefered">
                                                <a href="{{URL::to('offers/' . $row->id)}}">
                                                    <img src="{{URL::asset($row->img)}}" class="center-block">
                                                    <h4>{{$row->discount}}% خصم</h4>
                                                </a>
                                            </div>
                                            <h3 class="text-center" style="color: #222;">سيراميكا كليوباترا</h3>
                                            <p> {{($row->price)-($row->price)*($row->discount/100)}} جنية <span>{{$row->price}} جنية</span> </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- //item  -->

                                @endforeach

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <!-- news -->
        <!-- news -->
        <section id="news">
            <div class="container" style="width: 90%;">
                <div class="col-sm-12 news text-center">
                    <h2 class="wow swing">توكيلات <span style="font-size: 22px;">تركي - صيني - إيطالي</span> </h2>
                    <div class=" wow swing separator13"></div>
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
                    {{--<div class="col-sm-2 wow bounceInLeft">
                        <div class="ziko">
                            <img src="{{url::asset('resources/assets/site/images/80.png')}}" alt="">
                        </div>
                    </div>--}}
                    <!-- //item -->



                </div>
            </div>
        </section>
        <!-- //projects -->

        <!-- contact -->
        <section id="contact">
            <div class="container">
                <div class="col-sm-12 cont text-center">
                    <h2 class="wow swing">تواصل معنا</h2>
                    <div class="separator1 wow swing"></div>

                    <div class="col-sm-12 speak text-right">

                        <div class="col-sm-4 tx wow bounceInRight">
                            <div class="mz">
                                <h5><i class="fa fa-map-marker"></i> العنوان</h5>
                                <p> {{\App\Models\PrefsModel::get_address_value()}}</p>
                            </div>
                        </div>

                        <div class="col-sm-4 tx wow bounceInDown">
                            <div class="mz">
                                <h5><i class="fa fa-phone"></i> تليفون</h5>
                                <p> {{\App\Models\PrefsModel::get_tel_value()}} </p>
                            </div>
                        </div>

                        <div class="col-sm-4 tx wow bounceInLeft">
                            <div class="mz">
                                <h5><i class="fa fa-envelope"></i> راسلنا</h5>
                                <p>{{\App\Models\PrefsModel::get_email_value()}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 forms">
                        <div class="col-sm-8">
{{--
                            <form action="" method="">
--}}
                            {{Form::open(['id'=>'contact-form'])}}
                            <div class="hide success-contact col-xs-12 alert alert-success">تم إرسال الرسالة بنجاح</div>
                            <div class="hide error-contact col-xs-12 alert alert-danger">هناك خطأ ما، رجاء المحاولة لاحقا</div>

                            <div class="col-sm-6 wow bounceInDown">
                                    <input type="text" name="name" id="name" placeholder="الإسم*" required="required">
                                </div>
                                <div class="col-sm-6 wow bounceInLeft">
                                    <input type="email" name="email" id="email" placeholder="البريد الأليكترونى*" required="required">
                                </div>
                                <div class="col-sm-12 wow bounceInRight">
                                    <input type="text" name="subject" id="subject" placeholder="عنوان الرسالة*" required="required">
                                </div>
                                <div class="col-sm-12 wow bounceInLeft">
                                    <textarea name="msg" id="msg" placeholder="الرسالة*" required="required"></textarea>
                                </div>
                                <div class="col-sm-12 wow bounceInDown">
                                    <input type="submit" value="إرسل">
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-4 map">
{{--
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3452.988353369441!2d31.210598585517083!3d30.065868324516483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584119770584d1%3A0x301b5dd863eb0ca3!2z2KXYqNmGINiu2YTYr9mI2YbYjCDZhdiv2YrZhtipINin2YTYo9i52YTYp9mF2Iwg2KfZhNi52KzZiNiy2KnYjCDYp9mE2KzZitiy2Kk!5e0!3m2!1sar!2seg!4v1472759359383" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
--}}
                            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3549.103025010849!2d31.180985477446985!3d27.184498561153266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z2KfZhNix2YjZhdin2YbZiiDZhNmE2LPZitix2KfZhdmK2YMg2YjYp9mE2KjZiNix2LPZhNmK2YYg!5e0!3m2!1sen!2seg!4v1516277528899" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- //contact -->




    @stop