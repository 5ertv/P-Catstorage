$(document).ready(function(){
    $('#aviso1').hide();
    $('#aviso').hide();
    $('#form-recuperar').submit(e=>{
        let email = $('#email-recuperar').val();
        let user = $('#nombre-recuperar').val();
        if(email=='' || user==''){
            $('#aviso').show();
            $('#aviso').text('Tienes que rellenar los campos para solicitar tu nueva contraseña');
        }
        else{
            $('#aviso').hide();
            let funcion='verificar';
            $.post('../Controlador/RecuperarController.php',{funcion,email,user},(response)=>{
                if(response=='encontrado'){
                    $('#aviso').hide();
                    funcion='recuperar';
                    $.post('../Controlador/RecuperarController.php',{funcion,email,user},(response2)=>{
                        $('#aviso').hide();
                        $('#aviso1').hide();
                        console.log(response2);
                        if(response2=='enviado'){
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Se actualizo la contraseña, revisa tu correo, PORFAVOR cambiar la contraseña al ingresar",
                                showConfirmButton: false,
                                timer: 4500
                              }).then(function(){
                                location.href = 'login.php'
                              })
                            $('#form-recuperar').trigger('reset');
                        }
                        else{
                            Swal.fire({
                                icon: "error",
                                title: "Ups...",
                                text: "No se pudo restablecer."
                              });
                            $('#form-recuperar').trigger('reset');
                        }
                    })
                }
                else{
                    $('#aviso').hide();
                    $('#aviso1').hide();
                    $('#aviso').show();
                    $('#aviso').text('El correo y el usuario no se encuentran asociados o no estan registrados en el sistema, si crees que no es asi contacta al tecnico encargado');
                }

            })
        }
        e.preventDefault();
    })
})