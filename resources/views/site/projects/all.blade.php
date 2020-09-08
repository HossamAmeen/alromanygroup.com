@extends('site._masters.main')
@section('header')
    <meta property="og:image" content="{{URL::asset('resources/assets/site/images/fav.png')}}"/>
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
                <li><a href="{{url('projects')}}"> مشروعات معروضة </a></li>
            </ul>
        </div>
    </section>


    <section id="bodys">
        <div class="container">
            <div class="col-sm-12 services text-center">

                <ul class="timeline">

                    <!-- item -->
                    @foreach($years as $index=>$year)
                    <li class="year wow bounceInDown"> {{$year->year}}</li>


                        @foreach($projects as $index=>$project)
                            <?php
                            $items = Array('bounceInRight','bounceInLeft');
                            ?>

                    @if($year->year == date('Y', strtotime($project->deliver)))
                    <li class="event wow {!! $items[array_rand($items)] !!}">
                        <div class="item post col-sm-12 wow fadeInLeft">
                            <figure class="main">
                                <a href="{{url('projects/single/'.$project->id)}}">
                                    <img src="{{URL::asset($project->img)}}" class="center-block" alt=""/>
                                    <div class="box text-right">
                                        <h3 class="col-sm-12 ">{{$project->title}} <span></span></h3>
                                        <h5 class="col-sm-12"><i class="fa fa-file"></i> الوصف <span>{{$project->small_description}}</span></h5>
                                        <h5 class="col-sm-12"><i class="fa fa-bars"></i> الطوابق <span>{{$project->levels}} </span></h5>
                                        <h5 class="col-sm-12">
                                            <i class="fa fa-bank"></i> التشطيب
                                            <span class="scale"><i class="fa fa-minus-circle"></i> {{$project->finishing_type}}</span>
                                        </h5>
                                        <h5 class="col-sm-12"><i class="fa fa-building"></i> مساحات <span>{{$project->sizes}} متر</span></h5>
                                        <div class="progress1 progress-striped col-sm-12" style="padding: 0;">
                                            <div class="progress-bar progress-bar-danger active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                                <span>%{{$project->progress_percentage}} مكتمل</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </figure>
                        </div>
                    </li>
                    @endif

                    <!-- //item -->
                    @endforeach
                @endforeach



                 </ul>
            </div>
        </div>
    </section>


@stop