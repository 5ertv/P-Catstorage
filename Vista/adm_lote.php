<?php
session_start();
if($_SESSION['tipo_us']==3||$_SESSION['tipo_us']==1){
  include_once 'layouts/header.php'; 
?>

  <title>Administrar Lotes</title>
<?php
  include_once 'layouts/nav.php'
?>
<div class="modal fade" id="editarlote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="card card-secondary">
            <div class="card-header">
                <button data-dismiss="modal" arial-label="close"class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="card-tittle">Editar lote</h3>
            </div>
            <div class="card-body">
                  <div class="alert alert-success text-center" id="edit-lote" style='display:none;'>
                      <span><i class= "fas fa-check m-1"></i>Se edito correctamente</span>
                  </div>
                <form id="form-editar-lote">
                <div class="form-groups">
                        <label for="codigo_lote">Codigo lote: </label>
                        <label id="codigo_lote">Codigo lote</label>
                </div>
                    <div class="form-groups">
                        <label for="stock">Stock: </label>
                        <input id="stock"type="number" class="form-control" placeholder="Ingrese stock" required>
                    </div>
                    <input type="hidden" id="id_lote_prod">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn bg-gradient-primary float-right">Guardar</button>
                </form>
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
            <h1>Administrar lotes</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-tittle">Buscar lotes</h3>
                    <div class="input-group">
                        <input type="text" id="buscar-lote" class="form-control float-left" placeholder="Ingrese nombre de producto">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div id="lotes" class="row d-flex align-items-stretch">

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
<script src="../js/Lote.js"></script>