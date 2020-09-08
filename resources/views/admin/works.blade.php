@extends('admin/_masters/main')


@section('header')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

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
            $('#ma_images').addClass('active');
        });

        $("#images").fileinput({
            overwriteInitial: true,
            maxFileSize: 5000,
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
            defaultPreviewContent: '<img src="{{URL::asset(\App\Models\WorkModel::DEFAULT_MEDIA_COVER)}}" class="img-responsive" style="width:400px;"  >',
            layoutTemplates: {main2: '{preview} ' +   ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif",'jpeg']
        });

    </script>

@endsection


@section('content')


    <section id='projects-w'>
        <div id="units">


            <div class="row home-row-top">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> {{$pageTitle}} </h3>
                        </div>

                        {!! Form::open( array('url'=>'admin/works',  'enctype'=> 'multipart/form-data'  ))!!}
                            @include('admin._masters.validation_errors')
                        <div class="row">
                            <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
                        </div>

                        <div class="col-md-8" style="margin-bottom: 1em;" >

                            <div class=" form-group col-sm-12 col-md-4  col-xs-12 ">
                                <label>نوع العمل</label>
                                {!! Form::select($name = 'type', $types , null, $attributes = array(
                                         'id'=>'type',
                                         'class'=>' col-sm-12 col-xs-12 form-control',
                                         'required'=>'required',

                                     )) !!}
                            </div>
                            <div class="clearfix"></div>

                            <label for="images">إضافة الصور</label>

                            <!-- the avatar markup -->
                            <div class="kv-avatar center-block" style="">
                                <input id="images" name="images[]" type="file" multiple class="file-loading">
                            </div>

                        </div>



                        <input type="submit" class="col-md-offset-3 col-md-6 btn btn-info" value="إضافة الصور" />

                        {!!Form::close()!!}

                        <div class="panel-body">
                            <div class="table-responsive ls-table">
                                <table id="projects-tb" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الصورة</th>
                                        <th>النوع</th>
                                        <th class="text-center">خيارات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($works as $index => $work)
                                        <tr>
                                            <td>{{($index+1)}}</td>

                                            <td><img src='{{URL::asset("$work->url")}}' style="height: 10em;" class="img-responsive img-thumbnail" /> </td>
                                            <td>{{($types[$work->type])}}</td>
                                            <td class="text-center">
                                                <a class="check" href="{{URL::to("admin/work/$work->id/delete")}}"><button class="btn btn-xs btn-danger" title="حذف"><i class="fa fa-minus"></i></button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end panel body -->
                    </div> <!-- /. end panel default -->

                </div> <!-- /. end row -->
            </div><!-- end row home-row-top-->

        </div> <!-- /. end projects -->
    </section>
@stop