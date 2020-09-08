
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
    <!-- optionally if you need translation for your language then include
        locale file as mentioned below -->
    <script src="{{URL::asset('resources/assets/admin/plugins/bootstrap-fileinput/js/fileinput_locale_ar.js')}}" type="text/javascript"></script>

    <!-- the fileinput plugin initialization -->
    <script>
        $(document).ready(function(){
            $('#clients').addClass('active');
        });

        $("#logo").fileinput({
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
            defaultPreviewContent: '<img src="{{URL::asset($mClient->logo)}}" alt="لوجو الشركة" style="width:160px">',
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
            <h3 class="panel-title">{{$pageTitle}}</h3>
        </div>

        	 <div class="panel-body">
        	 {!! Form::model( $mClient ,array('method' => 'put', 'enctype'=> 'multipart/form-data') )!!}


                 <div class="form-group col-md-6">
                     <label for="title">اسم العميل</label>
                     {!! Form::text($name = 'title', null, $attributes = array(
                         'id'=>'title',
                         'class'=>'form-control',
                         'placeholder'=>'اسم العميل',
                         'required'=>'required',
                         'max-length'=>'99'
                     )) !!}
                 </div>


                 <div class="form-group col-md-6">
                     <label for="url">رابط العميل</label>
                     {!! Form::url($name = 'url', null, $attributes = array(
                         'id'=>'url',
                         'class'=>'form-control',
                         'placeholder'=>'رابط العميل',
                         'max-length'=>'99'
                     )) !!}
                 </div>


                 <div class="col-md-6" style="margin-bottom: 1em;" >
                     <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
                     <label>يفضل مقاس 160 * 100 بيكسل</label>

                     <!-- the avatar markup -->
                     <div class="kv-avatar center-block" style="width:200px">
                         <input id="logo" name="logo" type="file" class="file-loading">
                     </div>
                 </div>


                 <input type="submit" class="col-md-offset-3 col-md-6 btn btn-success" value="حفظ التعديلات" />


                 {!!Form::close()!!}
            </div> <!-- end panel body -->
        </div> <!-- /. end panel default -->

    </div> <!-- /. end row -->
</div><!-- end row home-row-top-->


@stop