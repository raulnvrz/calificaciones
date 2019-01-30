<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Conduent</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
      <br>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Conduent</h1>
            <form action="index.php" name="excel" method="post" enctype="multipart/form-data">
            <input class="d-sm-inline-block btn btn-sm shadow-xs" type="file" name="excelfile" >
            <a href="#" onclick="document.forms['excel'].submit(); return false;" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cargar excel</a>
            </form>
          </div>

                    <!-- Content Row -->
                    <div class="row">

                    <?php 
                      if(isset($_FILES['excelfile'])){
                      
                    ?>
              
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mejor calificación</div>
                        <div class="text-xs font-weight-bold text-default mb-1">Mejor calificación</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
  
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Calificación más baja</div>
                        <div class="text-xs font-weight-bold text-default mb-1">Mejor calificación</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

  
              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Promedio general</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          <div class="row">

          <div class="col-lg-6 mb-4">

          <?php 
          include 'class/simplexlsx.class.php';
          include 'class/calificaciones.class.php';

          if(isset($_FILES['excelfile'])){
            $xlsx = new SimpleXLSX( $_FILES['excelfile']['tmp_name'] );//Instanciamos la clase y le pasamos el parametro del archivo excel

            $alumnos = new Calificaciones($xlsx);

          ?>

            <!-- Alumns Card -->
                   <!-- <div class="col-xl-8 col-lg-7"> -->
                  <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Calificaciones</h6>
                </div>
                <div class="card-body">
                  <?php
                  foreach($alumnos->data() as $key){
                    print '<h4 class="small font-weight-bold">'.$key[0].' '.$key[1].' '.$key[2].' <span class="float-right"> '.$key[5].'</span></h4>';
                    print '<div class="progress mb-4">';
                    print '<div class="progress-bar bg-default" role="progressbar" style="width: '.$alumnos->remove_dot($key[5]).'%"  aria-valuemin="0" aria-valuemax="10"></div>';
                    print '</div>';
                  }

                  ?>
                  </div>
                </div>
              </div>
          </div> 

          <?php
            print '<textarea id="data_chart" style="display:none;">'.json_encode($alumnos->get_grades_average()).'</textarea>';
          }

          ?>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Promedio por grado</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="average_chart"></canvas>
                  </div>
                </div>
              </div>
            </div>


          </div>

          <?php
              }else{

          ?>
                              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                  </div>
                  <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                  <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
              </div>

              <?php
              }
              ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Conduent 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
