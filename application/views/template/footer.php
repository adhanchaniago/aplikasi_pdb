      </div>
      </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versi Update </b> V2.2 Dari Versi Sebelumnya
    </div>
    <strong>Copyright 2020 &copy; <a href=""><?= $this->config->item('copyright');  ?> SMPN 1 Kwandang</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
     
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
 
<script src="<?= base_url('assets/admin/dist') ?>/js/jquery.min.js"></script>
<script src="<?= base_url('assets/admin/dist') ?>/js/bootstrap-datepicker.min.js">
</script>
<script src="<?= base_url('assets/admin/dist') ?>/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/admin/dist') ?>/js/adminlte.min.js"></script>
<script src="<?= base_url('assets/admin/dist') ?>/js/dashboard.js"></script>
<script src="<?= base_url('assets/admin/dist') ?>/js/Chart.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/datatables.net-bs/js/jquery.dataTables.min.js"></script> 
<script src="<?= base_url('assets/admin') ?>/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url('assets/admin') ?>/plugins/datatables.net-bs/js/jquery.slimscroll.min.js"></script>
<script>
  $(function () {
    $('#datepicker').datepicker({
      autoclose: true
    })
   });

    $(function () {
    $('#datepicker1').datepicker({
      autoclose: true
    })
   });

  $(function () {
 
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#example5').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>


 


 

</body>
</html>
 