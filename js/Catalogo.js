$(document).ready(function(){
    $('#cat-carrito').show();
    mostrar_lotes_riesgo();
    buscar_producto();
    function buscar_producto(consulta) {
        funcion="buscar";
        $.post('../controlador/ProductoController.php',{consulta,funcion},(response)=>{
            const productos = JSON.parse(response);
            let template='';
            productos.forEach(producto=>{
                template+=`
                <div prodId="${producto.id}"prodStock="${producto.stock}"prodNombre="${producto.nombre}"prodPrecio="${producto.precio}"prodDescripcion="${producto.descripcion}"prodTipo="${producto.tipo_id}"prodAvatar="${producto.avatar}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                <i class="fas fa-lg fa-cubes"></i>${producto.stock}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                    <h2 class="lead">Codigo: <b>${producto.id}</b></h2>
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
                    <button class="agregar-carrito btn btn-sm btn-primary">
                      <i class="fas fa-plus-square mr-2"></i> Agregar al carrito
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
    function mostrar_lotes_riesgo() {
        funcion='buscar';
        $.post('../Controlador/LoteController.php',{funcion},(response)=>{
            const lotes= JSON.parse(response);
            let template='';
            lotes.forEach(lote => {
                if(lote.tipo==='Alimentos') {
                  if(lote.estado=='warning'){
                    template+=`
                    <tr class="table-warning">
                        <td>${lote.id}</td>
                        <td>${lote.nombre}</td>
                        <td>${lote.stock}</td>
                        <td>${lote.proveedor}</td>
                        <td>${lote.mes}</td>
                        <td>${lote.dia}</td>
                    </tr>
                    `;
                  }  
                  if(lote.estado=='danger'){
                    template+=`
                    <tr class="table-danger">
                        <td>${lote.id}</td>
                        <td>${lote.nombre}</td>
                        <td>${lote.stock}</td>
                        <td>${lote.proveedor}</td>
                        <td>${lote.mes}</td>
                        <td>${lote.dia}</td>
                    </tr>
                    `;
                  } 
                }
                $('#lotes').html(template);
            });
        })
    }
})