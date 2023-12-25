<?php

?>
<!DOCTYPE html>
<html lang="es">
<?php
include 'assets/head.php';
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/trophe.png" alt="AdminLTELogo" height="100" width="200">
  </div>

  <!-- Navbar -->
 <?php
 include 'assets/nav.php';
 ?>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
<?php
include 'assets/aside.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">PT's &nbsp; &nbsp
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                  Nuevo
                </button></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Clave Pt</th>
                    <th>Producto Terminado</th>
                    <th>Caducidad</th>
                    <th>Acciones</th>   
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      include "conexion.php";																
                      $query = mysqli_query($conexion, "SELECT clave_pt,pt,caducidad FROM claves");
                      $result = mysqli_num_rows($query);								
                      if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query)) { ?>
                          <tr>
                            <td class="text-center"><?php echo $data['clave_pt']; ?></td>
                            <td class="text-center"><?php echo $data['pt']; ?></td>
                            <td class="text-center"><?php echo $data['caducidad']; ?></td>
                            
                            <td class="text-center">
                              <a href="editar_parametros.php?id=<?php echo $data['id_parametros']; ?>" class="btn btn-success"><i class="fa-solid fa-eye">Ver</i></a>
                            </td>
                          </tr>
                          <?php }
                          
                        } 
                   ?>                 
                  </tbody>
                </table>
              </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

              <!-- /.card-body -->
              <div class="card-footer">
                Many more skins available. <a href="https://bantikyan.github.io/icheck-bootstrap/">Documentation</a>
              </div>
            </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
                    </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--Nuevo Pt -->
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Nuevo PT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="assets/save.php">              
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Clave PT</label>
                    <input type="text" class="form-control" name="clave_pt" placeholder="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>PT</label>
                    <input type="text" class="form-control" name="pt" placeholder="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Caducidad</label>
                    <input type="date" class="form-control" name="caducidad" placeholder="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Empaque</label>
                    <input type="text" class="form-control" name="empaque" placeholder="">
                  </div>
                </div>
              </div>
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Análisis fisicoquímicos</h3>
                </div>
                <div class="card-body">
                  <!-- Minimal style -->
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group clearfix">                                           
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkboxPrimary3" name="ehum">
                          <label for="checkboxPrimary3">
                            Humedad
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" name="minh" id="minh" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" name="maxh" id="maxh" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- radio -->
                      <div class="form-group clearfix">                     
                        <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxDange" name="eme">
                          <label for="checkboxDange">
                            Material extraño
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" name="minm" id="minm" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" name="maxm" id="maxm" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Minimal red style -->
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group clearfix">                      
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxDanger3" name="eg8">
                          <label for="checkboxDanger3">
                            Granulometría mallas 8
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" name="ming" id="ming" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" name="maxg" id="maxg" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- radio -->
                      <div class="form-group clearfix">                      
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxDanger" name="eg30">
                          <label for="checkboxDanger">
                            Granulometría mallas 30
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" name="ming3" id="ming3" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" name="maxg3" id="maxg3" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Minimal red style -->
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group clearfix">                      
                        <div class="icheck-success d-inline">
                          <input type="checkbox" id="checkboxSuccess3" name="efo">
                          <label for="checkboxSuccess3">
                            Fondo
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" name="minf" id="minf" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" name="maxf" id="maxf" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group clearfix">                      
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxph" name="eph">
                          <label for="checkboxph">
                            pH
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" name="minph" id="minph" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" name="maxph" id="maxph" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                
                  </div>
                </div>
              </div>
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Análisis microbiológicos</h3>
                </div>
                <div class="card-body">
                  <!-- Minimal style -->
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group clearfix">                                           
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkboxcta">
                          <label for="checkboxcta">
                            Cuenta total aeróbica
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" id="minc" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" id="maxc" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- radio -->
                      <div class="form-group clearfix">                     
                        <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxh">
                          <label for="checkboxh">
                            Hongos
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" id="minho" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" id="maxho" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Minimal red style -->
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group clearfix">                      
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxl">
                          <label for="checkboxl">
                            Levaduras
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" id="minl" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" id="maxl" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- radio -->
                      <div class="form-group clearfix">                      
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxc">
                          <label for="checkboxc">
                            Coliformes
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" id="minco" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" id="maxco" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Minimal red style -->
                  <!--<div class="row">
                    <div class="col-sm-6">                      
                      <div class="form-group clearfix">                      
                        <div class="icheck-success d-inline">
                          <input type="checkbox" id="checkboxSuccess3">
                          <label for="checkboxSuccess3">
                            Fondo
                          </label>
                          <div class="row">
                            <div class="col-3">
                              <input type="text" id="minf" class="form-control" placeholder="Min.">
                            </div>
                            <div class="col-3">
                              <input type="text" id="maxf" class="form-control" placeholder="Máx.">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                  
                  </div>-->
                </div>
              </div>
              </div>
              <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<!-- Scripts de visibilidad máximos y mínimos -->
<script>
  $(document).ready(function(){
    $("#minh").hide();
    $("#maxh").hide();
  $('#checkboxPrimary3').on('change',function(){
    if (this.checked) {
     $("#minh").show();
     $("#maxh").show();
    } else {
     $("#minh").hide();
     $("#maxh").hide();
    }  
  })
});
</script>
<script>
  $(document).ready(function(){
    $("#ming").hide();
     $("#maxg").hide();
  $('#checkboxDanger3').on('change',function(){
    if (this.checked) {
     $("#ming").show();
     $("#maxg").show();
    } else {
     $("#ming").hide();
     $("#maxg").hide();
    }  
  })
});
</script>
<script>
  $(document).ready(function(){
    $("#minm").hide();
     $("#maxm").hide();
  $('#checkboxDange').on('change',function(){
    if (this.checked) {
     $("#minm").show();
     $("#maxm").show();
    } else {
     $("#minm").hide();
     $("#maxm").hide();
    }  
  })
});
</script>
<script>
  $(document).ready(function(){
    $("#ming3").hide();
     $("#maxg3").hide();
  $('#checkboxDanger').on('change',function(){
    if (this.checked) {
     $("#ming3").show();
     $("#maxg3").show();
    } else {
     $("#ming3").hide();
     $("#maxg3").hide();
    }  
  })
});
</script>
<script>
  $(document).ready(function(){
    $("#minf").hide();
     $("#maxf").hide();
  $('#checkboxSuccess3').on('change',function(){
    if (this.checked) {
     $("#minf").show();
     $("#maxf").show();
    } else {
     $("#minf").hide();
     $("#maxf").hide();
    }  
  })
});
</script>
<script>
  $(document).ready(function(){
    $("#minc").hide();
     $("#maxc").hide();
  $('#checkboxcta').on('change',function(){
    if (this.checked) {
     $("#minc").show();
     $("#maxc").show();
    } else {
     $("#minc").hide();
     $("#maxc").hide();
    }  
  })
});
</script>
<script>
  $(document).ready(function(){
    $("#minho").hide();
     $("#maxho").hide();
  $('#checkboxh').on('change',function(){
    if (this.checked) {
     $("#minho").show();
     $("#maxho").show();
    } else {
     $("#minho").hide();
     $("#maxho").hide();
    }  
  })
});
</script>
<script>
  $(document).ready(function(){
    $("#minl").hide();
     $("#maxl").hide();
  $('#checkboxl').on('change',function(){
    if (this.checked) {
     $("#minl").show();
     $("#maxl").show();
    } else {
     $("#minl").hide();
     $("#maxl").hide();
    }  
  })
});
</script>
<script>
  $(document).ready(function(){
    $("#minph").hide();
     $("#maxph").hide();
  $('#checkboxph').on('change',function(){
    if (this.checked) {
     $("#minph").show();
     $("#maxph").show();
    } else {
     $("#minph").hide();
     $("#maxph").hide();
    }  
  })
});
</script>

<script>
  $(document).ready(function(){
    $("#minco").hide();
     $("#maxco").hide();
  $('#checkboxc').on('change',function(){
    if (this.checked) {
     $("#minco").show();
     $("#maxco").show();
    } else {
     $("#minco").hide();
     $("#maxco").hide();
    }  
  })
});
</script>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
</body>
</html>
