 <footer class="main-footer" >
    <strong>Copyright &copy; 2021-2022 <a href="https://glintel.com">Glintel Technologies</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../common/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../common/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->

<script src="../common/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../common/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../common/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../common/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../common/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../common/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../common/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../common/plugins/jszip/jszip.min.js"></script>
<script src="../common/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../common/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../common/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../common/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../common/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- ChartJS -->
<script src="../common/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../common/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../common/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../common/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../common/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../common/plugins/moment/moment.min.js"></script>
<script src="../common/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../common/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../common/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../common/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../common/dist/js/adminlte.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "scrollX": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "scrollX": true

    });
  });
  
  $("#success-alert").fadeTo(2000, 2500).slideUp(2500, function(){
    $("#success-alert").slideUp(2500);
});
</script>


</body>
</html>
