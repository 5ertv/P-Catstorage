$(document).ready(function(){
    var funcion;
    var edit=false;
    $('.select2').select2();
    rellenar_tipos();
    buscar_producto();
    rellenar_proveedores();
    function rellenar_proveedores() {
      funcion="rellenar_proveedores";
      $.post('../Controlador/ProveedorController.php',{funcion},(response)=>{
          const proveedores = JSON.parse(response);
          let template='';
          proveedores.forEach(proveedor => {
              template+=`
              <option value="${proveedor.id}">${proveedor.nombre}</option>
              `;
          });
          $('#proveedor').html(template);
      })
  }
    function rellenar_tipos() {
        funcion="rellenar_tipos";
        $.post('../Controlador/TipoController.php',{funcion},(response)=>{
            const tipos = JSON.parse(response);
            let template='';
            tipos.forEach(tipo => {
                template+=`
                <option value="${tipo.id}">${tipo.nombre}</option>
                `;
            });
            $('#tipo').html(template);
        })
    }
    $('#form-crear-producto').submit(e=>{
        let id=$('#id_edit_prod').val();
        let nombre = $('#nombre_producto').val();
        let descripcion = $('#descripcion').val();
        let precio = $('#precio').val();
        let tipo = $('#tipo').val();
        if(edit==true){
          funcion="editar";
        }
        else{
          funcion="crear";
        }
        $.post('../Controlador/ProductoController.php',{funcion,id,nombre,descripcion,precio,tipo},(response)=>{
            if(response=='add'){
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Se creo el producto",
                showConfirmButton: false,
                timer: 1500
              });
                $('#form-crear-producto').trigger('reset');
                buscar_producto();
            }
            if(response=='edit'){
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Se edito el producto",
                showConfirmButton: false,
                timer: 1500
              });
                $('#form-crear-producto').trigger('reset');
                buscar_producto();
            }
            if(response=='noadd'){
              Swal.fire({
                icon: "error",
                title: "Ups!",
                text: "No se agrego el producto",
              });
              $('#form-crear-producto').trigger('reset');
            }
            if(response=='noedit'){
              Swal.fire({
                icon: "error",
                title: "Ups!",
                text: "No se edito el producto",
              });
              $('#form-crear-producto').trigger('reset');
            }
            edit=false;
            
        });
        e.preventDefault();
    });
    function buscar_producto(consulta) {
        funcion="buscar";
        $.post('../controlador/ProductoController.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto=>{
                template+=`
                <div prodId="${producto.id}"prodNombre="${producto.nombre}"prodPrecio="${producto.precio}"prodDescripcion="${producto.descripcion}"prodTipo="${producto.tipo_id}"prodAvatar="${producto.avatar}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                <i class="fas fa-lg fa-cubes"></i>${producto.stock}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${producto.nombre}</b></h2>
                      <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${producto.precio}</b></h4>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fa-solid fa-comment"></i></span> Descripcion: ${producto.descripcion}</li>
                        <li class="small"><span class="fa-li"><i class="fa-solid fa-tag"></i></span> Categoria: ${producto.tipo}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i> Cambiar Imagen
                    </button>
                    <button class=" editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#crearproducto">
                      <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                    <button class="lote btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#crearlote">
                      <i class="fas fa-plus-square"></i> Agregar mas
                    </button>
                    <button class="borrar btn btn-sm btn-danger">
                      <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                  </div>
                </div>
              </div>
            </div>
                `;
            });
            $('#productos').html(template);
        });
    }
    $(document).on('keyup','#buscar-producto',function(){
        let valor =$(this).val();
        if(valor!=""){
            buscar_producto(valor);
        }
        else{
            buscar_producto();
        }

    });
    $(document).on('click','.avatar',(e)=>{
        funcion="cambiar_avatar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const avatar = $(elemento).attr('prodAvatar');
        const nombre = $(elemento).attr('prodNombre');
        $('#funcion').val(funcion);
        $('#id_logo_prod').val(id);
        $('#avatar').val(avatar);
        $('#logoactual').attr('src',avatar);
        $('#nombre_logo').html(nombre);
    });
    $(document).on('click','.lote',(e)=>{
      const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id = $(elemento).attr('prodId');
      const nombre = $(elemento).attr('prodNombre');
      $('#id_lote_prod').val(id);
      $('#nombre_producto_lote').html(nombre);
  });
    $('#form-logo').submit(e=>{
      let formData = new FormData($('#form-logo')[0]);
      $.ajax({
        url:'../Controlador/ProductoController.php',
        type:'POST',
        data:formData,
        cache:false,
        processData: false,
        contentType:false
        }).done(function(response){
        const json = JSON.parse(response);
        if(json.alert=='edit'){
          $('#logoactual').attr('src',json.ruta);
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Se edito la foto del producto",
            showConfirmButton: false,
            timer: 1500
          });
          $('#form-logo').trigger('reset');
          buscar_producto();
        }
        else{
          Swal.fire({
            icon: "error",
            title: "Ups!",
            text: "Formato invalido",
          });
          $('#form-logo').trigger('reset');
        }
      });
      e.preventDefault();
    });
    $(document).on('click','.editar',(e)=>{
      const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id = $(elemento).attr('prodId');
      const nombre = $(elemento).attr('prodNombre');
      const descripcion = $(elemento).attr('prodDescripcion');
      const precio = $(elemento).attr('prodPrecio');
      const tipo = $(elemento).attr('prodTipo');
      $('#id_edit_prod').val(id);
      $('#nombre_producto').val(nombre);
      $('#descripcion').val(descripcion);
      $('#precio').val(precio);
      $('#tipo').val(tipo).trigger('change');
      edit=true;
  });
  $(document).on('click','.borrar',(e)=>{
    funcion="borrar";
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('prodId');
    const nombre = $(elemento).attr('prodNombre');
    const avatar = $(elemento).attr('prodAvatar');
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger mr-1"
      },
      buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
      title: 'Desea eliminar '+nombre+'?',
      text: "No podras revertir esto!",
      imageUrl:''+avatar+'',
      imageWidth: 100,
      imageHeight: 100,
      showCancelButton: true,
      confirmButtonText: "Si, borra esto!",
      cancelButtonText: "No, cancelar!",
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
        $.post('../controlador/ProductoController.php',{id,funcion},(response)=>{
            edit==false;
                if(response=='borrado'){
                  swalWithBootstrapButtons.fire(
                    'Borrado!',
                    'El Producto '+nombre+' fue borrado.',
                    'success'
                  )
                  buscar_producto();
                }
                else{
                  swalWithBootstrapButtons.fire(
                        'No se pudo borrar!',
                        'El Producto '+nombre+' no fue borrado porque esta siendo utilizado en un lote o en una venta (Se necesita el producto para hacer el analisis de ventas).',
                        'error'
                  )
                }
        })

      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire(
              'Cancelado',
              'El Producto '+nombre+' no fue borrado.',
              'error'
        )
      }
    })
  })
  $('#form-crear-lote').submit(e=>{
    let id_producto=$('#id_lote_prod').val();
    let proveedor=$('#proveedor').val();
    let stock=$('#stock').val();
    let vencimiento=$('#vencimiento').val();
    funcion='crear';
    $.post('../Controlador/LoteController.php',{funcion,vencimiento,stock,proveedor,id_producto},(response)=>{
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Se agrego el lote",
        showConfirmButton: false,
        timer: 1500
      });
          $('#form-crear-lote').trigger('reset');
          buscar_producto();
    });
    

    e.preventDefault();
  });
  $(document).on('click','#button-reporte',(e)=>{
    Mostrar_Loader("generarReportePDF");
    funcion = 'reporte_productos';
    $.post('../controlador/ProductoController.php',{funcion},(response)=>{
      console.log(response);
      if(response==""){
        Cerrar_Loader("exito_reporte");
        window.open('../pdf/pdf-'+funcion+'.pdf','_blank')
      }
      else{
        Cerrar_Loader("error_reporte");
      }
    });
  });
  $(document).on('click','#button-reporteExcel',(e)=>{
    Mostrar_Loader("generarReportePDF");
    funcion = 'reporte_productosExcel';
    $.post('../controlador/ProductoController.php',{funcion},(response)=>{
      console.log(response);
      if(response==""){
        Cerrar_Loader("exito_reporte");
        window.open('../Excel/reporte_productos.xlsx','_blank')
      }
      else{
       Cerrar_Loader("error_reporte");
      }
    });
  });
  function Mostrar_Loader(mensaje){
    var texto = null;
    var mostrar= false;
    switch (mensaje) {
      case 'generarReportePDF':
        texto = 'Se esta generando el reporte, porfavor espere...';
        mostrar = true;
        break;
    }
    if (mostrar) {
      swal.fire({
        title: 'Generando reporte',
        text: texto,
        showConfirmButton: false
      })
    }
  }
  function Cerrar_Loader(mensaje){
    var tipo = null;
    var texto = null;
    var mostrar = null;
    switch (mensaje) {
      case 'exito_reporte':
          tipo="success";
          texto="Se genero el reporte correctamente."
          mostrar= true;
          break;
          case 'error_reporte':
            tipo="error";
            texto="El reporte no se genero, contactese con el personal del sistema."
            mostrar= true;
            break;
      default:
          swal.close();
        break;
    }
    if (mostrar) {
      swal.fire({
          position: 'center',
          icon: tipo,
          text: texto,
          showConfirmButton: false
      })
    }
  }
})