<?php
include_once '../modelo/Usuario.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
$usuario = new Usuario();

if(!empty($_SESSION['tipo_us'])){
    switch ($_SESSION['tipo_us']) {
        case 1:
            header('Location: ../Vista/admin_cat.php');
            break;
        case 2:
            header('Location: ../Vista/admin_cat.php');
            break;
        case 3:
            header('Location: ../Vista/admin_cat.php');
            break;        
    }
}
else {

    if(!empty($usuario->Login($user,$pass)=="logueado")){
        $usuario->obtener_dato_logueo($user);
        foreach ($usuario->objetos as $objeto) {
            $_SESSION['usuario']=$objeto->id_us;
            $_SESSION['tipo_us']=$objeto->tipo_us;
            $_SESSION['n_y_ap']=$objeto->n_y_ap;
        }
        switch ($_SESSION['tipo_us']) {
            case 1:
                header('Location: ../Vista/admin_cat.php');
                break;
            case 2:
                header('Location: ../Vista/admin_cat.php');
                break;
            case 3:
                header('Location: ../Vista/admin_cat.php');
                break;  
        }
    }
    else {
        header('Location: ../Vista/login.php');
    }
}

?>