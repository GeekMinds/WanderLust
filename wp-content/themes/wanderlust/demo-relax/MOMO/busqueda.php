<?
session_start();
$jsonLogin = $_SESSION['loginUser'];
$obje = json_decode($jsonLogin);
if ($obje == null) {
    header("Location: Login-Registro.php");
}  else {
    
       $nombre = $obje->{'name'};
       $apellido = $obje->{'lastname'};
};
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/busqueda.css"/>

        <link rel="stylesheet" type="text/css" href="css/component.css" />

        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/Facebook.js"></script>
        <script type="text/javascript">
            $(function() {
//More Button
                $('#ola').click(function()
                {
                    $('#ola').hide();
                    var q = $('#lastQuery').val();
                    ;
                    var m = $('#nextPageToken').val();
                    ;
                    var dataString = 'q=' + q + '&nextPageToken=' + m;
                    console.log(dataString);       
                    $.ajax({
                        type: "POST",
                        cache: false,
                                url: "Funciones/loadmore.php",
                        data: dataString,
                                success: function(html)
                                {
                            console.log(html);

                                        if (html)
                                        {
                                            $('.nextPageToken').remove();
                                            $('.lastQuery').remove();
                                            $(".lista ul").append(html);
                                            var nuevo = $(".lista").scrollTop() + 765;
                                             $(".lista").animate({ scrollTop: nuevo });
                                          // .scrollTop(actual+765);
                                            $('#ola').show();

                                        } else
                                        {
                                            $('div#loadmoreajaxloader').html('<center>No more posts to show.</center>');
                                        }
                                }
                            });

                    return false;
                });
                
                 $('#searchBtn').click(function()
                {

                    var q = $('#search').val();
                    console.log(q);
                    $('.lista ul li').remove();
                    $('.nextPageToken').remove();
                    $('.lastQuery').remove();
                    $('div#ola').hide();
                    $.ajax({
                        type: "POST",
                        url: "Funciones/query.php",
                        data: "q=" + q,
                        cache: false,
                        success: function(html) {
                           // console.log(html);
                            $(".lista ul").append(html);

                            $('#ola').show();
                        }
                    });
                    return false;
                });
                
                 $('.lista').on('click', '.btn', function() {
                    var idVideo = $(this).attr('id');
                    var button = $(this);
                    var data = "idVideo=" + idVideo + "&fecha=" + getFecha();
                    console.log(getFecha());
                    $.ajax({
                        type: "POST",
                        url: "Funciones/proponer.php",
                        data: data,
                        cache: false,
                        success: function(html) {
                            button.removeClass("btn");
                            button.addClass("btnVotado");
                            
                            $(".lista ul").append(html);
                           button.children().text('Sugerido');
                         //$(this).find("span").text('Sugerido');
                            publicarSugirio(idVideo,'<? echo $_SESSION['tipo']; ?>');
                        } 
                    });
                });

                $('.lista').on('click', '.btnVotar', function() {
                    
                    var idVideo = $(this).attr('id');
                    var idList = $(this).data('votelist');
                    var data = "idVoteList=" + idList + "&fecha=" + getFecha();
                    var button = $(this);
                    $.ajax({
                        type: "POST",
                        url: "Funciones/votar.php",
                        data: data,
                        cache: false,
                        success: function(html) {
                            button.removeClass("btnVotar");
                            button.addClass("btnVotado");  
                            button.children().text('Votado');
                             $(".lista ul").append(html);
                           
                            publicarVoto(idVideo, '<? echo $_SESSION['tipo']; ?>');
                        }
                    });
                });

                function getFecha() {
                                   var fecha = new Date();
                
                                       var dia = fecha.getDate();
                
                                   var mes = fecha.getMonth() + 1;
                                   var year = fecha.getFullYear();
                                   var resultado = dia + "/" + mes + "/" + year;

                                   return resultado;
                               }

            });
        </script>
    </head>
    <body>
        <div id="headerNoticias">
            <div class="menuOut">

            </div>

        </div>

        <div id="wrapper">
            <div id="logo"></div>
            <div id="menu">
                <div id="sb-search" class="sb-search">
                    <form>
                        <input class="sb-search-input" placeholder="Search video..." type="search" value="" name="search" id="search">
                        <input id='searchBtn' class="sb-search-submit" type="submit" value="">
                        <div style="color: transparent;" class="sb-icon-search"><span style="top: -10px;" class="sb-icon-search"></span></div>
                    </form>

                </div>  
                <ul>
                    <li><a href="index.php">Pagina Principal</a></li>
                    <li><a href="Noticias.php">Noticias</a></li>
                    <li><a href="Perfil.php">Perfil</a></li>
                </ul>

            </div>
            <div class="lef"></div>
            <section class="lista">
                <ul>
                    <?php
                    session_start();
                    if ($_GET['q']) {

                        // Call set_include_path() as needed to point to your client library.
                        require_once 'google-api-php-client/src/Google_Client.php';
                        require_once 'google-api-php-client/src/contrib/Google_YouTubeService.php';
                        //Call conection Mysql
                        require_once("Funciones/conexion.php");
                         require_once("Funciones/votosPropuestas.php");
                        /* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
                          Google APIs Console <http://code.google.com/apis/console#access>
                          Please ensure that you have enabled the YouTube Data API for your project. */
                        $DEVELOPER_KEY = 'AIzaSyCkVS9hbmtEZxm3LMzfmOZ6bjyyLkoS46U';

                        $client = new Google_Client();
                        $client->setDeveloperKey($DEVELOPER_KEY);

                        $youtube = new Google_YoutubeService($client);

                        try {
                            $searchResponse = $youtube->search->listSearch('id,snippet', array(
                                'q' => $_GET['q'],
                                'maxResults' => 5
                            ));
                            ?><input type="hidden" id="lastQuery" class="lastQuery" value="<?php echo $_GET['q']; ?>"/>
                            <?php
                            $videos = '';
                            $channels = '';
                            $playlists = '';
                            $nextPage = $searchResponse['nextPageToken'];

                            if (count($searchResponse['items']) > 0) {
                                foreach ($searchResponse['items'] as $searchResult) {
                                    switch ($searchResult['id']['kind']) {
                                        case 'youtube#video':
                                                #echo existsVideo($searchResult['id']['videoId']);
                                            if (existsVideo($searchResult['id']['videoId']) != null) {
                                                $json = existsVideo($searchResult['id']['videoId']);
                                                $obj = json_decode($json);
                                                $idVL = $obj->{'idVoteList'};
                                                 #echo(userVoteThis($idVL));
                                                if (userVoteThis($idVL)) {
                                                    $videos .= sprintf('  <li><div class="video"><img src="%s" /></div><div class="info"><p class="titulo" title="%s">%s</p><p class="descripcion">%s</p><div class="btnVotado">  <span>Votado</span></div></div></li>', $searchResult['snippet']['thumbnails']['high']['url'], $searchResult['snippet']['title'], $searchResult['snippet']['title'], $searchResult['snippet']['description']);
                                                    // $videos .= sprintf('<li>%s (%s)<img src="%s"/> <input type="button" class="votado" value="Ya ha votado" /> </li>', $searchResult['snippet']['title'], $searchResult['id']['videoId'], $searchResult['snippet']['thumbnails']['high']['url']);   
                                                } else {
                                                    $videos .= sprintf('  <li><div class="video"><img src="%s" /></div><div class="info"><p class="titulo" title="%s">%s</p><p class="descripcion">%s</p><div data-votelist="%s" id="%s" class="btnVotar">  <span>Votar</span></div></div></li>', $searchResult['snippet']['thumbnails']['high']['url'], $searchResult['snippet']['title'], $searchResult['snippet']['title'], $searchResult['snippet']['description'], $idVL, $searchResult['id']['videoId']);
                                                    // $videos .= sprintf('<li>%s (%s)<img src="%s"/> <input type="button" class="votar" id="%s" value="votar" /></li>', $searchResult['snippet']['title'], $searchResult['id']['videoId'], $searchResult['snippet']['thumbnails']['high']['url'], $idVL);
                                                }
                                            } else {
                                                $videos .= sprintf('  <li><div class="video"><img src="%s" /></div><div class="info"><p class="titulo" title="%s">%s</p><p class="descripcion">%s</p><div id="%s" class="btn">  <span>Sugerir</span></div></div></li>', $searchResult['snippet']['thumbnails']['high']['url'], $searchResult['snippet']['title'], $searchResult['snippet']['title'], $searchResult['snippet']['description'], $searchResult['id']['videoId']);
                                                // $videos .= sprintf('<li>%s (%s)<img src="%s"/> <input type="button" class="sugerir" id="%s" value="sugerir" /></li>', $searchResult['snippet']['title'], $searchResult['id']['videoId'], $searchResult['snippet']['thumbnails']['high']['url'], $searchResult['id']['videoId']);
                                            }

                                            break;
                                    }
                                }
                                ?><input type="hidden" id="nextPageToken" name="nextPageToken" class="nextPageToken" value="<?php echo $nextPage ?>"/>

                                <?php
                                echo $videos;
                            } else {
                                ?> <h1> <?php echo "Ningun resultado para " . $_GET['q']; ?> </h1> 
                                <?php
                            }
                        } catch (Google_ServiceException $e) {
                            echo '<p>A service error occurred: <code>' . htmlspecialchars($e->getMessage()) . '</code></p>';
                        } catch (Google_Exception $e) {
                            echo '<p>A service error occurred: <code>' . htmlspecialchars($e->getMessage()) . '</code></p>';
                        }
                    }
                    ?>
                </ul>
            </section>
            <div id='ola' class="more"><span>MORE</span></div>
            <section class="cassetes"></section>
            <div class="robot"></div>
            <img src="resources/image/busqueda/pulpo.png" id="pulpoFooter"/>
        </div>

        <div id="footerNoticias">
        </div>

        <!-- /container -->
        <script src="js/classie.js"></script>
        <script src="js/uisearch.js"></script>
        <script>
            new UISearch(document.getElementById('sb-search'));
        </script>
    </body>
</html>



