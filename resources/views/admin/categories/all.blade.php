@extends('admin._masters.main')

@section('header')


@endsection



@section('footer')
<script>
    $(document).ready(function(){
        $('#categories').addClass('active');
    });

</script>

@endsection

@section('content')

<div class="row home-row-top">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{$pageTitle}}  <a  href="{{URL::to('admin/cat/add')}}"><button class="btn btn-xs btn-success" title="إضافة"><i class="fa fa-plus"></i></button></a>
            </h3>
        </div>

             <div class="panel-body">
             <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم التصنيف</th>
                                                <th>صورة التصنيف</th>
                                                <th>تاريخ الإضافة</th>

                                                <th class="text-center">خيارات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($cats as $index => $row)
                                            <tr>
                                                <td>{{($index+1)}}</td>
                                                <td>{{$row->name}}</td>
                                                <td><img src="{{URL::asset($row->icon)}}" class="img-responsive" style="width: 100px;" /></td>
                                                <td>{{\App\Helpers\DateHelper::print_date($row->created_at)}}</td>
                                                <td class="text-center">
                                                    <a  href="{{URL::to('admin/cat/'.$row->id .'/update')}}"><button class="btn btn-xs btn-warning" title="تعديل"><i class="fa fa-pencil-square-o"></i></button></a>
                                                    <a class="check" href="{{URL::to('admin/cat/'.$row->id .'/delete')}}"><button class="btn btn-xs btn-danger" title="حذف"><i class="fa fa-minus"></i></button></a>
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