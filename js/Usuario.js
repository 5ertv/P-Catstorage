$(document).ready(function(){
    var funcion='';
    var id_us = $('#id_us').val();
    var edit=false;
    buscar_usuario(id_us);
    function buscar_usuario(dato) {
        funcion='buscar_usuario';
        $.post('../Controlador/UsuarioController.php',{dato,funcion},(response)=>{
            let nombre='';
            let edad='';
            let rut='';
            let tipo='';
            let telefono='';
            let ubicacion='';
            let correo='';
            let sexo='';
            const usuario = JSON.parse(response);
            nombre+=`${usuario.nombre}`;
            edad+=`${usuario.edad}`;
            rut+=`${usuario.rut}`;
            tipo+=`${usuario.tipo}`;
            telefono+=`${usuario.telefono}`;
            ubicacion+=`${usuario.ubicacion}`;
            correo+=`${usuario.correo}`;
            sexo+=`${usuario.sexo}`;
            $('#n_y_ap').html(nombre);
            $('#edad').html(edad);
            $('#rut_us').html(rut);
            $('#tipo_us').html(tipo);
            $('#telefono_us').html(telefono);
            $('#ubicacion_us').html(ubicacion);
            $('#correo_us').html(correo);
            $('#sexo_us').html(sexo);
            $('#avatar1').attr('src',usuario.avatar);
            $('#avatar2').attr('src',usuario.avatar);
            $('#avatar3').attr('src',usuario.avatar);
            $('#avatar4').attr('src',usuario.avatar);
            
            
            
        })
        
    }
    $(document).on('click','.edit',(e)=>{
        funcion='capturar_datos';
        edit=true;
        $.post('../Controlador/UsuarioController.php',{funcion,id_us},(response)=>{
            const usuario = JSON.parse(response);
            $('#telefono').val(usuario.telefono);
            $('#ubicacion').val(usuario.ubicacion);
            $('#correo').val(usuario.correo);
            $('#sexo').val(usuario.sexo);
        })
    });
    $('#form-usuario').submit(e=>{
        if(edit==true){
            let telefono=$('#telefono').val();
            let ubicacion=$('#ubicacion').val();
            let correo=$('#correo').val();
            let sexo=$('#sexo').val();
            funcion='editar_usuario';
            $.post('../Controlador/UsuarioController.php',{id_us,funcion,telefono,ubicacion,correo,sexo},(response)=>{
                if(response=='editado'){
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Se edito correctamente",
                        showConfirmButton: false,
                        timer: 1500
                      }).then(function(){
                        location.href = 'editar_datos_personales.php'
                      })
                    $('#form-usuario').trigger('reset');
                }
                edit=false;
                buscar_usuario(id_us);
            });
        }
        else{
            Swal.fire({
                icon: "error",
                title: "Ups!",
                text: "No se pudo editar..",
              });
            $('#form-usuario').trigger('reset');
        }
        e.preventDefault();
    })
    $('#form-pass').submit(e=>{
        let oldpass=$('#oldpass').val();
        let newpass=$('#newpass').val();
        funcion='cambiar_contra';
        $.post('../controlador/UsuarioController.php',{id_us,funcion,oldpass,newpass},(response)=>{
            if(response=='Update'){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Se edito correctamente",
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function(){
                    location.href = 'editar_datos_personales.php'
                  })
                $('#form-pass').trigger('reset');
            
            }
            else{
                Swal.fire({
                    icon: "error",
                    title: "Ups!",
                    text: "Contraseña incorrecta",
                  });
                $('#form-pass').trigger('reset');
            }
        })
        e.preventDefault();
    })
    $('#form-photo').submit(e=>{
        let formData = new FormData($('#form-photo')[0]);
        $.ajax({
            url:'../controlador/UsuarioController.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType:false
        }).done(function(response){
            const json = JSON.parse(response);
            if(json.alert=='edit'){
                $('#avatar1').attr('src',json.ruta);           
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Se edito correctamente",
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function(){
                    location.href = 'editar_datos_personales.php'
                  })
                $('#form-photo').trigger('reset');
                buscar_usuario(id_us);
            }
            else{
                Swal.fire({
                    icon: "error",
                    title: "Ups!",
                    text: "Formato no aceptado",
                  });
                $('#form-photo').trigger('reset');
            }

             
        });
        e.preventDefault();
    })
})