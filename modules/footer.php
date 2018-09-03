</div>
<!-- /.content-wrapper -->
<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Muhammad Fachrurroji company
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">Company</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>

</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?=baseUrl('style/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=baseUrl('style/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?=baseUrl('style/dist/js/adminlte.min.js');?>"></script>
<!-- Select2 -->
<script src="<?=baseUrl('style/bower_components/select2/dist/js/select2.full.min.js');?>"></script>
<!-- InputMask -->
<script src="<?=baseUrl('style/plugins/input-mask/jquery.inputmask.js');?>"></script>
<script src="<?=baseUrl('style/plugins/input-mask/jquery.inputmask.date.extensions.js');?>"></script>
<script src="<?=baseUrl('style/plugins/input-mask/jquery.inputmask.extensions.js');?>"></script>
<!-- date-range-picker -->
<script src="<?=baseUrl('style/bower_components/moment/min/moment.min.js');?>"></script>
<script src="<?=baseUrl('style/bower_components/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<!-- SlimScroll -->
<script src="<?=baseUrl('style/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<!-- bootstrap datepicker -->
<script src="<?=baseUrl('style/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?=baseUrl('style/plugins/iCheck/icheck.min.js');?>"></script>
<!-- FastClick -->
<script src="<?=baseUrl('style/bower_components/fastclick/lib/fastclick.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=baseUrl('style/dist/js/demo.js');?>"></script>
<!-- DataTables -->
<script src="<?=baseUrl('style/bower_components/datatables.net/js/jquery.dataTables.min.js');?>"></script>
<script src="<?=baseUrl('style/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>
<!-- bootstrap time picker -->
<script src="<?=baseUrl('style/plugins/timepicker/bootstrap-timepicker.min.js');?>"></script>


<script>
    $(function () {
        $('.datatable').DataTable();
        $('#example1').DataTable();
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'yyyy/mm/dd' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()
    })
</script>
<?=getBuffer('scripts');?>
</body>
</html>

