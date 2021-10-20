<?php


//incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

Class persona
{

   //implementar el metodo constructor
   public function __construct(){}

   //implementar un metodo para insertar registros
   public function insertar($tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email)
   {

     $sql="INSERT INTO persona(tipo_persona, nombre, tipo_documento, num_documento, direccion, telefono, email) VALUES('$tipo_persona', '$nombre', '$tipo_documento', '$num_documento', '$direccion', '$telefono', '$email')";
     return ejecutarConsulta($sql);

   }
   //implementar un metodo para actualizar registros
   public function editar($id, $tipo_persona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email)
   {
     $sql="UPDATE persona SET tipo_persona='$tipo_persona', nombre='$nombre', tipo_documento='$tipo_documento', num_documento='$num_documento', direccion='$direccion', telefono='$telefono', email='$email' WHERE idpersona='$id'";
     return ejecutarConsulta($sql);
   }

   //implementar un metodo para activar registros
   public function activar($id)
   {
     $sql="UPDATE persona SET condicion='1' WHERE idpersona='$id'";
     return ejecutarConsulta($sql);
   }

   //implementar un metodo para desactivar registros
   public function desactivar($id)
   {
     $sql="UPDATE persona SET condicion='0' WHERE idpersona='$id'";
     return ejecutarConsulta($sql);
   }
   
   //implementar un metodo para mostrar todos los registros
   public function listarp()
   {
     $sql="SELECT * FROM persona WHERE tipo_persona='Proveedor'";
     return ejecutarConsulta($sql);
   }

   public function listarc()
   {
     $sql="SELECT * FROM persona WHERE tipo_persona='Cliente'";
     return ejecutarConsulta($sql);
   }

   //implementar un metodo para buscar los registros
   public function mostrar($id)
   {
     $sql="SELECT * FROM persona WHERE idpersona='$id'";
     return ejecutarConsultaSimpleFila($sql);
   }

}

?>