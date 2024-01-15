<?php
include_once 'conexion.php';
class Usuario{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function Login($nombre,$pass){
        $sql ="SELECT * FROM usuario inner join roles on tipo_us=id_tipo_us where nombre_us=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $objetos= $query->fetchaLL();
        foreach ($objetos as $objeto) {
            $contrasena_actual = $objeto->contrasena_us;
        }
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($pass,$contrasena_actual)){
                return "logueado";
            }
        }
        else{
            if($pass==$contrasena_actual){
                return "logueado";
            }
        }
    }
    function obtener_dato_logueo($nombre){
        $sql="SELECT * FROM usuario join roles on tipo_us=id_tipo_us and nombre_us=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos= $query->fetchaLL();
        return $this->objetos;
    }
    function obtener_datos($id){
        $sql="SELECT * FROM usuario join roles on tipo_us=id_tipo_us and id_us=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos= $query->fetchaLL();
        return $this->objetos;
    }
    function editar($id_us,$telefono,$ubicacion,$correo,$sexo){
        $sql="UPDATE usuario SET telefono_us=:telefono,ubicacion_us=:ubicacion,correo_us=:correo,sexo_us=:sexo where id_us=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_us,':telefono'=>$telefono,':ubicacion'=>$ubicacion,':correo'=>$correo,':sexo'=>$sexo));
    }
    function cambiar_contra($id_us,$oldpass,$newpass){
        $sql="SELECT * FROM usuario where id_us=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_us));
        $this->objetos= $query->fetchaLL();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual = $objeto->contrasena_us;
        }
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($oldpass,$contrasena_actual)){
                $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
                $sql="UPDATE usuario SET contrasena_us=:newpass where id_us=:id";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_us,':newpass'=>$pass));
                echo 'Update';
            }
            else{
                echo 'NoUpdate';
            }
        }
        else{
            if($oldpass==$contrasena_actual){
                $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
                $sql="UPDATE usuario SET contrasena_us=:newpass where id_us=:id";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_us,':newpass'=>$pass));
                echo 'Update';
            }
            else{
                echo 'NoUpdate';
            }
        }
    }
    function cambiar_photo($id_us,$nombre){
        $sql="SELECT avatar FROM usuario where id_us=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_us));
        $this->objetos= $query->fetchaLL();

            $sql="UPDATE usuario SET avatar=:nombre where id_us=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_us,':nombre'=>$nombre));
        return $this->objetos;
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM usuario JOIN roles ON tipo_us=id_tipo_us WHERE n_y_ap LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchALL();
            return $this->objetos;
        }
        else{
            $sql="SELECT * FROM usuario JOIN roles ON tipo_us=id_tipo_us WHERE n_y_ap NOT LIKE '' ORDER BY id_us LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchALL();
            return $this->objetos;
        }
    }
    function crear($nombre,$edad,$rut,$usu,$pass,$tipo,$avatar){
        $sql="SELECT id_us FROM usuario where nombre_us=:usu";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':usu'=>$usu));
        $this->objetos=$query->fetchALL();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO usuario(n_y_ap,edad,rut_us,nombre_us,contrasena_us,tipo_us,avatar) VALUES(:nombre,:edad,:rut,:usu,:pass,:tipo,:avatar);";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':edad'=>$edad,':rut'=>$rut,':usu'=>$usu,':pass'=>$pass,':tipo'=>$tipo,':avatar'=>$avatar));
            echo 'add';
        }
    }
    function ascender($pass,$id_ascender,$id_us){
        $sql="SELECT * FROM usuario WHERE id_us=:id_us";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_us'=>$id_us));
        $this->objetos=$query->fetchALL();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual = $objeto->contrasena_us;
        }
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($pass,$contrasena_actual)){
                $tipo=1;
                $sql="UPDATE usuario SET tipo_us=:tipo where id_us=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_ascender,':tipo'=>$tipo));
                echo 'ascendido';
            }
            else{
                echo 'noascendido';
            }
        }
        else{
            if($pass==$contrasena_actual){
                $tipo=1;
                $sql="UPDATE usuario SET tipo_us=:tipo where id_us=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_ascender,':tipo'=>$tipo));
                echo 'ascendido';
            }
            else{
                echo 'noascendido';
            }
        }
    }
    function descender($pass,$id_descendido,$id_us){
        $sql="SELECT * FROM usuario WHERE id_us=:id_us";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_us'=>$id_us));
        $this->objetos=$query->fetchALL();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual = $objeto->contrasena_us;
        }
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($pass,$contrasena_actual)){
                $tipo=2;
                $sql="UPDATE usuario SET tipo_us=:tipo where id_us=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
                echo 'descendido';
            }
            else{
                echo 'nodescendido';
            }
        }
        else{
            if($pass==$contrasena_actual){
                $tipo=2;
                $sql="UPDATE usuario SET tipo_us=:tipo where id_us=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
                echo 'descendido';
            }
            else{
                echo 'nodescendido';
            }
        }
    }
    function borrar($pass,$id_borrado,$id_us){
        $sql="SELECT * FROM usuario WHERE id_us=:id_us";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_us'=>$id_us));
        $this->objetos=$query->fetchALL();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual = $objeto->contrasena_us;
        }
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($pass,$contrasena_actual)){
                $sql="DELETE FROM usuario WHERE id_us=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_borrado));
                echo 'borrado';
            }
            else{
                echo 'noborrado';
            }
        }
        else{
            if($pass==$contrasena_actual){
                $sql="DELETE FROM usuario WHERE id_us=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_borrado));
                echo 'borrado';
            }
            else{
                echo 'noborrado';
            }
        }
    }
    function devolver_avatar($id_us){
        $sql="SELECT avatar FROM usuario where id_us=:id_us";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_us'=>$id_us));
        $this->objetos= $query->fetchaLL();
        return $this->objetos;
    }
    function verificar($email,$user){
        $sql="SELECT * FROM usuario where correo_us=:email and nombre_us=:user";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':email'=>$email,':user'=>$user));
        $this->objetos= $query->fetchaLL();
        if(!empty($this->objetos)){
            if($query->rowCount()===1){
                echo 'encontrado';
            }
            else{
                echo 'no encontrado';
            }
        }
        else{
            echo 'no encontrado';
        }
    }
    function remplazar($codigo,$email,$user){
                $sql="UPDATE usuario SET contrasena_us=:codigo where correo_us=:email and nombre_us=:user";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':codigo'=>$codigo,':email'=>$email,':user'=>$user));
    }
}


?>