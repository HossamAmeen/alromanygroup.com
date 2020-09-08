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
                <h1 class="col-sm-2  col-sm-push-5 wow fadeInLeft">أسئلة واجابات</h1>
                <p class="col-sm-6  col-sm-push-3 wow fadeInDown">نتيح لكم خدمات التواصل والدعم الفني علي مدار الاربع وعشرين ساعه </p>
            </div>
        </div>
        <div class="sub-head">
            <ul>
                <li><a href=""> الرئيسية </a></li> /
                <li><a href=""> أسئلة واجابات </a></li>
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
                                    <a href="{{url('project/single/'.$project->id)}}">
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
                <div class="col-sm-9 sing-news " style="background: #f9f9f9;">

                    <div class="col-sm-12 xtract">

                        <div class="col-sm-12 text-right padd">
                            <a href="" data-toggle="modal" data-target="#exampleModal">هل لديك سؤال ؟!</a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog dd" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">إسأل مكتب الديار الهندسي</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            {!! Form::open(array('id'=>'contact-form')) !!}

                                            <div class="message-field" style="width: 92%;">
                                                <textarea name="question" placeholder="ضع سؤالك هنا"></textarea>
                                            </div>

                                            <div class="text-right col-md-12 zz"><button type="submit">إسأل !</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="inv">إذا كان لديك أي استفسار يرجى قراءة هذه المجموعة من الأسئلة المتداولة قبل الاتصال بنا. إذا كنت لا تزال غير واضحة عن شيء لا تتردد في الاتصال بنا.</p>
                        @foreach($mQuestions as $mQuestion)
                            <div class="dude wow fadeInRight">
                                <h4>{{$mQuestion->question}}</h4>
                                <div>
                                    <img src="{{\App\Models\UserModel::MALE_LOGO}}" >
                                    <p><span style="color: #000;">{{--{{$mQuestion->name}}--}}</span> {{\App\Helpers\DateHelper::print_ar_elapsed_time($mQuestion->created_at)}}</p>
                                    <h5>{!! $mQuestion->answer !!}</h5>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="col-sm-12 text-center">
                        <ul class="pagination pagination-lg">
                            {{$mQuestions->links()}}
                        </ul>
                    </div>
                </div>
                <!-- //right side -->

            </div>
        </div>
    </section>

@stop