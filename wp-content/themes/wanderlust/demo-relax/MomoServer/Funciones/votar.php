<?php
#echo 'Va por aca, si entro';
session_start();
if ($_POST['idVoteList']&&$_POST['fecha']) {
    require_once("Conexion.php");
    $instancia = Conexion::getInstance();
    $id = $_POST['idVoteList'];
    $fecha = $_POST['fecha'];
    $jsonLogin = $_SESSION['loginUser'];
       $obje = json_decode($jsonLogin); 
       $usr = $obje->{'id'}; 
       $queryVotos = "SELECT votos FROM `momolol`.`voteList` WHERE `idVoteList`='$id';";
       #echo $queryVotos;
       $resultVotos = $instancia::getConexion()->query($queryVotos);
       $resultVotos->data_seek(0);
       $row = $resultVotos->fetch_row();
       #echo('Comprobando el lado de la votacion'.$row[0]);
       if($row[0]>0){
           $newVotos = $row[0]+1;
           $query = "UPDATE `momolol`.`voteList` SET `votos`='$newVotos' WHERE `idVoteList`='$id';";
           
           if($result = $instancia::getConexion()->query($query)){
          $queryAfter = "INSERT INTO `momolol`.`voteDetails` (`idVoteList`, `username`, `date`) VALUES ($id, '$usr', '$fecha');";
           $instancia::getConexion()->query($queryAfter);
         
          
      }
       }
          
       
      
      ;
        
}

?>
