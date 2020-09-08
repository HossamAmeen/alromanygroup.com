@extends('admin._masters.main')

@section('footer')
    <script type="text/javascript">
    $(document).ready(function(){
       $('#managers').addClass('active');
    });   
    </script>

    <script>

        $('form.check-password').submit(function(e){
            var check_password = $('#password-modal #check_password').val();
            if(check_password != ''){
                console.log(check_password);
            }else{
                e.preventDefault();
                $('#password-modal').modal();
            }

        });

        $('#password-modal button.submit-form').click(function(){
           append_password();
            $('form.check-password').submit();
        });

        $('#password-modal button.close-modal').click(function(){
            $('#password-modal #check_password').val('');
        });

        function append_password(){
            $('form.check-password').find('#check_password').remove();
            var check_password = $('#password-modal #check_password');
            check_password_copy = check_password.clone();
            check_password_copy.addClass('hide');
            $('form.check-password').append(check_password_copy);
        }



    </script>

    <script>
        $(document).ready(function (){
            $('#addManager').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh',
                },
                fields:{
                    name:{
                        validators:{
                            stringLength:{
                                min:5,
                                message:'الاسم على الاقل 5 حروف'
                            },
                            notEmpty:{
                                message:'ادخل الاسم'
                            }
                        }
                    },
                    password:{
                        validators:{
                            stringLength:{
                                min:5,
                                message:'كلمة السر يجب ان تكون على الاقل 5 حروف'
                            },
                            notEmpty:{
                                message:'ادخل كلمة المرور'
                            }
                        }
                    } ,
                    password_confirmation:{
                        validators:{

                            notEmpty:{
                                message:'ادخل تأكيد كلمة المرور'
                            },
                            identical:{
                                field:'password',
                                message:'كلمة المرور غير متطابقة'
                            }
                        }
                    },
                    email:{
                        validators:{

                            notEmpty:{
                                message:'ادخل الايميل'
                            },
                            emailAddress:{
                                message:'ادخل بريد الكتروني صحيح'
                            }
                        }
                    },
                    role:{
                        validators:{

                            notEmpty:{
                                message:'اختر الصلاحية'
                            }
                        }
                    },
                    img:{
                        validators:{
                            notEmpty:{
                                message:'اختار صورة'
                            },
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 2097152,   // 2048 * 1024
                                message: 'ملف غير صحيح'
                            }

                        }
                    }




                }

            });


        });
    </script>
@endsection

@section('content')
<div class="row home-row-top">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">إضافة مدير</h3>
        </div>

             <div class="panel-body">
             {!! Form::open(['id'=>'addManager','class'=>'check-password']) !!}

                @include('admin._masters.validation_errors')

               <div class="form-group col-md-6">
                <label for="name">اسم المدير</label>
                {!! Form::text($name = 'name', null, $attributes = array(
                    'id'=>'name',
                    'class'=>'form-control',
                    'placeholder'=>'اسم المدير',
                    'required'=>'required',
                    'pattern'=>'[a-zA-Z0-9]+'
                )) !!}
              </div>

               <div class="form-group col-md-6">
                <label for="email">البريد الالكتروني</label>
                {!! Form::email($name = 'email', null, $attributes = array(
                    'id'=>'email',
                    'class'=>'form-control',
                    'required'=>'required',
                    'placeholder'=>'البريد الالكتروني'

                )) !!}
              </div>

            <div class="form-group col-md-4">
                <label for="password">كلمة المرور للمدير</label>
               <input placeholder='كلمة المرور للمدير' type="password" id="password" name="password" class="form-control" required>
              </div>


             <div class="form-group col-md-4">
                <label for="password-confirmation">تأكيد كلمة المرور</label>
               	<input placeholder='تأكيد كلمة المرور' type="password" id="password-confirmation" name="password_confirmation" class="form-control" required>
              </div>


                 <div class="form-group col-md-4">
                     <label for="role">صلاحيات المدير</label>
                     <select required id='role' name="role" class="form-control">
                         <option disabled selected>صلاحيات المدير</option>
                         <option value="1">مدير عام</option>
                         <option value="10">مشرف</option>
                     </select>
                 </div>

                 <div class="col-xs-12 notes">
                     <p><span class="red">*</span>المدير يمكنه إضافة مدراء أخرين</p>
                     <p><span class="red">*</span>المشرف لا يمكنه إضافة مدراء آخرين</p>
                 </div>


                 <button  type="submit" class="col-md-offset-3 col-md-6 btn btn-info" >حفظ البيانات </button>

             {!!Form::close()!!}

                     <!-- Modal -->
                 <div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <h4 class="modal-title" id="myModalLabel">كلمة المرور</h4>
                             </div>
                             <div class="modal-body">
                                 <div class="form-group col-md-12">
                                     <input placeholder='كلمة المرور' type="password" id="check_password" name="check_password" class="form-control" required>
                                 </div>

                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">اغلق</button>
                                 <button type="button" class="btn btn-info submit-form" >إرسال</button>
                             </div>
                         </div>
                     </div>
                 </div>
            </div> <!-- end panel body -->
        </div> <!-- /. end panel default -->

    </div> <!-- /. end row -->
</div><!-- end row home-row-top-->
@stop