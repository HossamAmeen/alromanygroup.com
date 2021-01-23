
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
        $('#products').addClass('active');
    });
    $("#image").fileinput({
        overwriteInitial: true,
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
        defaultPreviewContent: '<img src="{{URL::asset($mProduct->image)}}" alt="Your Avatar" style="width:160px">',
        layoutTemplates: {main2: '{preview} ' +   ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif",'jpeg']
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
        	 {!! Form::model( $mProduct ,array('id'=>'productForm','method' => 'put', 'enctype'=> 'multipart/form-data') )!!}


                 <div class="form-group col-md-6">
                     <label for="name">اسم المنتج</label>
                     {!! Form::text($name = 'name', null, $attributes = array(
                         'id'=>'name',
                         'class'=>'form-control',
                         'placeholder'=>'اسم المنتج',
                         'required'=>'required',
                         'max-length'=>'99'
                     )) !!}
                 </div>

                 <div class="form-group col-md-6">
                     <label for="category_id">اختر مشروع متعلق بالخبر</label>
                     {!! Form::select($name = 'category_id', $categories , null, $attributes = array(
                              'id'=>'category_id',
                              'class'=>' form-control ',
                              'required'=>'required',
                  )) !!}
                 </div>


                 <div class="form-group col-md-6">
                     <label for="price">السعر</label>
                     {!! Form::number($name = 'price', null, $attributes = array(
                         'id'=>'price',
                         'class'=>'form-control',
                         'placeholder'=>'السعر',
                         'required'=>'required',
                     )) !!}
                 </div>

                 <div class="form-group col-md-6">
                     <label for="offer_price">سعر العرض</label>
                     {!! Form::number($name = 'offer_price', null, $attributes = array(
                         'id'=>'offer_price',
                         'class'=>'form-control',
                         'placeholder'=>'سعر العرض',
                     )) !!}
                 </div>

                 <div class="form-group col-md-12">
                     <label for="offer_price">وصف المنتج</label>
                     {!! Form::textarea($name = 'description', null, $attributes = array(
                         'id'=>'description',
                         'class'=>'form-control',
                         'placeholder'=>'وصف المنتج',
                          'required'=>'required',

                     )) !!}
                 </div>

                 <div class="col-md-6" style="margin-bottom: 1em;" >
                     <label>رجاء مراعاة ألا تزيد مساحة الصورة عن ١٠٠٠ بيكسل</label>
                     <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
                     <!-- the avatar markup -->
                     <div class="kv-avatar center-block" style="width:200px">
                         <input id="image" name="image" type="file" class="file-loading">
                     </div>
                 </div>

                 <input type="submit" class="col-md-offset-3 col-md-6 btn btn-success" value="حفظ التعديلات" />


                 {!!Form::close()!!}
            </div> <!-- end panel body -->
        </div> <!-- /. end panel default -->

    </div> <!-- /. end row -->
</div><!-- end row home-row-top-->


@stop