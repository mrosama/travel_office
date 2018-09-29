<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2015 &copy; Metronic by keenthemes.
        <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="{{URL::to('/')}}/assets/global/plugins/respond.min.js"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{URL::to('/')}}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/script.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{URL::to('/')}}/assets/pages/scripts/form-wizard.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{URL::to('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- <script src="{{URL::to('/')}}/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{URL::to('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{URL::to('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/pages/scripts/form-input-mask.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{URL::to('/')}}/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{URL::to('/')}}/assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/assets/moment.js" type="text/javascript"></script>
<script src="https://rawgit.com/igorescobar/jQuery-Mask-Plugin/master/src/jquery.mask.js"></script>

<!--<script type="text/javascript" src="{{URL::to('/assets/form-validation.js')}}"></script>-->



@yield('JsScripts')
<script type="text/javascript">
function changeNotificationsSeen() {
    $("#notificationsCount1").text(0);
    $("#notificationsCount2").text(0);
    $.ajax({
        url: $("#base_url").val() + '/changeNotificationsSeen',
    })
            .done(function () {
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
}
function changeMessagesSeen() {
    $("#messageCount1").text(0);
    $("#messageCount2").text(0);
    $.ajax({
        url: $("#base_url").val() + '/changeMessagesSeen',
    })
            .done(function () {
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
}

</script>

</body>
</html>