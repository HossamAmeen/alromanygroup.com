@extends('admin._masters.main')
@section('header')

    <!-- Include Editor style. -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    {{--<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.4.1/css/froala_editor.min.css' rel='stylesheet' type='text/css' />--}}
    {{--<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.4.1/css/froala_style.min.css' rel='stylesheet' type='text/css' />--}}
    <link rel="stylesheet" href="{{URL::asset('resources/assets/admin/assets/css/froala_editor.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('resources/assets/admin/assets/css/froala_style.min.css')}}"/>



    <!-- some CSS styling changes and overrides -->
    <link href="{{URL::asset('resources/assets/admin/assets/plugins/bootstrap-fileinput/css/fileinput.min.css')}}"
          media="all" rel="stylesheet" type="text/css"/>



    <style>
        .kv-avatar .file-preview-frame, .kv-avatar .file-preview-frame:hover {
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

        #loginForm .has-error .control-label,
        #loginForm .has-error .help-block,
        #loginForm .has-error .form-control-feedback {
            color: #f39c12;
        }

        #loginForm .has-success .control-label,
        #loginForm .has-success .help-block,
        #loginForm .has-success .form-control-feedback {
            color: #18bc9c;

        hr {
            -moz-border-bottom-colors: none;
            -moz-border-image: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            border-color: #EEEEEE -moz-use-text-color #FFFFFF;
            border-style: solid none;
            border-width: 1px 0;
            margin: 18px 0;
        }
        }
    </style>

@endsection

@section('footer')

    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Include JS file. -->
    <script type="text/javascript"
            src="{{URL::asset('resources/assets/admin/assets/js/editor/froala_editor.min.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="{{URL::asset('resources/assets/admin/assets/js/editor/froala_editor_ie8.min.js')}}"></script>
    <![endif]-->
    <script src="{{URL::asset('resources/assets/admin/assets/js/editor/plugins/tables.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/assets/js/editor/plugins/lists.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/assets/js/editor/plugins/colors.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/assets/js/editor/plugins/media_manager.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/assets/js/editor/plugins/font_family.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/assets/js/editor/plugins/font_size.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/assets/js/editor/plugins/block_styles.min.js')}}"></script>
    <script src="{{URL::asset('resources/assets/admin/assets/js/editor/plugins/video.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#ar_news').editable({
                inlineMode: false, direction: 'rtl'
            })
            $('#en_news').editable({
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
    <script src="{{URL::asset('resources/assets/admin/assets/plugins/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js')}}"
            type="text/javascript"></script>
    <script src="{{URL::asset('resources/assets/admin/assets/plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>

    <!-- bootstrap.js below is only needed if you wish to the feature of viewing details
     of text file preview via modal dialog -->
    <!-- optionally if you need translation for your language then include
        locale file as mentioned below -->
    <script src="{{URL::asset('resources/assets/admin/assets/plugins/bootstrap-fileinput/js/fileinput_locale_ar.js')}}"
            type="text/javascript"></script>

    <!-- the fileinput plugin initialization -->
    <script>
        $(document).ready(function () {
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
            defaultPreviewContent: '<img src="{{URL::asset(\App\Models\NewsModel::DEFAULT_MEDIA_COVER)}}" alt="صورة الخدمة" style="width:160px">',
            layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });

    </script>

@endsection

@section('content')
    <div class="row home-row-top">
        <div class="col-md-12">
            <div class="panel panel-default">
                @include('admin._masters.validation_errors')

                <div class="panel-heading">
                    <h3 class="panel-title">الرد على سؤال</h3>
                </div>

                <br>
                <ul>
                    <p><i class="fa fa-question-circle"></i> <b> سؤال من :</b> {{$myQ->name}}</p>

                    <p> <i class="fa fa-envelope"></i>  <b> الايميل :</b> {{$myQ->email}}</p>
                </ul>
                <hr>
                <ul>
                    <li>
                        <h3 style="color: #00a8ff">{{$myQ->question}} </h3>
                    </li>
                </ul>
                <hr>


                <div class="panel-body">
                    {!! Form::model( $myQ ,array('method' => 'put', 'enctype'=> 'multipart/form-data') )!!}





                    <div class="form-group col-md-12">
                        <label for="ar_news" class="control-label">الاجابة</label>
                        {!! Form::textarea($name = 'answer', null, $attributes = array(
                            'id'=>'ar_news',
                            'class'=>'form-control txtEditor ',
                            'placeholder'=>'',

                        )) !!}
                    </div>




                    <input type="submit" class="col-md-offset-3 col-md-6 btn btn-info" value="إضافة رد"/>

                    {!!Form::close()!!}
                </div> <!-- end panel body -->
            </div> <!-- /. end panel default -->

        </div> <!-- /. end row -->
    </div>
    </div>
    </div>


@endsection
