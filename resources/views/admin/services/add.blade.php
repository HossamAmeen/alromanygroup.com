@extends('admin._masters.main')


@section('header')

        <!-- Include Editor style. -->
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
        {{--<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.4.1/css/froala_editor.min.css' rel='stylesheet' type='text/css' />--}}
        {{--<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.4.1/css/froala_style.min.css' rel='stylesheet' type='text/css' />--}}
        <link rel="stylesheet" href="{{URL::asset('resources/assets/admin/css/froala_editor.min.css')}}" />
        <link rel="stylesheet" href="{{URL::asset('resources/assets/admin/css/froala_style.min.css')}}" />



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

    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Include JS file. -->
    <script type="text/javascript" src="{{URL::asset('resources/assets/admin/js/editor/froala_editor.min.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="{{URL::asset('resources/assets/admin/js/editor/froala_editor_ie8.min.js')}}"></script>
    <![endif]-->
    <script src="{{URL::asset('resources/assets/admin/js/editor/plugins/tables.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/js/editor/plugins/lists.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/js/editor/plugins/colors.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/js/editor/plugins/media_manager.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/js/editor/plugins/font_family.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/js/editor/plugins/font_size.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/js/editor/plugins/block_styles.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/js/editor/plugins/video.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#ar_description').editable({inlineMode: false, direction: 'rtl'
            })
            $('#en_description').editable({inlineMode: false
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
    <!-- optionally if you need translation for your language then include
        locale file as mentioned below -->
    <script src="{{URL::asset('resources/assets/admin/plugins/bootstrap-fileinput/js/fileinput_locale_ar.js')}}" type="text/javascript"></script>

    <!-- the fileinput plugin initialization -->
    <script>
        $(document).ready(function(){
            $('#services').addClass('active');
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
            defaultPreviewContent: '<img src="{{URL::asset(\App\Models\ServiceModel::DEFAULT_MEDIA_COVER)}}" alt="صورة الخدمة" style="width:160px">',
            layoutTemplates: {main2: '{preview} ' +   ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });

    </script>
@endsection

@section('content')
    <div class="row home-row-top">
        <div class="col-md-12">
            <div class="panel panel-default">

                @include('admin._masters/validation_errors')

                <div class="panel-heading">
                    <h3 class="panel-title">إضافة خدمة جديدة</h3>
                </div>

                <div class="panel-body">
                    {!! Form::open( array('url'=>'admin/service/add',  'enctype'=> 'multipart/form-data'  ))!!}


                    <div class="form-group col-md-6">
                        <label for="ar_title">اسم الخدمة</label>
                        {!! Form::text($name = 'ar_title', null, $attributes = array(
                            'id'=>'ar_title',
                            'class'=>'form-control',
                            'placeholder'=>'اسم الخدمة',
                            'required'=>'required',
                            'max-length'=>'99'
                        )) !!}
                    </div>

                <div style="text-align: left" class="form-group col-md-6">
                        <label for="en_title">Title</label>
                        {!! Form::text($name = 'en_title', null, $attributes = array(
                            'id'=>'en_title',
                            'class'=>'form-control',
                            'placeholder'=>'Title',
                            'required'=>'required',
                            'max-length'=>'99'
                        )) !!}
                    </div>


                    <div class="form-group col-md-12">
                        <label for="ar_description">وصف الخدمة</label>
                        {!! Form::textarea($name = 'ar_description', null, $attributes = array(
                            'id'=>'ar_description',
                            'class'=>'form-control txtEditor ',
                            'placeholder'=>'',

                        )) !!}
                    </div>

                <div style="text-align: left" class="form-group col-md-12">
                        <label for="en_description">Description</label>
                        {!! Form::textarea($name = 'en_description', null, $attributes = array(
                            'id'=>'en_description',
                            'class'=>'form-control txtEditor ',
                            'placeholder'=>'',

                        )) !!}
                    </div>


                    <div class="col-md-6" style="margin-bottom: 1em;" >
                        <label>يفضل مقاس 426 * 270 بيكسل</label>

                        <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
                        <!-- the avatar markup -->
                        <div class="kv-avatar center-block" style="width:200px">
                            <input id="img" name="img" type="file" class="file-loading">
                        </div>
                    </div>

                    <input type="submit" class="col-md-offset-3 col-md-6 btn btn-info" value="إضافة خدمة" />

                    {!!Form::close()!!}
                </div> <!-- end panel body -->
            </div> <!-- /. end panel default -->

        </div> <!-- /. end row -->
    </div><!-- end row home-row-top-->

@stop