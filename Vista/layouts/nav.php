<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/datatables.css">
<link rel="stylesheet" href="../css/main.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/css/adminlte.min.css">
    <!-- select2 -->
  <link rel="stylesheet" href="../css/select2.css">
      <!-- sweetalert2 -->
  <link rel="stylesheet" href="../css/sweetalert2.css">
  <link rel="stylesheet" href="../css/compra.css">
  <link rel="stylesheet" href="../css/number.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../Vista/admin_cat.php" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../ayuda.php" class="nav-link">Soporte</a>
      </li>
      <li class="nav-item dropdown" id="cat-carrito" style="display:none">
          <img src="../img/carrito.png" class=" imagen carrito nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true">
            <span id="contador" class="contador badge badge-danger"></span>
          </img>
          <div class="carro dropdown-menu" aria-labelledby="navbarDropdown">
            <table class="table table-hover text-nowrap p-0">
              <thead class="table-secondary">
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody id="lista">

              </tbody>
            </table>
            <a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Procesar compra</a>
            <a href="#" id="vaciar-carrito" class="btn btn-primary btn-block">Vaciar carrito</a>
          </div>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <a href="../Controlador/logout.php" class="nav-link">Cerrar sesion</a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../Vista/admin_cat.php" class="brand-link">
      <img src="../img/logo.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span id="nombre_pyme" class="brand-text font-weight-light">
      CATSTORAGE
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <h2 class="text-center text-light">Bienvenido: </h2>
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img id="avatar4" src="../img/" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="editar_datos_personales.php" class="d-block">
            <?php
            echo $_SESSION['n_y_ap'];
            ?>
          </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Usuario</li>
          <li class="nav-item">
            <a href="editar_datos_personales.php" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Mi Perfil
              </p>
            </a>
          </li>
          <li id="administrar_usuario" class="nav-item">
            <a href="administrar_user.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Administrar Usuarios
              </p>
            </a>
          </li>
          <li  id="administrar_producto1" class="nav-header">Almacen</li>
          <li id="administrar_producto" class="nav-item">
            <a href="admin_prods.php" class="nav-link">
            <i class="fa-brands fa-dropbox"></i>
              <p>
                Lista de Productos
              </p>
            </a>
          </li>
          <li id="administrar_lotes" class="nav-item">
            <a href="adm_lote.php" class="nav-link">
            <i class="fas fa-cubes"></i>
              <p>
                Lista de lotes
              </p>
            </a>
          </li>
          <li class="nav-header">Ventas</li>
          <li id="administrar_ventas" class="nav-item">
            <a href="adm_venta.php" class="nav-link">
            <i class="fas fa-notes-medical"></i>
              <p>
                Lista de Ventas
              </p>
            </a>
          </li>
          <li id="administrar_proveedor1" class="nav-header">Compras</li>
          <li  id="administrar_proveedor" class="nav-item">
            <a href="adm_prov.php" class="nav-link">
            <i class="fa-solid fas fa-truck"></i>
              <p>
                Proveedor Externo
              </p>
            </a>
          </li>
          <li id="ver_analisis1" class="nav-header">Analisis</li>
          <li  id="ver_analisis" class="nav-item">
            <a href="../vista/adm_mas_consultas.php" class="nav-link">
            <i class="fa-solid fa-arrow-trend-up"></i>
              <p>
                Analisis de venta
              </p>
            </a>
          </li>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
