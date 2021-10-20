<?php

require_once "../modelos/Permiso.php";

$permiso = new Permiso();


switch($_GET["op"]){
  
  case 'listar':
$rspta=$permiso->listar();
//vamos a declara un array
$data = array();

  while ($reg=$rspta->fetch_object()){
    $data[] = array(
        "0" =>$reg->nombre
    );
  }
    $results = array(
    "sEcho" =>1, //informacion para el datatables
    "iTotalRecords" => count($data), //enviamos el total de registros al datatable
    "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
    "aaData" =>$data);

    echo json_encode($results);

    break;
   
}

?>