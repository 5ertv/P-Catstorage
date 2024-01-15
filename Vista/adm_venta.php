<?php
session_start();
if($_SESSION['tipo_us']==3||$_SESSION['tipo_us']==1||$_SESSION['tipo_us']==2){
  include_once 'layouts/header.php'; 
?>

  <title>Lista de Ventas</title>
<?php
  include_once 'layouts/nav.php'
?>
<div class="modal fade" id="vista_venta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="card card-secondary">
            <div class="card-header">
                <button data-dismiss="modal" arial-label="close"class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="card-tittle">Registro de venta</h3>
            </div>
            <div class="card-body">
                  <div class="form-groups">
                    <label for="codigo_venta">Codigo Venta: </label>
                    <span id="codigo_venta"></span>
                  </div>
                  <div class="form-groups">
                    <label for="fecha">Fecha: </label>
                    <span id="fecha"></span>
                  </div>
                  <div class="form-groups">
                    <label for="cliente">cliente: </label>
                    <span id="cliente"></span>
                  </div>
                  <div class="form-groups">
                    <label for="rut">RUT: </label>
                    <span id="rut"></span>
                  </div>
                  <div class="form-groups">
                    <label for="vendedor">Vendedor: </label>
                    <span id="vendedor"></span>
                  </div>
                  <table class="table table-hover text-nowrap responsive">
                    <thead class="table-secondary">
                      <tr>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Producto</th>
                        <th>Descripcion</th>
                        <th>Tipo</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody class="table-warning" id="registros">

                    </tbody>
                  </table>
                  <div class="float-right input-group-append">
                    <h3 class="m-3">Total: </h3>
                    <h3 class="m-3" id="total"></h3>
                  </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-outline-secondary float-right" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
  </div>
</div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Ventas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-tittle">Consultas</h3>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h3 id="venta_dia_vendedor">0</h3>

                          <p>Venta del dia por vendedor</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-user"></i>
                        </div>
                        <a href="adm_mas_consultas.php" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3 id="venta_diaria">0</h3>

                          <p>Venta total del dia</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-shopping-bag"></i>
                        </div>
                        <a href="adm_mas_consultas.php" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3 id="venta_mensual">0</h3>

                          <p>Venta Mensual</p>
                        </div>
                        <div class="icon">
                          <i class="far fa-calendar-alt"></i>
                        </div>
                        <a href="adm_mas_consultas.php" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-light">
                        <div class="inner">
                          <h3 id="venta_anual">0</h3>

                          <p>Venta anual</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-signal"></i>
                        </div>
                        <a href="adm_mas_consultas.php" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-tittle">Buscar ventas</h3>
                </div>
                <div class="card-body">
                <table id="tabla_venta" class="display table table-hover text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>RUT</th>
                            <th>Total</th>
                            <th>Vendedor</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
<script src="../js/Venta.js"></script>
<script src="../js/datatables.js"></script>