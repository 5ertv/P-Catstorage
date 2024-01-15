<?php
include '../modelo/Tipo.php';
$tipo=new Tipo();
if($_POST['funcion']=='rellenar_tipos'){
    $tipo->rellenar_tipos();
    $json = array();
    foreach ($tipo->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_tip_prod,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>