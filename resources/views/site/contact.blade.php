@extends('site._masters.main')
@section('header')
    <meta property="og:image" content="{{URL::asset('resources/assets/site/images/fav.png')}}"/>
@stop
@section('footer')
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

    <script>
        $(document).ready(function(){
            $('#cont').addClass('current');
        });
    </script>

@stop

@section('content')


    <section class="head-tool">
        <div class="container">
            <div class="col-sm-12 text-center">
                <h1 class="col-sm-2 col-sm-push-5 wow fadeInLeft">تواصل معنا</h1>
                <p class="col-sm-6 col-sm-push-3 wow fadeInDown">نتيح لكم خدمات التواصل والدعم الفني علي مدار الاربع وعشرين ساعه</p>
            </div>
        </div>
        <div class="sub-head">
            <ul>
                <li><a href="{{url('/')}}"> الرئيسية </a></li> /
                <li><a href="{{url('contact')}}"> تواصل معنا </a></li>
            </ul>
        </div>
    </section>



    <section id="bodys">
        <div class="container">
            <div class="col-sm-12 cont text-center">
                <div class="col-sm-12 cont text-center">
                    <div class="col-sm-12 speak text-right">

                        <div class="col-sm-4 tx wow bounceInRight">
                            <div class="mz">
                                <h5><i class="fa fa-map-marker"></i> العنوان</h5>
                                <p>{{\App\Models\PrefsModel::get_address_value()}}</p>
                            </div>
                        </div>

                        <div class="col-sm-4 tx wow bounceInDown">
                            <div class="mz">
                                <h5><i class="fa fa-phone"></i> تليفون</h5>
                                <p> مصر:  {{\App\Models\PrefsModel::get_tel_value()}} </p>
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
                            {{Form::open(['id'=>'contact-form'])}}

                            <div class="hide success-contact col-xs-12 alert alert-success">تم إرسال الرسالة بنجاح</div>
                            <div class="hide error-contact col-xs-12 alert alert-danger">هناك خطأ ما، رجاء المحاولة لاحقا</div>

                           {{-- {{Form::open(array('url'=>'contact', 'id'=>'contactForm'))}}
                            @include('admin._masters.validation_errors')--}}
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
                                    <input id="send-btn" type="submit" value="إرسل">
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-4 map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3452.988353369441!2d31.210598585517083!3d30.065868324516483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584119770584d1%3A0x301b5dd863eb0ca3!2z2KXYqNmGINiu2YTYr9mI2YbYjCDZhdiv2YrZhtipINin2YTYo9i52YTYp9mF2Iwg2KfZhNi52KzZiNiy2KnYjCDYp9mE2KzZitiy2Kk!5e0!3m2!1sar!2seg!4v1472759359383" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



@stop