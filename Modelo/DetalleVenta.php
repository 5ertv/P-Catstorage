<?php
include_once 'conexion.php';
class DetalleVenta{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function recuperar($id_venta){
        $sql="SELECT * FROM detalle_venta where id_det_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function borrar($id_detalle){
        $sql="DELETE FROM detalle_venta where id_detalle=:id_detalle";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_detalle'=>$id_detalle));
}
}
?>