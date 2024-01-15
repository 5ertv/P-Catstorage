<?php
include_once 'Venta.php';
include_once 'VentaProducto.php';
function getHtml($id_venta){
    $venta = new Venta();
    $venta_producto = new VentaProducto();
    $venta->buscar_id($id_venta);
    $venta_producto->ver($id_venta);
    $plantilla='
    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo.jpg" width="60" height="60">
      </div>
      <h1>COMPROBANTE DE PAGO</h1>
      <div id="company" class="clearfix">
        <div id="negocio">CATSTORAGE</div>
        <div>Direccion Numero ###,<br /> Ciudad, Provincia</div>
        <div>(344) 342234</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>';
      foreach ($venta->objetos as $objeto) {
    
      $plantilla.='
    
      <div id="project">
        <div><span>Codigo de Venta: </span>'.$objeto->id_venta.'</div>
        <div><span>Cliente: </span>'.$objeto->cliente.'</div>
        <div><span>RUT: </span>'.$objeto->rut.'</div>
        <div><span>Fecha y Hora: </span>'.$objeto->fecha.'</div>
        <div><span>Vendedor: </span>'.$objeto->vendedor.'</div>
      </div>';
      }
    $plantilla.='
    </header>
    <main>
      <table>
        <thead>
          <tr>   
            <th class="service">Producto</th>
            <th class="service">Descripcion</th>
            <th class="service">Tipo</th>
            <th class="service">Cantidad</th>
            <th class="service">Precio</th>
            <th class="service">Subtotal</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($venta_producto->objetos as $objeto) {
         
          $plantilla.='<tr>
            
            <td class="servic">'.$objeto->producto.'</td>
            <td class="servic">'.$objeto->descripcion.'</td>
            <td class="servic">'.$objeto->tipo.'</td>
            <td class="servic">'.$objeto->cantidad.'</td>
            <td class="servic">'.$objeto->precio.'</td>
            <td class="servic">'.$objeto->subtotal.'</td>
          </tr>';
        }
        $calculos= new Venta();
        $calculos->buscar_id($id_venta);
        foreach ($calculos->objetos as $objeto) {
          $iva=$objeto->total*0.19;
          $sub=$objeto->total-$iva;
          
          $plantilla.='
          <tr>
            <td colspan="8" class="grand total">SUBTOTAL</td>
            <td class="grand total">'.$sub.'</td>
          </tr>
          <tr>
            <td colspan="8" class="grand total">IVA(19%)</td>
            <td class="grand total">'.$iva.'</td>
          </tr>
          <tr>
            <td colspan="8" class="grand total">TOTAL</td>
            <td class="grand total">'.$objeto->total.'</td>
          </tr>';

        }
       $plantilla.='
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">*Presentar este comprobante de pago para cualquier reclamo o devolucion.</div>
        <div class="notice">*El reclamo procedera dentro de las 24 horas de haber hecho la compra.</div>
        <div class="notice">*Si el producto esta dañado o abierto, la devolucion no procedera.</div>
        <div class="notice">*Revise su cambio antes de salir del establecimiento.</div>
      </div>
    </main>
    <footer>
      Creado por CATSTORAGE estudiantes del instituto AIEP.
    </footer>
  </body>';
    return $plantilla;
}
?>