<?php
session_start();
if($_SESSION['tipo_us']==1 or $_SESSION['tipo_us']==3){
  include_once 'layouts/header.php'; 
?>

  <title>Administrar usuarios</title>
  <?php
  include_once 'layouts/nav.php'
  ?>


<!-- Modal -->
<div class="modal fade" id="confirmar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar accion</h1>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <h2>
            <?php
            echo $_SESSION['n_y_ap'];
            ?>
          </h2>
        </div>
        <span>Necesitamos su contraseña para continuar</span>
        <div class="alert alert-success text-center" id="confirmado" style='display:none;'>
            <span><i class= "fas fa-check m-1"></i>Se modifico el rol de usuario</span>

        </div>
        <div class="alert alert-danger text-center" id="rechazar" style='display:none;'>
          <span><i class= "fas fa-times m-1"></i>La contraseña no es correcta</span>
        </div>
        <form id="form-confirmar">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
            </div>
            <input id="oldpass" type="password" class="form-control" placeholder="Ingrese contraseña actual">
            <input type="hidden" id="id_user">
            <input type="hidden" id="funcion">
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
<div class="modal fade" id="crearusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="card card-secondary">
            <div class="card-header">
                <button data-dismiss="modal" arial-label="close"class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="card-tittle">Crear Usuario</h3>
            </div>
            <div class="card-body">
                  <div class="alert alert-success text-center" id="add" style='display:none;'>
                      <span><i class= "fas fa-check m-1"></i>Se creo correctamente</span>
                  </div>
                  <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                      <span><i class= "fas fa-times m-1"></i>El nombre de usuario ya existe</span>
                  </div>
                <form id="form-crear">
                    <div class="form-groups">
                        <label for="nombre">Nombre y Apellido</label>
                        <input id="nombre"type="text" class="form-control" placeholder="Ingrese nombre" required onkeydown="return soloLetras(event)">
                    </div>
                    <div class="form-groups">
                        <label for="edad">Nacimiento</label>
                        <input id="edad"type="date" class="form-control" placeholder="Ingrese fecha de nacimiento" required>
                    </div>
                    <div class="form-groups">
                        <label for="rut">RUT</label>
                        <input id="rut"type="text" class="form-control" placeholder="Ingrese RUT" required> 
                        <button type="button" id="btn-validar" class="btn btn-danger" > Validar rut </button> <p id="resultado"></p>
                    </div>
                    <div class="form-groups">
                        <label for="usu">Usuario</label>
                        <input id="usu"type="text" min="4" class="form-control" placeholder="Ingrese usuario" required minlength="5" maxlength="15">
                    </div>
                    <div class="form-groups">
                        <label for="pass">Contraseña</label>
                        <input id="pass"type="text" min="8" class="form-control" placeholder="Ingrese contraseña" required minlength="8" maxlength="15">
                    </div>

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
<div class="modal fade" id="cambiophoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Avatar</h1>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img id="avatar4"src="../img/" class="profile-user-img img-fluid img-circle" alt="">
        </div>
        <div class="text-center">
          <b>
            <?php
            echo $_SESSION['n_y_ap'];
            ?>
          </b>
        </div>
        <div class="alert alert-success text-center" id="edit" style='display:none;'>
            <span><i class= "fas fa-check m-1"></i>Se cambio el avatar correctamente</span>

        </div>
        <div class="alert alert-danger text-center" id="noedit" style='display:none;'>
          <span><i class= "fas fa-times m-1"></i>Formato invalido</span>
        </div>
        <form id="form-photo" enctype="multipart/form-data">
          <div class="input-group mb-3 ml-5 mt-2">
            <input type="file" name="photo" class="input-group">
            <input type="hidden" name="funcion" value="cambiar_foto">
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




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Usuarios <button id="button-crear" type="button" data-toggle="modal" data-target="#crearusuario" class="btn bg-gradient-primary ml-2">Crear Usuario</button></h1>
            <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['tipo_us']?>">

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-tittle">Buscar usuario</h3>
                    <div class="input-group">
                        <input type="text" id="buscar" class="form-control float-left" placeholder="Ingrese nombre de usuario">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div id="usuarios" class="row d-flex align-items-stretch">

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
<script src="../js/Gestion_usuario.js"></script>
<script src="../js/RutValidador.js"></script>
<script src="../js/funciones.js"></script>
<script src="../js/Filtro.js"></script>
<script src="../js/soloLetras.js"></script>

