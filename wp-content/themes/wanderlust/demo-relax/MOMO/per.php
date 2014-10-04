<?
$mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");
$resultado2 = $mysqli->query("SELECT  * FROM  User WHERE username = '" . $nombreUsuario . "'");
                    $resultado2->data_seek(0);
                    $row1 = $resultado2->fetch_row();
                    var_dump($row1);
?>