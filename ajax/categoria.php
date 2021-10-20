<?php

require_once "../modelos/Categoria.php";

$categoria = new Categoria();

$idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

switch($_GET["op"]){

  case 'guardaryeditar':

     if(empty($idcategoria)){
          $rspta=$categoria->insertar($nombre, $descripcion);
          echo $rspta ? "categoria registrada" : "categoria no se pudo registrar";
     }else{
        $rspta=$categoria->editar($idcategoria, $nombre, $descripcion);
        echo $rspta ? "categoria actualizada" : "categoria no se pudo actualizar";  
     }

    break;

  case 'desactivar':
    $rspta=$categoria->desactivar($idcategoria);
    echo $rspta ? "categoria desactivada" : "categoria no se pudo desactivar";
    break; 
    
  case 'activar':
    $rspta=$categoria->activar($idcategoria);
    echo $rspta ? "categoria activada" : "categoria no se pudo activar";
    break;  

  case 'mostrar':
    $rspta=$categoria->mostrar($idcategoria);
    //codificar el resultado utilizando json
    echo json_encode($rspta);
    break;    

  case 'listar':
$rspta=$categoria->listar();
//vamos a declara un array
$data = array();

  while ($reg=$rspta->fetch_object()){
    $data[] = array(
        "0" =>($reg->condicion)? '<button class="btn btn-warning" onclick=mostrar('.$reg->idcategoria.')> <i class="fa fa-pencil">  </i> </button>'
        .' <button class="btn btn-danger" onclick=desactivar('.$reg->idcategoria.')> <i class="fa fa-close">  </i> </button>':
        '<button class="btn btn-warning" onclick=mostrar('.$reg->idcategoria.')> <i class="fa fa-pencil">  </i> </button>'
        .' <button class="btn btn-primary" onclick=activar('.$reg->idcategoria.')> <i class="fa fa-check">  </i> </button>',
        "1" =>$reg->nombre,
        "2" =>$reg->descripcion,
        "3" =>($reg->condicion)? '<span class="label bg-green">Activado</span>' :
        '<span class="label bg-red">Desactivado</span>'
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