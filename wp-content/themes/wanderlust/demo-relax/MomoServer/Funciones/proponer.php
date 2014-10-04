<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if ($_POST['idVideo']&&$_POST['fecha']) {
    require_once("Conexion.php");
    $instancia = Conexion::getInstance();
    $id = $_POST['idVideo'];
    $fecha = $_POST['fecha'];
    $jsonLogin = $_SESSION['loginUser'];
       $obje = json_decode($jsonLogin); 
       $usr = $obje->{'id'}; 
       $query = "INSERT INTO `momolol`.`voteList` (`idVideo`, `username`, `votos`) VALUES ('$id', '$usr', 1);";
       ?><h1>query = <? echo $query; ?> <?
       $mysqli = new mysqli("10.200.10.193", "root", "root", "momolol", 8889);
      if($result = $mysqli->query($query)){
          $queryAfter = "INSERT INTO `momolol`.`voteDetails` (`idVoteList`, `username`, `date`) VALUES ($mysqli->insert_id, '$usr', '$fecha');";
            $mysqli->query($queryAfter);
          ?><h1>query = <? echo $queryAfter; ?> <?
          
      };      
}
?>