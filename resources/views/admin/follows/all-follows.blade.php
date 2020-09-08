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
        defaultPreviewContent: '<img src="{{URL::asset(\App\Models\NewsModel::DEFAULT_MEDIA_COVER)}}" alt="Your Avatar" style="width:160px">',
        layoutTemplates: {main2: '{preview} ' +   ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });




</script>

@endsection

@section('content')

<div class="row home-row-top">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{$pageTitle}}  <a  href="{{URL::to('admin/news/add')}}"><button class="btn btn-xs btn-success" title="إضافة"><i class="fa fa-plus"></i></button></a>
            </h3>
        </div>

             <div class="panel-body">
             <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم المتابعه</th>
                                                <th>صورة المشروع</th>
                                                <th>تاريخ نشر الخبر</th>
                                                <th>المشروع</th>

                                                <th class="text-center">خيارات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($news as $index => $row)
                                            <tr>
                                                <td>{{($index+1)}}</td>
                                                <td>{{$row->title}}</td>
                                                <td><img src="{{URL::asset($row->thumbnail)}}" class="img-responsive" style="width: 400px;" /></td>
                                                <td>{{\App\Helpers\DateHelper::print_date($row->created_at)}}</td>
                                                <td>
                                                    @if($row->project_id == 0 || !isset($row->project_id))
                                                        <p style="color:red;">لايوجد </p>
                                                    @else
                                                    <a  href="{{URL::to('admin/projects/custom/'.$row->project_id )}}">

                                                      {!!\App\Models\ProjectModel::get_projects_by_id($row->project_id)[0]->title !!}</a></td>
                                                @endif
                                                <td class="text-center">
                                                    <a  href="{{URL::to('admin/news/'.$row->id .'/update')}}"><button class="btn btn-xs btn-warning" title="تعديل"><i class="fa fa-pencil-square-o"></i></button></a>
                                                    <a class="check" href="{{URL::to('admin/news/'.$row->id .'/delete')}}"><button class="btn btn-xs btn-danger" title="حذف"><i class="fa fa-minus"></i></button></a>
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


@stop