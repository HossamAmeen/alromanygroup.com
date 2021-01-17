@extends('admin._masters.main')

@section('header')



@endsection



@section('footer')
<script>
    $(document).ready(function(){
        $('#employees').addClass('active');
    });




</script>

@endsection

@section('content')

<div class="row home-row-top">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">مستخدمي التطبيق</h3>
        </div>

             <div class="panel-body">
             <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>اسم العميل
                                                </th>
                                                <th>الوظيفة</th>
                                                <th>الهاتف</th>
                                                <th>الايميل</th>
                                                <th>تاريخ التسجيل</th>
                                                <th>Mac Address</th>
                                                <th>رقم النسخة</th>
                                                <th class="text-center">تاريخ الحصول على الخصم</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                            @foreach($mAppUsers as $index => $row)
                                            <tr class="text-center">
                                                <td>{{($index+1)}}</td>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->job}}</td>
                                                <td>{{$row->tel}}</td>
                                                <td>{{$row->email}}</td>
                                                <td>{{$row->created_at}}</td>
                                                <td>{{$row->macAddress}}</td>
                                                <td>{{$row->user_no}}</td>
                                             @if(empty($row->discount_datetime))
                                                <td>
                                                    <a class="check"  href="{{URL::to('admin/application-user/make-discount/'.$row->id)}}"><button class="btn btn-xs btn-success" title="صرف مكافأة">عمل خصم</button></a>
                                                </td>
                                             @else

                                                    <td>{{$row->discount_datetime}}</td>

                                              @endif
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