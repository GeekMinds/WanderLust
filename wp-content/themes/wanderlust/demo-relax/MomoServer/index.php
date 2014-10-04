
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Animated Border Menus | Demo 6</title>
        <meta name="description" content="Responsive Animated Border Menus with CSS Transitions" />
        <meta name="keywords" content="navigation, menu, responsive, border, overlay, css transition" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/icons.css" />
        <link rel="stylesheet" type="text/css" href="css/style6.css" />
        <script src="js/modernizr.custom.js"></script>
    </head>
    <body>
        <div class="container">
            <!--<header class="codrops-header">
                    <h1>Servidor</h1>
                    
                    <a href="#" id="bt-menu-trigger-out" class="bt-menu-trigger-out"><span class="bt-icon-alt icon-play"></span></a>
                    
                    
            </header>-->
            <nav id="bt-menu" class="bt-menu bt-menu-open">
                    <!--<a href="#" class="bt-menu-trigger"><span>Menu</span></a>-->
                <div id="player"></div>
                <ul class="bt-menu-top">
                    <!--<li><a href="#" class="bt-icon-alt icon-step-backward">Start</a></li>-->
                    <!--				<li><a href="#" class="bt-icon-alt icon-backward">Fast Backward</a></li>-->
                    <li><h1 style="font-size: 70px; margin: 0px auto; opacity: 0.7;">Momo Player</h1></li>
                    <!--<li><a href="#" class="bt-icon-alt icon-forward">Fast Forward</a></li>-->
                    <!--<li><a href="#" class="bt-icon-alt icon-step-forward">Next</a></li>-->
                </ul>
                <ul class="bt-menu-bottom">
                    <?
                    require_once("Funciones/conexion.php");
                    $instancia = Conexion::getInstance();
                    $query = "SELECT * FROM voteList ORDER BY votos DESC limit 0, 5";
                    # echo $query;
                    $result = $instancia::getConexion()->query($query);
                    $row_cnt = $result->num_rows;
                    for ($i = 0; $i < $row_cnt; $i++) {
                        $result->data_seek($i);
                        $row = $result->fetch_row();
                        
                            echo '<li><img src="http://i1.ytimg.com/vi/'.$row[1].'/mqdefault.jpg"/></li>';
                    }
                        ?>

                    
                    

                </ul>

            </nav>
        </div><!-- /container -->
        <script>
            // 2. This code loads the IFrame Player API code asynchronously.
            var tag = document.createElement('script');
            var myArray = [];
// Adds "hello" on index 0
                    <?
                    require_once("Funciones/conexion.php");
                    $instancia = Conexion::getInstance();
                    $query = "SELECT * FROM voteList ORDER BY votos DESC limit 0, 5";
                    # echo $query;
                    $result = $instancia::getConexion()->query($query);
                    $row_cnt = $result->num_rows;
                    for ($i = 0; $i < $row_cnt; $i++) {
                        $result->data_seek($i);
                        $row = $result->fetch_row();
                        
                            echo 'myArray.push("'.$row[1].'");';
                    }
                    ?>

          /*  RQ0FzwaqLow
            myArray.push("1ryx9EVH0MM");
            myArray.push("kA3YfgGTPbQ");*/
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('ul')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            // 3. This function creates an <iframe> (and YouTube player)
            //    after the API code downloads.
            var player;
            function onYouTubeIframeAPIReady() {
                player = new YT.Player('player', {
                    height: '100%',
                    width: '100%',
                    videoId: myArray[0],
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }

            // 4. The API will call this function when the video player is ready.
            function onPlayerReady(event) {
                event.target.playVideo();
            }

            // 5. The API calls this function when the player's state changes.
            //    The function indicates that when playing a video (state=1),
            //    the player should play for six seconds and then stop.
            //var done = false;
            function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.ENDED) {
                    /*
                     var url = event.target.getVideoUrl();
                     // "http://www.youtube.com/watch?v=gzDS-Kfd5XQ&feature=..."
                     var match = url.match(/[?&]v=([^&]+)/);
                     // ["?v=gzDS-Kfd5XQ", "gzDS-Kfd5XQ"]
                     var videoIdPrev = match[1];*/
                    myArray.shift();
                    var videoId = myArray[0];
                    if (videoId == null) {
                        alert('eliminara');
                        document.location.href = "delete.php";
                    } else {
                        //alert(videoId);
                    }

                    player.loadVideoById(videoId);
                    //player.loadVideoById('55npUcM1h5U');
                }
            }
            function stopVideo() {
                player.stopVideo();
            }
        </script>
    </body>
    <script src="js/classie.js"></script>
    <script src="js/borderMenu.js"></script>
</html>