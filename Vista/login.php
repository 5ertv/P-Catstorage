<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css "href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/css/all.min.css">
</head>
<?php
session_start();
if(!empty($_SESSION['tipo_us'])){
    header('Location: ../controlador/LoginController.php');
}
else {
    session_destroy();
?>
<body>
    <img class= "cat" src="../img/cat.png" alt="">
    <div class="contenedor">
        <div class="img">
            <img src="" width:150px  alt="">
        </div>
        <div class="contenido-login">
            <form id="form" action="../Controlador/LoginController.php" method="POST">
                <img src="" alt="">
                <h2>Catstorage</h2>
                <div class="input-div nombre">
                    <div class="i">
                        <i class= "fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input id="user" type="text" name="user" class= "input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class= "i">
                        <i class= "fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input id="password" type="password" name="pass" class= "input">
                    </div>
                </div>
                <a href="recuperar.php" target="_blank">Recuperar Contraseña</a>
                <a href="https://www.aiep.cl/" target="_blank">Creado por estudiantes de AIEP</a>
                <input disabled id="btn"type="submit" class= "btn" value= "Iniciar Sesion">
                <a href="../index.php">Volver a la pagina principal</a>
            </form>
        </div>
    </div>
    <script src="../js/login.js"></script>
    <script>
        let form = document.querySelector("#form");
        let btn = document.querySelector("#btn");
        function validar() {
            let deshabilitar = false;

            if(form.user.value == ""){
                deshabilitar = true;
            }
            if(form.password.value == ""){
                deshabilitar = true;
            }
            if (deshabilitar == true) {
                btn.disabled= true;
            }
            else{
                btn.disabled = false;
            }
        }
        form.addEventListener("keyup", validar)
    </script>
</body>
</html>
<?php
}
?>
