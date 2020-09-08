@extends('admin._masters.main')


@section('content')

    <div class="row home-row-top">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$pageTitle}}</h3>
                </div>

                <div class="panel-body">


                <div class="col-md-6">
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped">

                            <tbody>

                            @foreach(range(1, $mProject->levels) as $i  )
                                <tr>
                                @foreach(range(1, $mProject->level_flats_no) as $j  )
                                <td><input type="checkbox" name="booked[]" value="{{$totalFlats - $i*$mProject->level_flats_no +$j}}" /> </td>
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

                            @foreach(range(1, $mProject->levels) as $i  )
                                <tr>
                                @foreach(range(1, $mProject->level_flats_no) as $j  )
                                <td>{{$totalFlats - $i*$mProject->level_flats_no +$j}}</td>
                                @endforeach
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

                    <div class="col-xs-12 notes">
                        <p><span class="red">*</span> لتحديد الوحدات المحجوزة قم بالتعليم عليها فى الجدول الأيمن</p>
                    </div>

                </div>
        </div> <!-- /. end row -->
    </div><!-- end row home-row-top-->


@stop