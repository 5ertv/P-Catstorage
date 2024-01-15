<?php
session_start();
if($_SESSION['tipo_us']==1 or $_SESSION['tipo_us']==3){
  include_once 'layouts/header.php'; 
?>

  <title>Administrar Proveedores</title>
  <?php
  include_once 'layouts/nav.php'
  ?>


<!-- Modal -->
<div class="modal fade" id="cambiologo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar logo</h1>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img id="logoactual"src="../img" class="profile-user-img img-fluid img-circle" alt="">
        </div>
        <div class="text-center">
          <b id="nombre_logo">
          </b>
        </div>
        <div class="alert alert-success text-center" id="edit-prov" style='display:none;'>
            <span><i class= "fas fa-check m-1"></i>Se cambio el avatar correctamente</span>

        </div>
        <div class="alert alert-danger text-center" id="noedit-prov" style='display:none;'>
          <span><i class= "fas fa-times m-1"></i>Formato invalido</span>
        </div>
        <form id="form-logo" enctype="multipart/form-data">
          <div class="input-group mb-3 ml-5 mt-2">
            <input type="file" name="photo" class="input-group">
            <input type="hidden" name="funcion" id="funcion">
            <input type="hidden" name="id_logo_prov" id="id_logo_prov">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="crearproveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="card card-secondary">
            <div class="card-header">
                <button data-dismiss="modal" arial-label="close"class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="card-tittle">Crear Proveedor</h3>
            </div>
            <div class="card-body">
                  <div class="alert alert-success text-center" id="add-prov" style='display:none;'>
                      <span><i class= "fas fa-check m-1"></i>Se creo correctamente</span>
                  </div>
                  <div class="alert alert-danger text-center" id="noadd-prov" style='display:none;'>
                      <span><i class= "fas fa-times m-1"></i>El proveedor ya existe</span>
                  </div>
                  <div class="alert alert-success text-center" id="edit-provn" style='display:none;'>
                      <span><i class= "fas fa-check m-1"></i>Se modifico correctamente</span>
                  </div>
                <form id="form-crear">
                    <div class="form-groups">
                        <label for="nombre">Nombre</label>
                        <input id="nombre"type="text" onkeydown="return soloLetras(event)" class="form-control" placeholder="Ingrese nombre" required>
                    </div>
                    <div class="form-groups">
                        <label for="telefono">Telefono</label>
                        <input id="telefono"type="text" class="form-control" placeholder="Ingrese Telefono" required>
                    </div>
                    <div class="form-groups">
                        <label for="correo">Correo</label>
                        <input id="correo"type="email" class="form-control" placeholder="Ingrese correo">
                    </div>
                    <div class="form-groups">
                        <label for="direccion">Direccion</label>
                        <input id="direccion"type="text" class="form-control" placeholder="Ingrese direccion" required>
                    </div>
                    <input type="hidden" id="id_edit_prov">

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
            <h1>Administrar proveedor <button type="button" data-toggle="modal" data-target="#crearproveedor" class="btn bg-gradient-primary ml-2">Crear Proveedor</button></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-tittle">Buscar proveedor</h3>
                    <div class="input-group">
                        <input type="text" id="buscar_proveedor" class="form-control float-left" placeholder="Ingrese nombre de proveedor">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div id="proveedores" class="row d-flex align-items-stretch">

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
<script src="../js/Proveedor.js"></script>
<script src="../js/soloLetras.js"></script>
<script src="../js/Filtro.js"></script>