<?
session_start();
$jsonLogin = $_SESSION['loginUser'];
$obje = json_decode($jsonLogin);
if ($obje == null) {
    header("Location: Login-Registro.php");
};
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/PaginaPrincipal.css"/>
        <link rel="stylesheet" type="text/css" href="css/listaPaginaPrincipal.css" />
        <link rel="stylesheet" type="text/css" href="css/component.css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/Facebook.js"></script>
        <script type="text/javascript">
            function redireccionar(id) {
                window.location.href = "PerfilArtista.php?artist=" + id + "";
            }
            $(function() {
                var ele = $('#scroll');
                var speed = 25, scroll = 5, scrolling;

                $('#scroll-up').mouseenter(function() {
                    // Scroll the element up
                    scrolling = window.setInterval(function() {
                        ele.scrollTop(ele.scrollTop() - scroll);
                    }, speed);
                });

                $('#scroll-down').mouseenter(function() {
                    // Scroll the element down
                    scrolling = window.setInterval(function() {
                        ele.scrollTop(ele.scrollTop() + scroll);
                    }, speed);
                });

                $('#scroll-up, #scroll-down').bind({
                    click: function(e) {
                        // Prevent the default click action
                        e.preventDefault();
                    },
                    mouseleave: function() {
                        if (scrolling) {
                            window.clearInterval(scrolling);
                            scrolling = false;
                        }
                    }
                });
            });
        </script>
        <script type="text/javascript">
            function getVoteList() {
                var lista = $.ajax({
                    url: 'Funciones/voteList.php',
                    dataType: 'text',
                    async: false}).responseText;
                document.getElementById("voteList").innerHTML = lista;
            }
            function getListaSugeridos() {
                var lista = $.ajax({
                    url: 'Funciones/sugeridosList.php',
                    dataType: 'text',
                    async: false}).responseText;
                document.getElementById("listaSugeridos").innerHTML = lista;
            }
            function getListaPopulares() {
                var lista = $.ajax({
                    url: 'Funciones/popularesLista.php',
                    dataType: 'text',
                    async: false}).responseText;
                document.getElementById("listaPopulares").innerHTML = lista;
            }
            setInterval(getVoteList, 20000);
            setInterval(getListaSugeridos, 3600);
            setInterval(getListaPopulares, 3600);


        </script>
        <script>
           $('#voteList .btnVotar').live('click', function() {
                    
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
        </script>
    </head>
    <body>
        <section id="headerNoticias">
            <section id="menuOut">

            </section>
            <section id="pulpos">

            </section>
        </section>
        <section id="wrapper">
            <section id="logo"></section>
            <section id="menu">
                <div id="sb-search" class="sb-search">
                    <form action="busqueda.php" method="GET">
                        <input class="sb-search-input" placeholder="Search video..." type="search" value="" name="q" id="search">
                        <input id='searchBtn' class="sb-search-submit" type="submit" value="">
                        <div style="color: transparent;" class="sb-icon-search"><span style="top: -10px;" class="sb-icon-search"></span></div>
                    </form>

                </div> 
                <ul>
                    <li><a href="Noticias.php">Noticias</a></li>
                    <li><a href="Perfil.php">Perfil</a></li>
                    <li><a href="<? echo 'Funciones/logout.php' ?>" onclick="Logout()">Cerrar Sesion</a></li>

                </ul>
            </section>
            <img src="resources/image/PaginaPrincipal/yeti2.png" id="yeti"/>

            <section id="texturaTriangulos">
                <div id="promociones">
                    <div id="ca-container" class="ca-container">
                        <div class="ca-nav"><span class="ca-nav-prev" id="prev"></span><span class="ca-nav-next" id="next"></span></div>
                        <div class="ca-wrapper" id="voteList">
                            <?
                            require_once("Funciones/conexion.php");

                            $instancia = Conexion::getInstance();
                            $query = "SELECT * FROM voteList";
                            #echo $query;
                            $mysqli = $instancia::getConexion();
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
                            <p class="tituloVideo" title="Raining Tacos">Titulo</p>
                           
                            <p class="descripcion1">   Descripcion</p>
                          <div class="btnVotado">Ya votado</div>
                          
                        </div></span>

                                      </div>
                                      </div>'; 
                                } else {
                                     echo '<div class="ca-item ">
                                      <div class="ca-item-main" >
                                      <img src="http://i1.ytimg.com/vi/' . $row3[1] . '/mqdefault.jpg" class="imgVideos"/>
                                      <span class="spanVideos"> <div class="info2">
                            <p class="tituloVideo" title="Raining Tacos">Titulo</p>
                           
                            <p class="descripcion1">Descripcion</p>
                          
                            <div data-votelist="'.$row3[0].'" id="'.$row3[1].'" class="btnVotar"><span>Votar</span></div>
                        </div></span>

                                      </div>
                                      </div>'; 
                                }
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
                                if ($row_cnt > 0) {
                                    
                                    return true;
                                } 
                                return false;
                            }
                            ?>
                        </div>
                    </div>

                    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
                    <!-- the jScrollPane script -->
                    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
                    <script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
                    <script type="text/javascript">
            $('#ca-container').contentcarousel();
            function getSlider() {
                $('#ca-container').contentcarousel();
            }
            setInterval(getSlider, 20000);
                    </script>
                </div>
            </section>
            <img src="resources/image/PaginaPrincipal/go.png" id="go"/>
            <img src="resources/image/PaginaPrincipal/robot.png" id="robot"/>
            <section id="lista1">
                <section class="lef1">
                    <div style="position: absolute;margin-left: -40px; margin-top: 400px; width: 83px; height: 190px; background-image: url('resources/image/PaginaPrincipal/more.png');" id="scroll-down" class="btn"></div>
                    <div style="position: absolute;margin-left: -40px; margin-top: 210px; width: 83px; height: 190px; background-image: url('resources/image/PaginaPrincipal/more2.png');" id="scroll-up" class="btn"></div>
                </section>
                <section id="scroll" class="lista" >
                    <ul id="listaSugeridos">
                        <?php
                        $resultado2 = $mysqli->query("SELECT Artist.idArtist, Suggestion.idArtist, Artist.name, Artist.idGenre, Genre.name, Song.title,Song.idVideo, Genre.description, Artist.name FROM Suggestion INNER JOIN Artist ON Suggestion.idArtist = Artist.idArtist INNER JOIN Genre ON Artist.idGenre = Genre.idGenre INNER JOIN Song ON Artist.idArtist = Song.idArtist LIMIT 0,8");
                        /* $resultado2 = $mysqli->query("SELECT TOP 10 Song.title,Song.played FROM Song  ORDER BY played DESC"); */
                        $numeroregistros = $resultado2->num_rows;

                        for ($i = 0; $i < $numeroregistros; $i++) {
                            $i;
                            $resultado2->data_seek($i);
                            $row3 = $resultado2->fetch_row();





                            echo '<li>
                            <div class="video">
                                <img title="' . $row3[2] . '"src="http://i1.ytimg.com/vi/' . $row3[6] . '/mqdefault.jpg" />
                            </div>
                            <div class="info">
                                <p class="titulo" title="' . $row3[2] . '">' . $row3[2] . '</p>

                                <p class="descripcion"></p>

                                        <input class="btnVotado" type="button" value ="' . $row3[2] . '" onClick="redireccionar(' . $row3[0] . ')";/>
                            </div>
                        </li>';
                        }
                        ?>
                    </ul>
                </section>
            </section>
            <section id="lista2">
                <section class="lef2">

                </section>
                <section class="lista">
                    <ul id="listaPopulares">
                        <?
                        $resultado2 = $mysqli->query("SELECT * FROM Song ORDER BY played DESC limit 0,5");
                        $numeroregistros = $resultado2->num_rows;
                        for ($i = 0; $i < $numeroregistros; $i++) {
                            $i;
                            $resultado2->data_seek($i);
                            $row3 = $resultado2->fetch_row();
                            echo '
                        <li>
                            <div class="video">
                          <img src="http://i1.ytimg.com/vi/' . $row3[5] . '/mqdefault.jpg" />
                            </div>
                            <div class="info">
                                <a class="nombreArtista" href="perfil.php?' . $row3[2] . '"><p class="titulo" title="Raining Tacos">' . $row3[2] . '</p></a>

                                <p class="descripcion">' . $row3[7] . '</p>

                                
                            </div>
                        </li>
                    ';
                        }
                        ?>

                    </ul>
                </section>
            </section>
            <img src="resources/image/PaginaPrincipal/pulpo.png" id="pulpoFooter"/>
        </section>
        <section id="fondoCentralP">
            <img src="resources/image/PaginaPrincipal/f.png" id="fondoCentral"/>

        </section>
        <section id="footerNoticias">
            <section id="flecha"> 
            </section>
            <section id="redes">
                <section id="rd">
                    <div id="fb"></div>
                    <div id="plus"></div>
                    <div id="twitt"></div>
                </section>
            </section>
        </section>
        <script src="js/classie.js"></script>
        <script src="js/uisearch.js"></script>
        <script>
            new UISearch(document.getElementById('sb-search'));
        </script>
    </body>
</html>

