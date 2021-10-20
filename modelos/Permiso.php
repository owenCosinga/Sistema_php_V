<?php

//incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

Class Permiso
{

   //implementar el metodo constructor
   public function __construct(){}

   
   //implementar un metodo para mostrar todos los registros
   public function listar()
   {
     $sql="SELECT * FROM permiso";
     return ejecutarConsulta($sql);
   }


}

?>