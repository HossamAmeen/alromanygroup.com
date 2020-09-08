@extends('admin._masters.main')
@section('footer')
    <script>
        $(document).ready(function(){
            $('#stories').addClass('active');
        });
    </script>
@stop
@section('content')
    <div class="row home-row-top">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$pageTitle}}

                    </h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><span class="fa fa-question-circle"><b> السؤال</b> </span></th>
                                <th><span class="fa fa-calendar"><b> تاريخ النشر</b> </span></th>
                                <th><span class="fa fa-bell"><b> الحالة</b> </span></th>
                                <th class="text-center"><span class="fa fa-gears"><b> خيارات</b> </span></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($allQuestions as $index => $question)
                                <tr>
                                    <td>{{($index+1)}}</td>
                                    <td>{{$question->question}}</td>
                                    <td>{{\App\Helpers\DateHelper::print_date($question->created_at)}}</td>
                                    <td>@if($question->answer == null)
                                            <p style="color: red"> <i class="fa fa-clock-o "></i> قيد الانتظار</p>
                                        @else
                                            <p  style="color: green">  <i class="fa fa-check"></i> تم الرد</p>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="check" href="{{URL::to('admin/faq/'.$question->id .'/delete')}}"><button class="btn btn-xs btn-danger" title="حذف"><i class="fa fa-minus"></i></button></a>

                                        <a  href="{{URL::to('admin/faq/replay/'.$question->id )}}"><button class="btn btn-xs btn-info" title="رد"><i class="fa fa-reply"></i></button></a>
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


@endsection








