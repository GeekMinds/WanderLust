<?php 
require_once("conexion.php");
    $var3 = $_POST['responseFB'];
         echo "entrosds";
        $result = $var3;
        // start up your PHP session!   session_start();  
      session_start();  
        $_SESSION['loginUser'] = json_encode($result);
    echo json_encode($result);
    exit();
    #echo verificar_login("moya", "123", $result);
?>
