<?php
include 'conexion.php';
class Tipo{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function rellenar_tipos(){
        $sql="SELECT * FROM tipo_producto ORDER BY nombre ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchALL();
        return $this->objetos;
    }
}
?>