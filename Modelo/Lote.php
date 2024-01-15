<?php
include_once 'conexion.php';
class Lote{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($id_producto,$proveedor,$stock,$vencimiento){
        $sql="INSERT INTO lote(stock,vencimiento,lote_id_prod,lote_id_prov) values (:stock,:vencimiento,:id_producto,:id_proveedor)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':stock'=>$stock,':vencimiento'=>$vencimiento,':id_producto'=>$id_producto,':id_proveedor'=>$proveedor));
        echo 'add';
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT id_lote,stock,vencimiento,descripcion, producto.nombre as prod_nom, tipo_producto.nombre as tipo_nom, proveedor.nombre as proveedor, producto.avatar as logo FROM lote
            JOIN proveedor on lote_id_prov=id_proveedor
            JOIN producto on lote_id_prod=id_producto
            JOIN tipo_producto on prod_tip_prod=id_tip_prod and producto.nombre like :consulta order by producto.nombre limit 25;";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchaLL();
            return $this->objetos;
        }
        else{
            $sql="SELECT id_lote,stock,vencimiento,descripcion, producto.nombre as prod_nom, tipo_producto.nombre as tipo_nom, proveedor.nombre as proveedor, producto.avatar as logo FROM lote
            JOIN proveedor on lote_id_prov=id_proveedor
            JOIN producto on lote_id_prod=id_producto
            JOIN tipo_producto on prod_tip_prod=id_tip_prod and producto.nombre not like '' order by producto.nombre limit 25;";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchaLL();
            return $this->objetos;
        }
    }
    function editar($id,$stock){
        $sql="UPDATE lote SET stock=:stock WHERE id_lote=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':stock'=>$stock));
        echo 'edit';
    }
    function borrar($id){
        $sql="DELETE FROM lote WHERE id_lote=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'noborrado';
        }
    }
    function devolver($id_lote,$cantidad,$vencimiento,$producto,$proveedor){
        $sql="SELECT * FROM lote WHERE id_lote=:id_lote";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_lote'=>$id_lote));
        $lote=$query->fetchaLL();
        if(!empty($lote)){
            $sql="UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote));
        }
        else{
            $sql="SELECT * FROM lote WHERE vencimiento=:vencimiento and lote_id_prod=:producto and lote_id_prod=:proveedor";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor));
            $lote_nuevo=$query->fetchaLL();
            foreach ($lote_nuevo as $objeto) {
                $id_lote_nuevo = $objeto->id_lote;
            }
            if(!empty($lote_nuevo)){
                $sql="UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote_nuevo));
            }
            else{
                $sql="INSERT INTO lote(id_lote,stock,vencimiento,lote_id_prod,lote_id_prov) values(:id_lote,:stock,:vencimiento,:producto,:proveedor)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id_lote'=>$id_lote,':stock'=>$cantidad,':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor));
            }
        }
    }
}
?>