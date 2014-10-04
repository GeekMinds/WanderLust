<?
session_start();
//Call conection Mysql
require_once("conexion.php");
function existsVideo($idVideo) {
    $instancia = Conexion::getInstance();
    $query = "SELECT * FROM voteList WHERE idVideo='" . $idVideo . "'";

    $result = $instancia::getConexion()->query($query);
    $result->data_seek(0);
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $row = $result->fetch_row();
        $arr = array(
            'idVoteList' => $row[0],
            'votos' => $row[3]
        );

        return json_encode($arr);
    }

    return null;
}

function userVoteThis($idVoteList) {
    $instancia = Conexion::getInstance();
    $jsonLogin = $_SESSION['loginUser'];
    $obje = json_decode($jsonLogin);
    $usr = $obje->{'id'};
    $query = "SELECT * FROM voteDetails WHERE idVoteList=" . $idVoteList . " AND username='" . $usr . "'";
    #echo $query;
    $result = $instancia::getConexion()->query($query);
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0){
        return true;
    }
    return false;
}
?>