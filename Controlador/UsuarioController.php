<?php
include_once '../modelo/Usuario.php';
$usuario = new Usuario();
session_start();
$id_us= $_SESSION['usuario'];
$tipo_usuario= $_SESSION['tipo_us'];
if($_POST['funcion']=='buscar_usuario'){
    $json=array();
    $fecha_actual = new DateTime();
    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        $nacimiento = new DateTime($objeto->edad);
        $edad = $nacimiento->diff($fecha_actual);
        $edad_years = $edad->y;
        $json[]=array(
            'nombre'=>$objeto->n_y_ap,
            'edad'=>$edad_years, 
            'rut'=>$objeto->rut_us,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->telefono_us,
            'ubicacion'=>$objeto->ubicacion_us,
            'correo'=>$objeto->correo_us,
            'sexo'=>$objeto->sexo_us,
            'avatar'=>'../img/'.$objeto->avatar

        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='capturar_datos'){
    $json=array();
    $id_us=$_POST['id_us'];
    $usuario->obtener_datos($id_us);
    foreach ($usuario->objetos as $objeto) {
        $json[]=array(
            'telefono'=>$objeto->telefono_us,
            'ubicacion'=>$objeto->ubicacion_us,
            'correo'=>$objeto->correo_us,
            'sexo'=>$objeto->sexo_us,
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='editar_usuario'){
    $id_us=$_POST['id_us'];
    $telefono=$_POST['telefono'];
    $ubicacion=$_POST['ubicacion'];
    $correo=$_POST['correo'];
    $sexo=$_POST['sexo'];

    $usuario->editar($id_us,$telefono,$ubicacion,$correo,$sexo);
    echo 'editado';
}
if($_POST['funcion']=='cambiar_contra'){
    $id_us=$_POST['id_us'];
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    $usuario->cambiar_contra($id_us,$oldpass,$newpass);

}
if($_POST['funcion']=='cambiar_foto'){
    if(($_FILES['photo']['type']=='image/jpeg') or ($_FILES['photo']['type']=='image/png') or ($_FILES['photo']['type']=='image/gif')) {
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $usuario->cambiar_photo($id_us,$nombre);
        foreach ($usuario->objetos as $objeto) {
            unlink('../img/'.$objeto->avatar);
        }
        $json= array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
    else{
        $json= array();
        $json[]=array(
            'alert'=>'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
        
    }
}
if($_POST['funcion']=='buscar_usuarios_adm'){
    $json=array();
    $fecha_actual = new DateTime();
    $usuario->buscar();
    foreach ($usuario->objetos as $objeto) {
        $nacimiento = new DateTime($objeto->edad);
        $edad = $nacimiento->diff($fecha_actual);
        $edad_years = $edad->y;
        $json[]=array(
            'id'=>$objeto->id_us,
            'nombre'=>$objeto->n_y_ap,
            'edad'=>$edad_years, 
            'rut'=>$objeto->rut_us,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->telefono_us,
            'ubicacion'=>$objeto->ubicacion_us,
            'correo'=>$objeto->correo_us,
            'sexo'=>$objeto->sexo_us,
            'avatar'=>'../img/'.$objeto->avatar,
            'tipo_usuario'=>$objeto->tipo_us,

        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
        

if($_POST['funcion']=='devolver_avatar'){
    $usuario->devolver_avatar($id_us);    
    $json=array();
    foreach ($usuario->objetos as $objeto) {
        $json=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='crear_usuario'){
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $rut = $_POST['rut'];
    $usu = $_POST['usu'];
    $pass = $_POST['pass'];
    $tipo=2;
    $avatar='default.png';
    $usuario->crear($nombre,$edad,$rut,$usu,$pass,$tipo,$avatar);
}
if($_POST['funcion']=='ascender'){
    $pass=$_POST['pass'];
    $id_ascender=$_POST['id_us'];
    $usuario->ascender($pass,$id_ascender,$id_us);
}
if($_POST['funcion']=='descender'){
    $pass=$_POST['pass'];
    $id_descendido=$_POST['id_us'];
    $usuario->descender($pass,$id_descendido,$id_us);
}
if($_POST['funcion']=='borrar-usuario'){
    $pass=$_POST['pass'];
    $id_borrado=$_POST['id_us'];
    $usuario->borrar($pass,$id_borrado,$id_us);
}
if($_POST['funcion']=='tipo_usuario'){
    echo $tipo_usuario;
}
?>