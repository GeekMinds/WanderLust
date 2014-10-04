<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if ($_POST['idVideo']&&$_POST['fecha']) {
    $mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");
    
    $id = $_POST['idVideo'];
    $fecha = $_POST['fecha'];
    $jsonLogin = $_SESSION['loginUser'];
       $obje = json_decode($jsonLogin); 
       $usr = $obje->{'id'}; 
       $query = "INSERT INTO voteList (idVideo, username, votos) VALUES ('$id', '$usr', 1);";
       
       
      if($result = $mysqli->query($query)){
          $queryAfter = "INSERT INTO voteDetails (idVoteList, username, date) VALUES ($mysqli->insert_id, '$usr', '$fecha');";
            $mysqli->query($queryAfter);
         
          
      };      
}
?>