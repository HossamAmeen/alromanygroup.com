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


    <section class="head-tool" style="background:url(images/cd8.jpg) center fixed; background-size: cover;">
        <div class="container">
            <div class="col-sm-12 text-center">
                <h1 class="wow fadeInLeft"><i class="fa fa-hospital-o"></i> العروض والخصومات <i class="fa fa-hospital-o"></i></h1>
            </div>
        </div>
        <div class="sub-head">
            <ul>
                <li><a href="{{url::to('/')}}"> الرئيسية </a></li> /
                <li><a href="{{url::to('offers')}}">  العروض والخصومات  </a></li>
            </ul>
        </div>
    </section>


    <section id="bodys">
        <div class="container">
            <div class="col-sm-12 information">

                <!-- left side -->
                <div class="col-sm-3 left-side hidden-xs">

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



                    <!-- projects -->
                    <div class="col-sm-12 most-common">
                        <h1><i class="fa fa-tree"></i> الأكثر مشاهدة</h1>
                        <i class="fa fa-arrow-up" id="nt-example2-next"></i>
                        <i class="fa fa-arrow-down" id="nt-example2-prev"></i>
                        <ul id="nt-example2">
                            @foreach($mOffers as $Offer)
                                <li>
                                    <h4>{{$Offer->title}} </h4>
                                    <a href="{{url::to('/offers/'.$Offer->id)}}">
                                        <img src="{{URL::asset($Offer->img)}}" style="height:220px">
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <!-- //projects -->

                </div>
                <!-- //left side -->



                <!-- right side -->
                <div class="col-sm-9 sing-news cs">

                    <div class="col-md-5 col-xs-12 grid" style="direction:ltr;">
                        <div class="flexslider">
                            <ul class="slides">
                                @foreach($offerImages as $offerImages)
                                <li data-thumb="{{URL::asset($offerImages->img)}}">
                                    <div class="thumb-image"> <img src="{{URL::asset($offerImages->img)}}" data-imagezoom="true" class="img-responsive"> </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7 single-top-in">
                        <div class="single-para simpleCart_shelfItem">
                            <h1 style="margin-bottom:30px;">{{$Offer->title}}</h1>
                            <p style="margin-bottom:30px;">{{$Offer->content}}</p>
                            <div class="star-on rating" style="margin-bottom:10px;">
{{--
                                <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
--}}
                                <div class="review">
                                    <a href="#"> {{$Offer->page_views}} reviews </a>/
                                </div>
                                <div class="clearfix"> </div>
                            </div>

                        </div>
                    </div>

                    <div class="clearfix"> </div>
                    <div class="col-sm-12 another text-right">
                        <h2><i class="fa fa-eye"></i> شاهد أيضأ:</h2>
                        <!-- item -->
                        @foreach($lastOffers as $lastOffer)
                        <div class="col-sm-4 wow fadeInLeft">
                            <div class="box-style-1 gray-bg">
                                <div class="fact1 wow fadeInRight">
                                    <div class="prefered">
                                        <a href="{{url::to('/offers/'.$lastOffer->id)}}">
                                            <img src="{{URL::asset($lastOffer->img)}}" class="center-block">
                                            <h4>20% sale</h4>
                                        </a>
                                    </div>
                                    <h3 class="text-center" style="color: #222;">{{$lastOffer->title}}</h3>
                                    <p> {{($row->price)-($row->price)*($row->discount/100)}} جنية <span>{{$row->price}} جنية</span> </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- //item  -->



                    </div>

                    <!-- //right side -->



                </div>
            </div>
        </div>
    </section>


@stop