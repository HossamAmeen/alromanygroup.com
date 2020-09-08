<!-- Modal -->
<div id="loading-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body " style="margin: 5em 0em; ">

                <img class="center-block" src="{{URL::asset('resources/assets/admin/images/loader.gif')}}" />

                <div class="form-group col-md-12">

                </div>
                <div class="clearfix"></div>
            </div>


        </div>

    </div>
</div>
{{--<script type="text/javascript" src="{{URL::asset('resources/assets/site/bootstrap/js/bootstrap.min.js')}}"></script>--}}

<!--Layout Script start -->
<script type="text/javascript" src="{{URL::asset('resources/assets/admin/js/color.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/admin/js/lib/jquery-1.11.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/admin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/admin/js/multipleAccordion.js')}}"></script>


<!--easing Library Script Start -->
<script src="{{URL::asset('resources/assets/admin/js/lib/jquery.easing.js')}}"></script>
<!--easing Library Script End -->

<!--Nano Scroll Script Start -->
<script src="{{URL::asset('resources/assets/admin/js/jquery.nanoscroller.min.js')}}"></script>
<!--Nano Scroll Script End -->

<!--switchery Script Start -->
<script src="{{URL::asset('resources/assets/admin/js/switchery.min.js')}}"></script>
<!--switchery Script End -->

<!--bootstrap switch Button Script Start-->
<script src="{{URL::asset('resources/assets/admin/js/bootstrap-switch.js')}}"></script>
<!--bootstrap switch Button Script End-->

<!--easypie Library Script Start -->
<script src="{{URL::asset('resources/assets/admin/js/jquery.easypiechart.min.js')}}"></script>
<!--easypie Library Script Start -->

<!--bootstrap-progressbar Library script Start-->
<script src="{{URL::asset('resources/assets/admin/js/bootstrap-progressbar.min.js')}}"></script>
<!--bootstrap-progressbar Library script End-->

<!--notify.js Library script Start-->
<script src="{{URL::asset('resources/assets/admin/js/notify.js')}}"></script>
<script src="{{URL::asset('resources/assets/admin/js/msgs.js')}}"></script>
<!--notify.js Library script End-->

<script src="{{URL::asset('resources/assets/admin/js/bootstrapvalidator/bootstrapValidator.js')}}"></script>


<script type="text/javascript" src="{{URL::asset('resources/assets/admin/js/pages/layout.js')}}"></script>
<!--Layout Script End -->
<script src="{{URL::asset('resources/assets/admin/js/bootbox.min.js')}}"></script>
<script type="text/javascript">
    $('.check').click(function(){
        $url = $(this).attr('href');
        bootbox.dialog({
            message: "هل أنت متأكد من أنك تريد القيام بهذه العملية؟",
            title: "تأكيد القيام بالعملية",
            buttons: {
                success: {
                    label: "نعم!",
                    className: "btn-success",
                    callback: function() {

                        if($url == undefined)
                            $('form').submit();
                        else{
                            console.log("should go to " + $url);
                            window.location = $url;

                        }
                    }
                },
                danger: {
                    label: "لا!",
                    className: "btn-danger",
                    callback: function() {
                        //Example.show("uh oh, look out!");
                    }
                },

            }
        });
        return false;
    });

    $('form').submit(function(){
        if(!$('form').hasClass('check-password')) {
            $("#loading-modal").modal();
        }
    })
</script>
<script src="{{URL::asset('resources/assets/admin/js/editable-table/jquery.dataTables.editable.js')}}"></script>
<script src="{{URL::asset('resources/assets/admin/js/editable-table/jquery.dataTables.min.js')}}"></script>

<script>
    $('.table').dataTable();
</script>

