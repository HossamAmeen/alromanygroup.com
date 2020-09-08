@extends('admin._masters.main')

@section('footer')
    <script>
        $(document).ready(function(){
            $('#services').addClass('active');
        });
        </script>
@stop
@section('content')

<div class="row home-row-top">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">كل الخدمات
                <a href="{{URL::to('admin/service/add')}}"> <button  class="btn btn-xs btn-success" title="إضافة"><i class="fa fa-plus"></i></button></a>

            </h3>
        </div>

             <div class="panel-body">
             <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم الخدمة</th>
                                                <th>صورة الخدمة</th>
                                                <th>تاريخ نشر الخدمة</th>

                                                <th class="text-center">خيارات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($services as $index => $service)
                                            <tr>
                                                <td>{{($index+1)}}</td>
                                                <td>{{$service->ar_title}}</td>
                                                <td><img src="{{URL::asset($service->img)}}" class="img-responsive" style="width: 400px;" /></td>
                                                <td>{{\App\Helpers\DateHelper::print_date($service->created_at)}}</td>

                                                <td class="text-center">
                                                    <a  href="{{URL::to('admin/service/'.$service->id .'/update')}}"><button class="btn btn-xs btn-warning" title="تعديل"><i class="fa fa-pencil-square-o"></i></button></a>
                                                    <a class="check" href="{{URL::to('admin/service/'.$service->id .'/delete')}}"><button class="btn btn-xs btn-danger" title="حذف"><i class="fa fa-minus"></i></button></a>
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