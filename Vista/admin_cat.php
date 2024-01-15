<?php
session_start();
if($_SESSION['tipo_us']==1 or $_SESSION['tipo_us']==3 or $_SESSION['tipo_us']==2){
  include_once 'layouts/header.php'; 
?>

  <title>Catalogo</title>
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
            <h1>Catalogo</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section>
        <div class="container-fluid">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-tittle">Lotes en riesgo</h3>
                </div>
                <div class="card-body p-0 table-responsive">
                  <table class="table table-hover text-nowrap">
                    <thead class="table-info">
                      <tr>
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Proveedor</th>
                        <th>Mes</th>
                        <th>Dias</th>
                      </tr>
                    </thead>
                    <tbody id="lotes" class="table-active">

                    </tbody>
                  </table>
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
                    <h3 class="card-tittle">Buscar Producto</h3>
                    <div class="input-group">
                        <input type="text" id="buscar-producto" class="form-control float-left" placeholder="Ingrese nombre de producto">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div id="productos" class="row d-flex align-items-stretch">

                  </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php
include_once 'layouts/footer.php';
}
else {
    header('Location: login.php');
}
?>
<script src="../js/Catalogo.js"></script>
<script src="../js/Carrito.js"></script>