$(document).ready(function(){
    calcularTotal();
    Contar_productos();
    RecuperarLS_carrito();
    RecuperarLS_carrito_compra();
    $(document).on('click.','.agregar-carrito',(e)=>{
      const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id = $(elemento).attr('prodId');
      const nombre = $(elemento).attr('prodNombre');
      const descripcion = $(elemento).attr('prodDescripcion');
      const precio = $(elemento).attr('prodPrecio');
      const tipo = $(elemento).attr('prodTipo');
      const avatar = $(elemento).attr('prodAvatar');
      const stock = $(elemento).attr('prodStock');
        const producto={
            id: id,
            nombre: nombre,
            descripcion: descripcion,
            precio: precio,
            tipo: tipo,
            avatar: avatar,
            stock:stock,
            cantidad:1
        }
        let id_producto;
        let productos;
        productos = RecuperarLS();
        productos.forEach(prod => {
            if(prod.id===producto.id){
                id_producto=prod.id;
            }
            
        });
        if(id_producto === producto.id){
            Swal.fire({
                icon: "error",
                title: "Ups...",
                text: "El producto ya existe!",
              });
        }
        else{
            template=`
            <tr prodId="${producto.id}">
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>${producto.descripcion}</td>
                <td>${producto.precio}</td>
                <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
            </tr>
        `;
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Se ha agregado el producto al carrito',
          showConfirmButton: false,
          timer: 1500
        })
        $('#lista').append(template);
        AgregarLS(producto);
        let contador;
        Contar_productos();
        }

    })
    $(document).on('click.','.borrar-producto',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        elemento.remove();
        Eliminar_producto_LS(id);
        Contar_productos();
        calcularTotal();
      })
      $(document).on('click.','#vaciar-carrito',(e)=>{
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Se vacio el carrito',
          showConfirmButton: false,
          timer: 1500
        })
        $('#lista').empty();
        EliminarLS();
        Contar_productos();
      })
      $(document).on('click','#procesar-pedido',(e)=>{
        Procesar_pedido();
      })
      $(document).on('click','#procesar-compra',(e)=>{
        Procesar_compra();
      })
      function RecuperarLS() {
        let productos;
        if(localStorage.getItem('productos')===null){
            productos=[];
        }
        else{
            productos= JSON.parse(localStorage.getItem('productos'))
        }
        return productos
        
      }
      function AgregarLS(producto) {
        let productos;
        productos = RecuperarLS();
        productos.push(producto);
        localStorage.setItem('productos',JSON.stringify(productos))
      }
      function RecuperarLS_carrito() {
        let productos,id_producto;
        productos = RecuperarLS();
        funcion="buscar_id";
        productos.forEach(producto => {
          id_producto=producto.id;
          $.post('../Controlador/ProductoController.php',{funcion,id_producto},(response)=>{
            let template_carrito='';
            let json = JSON.parse(response);
            template_carrito=`
              <tr prodId="${json.id}">
                  <td>${json.id}</td>
                  <td>${json.nombre}</td>
                  <td>${json.descripcion}</td>
                  <td>${json.precio}</td>
                  <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
              </tr>
            `;
            $('#lista').append(template_carrito);
          })
        });
      }
      function Eliminar_producto_LS(id){
        let productos;
        productos = RecuperarLS();
        productos.forEach(function(producto,indice) {
            if(producto.id===id){
                productos.splice(indice,1);
            }
        });
        localStorage.setItem('productos',JSON.stringify(productos));
      }
      function EliminarLS() {
        localStorage.clear();
      }
      function Contar_productos() {
        let productos;
        let contador=0;
        productos=RecuperarLS();
        productos.forEach(producto => {
          contador++;
        });
        $('#contador').html(contador);
      }
      function Procesar_pedido() {
        let productos;
        productos= RecuperarLS();
        if(productos.length ===0){
          Swal.fire({
            icon: "error",
            title: "Ups...",
            text: "El Carrito esta vacio!",
          });
        }
        else{
          location.href = '../vista/adm_compra.php';
        }
      }
      async function RecuperarLS_carrito_compra(){
         let productos;
         productos = RecuperarLS();
         funcion="traer_productos";
         const response = await fetch('../Controlador/ProductoController.php',{
           method: 'POST',
           headers:{'Content-Type':'application/x-www-form-urlencoded'},
           body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
         })
         let resultado = await response.text();
         $('#lista-compra').append(resultado);
      }

      $(document).on('click','#actualizar',(e)=>{
        let productos,precios;
        precios=document.querySelectorAll('.precio');
        productos=RecuperarLS();
        productos.forEach(function(producto,indice){
            producto.precio = precios[indice].textContent;
        });
        localStorage.setItem('productos',JSON.stringify(productos));
        calcularTotal();
      })
      $('#cp').keyup((e)=>{
        let id, cantidad,producto,productos,montos,precio;
        producto= $(this)[0].activeElement.parentElement.parentElement;
        id = $(producto).attr('prodId');
        precio = $(producto).attr('prodPrecio');
        cantidad = producto.querySelector('input').value;
        montos = document.querySelectorAll('.subtotales');
        productos = RecuperarLS();
        productos.forEach(function(prod,indice) {
          if(prod.id === id){
            prod.cantidad = cantidad;
            prod.precio = precio;
            montos[indice].innerHTML = `<h5>${cantidad*precio}</h5>`;
          }
        });
        localStorage.setItem('productos',JSON.stringify(productos));
        calcularTotal();
      })
      function calcularTotal() {
        let productos,subtotal,con_iva,total_sin_descuento,pago,vuelto,descuento;
        let total=0,iva=0.19;
        productos=RecuperarLS();
        productos.forEach(producto => {
          let subtotal_producto = Number(producto.precio * producto.cantidad);
          total=total+subtotal_producto;
        });
        pago=$('#pago').val();
        descuento=$('#descuento').val();
        total_sin_descuento=total;
        con_iva=total*iva;
        subtotal=total-con_iva;

        total=total-descuento;
        vuelto=pago-total;
        $('#subtotal').html(subtotal);
        $('#con_iva').html(con_iva);
        $('#total_sin_descuento').html(total_sin_descuento);
        $('#total').html(total);
        $('#vuelto').html(vuelto);
        
      }
      function Procesar_compra() {
        let nombre,rut;
        nombre=$('#cliente').val();
        rut=$('#rut').val();
        if(RecuperarLS().length == 0){
          Swal.fire({
            icon: "error",
            title: "Ups...",
            text: "No hay productos, Selecciona algunos!",
          }).then(function(){
            location.href = '../Vista/admin_cat.php'
          })
        }
        else if(nombre==''){
          Swal.fire({
            icon: "error",
            title: "Ups...",
            text: "El cliente necesita un nombre, Porfavor agregalo!",
          });
        }
        else if(rut==''){
          Swal.fire({
            icon: "error",
            title: "Ups...",
            text: "El cliente necesita un rut, Porfavor agregalo!",
          });
        }
        else{
          Verificar_stock().then(error=>{
            if(error==0){      
              Registrar_compra(nombre,rut);        
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Se realizo la compra!",
                showConfirmButton: false,
                timer: 1500,
              }).then(function(){
                EliminarLS();
                location.href = '../Vista/admin_cat.php'
              })
            }
            else{
              Swal.fire({
                icon: "error",
                title: "Ups...",
                text: "Hay conflicto en el stock de algun producto!",
              });
            }
          });
        }
      }
      async function Verificar_stock(){
        let productos;
        funcion='verificar_stock';
        productos=RecuperarLS();
        const response = await fetch('../Controlador/ProductoController.php',{
          method: 'POST',
          headers:{'Content-Type':'application/x-www-form-urlencoded'},
          body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
        })
        let error = await response.text();

        return error;
      }
      function Registrar_compra(nombre,rut) {
        funcion='registrar_compra';
        let total=$('#total').get(0).textContent;
        let productos=RecuperarLS();
        let json = JSON.stringify(productos);
        $.post('../Controlador/CompraController.php',{funcion,total,nombre,rut,json},(response)=>{
          console.log(response);
        })
      }
})