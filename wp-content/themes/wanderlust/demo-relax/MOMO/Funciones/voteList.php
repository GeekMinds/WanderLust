<?
/*
$mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");
$resultado2 = $mysqli->query("SELECT * FROM voteList");
$numero = $resultado2->num_rows;
for ($i = $numero; $i > 0; $i--) {
    $resultado2->data_seek($i-1);
    $row3 = $resultado2->fetch_row();
    echo '<div class="ca-item ">
                                <div class="ca-item-main" >
                                    <img src="http://i1.ytimg.com/vi/' . $row3[1] . '/mqdefault.jpg" class="imgVideos"/>';
    
        echo '<span class="spanVideos"> <label class="votar" onClick="votar(';
        echo "'" . $row3[1] . "'";
        echo',' . $row3[0] . ')"></label></br><label class="etiquetaVotar">Votar</label></span>';
    
    echo '</div>
                            </div>';
}*/
 
//require_once("./votosPropuestas.php");
require_once("./conexion.php");
//echo __DIR__.'hello wordl';
$instancia = Conexion::getInstance();
$query = "SELECT * FROM voteList";
    #echo $query;
    $resultado2 = $instancia::getConexion()->query($query);
$numero = $resultado2->num_rows;
for ($i = $numero; $i > 0; $i--) {
                                $resultado2->data_seek($i);
                                $row3 = $resultado2->fetch_row();


                                if (userVoteThis($row3[0])) {
                                   // echo userVoteThis($row3[0]);
                                     echo '<div class="ca-item ">
                                      <div class="ca-item-main" >
                                      <img src="http://i1.ytimg.com/vi/' . $row3[1] . '/mqdefault.jpg" class="imgVideos"/>
                                      <span  class="spanVideos"> <div class="info2">
                            <p class="tituloVideo" title="Raining Tacos">Raining Tacos</p>
                           
                            <p class="descripcion1">Open your mouth and close your eyes. Its raining tacos (8)</p>
                          <div class="btnVotado">Ya votado</div>
                          
                        </div></span>

                                      </div>
                                      </div>'; 
                                } else {
                                     echo '<div class="ca-item ">
                                      <div class="ca-item-main" >
                                      <img src="http://i1.ytimg.com/vi/' . $row3[1] . '/mqdefault.jpg" class="imgVideos"/>
                                      <span class="spanVideos"> <div class="info2">
                            <p class="tituloVideo" title="Raining Tacos">Raining Tacos</p>
                           
                            <p class="descripcion1">Open your mouth and close your eyes. Its raining tacos (8)</p>
                          
                            <div data-votelist="'.$row3[0].'" id="'.$row3[1].'" class="btnVotar"><span>Votar</span></div>
                        </div></span>

                                      </div>
                                      </div>'; 
                                }
                            }
function existsVideo($idVideo) {
    $instancia = Conexion::getInstance();
    $query = "SELECT * FROM `momolol`.`voteList` WHERE idVideo='" . $idVideo . "'";

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

