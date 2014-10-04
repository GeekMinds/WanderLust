<?php
session_start();
if ($_POST['q'] && $_POST['nextPageToken']) {

    // Call google client library.
    require_once '../google-api-php-client/src/Google_Client.php';
    require_once '../google-api-php-client/src/contrib/Google_YouTubeService.php';
    //Call conection Mysql
    require_once("conexion.php");
    /* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
      Google APIs Console <http://code.google.com/apis/console#access>
      Please ensure that you have enabled the YouTube Data API for your project. */
    $DEVELOPER_KEY = 'AIzaSyCkVS9hbmtEZxm3LMzfmOZ6bjyyLkoS46U';

    $client = new Google_Client();
    $client->setDeveloperKey($DEVELOPER_KEY);

    $youtube = new Google_YoutubeService($client);

    try {
        $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $_POST['q'],
            'pageToken' => $_POST['nextPageToken'],
            'maxResults' => 5
        ));
        ?><input type="hidden" id="lastQuery" class="lastQuery" value="<?php echo $_POST['q']; ?>"/>
        <?php
        $videos = '';
        $channels = '';
        $playlists = '';
        $nextPage = $searchResponse['nextPageToken'];
       
        if (count($searchResponse['items']) > 0) {
            foreach ($searchResponse['items'] as $searchResult) {
                switch ($searchResult['id']['kind']) {
                   
                      case 'youtube#video':

                                            if (existsVideo($searchResult['id']['videoId']) != null) {
                                                $json = existsVideo($searchResult['id']['videoId']);
                                                $obj = json_decode($json);
                                                $idVL = $obj->{'idVoteList'};

                                                if (userVoteThis($idVL)) {
                                                    $videos .= sprintf('  <li><div class="video"><img src="%s" /></div><div class="info"><p class="titulo" title="%s">%s</p><p class="descripcion">%s</p><div class="btnVotado">  <span>Votado</span></div></div></li>', $searchResult['snippet']['thumbnails']['high']['url'], $searchResult['snippet']['title'], $searchResult['snippet']['title'], $searchResult['snippet']['description']);
                                                    
                                                } else {
                                                    $videos .= sprintf('  <li><div class="video"><img src="%s" /></div><div class="info"><p class="titulo" title="%s">%s</p><p class="descripcion">%s</p><div data-voteList="%s" id="%s" class="btnVotar">  <span>Votar</span></div></div></li>', $searchResult['snippet']['thumbnails']['high']['url'], $searchResult['snippet']['title'], $searchResult['snippet']['title'], $searchResult['snippet']['description'], $idVL, $searchResult['id']['videoId']);
                                                   // $videos .= sprintf('  <li><div class="video"><img src="%s" /></div><div class="info"><p class="titulo" title="%s">%s</p><p class="descripcion">%s</p><div id="%s" class="btnVotar">  <span>Votar</span></div></div></li>', $searchResult['snippet']['thumbnails']['high']['url'], $searchResult['snippet']['title'], $searchResult['snippet']['title'], $searchResult['snippet']['description'], $idVL);
                                                    
                                                }
                                            } else {
                                                $videos .= sprintf('  <li><div class="video"><img src="%s" /></div><div class="info"><p class="titulo" title="%s">%s</p><p class="descripcion">%s</p><div id="%s" class="btn">  <span>Sugerir</span></div></div></li>', $searchResult['snippet']['thumbnails']['high']['url'], $searchResult['snippet']['title'], $searchResult['snippet']['title'], $searchResult['snippet']['description'], $searchResult['id']['videoId']);
                                                
                                            }

                                            break;
                }
            }
            ?><input type="hidden" id="nextPageToken" name="nextPageToken" class="nextPageToken" value="<?php echo $nextPage ?>"/>

            <?php echo $videos;
        } else {
            ?> <h1> <?php echo "Ningun resultado para " . $_POST['q']; ?> </h1> 
            <?php
        }
    } catch (Google_ServiceException $e) {
        echo '<p>A service error occurred: <code>' . htmlspecialchars($e->getMessage()) . '</code></p>';
    } catch (Google_Exception $e) {
        echo '<p>A service error occurred: <code>' . htmlspecialchars($e->getMessage()) . '</code></p>';
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
    if ($row_cnt > 0)
        return true;
    return false;
}
?>
