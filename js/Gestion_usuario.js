$(document).ready(function(){
    var tipo_usuario = $('#tipo_usuario').val();
    if(tipo_usuario==2){
        $('#button-crear').hide();
    }
    buscar_datos();
    var funcion;
    function buscar_datos(consulta) {
        funcion='buscar_usuarios_adm';
        $.post('../Controlador/UsuarioController.php',{consulta,funcion},(response)=>{
            const usuarios = JSON.parse(response);
            let template='';
            usuarios.forEach(usuario =>{
                template+=`
                <div usuarioId="${usuario.id}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  ${usuario.tipo}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${usuario.nombre}</b></h2>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad: ${usuario.edad}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> RUT: ${usuario.rut}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Ubicacion: ${usuario.ubicacion}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono : ${usuario.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-person"></i></span> Sexo: ${usuario.sexo}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${usuario.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">`;
                  if(tipo_usuario==3){
                    if(usuario.tipo_usuario!=3){
                        template+=`
                        <button class="borrar-usuario btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirmar">
                            <i class="fas fa-window-close mr-1"></i>Eliminar
                        </button>
                        `;
                    }
                    if(usuario.tipo_usuario==2){
                        template+=`
                        <button class="ascender btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                            <i class="fas fa-sort-amount-up mr-1"></i>Ascender
                        </button>
                        `; 
                    }
                    if(usuario.tipo_usuario==1){
                        template+=`
                        <button class="descender btn btn-secondary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                            <i class="fas fa-sort-amount-down mr-1"></i>Descender
                        </button>
                        `; 
                    }
                  }
                  else{
                    if(tipo_usuario==1 && usuario.tipo_usuario!=1 && usuario.tipo_usuario!=3){
                        template+=`
                        <button class="borrar-usuario btn btn-danger" type="button" data-toggle="modal" data-target="#confirmar">
                            <i class="fas fa-window-close mr-1"></i>Eliminar
                        </button>
                        `;
                    }
                  }

                  template+=`
                  </div>
                </div>
              </div>
            </div>
                `;
            });
            $('#usuarios').html(template);
        });
    }
    $(document).on('keyup','#buscar',function(){
        let valor =$(this).val();
        if(valor!=""){
            buscar_datos(valor);
        }
        else{
            buscar_datos();
        }

    });
    $('#form-crear').submit(e=>{
      let nombre = $('#nombre').val();
      let edad = $('#edad').val();
      let rut = $('#rut').val();
      let usu = $('#usu').val();
      let pass = $('#pass').val();
      funcion='crear_usuario';
      $.post('../controlador/UsuarioController.php',{nombre,edad,rut,usu,pass,funcion},(response)=>{
        if(response=='add'){
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Se agrego el usuario",
            showConfirmButton: false,
            timer: 1500
          }).then(function(){
            location.href = 'administrar_user.php'
          })
            $('#form-crear').trigger('reset');
        
        }
        else{
          Swal.fire({
            icon: "error",
            title: "Ups!",
            text: "El usuario que estas creando no puede tener el mismo nombre de un usuario ya creado",
          });
            $('#form-crear').trigger('reset');
        }
        buscar_datos();
      });
      e.preventDefault();
    });
    $(document).on('click','.ascender',(e)=>{
      const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id=$(elemento).attr('usuarioId')
      funcion='ascender';
      $('#id_user').val(id);
      $('#funcion').val(funcion);
    });
    $(document).on('click','.descender',(e)=>{
      const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id=$(elemento).attr('usuarioId')
      funcion='descender';
      $('#id_user').val(id);
      $('#funcion').val(funcion);
    });
    $(document).on('click','.borrar-usuario',(e)=>{
      const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id=$(elemento).attr('usuarioId')
      funcion='borrar-usuario';
      $('#id_user').val(id);
      $('#funcion').val(funcion);
    });
    $('#form-confirmar').submit(e=>{
      let pass=$('#oldpass').val();
      let id_us=$('#id_user').val();
      funcion=$('#funcion').val();
      $.post('../controlador/UsuarioController.php',{pass,id_us,funcion},(response)=>{
        if(response=='ascendido' || response=='descendido' || response=='borrado'){
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Se hizo la modificacion",
            showConfirmButton: false,
            timer: 1500
          }).then(function(){
            location.href = 'administrar_user.php'
          })
          $('#form-confirmar').trigger('reset');
        }
        else{
          Swal.fire({
            icon: "error",
            title: "Ups!",
            text: "Contraseña incorrecta",
          });
          $('#form-confirmar').trigger('reset');
        }
        buscar_datos();
      });
      e.preventDefault();
    });
})