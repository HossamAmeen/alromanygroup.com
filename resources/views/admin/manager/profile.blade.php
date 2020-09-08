@extends('_masters/main')

@section('header')

    <!-- some CSS styling changes and overrides -->
    <link href="{{URL::asset('plugins/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />



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
    <script src="{{URL::asset('plugins/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>

<!-- bootstrap.js below is only needed if you wish to the feature of viewing details
 of text file preview via modal dialog -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- optionally if you need translation for your language then include
        locale file as mentioned below -->
<script src="{{URL::asset('js/fileinput_locale_ar.js')}}" type="text/javascript"></script>

    <!-- the fileinput plugin initialization -->
    <script>
        $(document).ready(function(){
            $('#profile').addClass('active');
        });
        $("#avatar").fileinput({
            overwriteInitial: true,
            maxFileSize: 15000,
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
            defaultPreviewContent: '<img src="{{URL::asset($mUser->image)}}" alt="Your Avatar" style="width:160px">',
            layoutTemplates: {main2: '{preview} ' +   ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });




    </script>

@endsection

@section('main-content')
<div class="row home-row-top">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">تعديل الحساب الشخصي</h3>
        </div>

             <div class="panel-body">

             {!! Form::model($mUser,
                    array('url'=>URL::to("admin/managers/edit/$mUser->id"),
                        'enctype'=> 'multipart/form-data'  ) )!!}

             @if($errors->any())
                <div class="alert alert-danger">
                  <ul>
                @foreach ($errors->all() as $error)
                     <li>{{$error}}</li>
                @endforeach
                </ul>
                </div>
             @endif

               <div class="form-group col-md-6">
                <label for="user-name">اسم المدير</label>
                {!! Form::text($name = 'name', null, $attributes = array(
                    'id'=>'manager',
                    'class'=>'form-control',
                    'placeholder'=>'اسم المدير',
                    'required'=>'required',
                    'pattern'=>'[a-zA-Z0-9]+'
                )) !!}
              </div>

               <div class="form-group col-md-6">
                <label for="email">البريد الالكتروني</label>
                {!! Form::email($name = 'email', null, $attributes = array(
                    'id'=>'email',
                    'class'=>'form-control',
                    'required'=>'required',
                    'placeholder'=>'البريد الالكتروني'

                )) !!}
              </div>

                <div class="form-group col-md-6">
                <label for="password">كلمة المرور الجديدة</label>
               <input placeholder='كلمة المرور الجديدة' type="password" id="password" name="password" class="form-control" >
              </div>


                <div class="form-group col-md-6">
                <label for="password-confirmation">كلمة المرور الجديدة</label>
               	<input placeholder='تأكيد كلمة المرور' type="password" id="password-confirmation" name="password_confirmation" class="form-control" >
              </div>

                 <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>

                 <div class="col-md-6" style="margin-bottom: 1em;" >
                     <!-- the avatar markup -->
                     <div class="kv-avatar center-block" style="width:200px">
                         <input id="avatar" name="avatar" type="file" class="file-loading">
                     </div>
                 </div>




                 <button type="submit" class="col-md-offset-3 col-md-6 btn btn-default">حفظ البيانات </button>

             {!!Form::close()!!}
            </div> <!-- end panel body -->
        </div> <!-- /. end panel default -->

    </div> <!-- /. end row -->
</div><!-- end row home-row-top-->
@stop