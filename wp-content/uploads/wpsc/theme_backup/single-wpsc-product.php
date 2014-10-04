<?php



  $palabra = "reconocer";

    $cuantas_letras_tiene = strlen($palabra); // Cuando es ana esta variable es igual a 3
    for($i=0; $i < $cuantas_letras_tiene ; $i++ ){
      $new_palabra[$i] = substr($palabra,$i,1);
    }

    $check_palabra = "";
    /*
      $i = 3;
      $j=$i-1 = 2;
      $j >= 0;
      $new_palabra[0] "a";
      $new_palabra[1] "n";
      $new_palabra[2] "a";
      $check_palabra = $new_palabra[2] = "a"
      $check_palabra = $new_palabra[1] = "n"
      $check_palabra = $new_palabra[0] = "a"
      $check_palabra = "ana";
    */



    for($j = $i-1; $j >= 0; $j--){
      $check_palabra .= $new_palabra[$j];
    }

  if($palabra == $check_palabra ){
    print_r("si" );
  }else{
    print_r("no ");
    echo  $check_palabra;
  }

  //echo "<pre>";
  //print_r($check_palabra);



?>
