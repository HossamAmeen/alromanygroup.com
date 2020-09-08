
@extends('admin._masters.main')


@section('header')

        <!-- some CSS styling changes and overrides -->
<link href="{{URL::asset('resources/assets/admin/plugins/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />



<style>
    .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }
    .kv-avatar .file-input {
        display: table-cell;
        max-width: 220px;
    }
</style>

@endsection



@section('footer')

        <!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
<script src="{{URL::asset('resources/assets/admin/plugins/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('resources/assets/admin/plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>

<!-- bootstrap.js below is only needed if you wish to the feature of viewing details
 of text file preview via modal dialog -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>
<!-- optionally if you need translation for your language then include
    locale file as mentioned below -->
<script src="{{URL::asset('resources/assets/admin/plugins/bootstrap-fileinput/js/fileinput_locale_ar.js')}}" type="text/javascript"></script>

<!-- the fileinput plugin initialization -->
<script>
    $(document).ready(function(){
        $('#news').addClass('active');
    });
    $("#img").fileinput({
        overwriteInitial: true,
        maxFileSize: 3000,
        showCaption: false,
        showPreview: true,
        showRemove: true,
        showUpload: false, // <------ just set this from true to false
        showCancel: true,
        showUploadedThumbs: true,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="{{URL::asset($mProject->img)}}" alt="Your Avatar" style="width:160px">',
        layoutTemplates: {main2: '{preview} ' +   ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });




</script>

        <script>
            $(document).ready(function (){
                $('#projectForm').bootstrapValidator({
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
                                    message:'ادخل اسم المشروع'
                                }
                            }
                        },

                        small_description:{
                            validators:{
                                stringLength:{
                                    min:5,
                                    message:'ادخل اكتر من خمسة حروف'
                                },
                                notEmpty:{
                                    message:'ادخل الوصف المختصر'
                                }
                            }
                        }, description:{
                            validators:{
                                stringLength:{
                                    min:500,
                                    message:'ادخل اكتر من (500) حروف'
                                },
                                notEmpty:{
                                    message:'ادخل وصف المشروع'
                                }
                            }
                        },
                        area:{
                            validators:{
                                stringLength:{
                                    min:5,
                                    message:'ادخل اكتر من خمسة حروف'
                                },
                                notEmpty:{
                                    message:'ادخل المنطقة'
                                }
                            }
                        },
                        address:{
                            validators:{
                                stringLength:{
                                    min:5,
                                    message:'ادخل اكتر من خمسة حروف'
                                },
                                notEmpty:{
                                    message:'ادخل العنوان'
                                }
                            }
                        },
                        finishing_type:{
                            validators:{

                                regexp: {
                                    regexp: /^[\u0600-\u06FF]+$/i,
                                    message: 'ادخل نوع التشطيب بالشكل الصحيح (حروف عربية فقط)'
                                },
                                notEmpty:{
                                    message:'ادخل نوع التشطيب'
                                }
                            }
                        },
                        progress_percentage:{
                            validators:{
                                regexp: {
                                    regexp: /^[0-9]+$/,
                                    message: 'النسبة يجب ان تكون ارقام فقط'
                                },
                                notEmpty:{
                                    message:'ادخل نسبة اكتمال المشروع'
                                }
                            }
                        },
                        levels:{
                            validators:{

                                notEmpty:{
                                    message:'ادخل عدد الادوار'
                                }
                            }
                        },
                        level_flats_no:{
                            validators:{

                                notEmpty:{
                                    message:'ادخل عدد الشقق في كل دور'
                                }
                            }
                        },
                        deliver:{
                            validators:{
                                date:{
                                    message:'اختر التاريخ بالشكل الصحيح (DD/MM/YY)'
                                },
                                notEmpty:{
                                    message:'ادخل عدد الشقق في كل دور'
                                }
                            }
                        },
                        sizes:{
                            validators:{
                                regexp: {
                                    regexp: /^(\d+)\s*-\s*(\d+)$/,
                                    message: 'افصل بين المساحات بالعلامة (-) مثال (95-100)'
                                },
                                notEmpty:{
                                    message:'ادخل المساحات'
                                }
                            }
                        },
                        coordinators:{
                            validators:{
                                regexp: {
                                    regexp: /^[ A-Za-z0-9.,]*$/,
                                    message: 'الابعاد خاطئة , مثال(30.46468,50.144)'
                                },
                                notEmpty:{
                                    message:'ادخل موقع المشروع على خرائط جوجل'
                                }
                            }
                        },
                        img:{
                            validators:{
                                notEmpty:{
                                    message:'اختار صورة للخبر'
                                },
                                file: {
                                    extension: 'jpeg,jpg,png',
                                    type: 'image/jpeg,image/png',
                                    maxSize: 2097152,   // 2048 * 1024
                                    message: 'ملف غير صحيح'
                                }

                            }
                        }




                    }

                });


            });
        </script>


@endsection

@section('content')
<div class="row home-row-top">
    <div class="col-md-12">
    <div class="panel panel-default">
        @include('admin._masters/validation_errors')
        <div class="panel-heading">
            <h3 class="panel-title">{{$pageTitle}}</h3>
        </div>

        	 <div class="panel-body">
        	 {!! Form::model( $mProject ,array('id'=>'projectForm','method' => 'put', 'enctype'=> 'multipart/form-data') )!!}


                 <div class="form-group col-md-4">
                     <label for="title">عنوان العرض </label>
                     {!! Form::text($name = 'title', null, $attributes = array(
                         'id'=>'title',
                         'class'=>'form-control',
                         'placeholder'=>'عنوان العرض ',
                         'required'=>'required',
                         'max-length'=>'99'
                     )) !!}
                 </div>

                 <div class="form-group col-md-4">
                     <label for="title">السعر الاساسي </label>
                     {!! Form::number($name = 'price', null, $attributes = array(
                         'id'=>'price',
                         'class'=>'form-control',
                         'placeholder'=>'السعر الاساسي ',
                         'required'=>'required',
                         'max-length'=>'99'
                     )) !!}
                 </div>

                 <div class="form-group col-md-4">
                     <label for="title">نسبة الخصم </label>
                     {!! Form::number($name = 'discount', null, $attributes = array(
                         'id'=>'discount',
                         'class'=>'form-control',
                         'placeholder'=>'نسبة الخصم ',
                         'required'=>'required',
                         'max-length'=>'99'
                     )) !!}
                 </div>

                 <div class="form-group col-md-12">
                     <label for="description">وصف العرض</label>
                     {!! Form::textarea($name = 'content', null, $attributes = array(
                         'id'=>'content',
                         'class'=>'form-control',
                         'placeholder'=>'وصف العرض',
                         'required'=>'required',
                         'max-length'=>'2048'
                     )) !!}
                 </div>


                 <div class="col-md-6" style="margin-bottom: 1em;" >
                     <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
                     <label>الصورة الرئيسة للعرض</label>
                     <!-- the avatar markup -->
                     <div class="kv-avatar center-block" style="width:200px">
                         <input id="img" name="img" type="file" class="file-loading">
                     </div>
                 </div>


                 <div class="clearfix"></div>

                 <div class="col-xs-12 notes">
                     <p><span class="red">*</span>يمكن الحصول على خطوط الطول و العرض عن طريق خدمة <a target="_blank" href="https://www.google.com.eg/maps/">جوجل ماب</a> </p>
                 </div>


                 <input type="submit" class=" col-md-6 btn btn-info" value="حفظ التعديلات" />
                 <a href="{{URL::to('admin/offers/'.$mProject->id.'/images')}} " class=" col-md-6 btn btn-success">تعديل صور المشروع</a>


                 {!!Form::close()!!}
            </div> <!-- end panel body -->
        </div> <!-- /. end panel default -->

    </div> <!-- /. end row -->
</div><!-- end row home-row-top-->


@stop