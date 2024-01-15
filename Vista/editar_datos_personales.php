<?php
session_start();
if($_SESSION['tipo_us']==1 or $_SESSION['tipo_us']==3 or $_SESSION['tipo_us']==2){
  include_once 'layouts/header.php'; 
?>

  <title>Editar Datos</title>
  <?php
  include_once 'layouts/nav.php'
  ?>


<!-- Modal -->
<div class="modal fade" id="cambiocontra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Contraseña</h1>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img id="avatar1"src="../img/gato2.jpg " class="profile-user-img img-fluid img-circle" alt="">
        </div>
        <div class="text-center">
          <b>
            <?php
            echo $_SESSION['n_y_ap'];
            ?>
          </b>
        </div>
        <div class="alert alert-success text-center" id="update" style='display:none;'>
            <span><i class= "fas fa-check m-1"></i>Se cambio correctamente la contraseña</span>

        </div>
        <div class="alert alert-danger text-center" id="noupdate" style='display:none;'>
          <span><i class= "fas fa-times m-1"></i>La contraseña no es correcta</span>
        </div>
        <form id="form-pass">
          <dib class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
            </div>
            <input id="oldpass" type="password" class="form-control" placeholder="Ingrese contraseña actual">
          </dib>
          <dib class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input id="newpass" type="password" class="form-control" placeholder="Ingrese nueva contraseña" minlength="8">
          </dib>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
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
          <img id="avatar2"src="../img" class="profile-user-img img-fluid img-circle" alt="">
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
            <h1>Datos personales</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class=" card card-secondary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img id="avatar3"src="../img/gato2.jpg" class="profile-user-img img-fluid img-circle">
                                </div>
                                <div class="text-center mt-1">
                                  <button type='button' data-toggle="modal" data-target="#cambiophoto" class="btn btn-primary btn-sm">Cambiar Avatar</button>
                                </div>
                                <input id="id_us" type="hidden" value="<?php echo $_SESSION['usuario']?>">
                                <h3 id="n_y_ap"class="profile-username text-center text-secondary">Nombre y apellido</h3>
                                  <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                      <b style="color: #5e6063">Edad</b><a id="edad"class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">
                                     <b style="color: #5e6063">RUT</b><a id="rut_us" class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">
                                      <b style="color: #5e6063">Tipo Usuario</b>
                                      <span id="tipo_us"class="float-right badge badge-danger">Administrador</span>
                                    </li>
                                    <button data-toggle="modal" data-target="#cambiocontra" type="button" class="btn btn-block btn-outline-warning btn-sm">Cambiar Contraseña</button>
                                </ul>
                            </div>
                        </div>
                        <div class="card card-secondary">
                          <div class="card-header">
                            <h4 class="card-tittle">Sobre mi</h4>
                          </div>
                          <div class="card-body">
                            <strong style="color: #5e6063">
                              <i class="fas fa-phone mr-1"></i>Telefono
                            </strong>
                            <p id="telefono_us" class="text-muted">+56 9 3912 9023</p>
                            <strong style="color: #5e6063">
                              <i class="fas fa-map-marker-alt mr-1"></i>Ubicacion
                            </strong>
                            <p id="ubicacion_us"class="text-muted">San antonio</p>
                            <strong style="color: #5e6063">
                              <i class="fas fa-at mr-1"></i>Correo
                            </strong>
                            <p id="correo_us" class="text-muted">@email.com</p>
                            <strong style="color: #5e6063">
                              <i class="fas fa-person mr-1"></i>Sexo
                            </strong>
                            <p id="sexo_us"class="text-muted">Masculino</p>
                            <button class=" edit btn btn-block btn-outline-warning btn-sm">Editar</button>
                          </div>
                          <div class="card-footer">
                            <p class="text-muted">Tip: Presionando el boton puedes editar tus datos :D</p>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                      <div class="card card-secondary">
                        <div class="card-header">
                          <h4 class="card-title">Editar datos personales</h4>
                        </div>
                        <div class="card-body">
                          <div class="alert alert-success text-center" id="editado" style='display:none;'>
                          <span><i class= "fas fa-check m-1"></i>Editado</span>

                          </div>
                          <div class="alert alert-danger text-center" id="noeditado" style='display:none;'>
                          <span><i class= "fas fa-times m-1"></i>Edicion deshabilitada</span>

                          </div>
                          <form id="form-usuario" class="form-horizontal">
                            <div class="form-group row">
                              <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                              <div class="col-sm-10">
                              <input type="number" id="telefono" class="form-control" maxlength="9">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="ubicacion" class="col-sm-2 col-form-label">Ubicacion</label>
                              <div class="col-sm-10">
                              <input type="text" id="ubicacion" class="form-control">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                              <div class="col-sm-10">
                              <input type="email" id="correo" class="form-control">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                              <div class="col-sm-10">
                              <input type="text" id="sexo" class="form-control">
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10 float-right">
                                <button id="btn"class="btn btn-block btn-outline-success">Guardar</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="card-footer">
                            <p class="text-muted">Verifica que tus datos esten correctos antes de apretar el boton</p>
                        </div>
                      </div>
                    </div>
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
<script src="../js/Usuario.js"></script>
<script src="../js/Filtro.js"></script>


