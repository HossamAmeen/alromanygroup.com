@extends('admin._masters.main')


@section('content')

    <div class="row home-row-top">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$pageTitle}}</h3>
                </div>

                <div class="panel-body">
                    {!! Form::open( array(  'enctype'=> 'multipart/form-data'  ))!!}


                <div class="col-md-6">
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped">

                            <tbody>
                            <tr>
                                <td>الطابق</td>
                                <td colspan="{{$mProject->level_flats_no}}"></td>

                            </tr>
                            @foreach(range(1, $mProject->levels) as $i  )
                                <tr>
                                <td>{{$totalFlats / $mProject->level_flats_no - $i + 1 }}</td>
                                @foreach(range(1, $mProject->level_flats_no) as $j  )
                                <td><input type="checkbox" name="books[]" <?=(in_array($totalFlats-$i*$mProject->level_flats_no+$j, $books)?'checked':'')?> value="{{$totalFlats - $i*$mProject->level_flats_no +$j}}" /> </td>
                                @endforeach
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

<div class="col-md-6">
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped">

                            <tbody>
                            <tr>
                                <td>الطابق \ شقة</td>

                                @foreach(range(1, $mProject->level_flats_no) as $j  )
                                    <th>{{$j}}</th>
                                @endforeach
                            </tr>@foreach(range(1, $mProject->levels) as $i  )
                                <tr>
                                    <td>{{$totalFlats / $mProject->level_flats_no - $i + 1 }}</td>
                                @foreach(range(1, $mProject->level_flats_no) as $j  )
                                <td <?=(in_array($totalFlats-$i*$mProject->level_flats_no+$j, $books)?'style="background: red; color:white;"':'')?>   >{{$totalFlats - $i*$mProject->level_flats_no +$j}}</td>
                                @endforeach
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

                    <div class="col-xs-12 notes">
                        <p><span class="red">*</span> لتحديد الوحدات المحجوزة قم بالتعليم عليها فى الجدول الأيمن ثم اضغط حفظ</p>
                        <p><span class="red">*</span> اللون الأحمر يعني أن الوحدة محجوزة</p>
                    </div>

                    <input type="submit" class="col-md-offset-3 col-md-6 btn btn-info" value="حفظ" />
                    {{Form::close()}}
                </div>
        </div> <!-- /. end row -->
    </div><!-- end row home-row-top-->


@stop