<?php
include_once 'conexion.php';
class VentaProducto{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    function ver($id){
        $sql="SELECT venta_producto.precio as precio,cantidad, producto.nombre as producto,descripcion, tipo_producto.nombre as tipo,subtotal
        FROM venta_producto
        JOIN producto on producto_id_producto = id_producto and venta_id_venta=:id
        JOIN tipo_producto on prod_tip_prod = id_tip_prod";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchaLL();
        return $this->objetos;
    }
    function borrar($id_venta){
            $sql="DELETE FROM venta_producto where venta_id_venta=:id_venta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_venta'=>$id_venta));
    }
}
?>