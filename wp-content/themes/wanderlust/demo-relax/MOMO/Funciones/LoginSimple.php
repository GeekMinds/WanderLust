<?php

$var1 = $_POST['username'];
$var2 = $_POST['password'];
$result = verificar_login($var1, $var2, $result);

function verificar_login($user, $password, &$result) {
    $mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");
    if ($mysqli->connect_errno) {
        echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    /* echo $mysqli->host_info . "\n"; */
    $resultado = $mysqli->query("SELECT * FROM  User where username='$user' and userPass='$password'");


    $resultado->data_seek(0);
    /* obtener fila */
    $row = $resultado->fetch_row();

    $result = null;

    if (strcmp($row[0], $user) == 0 && strcmp($row[1], $password) == 0) {
        $arr = array(
            'error' => 0,
            'id' => $row[0],
            'name' => $row[3],
            'lastname' => $row[4]
        );
        session_start();
        $_SESSION['login'] = 0;

        $result = $arr;
        session_start();
        $_SESSION['loginUser'] = json_encode($result);
    } else {
        $arr = array(
            'error' => 1
        );
        $result = $arr;
        session_start();
        $_SESSION['login'] = 1;
    }

    return $result;
}

// start up your PHP session!   session_start();  

echo json_encode($result);
exit();
#echo verificar_login("moya", "123", $result);
?>
