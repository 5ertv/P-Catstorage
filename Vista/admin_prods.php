<?php
session_start();
if($_SESSION['tipo_us']==1 or $_SESSION['tipo_us']==3){
  include_once 'layouts/header.php'; 
?>

  <title>Administrar productos</title>
<?php
  include_once 'layouts/nav.php'
?>
<div class="modal fade" id="FormatoReporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="card card-secondary">
            <div class="card-header">
                <button data-dismiss="modal" arial-label="close"class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="card-tittle">Elige tu formato de reporte</h3>
            </div>
            <div class="card-body">
              <div class="form-group text-center">
                  <button id="button-reporte" class="btn btn-danger">Formato PDF <i class="far fa-file-pdf ml-2"></i></button>
                  <button id="button-reporteExcel" class="btn btn-success ml-3">Formato Excel <i class="far fa-file-excel ml-2"></i></button>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="crearlote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="card card-secondary">
            <div class="card-header">
                <button data-dismiss="modal" arial-label="close"class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="card-tittle">Crear lote</h3>
            </div>
            <div class="card-body">
                  <div class="alert alert-success text-center" id="add-lote" style='display:none;'>
                      <span><i class= "fas fa-check m-1"></i>Se agrego correctamente</span>
                  </div>
                <form id="form-crear-lote">
                <div class="form-groups">
                        <label for="nombre_producto_lote">Producto: </label>
                        <label id="nombre_producto_lote">Nombre de producto</label>
                </div>
                <div class="form-groups">
                        <label for="proveedor">Proveedor: </label>
                        <select name="tipo" id="proveedor" class="form-control select2" style="width: 100%"></select>
                    </div>
                    <div class="form-groups">
                        <label for="stock">Stock: </label>
                        <input id="stock"type="number" class="form-control" placeholder="Ingrese stock" required>
                    </div>
                    <div class="form-groups">
                        <label for="vencimiento">Vencimiento: </label>
                        <input id="vencimiento"type="date" class="form-control" placeholder="Ingrese fecha de vencimiento">
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
<div class="modal fade" id="calcularprecio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="card card-secondary">
            <div class="card-header">
                <button data-dismiss="modal" arial-label="close"class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="card-tittle">Calcular precio</h3>
            </div>
            <div class="card-body">
                  <div class="alert alert-success text-center" id="add-lote" style='display:none;'>
                      <span><i class= "fas fa-check m-1"></i>Se agrego correctamente</span>
                  </div>
                  <form id="precioVentaForm">
                          <label for="costoProduccion">Costo de Producción:</label>
                          <input type="number" id="costoProduccion" class="form-control" placeholder="Ingrese el costo de producción" required>

                          <label for="gastosGenerales">Gastos Generales:</label>
                          <input type="number" id="gastosGenerales" class="form-control" placeholder="Ingrese los gastos generales" required>

                          <label for="margenBeneficio">Margen de Beneficio (%):</label>
                          <input type="number" id="margenBeneficio" class="form-control" placeholder="Ingrese el margen de beneficio" required>
                  </form>
                        <form id="form-resultado">
                          <label >Precio venta:</label>
                          <input type="text" id="resultado" class="form-control" readonly>
                        </form>
  

  <script>
    function calcularPrecioVenta() {
      var costoProduccion = parseInt(document.getElementById('costoProduccion').value) || 0;
      var gastosGenerales = parseInt(document.getElementById('gastosGenerales').value) || 0;
      var margenBeneficioPorcentaje = parseInt(document.getElementById('margenBeneficio').value) || 0;

      var precioVenta = costoProduccion + (costoProduccion * 0.19) + gastosGenerales + (costoProduccion * (margenBeneficioPorcentaje / 100));

      document.getElementById('resultado').value = precioVenta.toFixed(0);
      $('#precioVentaForm').trigger('reset');


    }
    function copyToClipboard() {
            // Seleccionar el campo de entrada
            var resultInput = document.getElementById('resultado');

            // Seleccionar el texto dentro del campo de entrada
            resultInput.select();
            

            // Copiar el texto al portapapeles
            document.execCommand('copy');

            // Desseleccionar el campo de entrada
            resultInput.setSelectionRange(0, 0);
            resultInput.setSelectionRange(0, 99999); // Para dispositivos móviles

            // Alerta al usuario que el texto ha sido copiado
            alert('Resultado copiado al portapapeles: ' + $('#resultado').val());
            $('#form-resultado').trigger('reset');

        }
    

  </script>

  </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-outline-secondary float-right" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="calcularPrecioVenta()">Calcular Precio de Venta</button>
                <button class="btn btn-warning" onclick="copyToClipboard()">Copiar Resultado</button>
            </div>
        </div>
    </div>
  </div>
</div>

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
        <div class="alert alert-success text-center" id="edit" style='display:none;'>
            <span><i class= "fas fa-check m-1"></i>Se cambio el avatar correctamente</span>

        </div>
        <div class="alert alert-danger text-center" id="noedit" style='display:none;'>
          <span><i class= "fas fa-times m-1"></i>Formato invalido</span>
        </div>
        <form id="form-logo" enctype="multipart/form-data">
          <div class="input-group mb-3 ml-5 mt-2">
            <input type="file" name="photo" class="input-group">
            <input type="hidden" name="funcion" id="funcion">
            <input type="hidden" name="id_logo_prod" id="id_logo_prod">
            <input type="hidden" name="avatar" id="avatar">
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
<div class="modal fade" id="crearproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="card card-secondary">
            <div class="card-header">
                <button data-dismiss="modal" arial-label="close"class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="card-tittle">Crear Producto</h3>
            </div>
            <div class="card-body">
                  <div class="alert alert-success text-center" id="add" style='display:none;'>
                      <span><i class= "fas fa-check m-1"></i>Se agrego correctamente</span>
                  </div>
                  <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
                      <span><i class= "fas fa-times m-1"></i>El producto ya existe</span>
                  </div>
                  <div class="alert alert-success text-center" id="edit_prod" style='display:none;'>
                      <span><i class= "fas fa-check m-1"></i>Se edito correctamente</span>
                  </div>
                <form id="form-crear-producto">
                    <div class="form-groups">
                        <label for="nombre_producto">Nombre</label>
                        <input id="nombre_producto"type="text" onkeydown="return soloLetras(event)" class="form-control" placeholder="Ingrese nombre" required>
                    </div>
                    <div class="form-groups">
                        <label for="descripcion">Descripcion</label>
                        <input id="descripcion"type="text" class="form-control" placeholder="Ingrese descripcion" required>
                    </div>
                    <div class="form-groups">
                        <label for="precio">Precio</label>
                        <input id="precio"type="text" step="any" class="form-control" placeholder="Ingrese precio" required>
                    </div>
                    <div class="form-groups">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control select2" style="width: 100%"></select>
                    </div>
                    <input type="hidden" id="id_edit_prod">
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
            <h1>Administrar Productos <button id="button-crear" type="button" data-toggle="modal" data-target="#crearproducto" class="btn bg-gradient-primary ml-2">Crear Producto</button>
            <button type="button" data-toggle="modal" data-target="#calcularprecio" class="btn bg-gradient-secondary ml-2">Calcular precio</button>
            <button type="button" data-toggle="modal" data-target="#FormatoReporte" class="btn bg-gradient-warning ml-2">Reporte de productos</button>
          </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
  </div>
  <!-- /.content-wrapper -->


<?php
include_once 'layouts/footer.php';
}
else {
    header('Location: login.php');
}
?>
<script src="../js/Producto.js"></script>
<script src="../js/soloLetras.js"></script>
<script src="../js/Filtro.js"></script>