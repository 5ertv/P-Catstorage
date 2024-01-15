<?php
include_once 'conexion.php';
class Venta{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function Crear($nombre,$rut,$total,$fecha,$vendedor){
            $sql="INSERT INTO venta(fecha,cliente,rut,total,vendedor) values(:fecha,:cliente,:rut,:total,:vendedor)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':fecha'=>$fecha,':cliente'=>$nombre,':rut'=>$rut,':total'=>$total,':vendedor'=>$vendedor));
    }
    function ultima_venta(){
        $sql="SELECT MAX(id_venta) as ultima_venta FROM venta";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function borrar($id_venta){
            $sql="DELETE FROM venta where id_venta=:id_venta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_venta'=>$id_venta));
            echo 'delete';
    }
    function buscar(){
        $sql="SELECT id_venta,fecha,cliente,rut,total, CONCAT(usuario.n_y_ap) as vendedor FROM venta join usuario on vendedor=id_us";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function verificar($id_venta,$id_us){
        $sql="SELECT * FROM venta WHERE vendedor=:id_us and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_us'=>$id_us,':id_venta'=>$id_venta));
        $this->objetos=$query->fetchaLL();
        if(!empty($this->objetos)){
            return 1;
        }
        else{
            return 0;
        }
    }
    function recuperar_vendedor($id_venta){
        $sql="SELECT tipo_us FROM venta join usuario on id_us=vendedor WHERE id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function venta_dia_vendedor($id_us){
        $sql="SELECT SUM(total) as venta_dia_vendedor FROM venta WHERE vendedor=:id_us and date(fecha)= date(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_us'=>$id_us));
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function venta_diaria(){
        $sql="SELECT SUM(total) as venta_diaria FROM venta WHERE date(fecha)= date(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function venta_mensual(){
        $sql="SELECT SUM(total) as venta_mensual FROM venta WHERE year(fecha)= year(curdate()) and month(fecha) = month(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function venta_anual(){
        $sql="SELECT SUM(total) as venta_anual FROM venta WHERE year(fecha)= year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function buscar_id($id_venta){
        $sql="SELECT id_venta,fecha,cliente,rut,total, CONCAT(usuario.n_y_ap) as vendedor FROM venta join usuario on vendedor=id_us and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function venta_mes(){
        $sql="SELECT SUM(total) as cantidad, month(fecha) as mes FROM `venta` WHERE year(fecha) = year(curdate()) GROUP BY month(fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function vendedor_mes(){
        $sql="SELECT CONCAT(usuario.n_y_ap) as vendedor_nombre, SUM(total) as cantidad FROM `venta` join usuario on id_us=vendedor WHERE month(fecha)=month(curdate()) and year(fecha)=year(curdate()) GROUP BY vendedor ORDER BY cantidad DESC LIMIT 3;";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function producto_mas_vendido(){
        $sql="SELECT nombre, descripcion, SUM(cantidad) as total FROM `venta`
        JOIN venta_producto ON id_venta=venta_id_venta
        JOIN producto ON id_producto=producto_id_producto
        WHERE year(fecha)= year(curdate()) and month(fecha)= month(curdate())
        GROUP BY producto_id_producto ORDER BY total desc limit 5;";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
}
?>