<?php
include 'conexion.php';
class Producto{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$descripcion,$precio,$tipo,$avatar){
        $sql="SELECT id_producto FROM producto where nombre=:nombre and descripcion=:descripcion and prod_tip_prod=:tipo";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':descripcion'=>$descripcion,':tipo'=>$tipo));
        $this->objetos=$query->fetchaLL();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
            $sql="INSERT INTO producto(nombre,descripcion,precio,prod_tip_prod,avatar) values (:nombre,:descripcion,:precio,:tipo,:avatar);";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':descripcion'=>$descripcion,':tipo'=>$tipo,':precio'=>$precio,':avatar'=>$avatar));
            echo 'add';
        }
    }
    function editar($id,$nombre,$descripcion,$precio,$tipo){
        $sql="SELECT id_producto FROM producto where id_producto!=:id and nombre=:nombre and descripcion=:descripcion and prod_tip_prod=:tipo";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre,':descripcion'=>$descripcion,':tipo'=>$tipo));
        $this->objetos=$query->fetchaLL();
        if(!empty($this->objetos)){
            echo 'noedit';
        }
        else{
            $sql="UPDATE producto SET nombre=:nombre, descripcion=:descripcion, prod_tip_prod=:tipo, precio=:precio where id_producto=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre,':descripcion'=>$descripcion,':tipo'=>$tipo,':precio'=>$precio));
            echo 'edit';
        }
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT id_producto, producto.nombre as nombre, descripcion, precio, tipo_producto.nombre as tipo, avatar,prod_tip_prod
            FROM producto
            join tipo_producto on prod_tip_prod=id_tip_prod and producto.nombre LIKE :consulta LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchaLL();
            return $this->objetos;
        }
        else{
            $sql="SELECT id_producto, producto.nombre as nombre, descripcion, precio, tipo_producto.nombre as tipo, avatar,prod_tip_prod
            FROM producto
            join tipo_producto on prod_tip_prod=id_tip_prod and producto.nombre NOT LIKE '' order by producto.nombre LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchaLL();
            return $this->objetos;
        }
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM producto where id_producto=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,));
        $this->objetos = $query->fetchaLL(); 
        
        $sql="UPDATE producto SET avatar=:nombre where id_producto=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
    }
    function borrar($id){
        $sql="DELETE FROM producto WHERE id_producto=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'noborrado';
        }
    }
    function obtener_stock($id){
        $sql="SELECT SUM(stock) as total FROM lote where lote_id_prod=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchaLL(); 
        return $this->objetos;
    }
    function buscar_id($id){
        $sql="SELECT id_producto, producto.nombre as nombre, descripcion, precio, tipo_producto.nombre as tipo, avatar,prod_tip_prod
        FROM producto
        join tipo_producto on prod_tip_prod=id_tip_prod where id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function reporte_producto(){
            $sql="SELECT id_producto, producto.nombre as nombre, descripcion, precio, tipo_producto.nombre as tipo, avatar,prod_tip_prod
            FROM producto
            join tipo_producto on prod_tip_prod=id_tip_prod and producto.nombre NOT LIKE '' order by producto.nombre LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchaLL();
            return $this->objetos;
    }
}

?>