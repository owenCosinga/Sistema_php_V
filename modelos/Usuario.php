<?php

//incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

Class Usuario
{

   //implementar el metodo constructor
   public function __construct(){}

   //implementar un metodo para insertar registros
   public function insertar($nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo, $login, $clave, $imagen, $permisos)
   {

     $sql="INSERT INTO usuario(nombre, tipo_documento, num_documento, direccion, telefono, email, cargo, login, clave, imagen, condicion) 
     VALUES('$nombre', '$tipo_documento', '$num_documento', '$direccion', '$telefono', '$email', '$cargo', '$login', '$clave', '$imagen', '1')";
     
     //return ejecutarConsulta($sql);

     $idusuarionew=ejecutarConsulta_retornarID($sql);

     $num_elementos=0;
     $sw=true;

     while ($num_elementos < count($permisos)){
       $sql_detalle="INSERT INTO usuario_permiso(idusuario, idpermiso) 
       VALUES('$idusuarionew', '$permisos[$num_elementos]')";

        ejecutarConsulta($sql_detalle) or $sw = false;       
       $num_elementos=$num_elementos + 1; 
     }
         return $sw;
   }
   //implementar un metodo para actualizar registros
   public function editar($id, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo, $login, $clave,$imagen, $permisos)
   {
     $sql="UPDATE usuario SET nombre='$nombre', tipo_documento='$tipo_documento', num_documento='$num_documento', direccion='$direccion', telefono='$telefono', email='$email', cargo='$cargo', login='$login', clave='$clave', imagen='$imagen' 
     WHERE idusuario='$id'";
      ejecutarConsulta($sql);

      //eliminamos todos los permisos asignados para volverlos a registrar
      $sqldel="DELETE FROM usuario_permiso WHERE idusuario='$id'";

      ejecutarConsulta($sqldel);

      $num_elementos=0;
      $sw=true;
 
      while ($num_elementos < count($permisos)){
        $sql_detalle="INSERT INTO usuario_permiso(idusuario, idpermiso) 
        VALUES('$id', '$permisos[$num_elementos]')";
 
         ejecutarConsulta($sql_detalle) or $sw = false;       
        $num_elementos=$num_elementos + 1; 
      }
          return $sw;

   }

   //implementar un metodo para activar registros
   public function activar($id)
   {
     $sql="UPDATE usuario SET condicion='1' WHERE idusuario='$id'";
     return ejecutarConsulta($sql);
   }

   //implementar un metodo para desactivar registros
   public function desactivar($id)
   {
     $sql="UPDATE usuario SET condicion='0' WHERE idusuario='$id'";
     return ejecutarConsulta($sql);
   }
   
   //implementar un metodo para mostrar todos los registros
   public function listar()
   {
     $sql="SELECT * FROM usuario";
     return ejecutarConsulta($sql);
   }

   //implementar un metodo para buscar los registros
   public function mostrar($id)
   {
     $sql="SELECT * FROM usuario WHERE idusuario='$id'";
     return ejecutarConsultaSimpleFila($sql);
   }

   public function listarmarcados($idusuario){
     $sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
     return ejecutarConsulta($sql);
   }

     //function para verificar el acceso la sistema
   public function verificar($login, $clave){
     $sql="SELECT idusuario, nombre, tipo_documento, num_documento, direccion, telefono, email, cargo, imagen, login
     FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'";   
   }

}

?>