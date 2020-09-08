@extends('site._masters.main')
@section('header')
    <meta property="og:image" content="{{URL::asset($mProject->img)}}"/>
@stop
@section('footer')
    <script>
        $(document).ready(function(){
            $('#proj').addClass('current');
        });
    </script>
@stop
@section('content')
    <section class="head-tool">
        <div class="container">
            <div class="col-sm-12 text-center">
                <h1 class="col-sm-2  col-sm-push-5 wow fadeInLeft">مشروعات</h1>
                <p class="col-sm-6  col-sm-push-3 wow fadeInDown">نتيح لكم خدمات التواصل والدعم الفني علي مدار الاربع وعشرين ساعه </p>
            </div>
        </div>
        <div class="sub-head">
            <ul>
                <li><a href="{{url('/')}}"> الرئيسية </a></li> /
                <li><a href="{{url('projects')}}"> مشروعات </a></li>
            </ul>
        </div>
    </section>

    <section id="first">
        <div class="container">
            <div class="col-sm-12 services text-center">
                <div class="project-info">
                    <h4><i class="fa fa-building"></i> {{$mProject->title}}</h4>
                    <h6>{{$mProject->progress_percentage}}%</h6>
                    <a href="{{url('projects')}}"> مشروعات أخري <i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></a>

                    <div class="checkout-wrap" >
                        <ul class="checkout-bar">

                            @if($mProject->progress_phase == 4)
                                <li class="active">أعمال الحفر</li>
                                <li class="active">الأساسات</li>
                                <li class="active">البناء</li>
                                <li class="active">التشطيبات</li>
                            @endif
                                @if($mProject->progress_phase == 3)
                                    <li class="active">أعمال الحفر</li>
                                    <li class="active">الأساسات</li>
                                    <li class="active">البناء</li>
                                    <li>التشطيبات</li>
                                @endif
                                @if($mProject->progress_phase == 2)
                                    <li class="active" >أعمال الحفر</li>
                                    <li class="active">الأساسات</li>
                                    <li>البناء</li>
                                    <li>التشطيبات</li>


                                @endif
                                @if($mProject->progress_phase == 1)
                                    <li class="active">أعمال الحفر</li>
                                    <li>الأساسات</li>
                                    <li>البناء</li>
                                    <li>التشطيبات</li>
                                @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>



    <section id="second">
        <div class="container">
            <h2 class="text-center wow swing">بيانات المشروع</h2>
            <div class="separator14 wow swing"></div>
            <div class="col-sm-12" style="padding: 0;">
                <div class="col-sm-12" style="padding: 0;">



                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="col-sm- 12 item active">
                                @foreach($images as $index=>$image)
                                <div class="col-sm-3 image-box mix mix_all living-room kitchen garage">
                                    <div class="inner-box">
                                        <figure class="image"><a href="{{URL::asset($image->img)}}" class="lightbox-image"><img src="{{URL::asset($image->img)}}" alt=""></a></figure>
                                        <a href="{{URL::asset($image->img)}}" class="zoom-btn lightbox-image"></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <i class="fa fa-chevron-circle-left"></i>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <i class="fa fa-chevron-circle-right"></i>
                            </a>
                        </div>
                    </div>


                    <div class="col-sm-12 text-right" style="padding: 0">

                        <div class="col-sm-5 disc-table">
                            <table>
                                <tr>
                                    <td class="phy"><i class="fa fa-map-marker"></i> المنطقة</td>
                                    <td>{{$mProject->area}}</td>
                                </tr>
                                <tr>
                                    <td class="phy"><i class="fa fa-street-view"></i> العنوان</td>
                                    <td>{{$mProject->address}}</td>
                                </tr>
                                <tr>
                                    <td class="phy"><i class="fa fa-building"></i> الوصف</td>
                                    <td>{{$mProject->small_description}}</td>
                                </tr>
                                <tr>
                                    <td class="phy"><i class="fa fa-cloud"></i> التشطيبات</td>
                                    <td><i class="fa fa-minus-circle"></i>{{$mProject->finishing_type}}</td>
                                </tr>
                                <tr>
                                    <td class="phy"><i class="fa fa-bars"></i> الطوابق</td>
                                    <td>{{$mProject->levels}} طابق</td>
                                </tr>
                                <tr>
                                    <td class="phy"><i class="fa fa-arrows-h"></i> المساحات</td>
                                    <td>{{$mProject->sizes}} متر مربع</td>
                                </tr>
                              {{--  <tr>
                                    <td class="phy"><i class="fa fa-money"></i> طرق الدفع</td>
                                    <td>كاش - تقسيط</td>
                                </tr>--}}
                            </table>
                        </div>

                        <div class="col-sm-7 discreption1">
                            <h1>وصف المشروع</h1>
                            <p>{{$mProject->description}} </p>

                            {{--<div class="col-sm-8 col-sm-push-2 prices">
                                <h2 class="red3"><i class="fa fa-money"></i> كاش: <span>1,700,000</span>  جنيه</h2>
                                <h2 class="green3"><i class="fa fa-money"></i> تقسيط: <span>10,000</span> جنيه</h2>
                            </div>--}}
                        </div>

                    </div>
                </div>
    </section>

    <section id="third">
        <div class="container">
            <div class="col-sm-12 building">
                <h2 class="text-center wow swing">عرض الوحدات</h2>
                <div class="separator1 wow swing"></div>

                <div class="green1 col-sm-1">خالي</div>
                <div class="red1 col-sm-1">محجوز</div>
                <div class="contain">

                    @foreach(range(1, $mProject->levels) as $i  )
                    <div class="col-sm-1">
                        <h5>الدور {{$totalFlats / $mProject->level_flats_no - $i + 1 }}  </h5>
                        @foreach(range(1, $mProject->level_flats_no) as $j  )
                        <h4 <?=(in_array($totalFlats-$i*$mProject->level_flats_no+$j, $books)?'class="red"':'class="green"')?>>شقة {{$totalFlats - $i*$mProject->level_flats_no +$j}}</h4>
                        @endforeach
                    </div>
                    @endforeach


                </div>
            </div>

            <div class="col-sm-12 faceshare text-center">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{\Illuminate\Support\Facades\Request::url()}}"><i class="fa fa-facebook"></i> مشاركة فيس بوك</a>
                <a href="http://twitter.com/home?status={{\Illuminate\Support\Facades\Request::url()}}" class="twitt"><i class="fa fa-twitter"></i> مشاركة تويتر</a>
            </div>
        </div>
    </section>





    <section id="maps">
{{--
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28394.71442482999!2d31.201927704568856!3d27.177070640785377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14450be607cb7bcd%3A0xba699162bfc01112!2z2KPYs9mK2YjYt9iMINin2YTYrdmF2LHYp9ihINin2YTYq9in2YbZitip2Iwg2YXYsdmD2LIg2KfZhNmB2KrYrdiMINij2LPZitmI2Lc!5e0!3m2!1sar!2seg!4v1495020132080" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
--}}

        <div  id="googleMap" style="height:450px;border-radius:2px; margin-top:30px;margin-bottom:60px;">
            <script>
                function initialize() {
                    var mapProp = {
                        center:new google.maps.LatLng({{$mProject->coordinators}}), //خطوط الطول والعرض
                        zoom:14,
                        mapTypeId:google.maps.MapTypeId.ROADMAP
                    };
                    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>


            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
            <script type='text/javascript'>
                function init_map()
                {
                    var myOptions = {zoom:10,center:new google.maps.LatLng({{$mProject->coordinators}}),
                        mapTypeId: google.maps.MapTypeId.ROADMAP};
                        map = new google.maps.Map(document.getElementById('googleMap'), myOptions);
                    marker = new google.maps.Marker({map: map,position: new google.maps.LatLng({{$mProject->coordinators}})});
                    infowindow = new google.maps.InfoWindow({content:''});
                    google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);
                    });
                    infowindow.open(map,marker);
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);
            </script>

        </div>
    </section>
    <!-- news -->
    <section id="news">
        <div class="container">
            <div class="col-sm-12 news text-center">
                <h2 class="wow swing">أخبار متعلقة</h2>
                <div class="separator1"></div>

                <div class="carousel-wrapper" style="direction:ltr;">
                    <div class="carousel caro carousel-boxed blog" style="direction:ltr;">

                        @foreach($mNews as $news)
                        <!-- item -->
                        <div class="col-sm-12 cb grid-view-post wow fadeInLeft">
                            <div class="item post">
                                <figure class="main xmen">
                                    <a href="{{url('news/'.$news->id)}}" ><img src="{{URL::asset($news->thumbnail)}}" alt="" /></a>
                                </figure>
                                <div class="box bx1 text-center">
                                    <h4 class="post-title grap"><a href="">{{$news->small_description}} </a></h4>
                                    <div class="meta">
                                        <span class="date"><i class="fa fa-clock-o"></i> {{\App\Helpers\DateHelper::print_ar_elapsed_time($news->created_at)}} </span>
                                    </div>
                                    <p class="spam text-right">{{str_limit($news->content,100)}}</p>
                                    <a href="{{url('news/'.$news->id)}}" class="details"> التفاصيل <i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /item -->
                            @endforeach

                    </div>
                    <!--/.carousel -->
                </div>
                <!--/.carousel-wrapper -->

                <div class="col-sm-12 moree">
                    <a href="http://elmasria.co/news">المزيد من الأخبار !</a>
                </div>

            </div>
        </div>
    </section>
    <!-- //news -->

    <section id="location">
        <div class="container" style="width: 95%;">
            <div class="col-sm-12">
                <h2>شاهد الفيديو</h2>
                <div class="separator14"></div>
                <div class="col-sm-8 col-sm-push-2">
                    <iframe width="100%" height="450" src="https://www.youtube.com/embed/mo50fhqipIo?list=PLtmw4f2VMG3A5-a-K2rUazIq-IdNOSpEM" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="third">
        <div class="container">

            <div class="col-sm-12 xmap projects text-center" style="padding-top: 30px;">
                <h2 class="wow swing">عقارات مشابهة</h2>
                <div class="separator1 wow swing"></div>
                <div class="carousel-wrapper" style="direction: ltr;">
                    <div class="carousel carousel-boxed blog" style="direction: ltr;">
                        <!-- item -->
                        @foreach($lastProjects as $project)
                        <div class="item post col-sm-12 wow fadeInDown">
                            <figure class="main">
                                <a href="{{url('projects/single/'.$project->id)}}">
                                    <img src="{{URL::asset($project->img)}}" alt=""/>
                                    <div class="box text-right">
                                        <h3 class="col-sm-12 ">{{$project->title}} <span></span></h3>
                                        <h5 class="col-sm-12"><i class="fa fa-file"></i> الوصف <span>{{$project->small_description}}</span></h5>
                                        <h5 class="col-sm-12"><i class="fa fa-bars"></i> الطوابق <span>{{$project->levels}} طابق </span></h5>
                                        <h5 class="col-sm-12">
                                            <i class="fa fa-bank"></i> التشطيب
                                            <span class="scale"><i class="fa fa-minus-circle"></i> {{$project->finishing_type}}</span>
                                        </h5>
                                        <h5 class="col-sm-12"><i class="fa fa-building"></i> مساحات <span>{{$project->sizes}} متر</span></h5>
                                        <div class="progress1 progress-striped col-sm-12" style="padding: 0;">
                                            <div class="progress-bar progress-bar-danger active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                                <span>%{{$project->progress_percentage}} مكتمل</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </figure>
                        </div>
                        <!-- /item -->
                        @endforeach


                    </div>
                </div>
            </div>

        </div>
    </section>


    <section id="compose">
        <div class="container">
            <div class="col-sm-12">
                <h5 class="wow swing">لماذا زهرة المدائن ؟</h5>
                <div class="separator14 wow swing" style="margin-bottom: 50px;"></div>
                <div class="col-sm-4 crus fadeInLeft wow">
                    <div class="box-style-2">
                        <div class="icon-container default-bg">
                            <i class="fa fa-leaf"></i>
                        </div>
                        <div class="body">
                            <h2>الإبداع</h2>
                            <p>الإبداع ليس وسيلة بل غاية تتم بتكامل الخبرات.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 crus fadeInDown wow">
                    <div class="box-style-2">
                        <div class="icon-container default-bg">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <div class="body">
                            <h2>الخبرة</h2>
                            <p>خبرة نتيجة سنوات عمل حقيقية.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 crus fadeInRight wow">
                    <div class="box-style-2">
                        <div class="icon-container default-bg">
                            <i class="fa fa-fighter-jet "></i>
                        </div>
                        <div class="body">
                            <h2>السرعة</h2>
                            <p> لأن الوقت يساوي المال فسرعة الإنجاز تساوي لك الكثير.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 crus fadeInLeft wow">
                    <div class="box-style-2">
                        <div class="icon-container default-bg">
                            <i class="fa fa-hand-peace-o"></i>
                        </div>
                        <div class="body">
                            <h2>التنوع</h2>
                            <p>تنوع الخدمات جعل لدينا القدرة على تقديم عمل متكامل.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 crus fadeInDown wow">
                    <div class="box-style-2">
                        <div class="icon-container default-bg">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="body">
                            <h2>الإدارة</h2>
                            <p>أسلوب إدارة أساسه التواصل بين العميل والفريق فنحقق ما يفوق التوقعات.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 crus fadeInRight wow">
                    <div class="box-style-2">
                        <div class="icon-container default-bg">
                            <i class="fa fa-crosshairs"></i>
                        </div>
                        <div class="body">
                            <h2>الدقة</h2>
                            <p>الدقه هدفنا الذى نسعى اليه وإرضاء العميل هو الغاية.</p>
                        </div>
                    </div>
                </div>

            </div>
    </section>
    <section id="contact">
        <div class="container">
            <div class="col-sm-12 cont text-center">
                <h2 class="wow swing">تواصل معنا</h2>
                <div class="separator1 wow swing"></div>
                <div class="col-sm-12 forms">
                    <div class="col-sm-8">
                        <div class="hide success-contact col-xs-12 alert alert-success">تم إرسال الرسالة بنجاح</div>
                        <div class="hide error-contact col-xs-12 alert alert-danger">هناك خطأ ما، رجاء المحاولة لاحقا</div>

                        {{Form::open(array('url'=>'contact', 'id'=>'contact-form'))}}
                        @include('admin._masters.validation_errors')
                        <div class="col-sm-6 wow fadeInDown">
                            <input type="text" name="title" id="title" placeholder="الاسم" required="required">
                        </div>
                        <div class="col-sm-6 wow fadeInLeft">
                            <input type="email" name="email" id="email" placeholder="البريد الالكتروني" required="required">
                        </div>
                        <div class="col-sm-12 wow fadeInRight">
                            <input type="text" name="subject" id="subject" placeholder="عنوان الرسالة" required="required">
                        </div>
                        <div class="col-sm-12 wow fadeInLeft">
                            <textarea name="msg" id="msg" placeholder="الرسالة*" required="required"></textarea>
                        </div>
                        <div class="col-sm-12 wow fadeInDown">
                            <input id="send-btn" type="submit" value="ارسل">
                        </div>
                        {{Form::close()}}
                    </div>

                    <div class="col-sm-4 inf text-center wow fadeInLeft">
                        <h1>معلومات التواصل</h1>
                        <h4><i class="fa fa-map-marker"></i> العنوان</h4>
                        <p>{{\App\Models\PrefsModel::get_address1_value()}}</p>
                        <p>{{\App\Models\PrefsModel::get_address2_value()}}</p>
                        <h4><i class="fa fa-mobile"></i> موبايل</h4>
                        <p>{{\App\Models\PrefsModel::get_tel_value()}}</p>
                    </div>

                </div>


            </div>
        </div>
    </section>

@stop