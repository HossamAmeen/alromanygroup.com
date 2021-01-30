@extends('admin._masters.main')

@section('footer')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            $('#prefs').addClass('active');
        });

    </script>

   {{-- <script>
        $(document).ready(function (){
            $('#prefsForm').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh',
                },
                fields:{
                    title:{
                        validators:{
                            stringLength:{
                                min:5,
                                message:'ادخل اكتر من خمسة حروف'
                            },
                            notEmpty:{
                                message:'ادخل اسم الموقع'
                            }
                        }
                    },
                    slogan:{
                        validators:{
                            stringLength:{
                                min:5,
                                message:'ادخل اكتر من خمسة حروف'
                            },
                            notEmpty:{
                                message:'ادخل وصف الموقع'
                            }
                        }
                    },
                    manager_talk:{
                            stringLength:{
                                max:500,
                                message:'لقد تجاوزت الحد الاقصى للكتابة'
                            },
                            notEmpty:{
                                message:'ادخل كلمة المدير'
                            }
                        }
                    },
                    address1:{
                        validators:{
                            stringLength:{
                                min:10,
                                message:'ادخل اكتر من (10) حروف'
                            },
                            notEmpty:{
                                message:'ادخل عنوان أسيوط'
                            }
                        }
                    },
                    address2:{
                        validators:{
                            stringLength:{
                                min:10,
                                message:'ادخل اكتر من (10) حروف'
                            },
                            notEmpty:{
                                message:'ادخل عنوان القاهرة'
                            }
                        }
                    },
                    coordinators1:{
                        validators:{
                            regexp: {
                                regexp: /^[ A-Za-z0-9.,]*$/,
                                message: 'الابعاد خاطئة , مثال(30.46468,50.144)'
                            },
                            notEmpty:{
                                message:'ادخل موقع فرع اسيوط على خرائط جوجل'
                            }
                        }
                    },
                    coordinators2:{
                        validators:{
                            regexp: {
                                regexp: /^[ A-Za-z0-9.,]*$/,
                                message: 'الابعاد خاطئة , مثال(30.46468,50.144)'
                            },
                            notEmpty:{
                                message:'ادخل موقع فرع القاهرة على خرائط جوجل'
                            }
                        }
                    },
                    tel:{
                        validators:{
                            regexp: {
                                regexp: /^[0-9-]*$/,
                                message: 'ادخل الارقام بشكل صحيح'
                            },
                            notEmpty:{
                                message:'ادخل رقم التليفون'
                            }
                        }
                    },
                    whatsapp:{
                        validators:{
                            stringLength:{
                                max:12,
                                message:'الرقم لا يتجاوز 12'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'الواتس/الفايبر يجب ان تكون ارقام فقط'
                            },
                            notEmpty:{
                                message:'ادخل رقم الواتس/الفايبر'
                            }
                        }
                    },

                    facebook:{
                        validators:{
                            notEmpty:{
                                message:'ادخل رابط الفيس بوك'
                            },
                            uri: {
                                message: 'رابط غير صحيح مثال ( https://www.example.com)'

                            }

                        }
                    },

                    email:{
                        validators:{

                            notEmpty:{
                                message:'ادخل الايميل'
                            },
                            emailAddress:{
                                message:'ادخل بريد الكتروني صحيح'
                            }
                        }
                    }




                }

            });


        });
    </script>--}}

@stop


@section('content')
    <div class="row home-row-top">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$pageTitle}}</h3>
                </div>

                <div class="panel-body">

                    {!! Form::model($mPrefs, array('id'=>'prefsForm','enctype' => "multipart/form-data" )) !!}

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel-body">


                        <div class="form-group col-md-6">
                            <label for="title">اسم الموقع</label>
                            {!! Form::text($name = 'title', null, $attributes = array(
                                'id'=>'title',
                                'class'=>'form-control',
                                'placeholder'=>'اسم الموقع',
                                'required'=>'required',
                                'max-length'=>'99'

                            )) !!}
                        </div>

                        <div class="form-group col-md-6">
                            <label for="slogan">شعار / وصف الموقع</label>
                            {!! Form::text($name = 'slogan', null, $attributes = array(
                                'id'=>'slogan',
                                'class'=>'form-control',
                                'placeholder'=>'شعار / وصف الموقع',
                                'max-length'=>'99'
                            )) !!}
                        </div>


                        <div class="form-group col-md-6">
                            <label for="tel">رقم التليفون </label>
                            {!! Form::tel($name = 'tel', null, $attributes = array(
                                'id'=>'tel',
                                'class'=>'form-control',
                                'placeholder'=>'رقم التليفون',
                                'max-length'=>'25'
                            )) !!}
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">الايميل </label>
                            {!! Form::email($name = 'email', null, $attributes = array(
                                'id'=>'email',
                                'class'=>'form-control',
                                'placeholder'=>'الايميل',
                                'max-length'=>'25'

                            )) !!}
                        </div>


                        <div class="form-group col-md-6">
                            <label for="address1">العنوان </label>
                            {!! Form::text($name = 'address', null, $attributes = array(
                                'id'=>'address',
                                'class'=>'form-control',
                                'placeholder'=>'العنوان',
                                'max-length'=>'99'
                            )) !!}
                        </div>



                        <div class="form-group col-md-6">
                            <label for="facebook">رابط الفيس بوك </label>
                            {!! Form::url($name = 'facebook', null, $attributes = array(
                                'id'=>'facebook',
                                'class'=>'form-control',
                                'placeholder'=>'رابط الفيس بوك',
                                'max-length'=>'99'


                            )) !!}
                        </div>

                            <div class="form-group col-md-6">
                            <label for="instagram">رابط الانستجرام</label>
                            {!! Form::url($name = 'instagram', null, $attributes = array(
                                'id'=>'instagram',
                                'class'=>'form-control',
                                'placeholder'=>'رابط الانستجرام',
                                'max-length'=>'99'


                            )) !!}
                        </div>
                            <div class="form-group col-md-6">
                            <label for="facebook">رابط  يوتيوب </label>
                            {!! Form::url($name = 'youtube', null, $attributes = array(
                                'id'=>'youtube',
                                'class'=>'form-control',
                                'placeholder'=>'رابط يوتيوب',
                                'max-length'=>'99'


                            )) !!}
                        </div>
{{--
                        <div class="form-group col-md-6">
                            <label for="whatsapp">رقم فيبر و الواتس</label>
                            {!! Form::tel($name = 'whatsapp', null, $attributes = array(
                                'id'=>'whatsapp',
                                'class'=>'form-control',
                                'placeholder'=>'رقم فيبر و الواتس',
                                'max-length'=>'15'

                            )) !!}
                        </div>--}}

                  {{--      <div class="form-group col-md-12">
                            <label for="manager_talk">كلمة المدير</label>
                            {!! Form::textarea($name = 'manager_talk', null, $attributes = array(
                                'id'=>'manager_talk',
                                'class'=>'form-control',
                                'placeholder'=>'كلمة المدير',
                                'max-length'=>'2048'



                            )) !!}
                        </div>--}}




                        <input id="owner-form-button" type="submit" class="col-md-offset-3 col-md-6 btn btn-info" onclick="ownerFormCallBack()" value="حفظ البيانات">
                        {!!Form::close()!!}

                    </div> <!-- end panel body -->
                </div> <!-- /. end panel default -->

            </div> <!-- /. end row -->
        </div><!-- end row home-row-top-->
@stop