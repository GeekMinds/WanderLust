<?php
   require_once("conexion.php");
   //subirimagen
       $instancia = Conexion::getInstance();
       $query="INSERT INTO User VALUES ('".$_POST["username"]."','".$_POST["pass"]."', 2 , '".$_POST["name"]."', '".$_POST["lastName"]."','".$_POST["age"]."', '".$_POST["email"]."', '".$_POST["sexo"]."', '".$_POST["urlImagen"]."', 0)";
       echo $query;
       $basedeDatos=$instancia::getConexion();
       echo $basedeDatos->query($query);
?>