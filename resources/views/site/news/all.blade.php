@extends('site._masters.main')
@section('header')
    <meta property="og:image" content="{{URL::asset('resources/assets/site/images/fav.png')}}"/>

@stop
@section('footer')
    <script>
        $(document).ready(function(){
            $('#new').addClass('current');
        });
    </script>
@stop
@section('content')


    <section class="head-tool">
        <div class="container">
            <div class="col-sm-12 text-center">
                <h1 class="col-sm-2  col-sm-push-5 wow fadeInLeft">أحدث الأخبار</h1>
                <p class="col-sm-6  col-sm-push-3 wow fadeInDown">نتيح لكم خدمات التواصل والدعم الفني علي مدار الاربع وعشرين ساعه </p>
            </div>
        </div>
        <div class="sub-head">
            <ul>
                <li><a href=""> الرئيسية </a></li> /
                <li><a href=""> الأخبار </a></li>
            </ul>
        </div>
    </section>


    <section id="bodys">
        <div class="container">
            <div class="col-sm-12 information">
                <!-- left side -->
                <div class="col-sm-3 left-side">

                    <div class="col-sm-12 facebook">
                        <h1><i class="fa fa-tree"></i> فيس بوك</h1>
                        <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1662110714071839";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-page"
                             data-tabs="timeline,events,messages"
                             data-href="{{\App\Models\PrefsModel::get_facebook_value()}}"
                             data-width="380"
                             data-hide-cover="false"></div>
                    </div>
                    <!-- news -->
                    <div class=" most-common col-sm-12">
                        <h1><i class="fa fa-tree"></i> أحدث الأخبار</h1>
                        <i class="fa fa-arrow-up" id="nt-example1-next"></i>
                        <i class="fa fa-arrow-down" id="nt-example1-prev"></i>
                        <ul id="nt-example1">
                            @foreach($lastNews as $last)

                            <li>
                                <a href="{{url::to('/news/'.$last->id)}}">{{$last->title}}</a>
                                <h3><i class="fa fa-clock-o"></i> {{\App\Helpers\DateHelper::print_ar_elapsed_time($last->created_at)}}</h3>
                                <a href=""><img src="{{URL::asset($last->thumbnail)}}" alt=""></a>
                            </li>

                                @endforeach


                        </ul>
                    </div>
                    <!-- //news -->
                    <!-- projects -->
                    <div class="col-sm-12 most-common">
                        <h1><i class="fa fa-tree"></i> أحدث المشروعات</h1>
                        <i class="fa fa-arrow-up" id="nt-example2-next"></i>
                        <i class="fa fa-arrow-down" id="nt-example2-prev"></i>
                        <ul id="nt-example2">


                            @foreach($mProject as $project)
                            <li>
                                <h4>{{$project->small_description}}</h4>
                                <a href="{{url('offers'.$project->id)}}">
                                    <img src="{{URL::asset($project->img)}}" style="height:120px">
                                </a>
                            </li>
                            @endforeach


                        </ul>
                    </div>
                    <!-- //projects -->

                </div>
                <!-- //left side -->


                <!-- right side -->
                <div class="col-sm-9 sing-news ">


                    @foreach($news as $row)
                    <!-- item -->
                    <div class="col-sm-12 single-pos text-right">
                        <div class="col-sm-4">
                            <a href="{{URL::to('news/' . $row->id)}}"><img src="{{URL::asset($row->thumbnail)}}"></a>
                        </div>
                        <div class="col-sm-8">
                            <a href="{{URL::to('news/' . $row->id)}}">  <h1>{{$row->title}}</h1></a>
                            <h6><i class="fa fa-clock-o"></i> {{\App\Helpers\DateHelper::print_ar_elapsed_time($row->created_at)}}</h6>
                            <p>{!! substr($row->content, 0, 400) !!} </p>
                            <div class="single11">
                                <a href="{{URL::to('news/' . $row->id)}}"><i class="fa fa-eye"></i> تفاصيل الخبر</a>
                            </div>
                        </div>
                    </div>
                    <!-- //item -->
                    @endforeach


                    <div class="col-sm-12 text-center">
                        <ul class="pagination pagination-lg">
                           {{$news->links()}}
                        </ul>
                    </div>
                </div>
                <!-- //right side -->

            </div>
        </div>
    </section>

@stop