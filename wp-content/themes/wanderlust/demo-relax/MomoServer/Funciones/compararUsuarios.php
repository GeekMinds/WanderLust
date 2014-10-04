<?php
   require_once("conexion.php");
   //subirimagen
       $instancia = Conexion::getInstance();
       $query="SELECT * FROM momolol.User where username='".$_POST['username']."'";
       $basedeDatos=$instancia::getConexion();
        $resultado = $basedeDatos->query($query);
        $resultado->data_seek(0);
        /* obtener fila */
        $row = $resultado->fetch_row();
        if(strcmp($row[0],"")==0){
            $arr = array(
                //true
                'error' =>1
            );
        }else{
            $arr = array(
                //false
                'error' =>0
            );
        }
        echo json_encode($arr);
?>
