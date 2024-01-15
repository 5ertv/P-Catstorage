<?php
session_start();
if($_SESSION['tipo_us']==3){
  include_once 'layouts/header.php'; 
?>

  <title>Mas consultas</title>
<?php
  include_once 'layouts/nav.php'
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mas consultas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-tittle">Consultas Generales</h3>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Ventas por mes del año actual</h2>
                        <div class="chart-responsive">
                              <canvas id='Grafico1' style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h2>Top 3 vendedor del mes</h2>
                        <div class="chart-responsive">
                              <canvas id='Grafico2' style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                </div>
                <div class="col-md-12">
                        <h2>Top 5 productos mas vendidos</h2>
                        <div class="chart-responsive">
                              <canvas id='Grafico3' style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->


<?php
include_once 'layouts/footer.php';
}
else {
    header('Location: login.php');
}
?>
<script src="../js/Chart.min.js"></script>
<script src="../js/Mas_consultas.js"></script>