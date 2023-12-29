<?php

?>
<!DOCTYPE html>
<html lang="es">
<?php
include 'assets/head.php';
?>
<body class="hold-transition sidebar-mini layout-fixed">
  <style>
	.analisis-wrapper{
		display:grid;
		gap: 0.6rem;
	}
    .analisis-item{
      display: grid;
      grid-template-areas: "nombre-analisis input-resultado"
                           "valores-analisis input-resultado";
	  grid-template-columns: 1fr 1fr;
	  justify-items: center;
	  border-bottom: 1px solid black;
	  padding-bottom: 0.3rem;
    }
	.analisis-item__name{
		grid-area: nombre-analisis;
	}
	.analisis-item__valores{
		grid-area: valores-analisis;
		display: flex;
		justify-content: space-around;
		width: 100%;
	}
	.analisis-item__input{
		grid-area: input-resultado;
	}
  </style>
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
                <h3 class="card-title">Agregar resultados &nbsp; &nbsp
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                  Nuevo
                </button></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>PT</th>
                    <th>Clave PT</th>
                    <th>Análisis</th>
                    <th>Mínimo</th>
                    <th>Máximo</th>   
                    <th>Fecha de caducidad</th>
                    <th>Empaque</th>
                    
                    <!--<th>Acciones</th>-->
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                          include "conexion.php";																
                          $query = mysqli_query($conexion, "SELECT p.email, p.telefono, a.id_analisis,  a.nombre_a, p.min, p.max, p.condiciones, p.envio
                          FROM proveedores p INNER JOIN analisis a ON p.id_analisis = a.id_analisis");
                          $result = mysqli_num_rows($query);								
                          if ($result > 0) {
                            while ($data = mysqli_fetch_assoc($query)) { ?>
                              <tr>
                                <td class="text-center"><?php echo $data['email']; ?></td>
                                <td class="text-center"><?php echo $data['telefono']; ?></td>
                                <td class="text-center"><?php echo $data['nombre_a']; ?></td>
                                <td class="text-center"><?php echo $data['min']; ?></td>
                                <td class="text-center"><?php echo $data['max']; ?></td>
                                <td class="text-center"><?php echo $data['condiciones']; ?></td>
                                <td class="text-center"><?php echo $data['envio']; ?></td>
                                
                                <!--<td class="text-center">
                                  <a href="<?php /* echo $data['id_parametros'];*/ ?>" class="btn btn-success"><i class="fa-solid fa-eye">Ver</i></a>
                                </td>-->
                              </tr>
                              <?php }
                              
                          } ?>          
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

<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="formResultados">
                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlInput1">Lote</label>
                        <input class="form-control" name="lote" id="lote" type="text" placeholder="Lote">
                    </div>
                    <div class="mb-3">
                    <label class="form-label" for="exampleFormControlInput1">Clave de PT</label>
                    <select class="form-control" required id="id_producto" name="id_producto">
                      <option value="0">--Selecciona una opcion--</option>
                      <?php
                      include "conexion.php";
                      $sql = "SELECT * FROM proveedores ";
                      $resultado = mysqli_query($conexion, $sql);
                      while ($consulta = mysqli_fetch_array($resultado)) {
                          echo '<option value="' . $consulta['id'] . '">' . $consulta['email'] . '</option>';
                      }

                      ?>

                    </select>                   
                    </div>
                    <div class="analisis-wrapper">

                    </div>
                    <div class="form-group" id="select2lista">

                    </div> 
                   <!-- <div class="mb-3">
                        <label class="form-label" for="exampleFormControlTextarea1">PT</label>
                        <input class="form-control" id="pt" name="pt" placeholder="">
                    </div>                 
                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlTextarea1">Mesofílico</label>
                        <input class="form-control" name="meso" id="meso" placeholder="Mesofílico">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlTextarea1">Coliformes</label>
                        <input class="form-control" name="coli" id="coli" placeholder="Coliformes">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlTextarea1">Hongos</label>
                        <input class="form-control" name="hon" id="hon" placeholder="Hongos">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlTextarea1">Levadura</label>
                        <input class="form-control" name="leva" id="leva" placeholder="Levadura">
                    </div>-->
                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlTextarea1">Estatus</label>
                        <input class="form-control" name="estatus" id="estatus" placeholder="Estatus">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="exampleFormControlTextarea1">Comentarios</label>
                        <input class="form-control" name="com" id="comentarios" placeholder="Comentarios">
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

<script>
    $(document).ready(function() {
        $('#id_producto').val(0);
        // recargarLista();

        $('#id_producto').change(function() {
            let id_value = this.value
            recargarLista(id_value);
        });

        let formResultados = document.getElementById("formResultados");
        formResultados.addEventListener("submit", async function(e){
          e.preventDefault();
          let lote = document.getElementById("lote").value
          id_producto = document.getElementById("id_producto").value,
          estatus = document.getElementById("estatus").value,
          comentarios = document.getElementById("comentarios").value,
          arregloInputResultados = document.querySelectorAll(".input-resultados"),
          arregloResultados = []

          arregloInputResultados.forEach(inputResultado => {
            arregloResultados.push({
              valorResultado: inputResultado.value,
              id_proveedor_analisis: inputResultado.getAttribute("dataIPA")
            })
          })

          let data = {
            lote,
            id_producto,
            estatus,
            comentarios,
            arregloResultados
          }

          console.log(data)

          let respuestaInsert = await fetch("./assets/save.php",{
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data)
          })

          let res = await respuestaInsert.json()
          console.log(res)




        })
    })
</script>
<script>
    async function recargarLista(id_pt = 0) {

      let data = {id_pt}
      let res = await fetch("./getAllAnalisis.php",{
        method: "POST",
        headers:{
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
      })
      let response = await res.json()
      console.log("allanalisis",response)
      let analisisWrapper = document.querySelector(".analisis-wrapper")
      analisisWrapper.insertAdjacentHTML("beforeend",`<div style="width: 100%; "><b>Análisis</b></div>`);
      response.respuesta.forEach(analisis => {
        analisisWrapper.insertAdjacentHTML("beforeend",
        `<div class="analisis-item">
        	<div class="analisis-item__name">${analisis.analisis}</div>
			<div  class="analisis-item__valores">
				<div>Min. ${analisis.min}</div>
				<div>Max. ${analisis.max}</div>
			</div>
			<div class="analisis-item__input">
				<label class="form-label" for="">Resultado</label>
				<input class="form-control input-resultados" type="number" dataIPA="${analisis.id_proveedor_analisis}" required>
			</div>
		</div>`)
      })
      try {
        $.ajax({
            type: "POST",
            url: "obtener.php",
            data: "telefono=" + $('#id_producto').val(),
            success: function(r) {
                $('#select2lista').html(r);
            },
            error: function(e){
              console.log(e)
            }
        });
        
      } catch (error) {
        console.log(error)
      }
    }
</script>
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
