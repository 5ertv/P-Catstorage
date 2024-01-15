<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recuperar Contraseña</title>


  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/css/adminlte.min.css">
  <link rel="stylesheet" href="../css/sweetalert2.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1"><b class="mr-1">CAT</b>STORAGE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg mt-3">Olvidaste tu contraseña? Aqui te daremos una nueva.</p>
      <span id="aviso1" class="text-success text-bold">Texto</span>
      <span id="aviso" class="text-danger text-bold">Texto</span>
      <form id="form-recuperar"action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="nombre-recuperar" placeholder="Nombre de usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="email-recuperar" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Pedir nueva contraseña</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="login-box-msg mt-3">Se le enviara una contraseña nueva a su correo electronico.</p>
      <p class="mt-3 mb-1">
        <a href="login.php">Volver al login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<script src="../js/recuperar.js"></script>
<script src="../js/sweetalert2.js"></script>
</body>
</html>
