<?php

class Conexion {

    private static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    public static function getConexion() {
        $mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");
        return $mysqli;
    }

    public function __clone() {
        trigger_error('Clone no se permite.', E_USER_ERROR);
    }

}

/* function calcular_edad(fecha){
  var dias = split("/", fecha, 3);
  var dias = mktime(0,0,0,dias[1],dias[0],dias[2]);
  var edad = (int)((time()-dias)/31556926 );
  return edad;
  } */
//Funcion de Informacion
?>     
