<?php

//incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

Class Categoria
{

   //implementar el metodo constructor
   public function __construct()
   {

    

   }

   //implementar un metodo para insertar registros
   public function insertar($nombre, $descripcion)
   {

     $sql="INSERT INTO categoria(nombre, descripcion, condicion) VALUES('$nombre', '$descripcion', '1')";
     return ejecutarConsulta($sql);

   }
   //implementar un metodo para actualizar registros
   public function editar($id ,$nombre, $descripcion)
   {
     $sql="UPDATE categoria SET nombre='$nombre', descripcion='$descripcion' WHERE idcategoria='$id'";
     return ejecutarConsulta($sql);
   }

   //implementar un metodo para activar registros
   public function activar($id)
   {
     $sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$id'";
     return ejecutarConsulta($sql);
   }

   //implementar un metodo para desactivar registros
   public function desactivar($id)
   {
     $sql="UPDATE categoria SET condicion='0' WHERE idcategoria='$id'";
     return ejecutarConsulta($sql);
   }
   
   //implementar un metodo para mostrar todos los registros
   public function listar()
   {
     $sql="SELECT * FROM categoria";
     return ejecutarConsulta($sql);
   }

   //implementar un metodo para mostrar todos los registros
   public function select()
   {
     $sql="SELECT * FROM categoria WHERE condicion='1'";
     return ejecutarConsulta($sql);
   }

   //implementar un metodo para buscar los registros
   public function mostrar($id)
   {
     $sql="SELECT * FROM categoria WHERE idcategoria='$id'";
     return ejecutarConsultaSimpleFila($sql);
   }

}

?>