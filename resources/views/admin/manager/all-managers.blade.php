@extends('admin._masters/main')

@section('footer')
   <script type="text/javascript">
    $(document).ready(function(){
       $('#managers').addClass('active');
    });   
    </script>


@stop
@section('content')

<div class="row home-row-top">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">كل المديرين
                <a href="{{URL::to('admin/manager/add')}}"> <button  class="btn btn-xs btn-success" title="إضافة"><i class="fa fa-plus"></i></button></a>
            </h3>
        </div>

             <div class="panel-body">
             <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم المدير</th>
                                                <th>الصلاحية</th>

                                                <th class="text-center">خيارات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($users as $index => $user)
                                            <tr>
                                                <td>{{($index+1)}}</td>
                                                 <td>{{$user->name}}</td>
                                                 <td>{{\App\Models\UserModel::getRoleTitle($user->role)}}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#manager-{{$user->id}}">
                                                        <i class="fa fa-key"></i></button>

                                                    <!-- Modal -->
                                                    <div id="manager-{{$user->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                {!! Form::open(array('url' => "admin/manager/$user->id/edit-role")) !!}

                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">تعديل صلاحيات المدير</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="clearfix"></div>

                                                                    <div class="col-md-6 col-xs-12 form-group">
                                                                        <label for="role">الصلاحية</label>
                                                                        {!! Form::select($name = 'role', ['1'=>'مدير عام','2'=>'مشرف'] , null, $attributes = array(
                                                                                 'id'=>'role',
                                                                                 'class'=>' form-control',
                                                                                 'required'=>'required',
                                                                     )) !!}
                                                                    </div>

                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success" >حفظ</button>
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">إلغاء</button>
                                                                </div>
                                                                </form>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <a  href="{{URL::to('admin/manager/edit/'.$user->id .'')}}"><button class="btn btn-xs btn-warning" title="تعديل"><i class="fa fa-pencil-square-o"></i></button></a>

                                                    <a class="check" href="{{URL::to("admin/manager/$user->id/delete")}}">
                                                            <button  class="btn btn-xs btn-danger delete" title=" حذف "><i class="fa fa-minus"></i></button>
                                                    </a>
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