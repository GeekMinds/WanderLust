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
        <link rel="stylesheet" href="css/Noticias.css"/>
        <link rel="stylesheet" type="text/css" href="css/nuevo.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/component.css" />
    </head>
    <body>
        <div id="headerNoticias">
            <div id="menuOut">

            </div>
            <div id="comida">

            </div>
        </div>

        <div id="wrapper">
            <div id="logo"></div>
            <div id="menu">
                <div id="sb-search" class="sb-search">
                    <form action="busqueda.php" method="GET">
                        <input class="sb-search-input" placeholder="Search video..." type="search" value="" name="q" id="search">
                        <input id='searchBtn' class="sb-search-submit" type="submit" value="">
                        <div style="color: transparent;" class="sb-icon-search"><span style="top: -10px;" class="sb-icon-search"></span></div>
                    </form>

                </div> 
                <ul>
                    <li><a href="index.php">Pagina Principal</a></li>
                    <li><a href="Perfil.php">Perfil</a></li>
                </ul>
            </div>
            <div id="comelon">
            </div>
            <div id="promociones">
                <ul id="anuncios">
                    <li><img src="resources/image/Noticias/anuncio4.png"/></li>
                    <li><img src="resources/image/Noticias/anuncio2.jpg"/></li>
                    <li><img src="resources/image/Noticias/anuncio3.jpg"/></li>
                </ul>
            </div>
            <img src="resources/image/Noticias/ganadorListon.png" id="ganadorListon"/>
            <div id="ca-container" class="ca-container">
                <div class="ca-nav"><span class="ca-nav-prev" id="prev"></span><span class="ca-nav-next" id="next"></span></div>
                <div class="ca-wrapper">
                    <?
                    $mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");
                    $query = "SELECT User.name,User.userPass, User.lastName,User.urlPicture, PlaylistRegister.votos FROM PlaylistRegister INNER JOIN User ON PlaylistRegister.username = User.username";

                    $resultado = $mysqli->query($query);
                    $numeroResultados = $resultado->num_rows;
                    for ($i = 0; $i < $numeroResultados; $i++) {
                        $resultado->data_seek($i);
                        $row = $resultado->fetch_row();
                        if (strcmp($row[1], "") == 0) {
                            echo '<div class="ca-item ">
                        <div class="ca-item-main">
                            <img id="imagenGanador" src="' . $row[3] . '"/>
                            <div id="infoGanador">
                                <label>' . $row[0] . " " . $row[2] . '</label></br>
                                <label>Votos: '. $row[4] . '</label></br>
                            </div>
                        </div>
                    </div>';
                        } else {
                            echo '<div class="ca-item ">
                        <div class="ca-item-main">
                            <img id="imagenGanador" src="' . $row[3] . "?width=600&height=600" . '"/>
                            <div id="infoGanador">
                                <label>' . $row[0] . " " . $row[2] . '</label></br>
                                <label>Votos: ' . $row[4] . '</label></br>
                            </div>
                        </div>
                    </div>';
                        };
                    };
                    ?>
                </div>
            </div>

            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
            <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
            <!-- the jScrollPane script -->
            <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
            <script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
            <script type="text/javascript">
                $('#ca-container').contentcarousel(

                        );

            </script>
            <img src="resources/image/PaginaPrincipal/pulpo.png" id="pulpoFooter"/>
        </div>
        <div id="copas">
            <img src="resources/image/Noticias/copasDerecha.png" id="copasDerecha"/>
            <img src="resources/image/Noticias/copasIzquierda.png" id="copasIzquierda"/>
        </div>
        <div id="footerNoticias">
            <section id="flecha"> 
            </section>
            <section id="fbRegister">
                <div id="feis"></div>
                <div id="registerfeis">

                </div>
            </section>
        </div>
        <script src="js/classie.js"></script>
        <script src="js/uisearch.js"></script>
        <script>
            new UISearch(document.getElementById('sb-search'));
        </script>
    </body>
</html>
