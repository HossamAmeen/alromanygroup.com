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

        <link rel="stylesheet" href="{{URL::asset('resources/assets/admin/css/froala_editor.min.css')}}"/>
        <link rel="stylesheet" href="{{URL::asset('resources/assets/admin/css/froala_style.min.css')}}"/>

@endsection



@section('footer')

    <script type="text/javascript"
            src="{{URL::asset('resources/assets/admin/js/editor/froala_editor.min.js')}}"></script>

    <script src="{{URL::asset('resources/assets/admin/js/editor/froala_editor_ie8.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            $('#content').editable({
                inlineMode: false, direction: 'rtl',
                height: 200
            })
            $('#content').editable({
                inlineMode: false
            })

//            $('.Editor-editor').append($('#ar_description').text());
        });
        //        $('form').submit(function(e){
        //            $('#ar_description').html($('.Editor-editor').html());
        //        });

    </script>

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
        defaultPreviewContent: '<img src="{{URL::asset(\App\Models\NewsModel::DEFAULT_MEDIA_COVER)}}" alt="Your Avatar" style="width:160px">',
        layoutTemplates: {main2: '{preview} ' +   ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });




</script>
    <script>
        $(document).ready(function (){
            $('#newsForm').bootstrapValidator({
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
                                message:'ادخل العنوان'
                            }
                        }
                    },

                   content:{
                        validators:{
                            stringLength:{
                                min:500,
                                message:'ادخل اكتر من (500) حروف'
                            },
                            notEmpty:{
                                message:'ادخل الخبر'
                            }
                        }
                    }/*,
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
                    }*/




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
                @if ( session('addAction') )
                <div class="alert alert-info">
                    <ul>
                        <li> {{ session('addAction') }}</li>
                    </ul>
                </div>
            
                @endif
                <div class="panel-heading">
                    <h3 class="panel-title">صرف مكافأة لـ {{$employee->name}}</h3>
                </div>

                <div class="panel-body">
                    {!! Form::open( array('id'=>'newsForm','url'=>'admin/equivalents?employeeId='.$employee->id,  'enctype'=> 'multipart/form-data'  ))!!}


                   
                    <div class="form-group col-md-6">
                        <label >عدد النقاط</label>
                        <input type="number" name="value" class="form-control" onchange="getRewardValue()" id="rewardValue" required>
                        {{-- {!! Form::number($name = 'value', null, $attributes = array(
                            
                            'class'=>'form-control',
                            'placeholder'=>' قيمة الصرف ',
                            'required'=>'required',
                            'max-length'=>'99',
                            'id' => 'rewardValuee'
                        )) !!} --}}
                        <span>الحد الادني للصرف {{$configration->minimum }}</span><br>
                        <span>نسبة السحب {{$configration->pull_ratio }}%</span><br>
                        <span  > قيمة المكافئة (بالجنية): </span> <span id="rewardActualValue" ></span>
                    </div>
                  
                    <div class="form-group col-md-6">
                        <label >نقاط متاحة للسحب</label>
                        <input class="form-control"


                      value="{{$employee->projects->sum('bill_value') - $employee->disbursedsewards->sum('value')}}"
                        readonly>
                        {{-- {!! Form::number($name = 'value', null, $attributes = array(
                            
                            'class'=>'form-control',
                            'placeholder'=>' قيمة الصرف ',
                            'required'=>'required',
                            'max-length'=>'99'
                        )) !!} --}}
                    </div>
                    {{-- <div class="form-group col-md-6">
                        <label for="content">اختر  فني</label>
                        {!! Form::select($name = 'employee_id', $items , null, $attributes = array(
                                 'id'=>'project_id',
                                 'class'=>' form-control ',
                                 'required'=>'required',
                     )) !!}
                    </div> --}}

                 



                    

                    <input type="submit" class="col-md-offset-3 col-md-6 btn btn-info" value="صرف المكافأة" />

                    {!!Form::close()!!}
                </div> <!-- end panel body -->
            </div> <!-- /. end panel default -->

        </div> <!-- /. end row -->
    </div><!-- end row home-row-top-->

<script>
   function getRewardValue(){
    var rewardValue = document.getElementById("rewardValue").value;
    // Displaying the value
    // alert(inputVal);
    document.getElementById("rewardActualValue").innerHTML = rewardValue * {!!$configration->pull_ratio!!} / 100;
   }
</script>

@stop