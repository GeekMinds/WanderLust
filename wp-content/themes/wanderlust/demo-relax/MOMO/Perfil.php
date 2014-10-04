<?
session_start();
$jsonLogin = $_SESSION['loginUser'];
$obje = json_decode($jsonLogin);
if ($obje == null) {
    header("Location: Login-Registro.php");
}else {
        $nombreUsuario = $obje->{'id'};
};
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/Perfil.css"/>
        <link rel="stylesheet" type="text/css" href="css/component.css" />

    </head>
    <body>
        <?php
        $mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");

        
        ?>
        <div id="headerNoticias">


            <div class="menuOut">

            </div>

        </div>


        <div id="wrapper">
            <div id="logo"></div>
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

            <section class="contenedorDetalles">
                <div class="photo">
                    <?php
                    $resultado2 = $mysqli->query("SELECT  * FROM  User WHERE username = '" . $nombreUsuario . "'");
                    $resultado2->data_seek(0);
                    $row1 = $resultado2->fetch_row();

                    echo '<img src="' . $row1[8] . '?width=600&height=600"/>';
                    ?>
                </div>
                <div class="info">
                    <p><?php echo $row1[3] . " " .$row1[4] ?></p>

                    <p><?php echo $row1[5] ?></p>
                </div>
                <div class="stats">
                    <p style="margin-top: 40px;">Videos Ganados</p>
                    <div class="star">
                        <?php
                        $resultado2 = $mysqli->query("SELECT * FROM PlaylistRegister WHERE username = '" . $nombreUsuario . "' AND winner >= 1");
                        $numeroregistros = $resultado2->num_rows;
                        echo '<label style="color:white;">' . $numeroregistros . '</label>';
                        ?>

                    </div>
                    <p>Videos Propuestos</p>
                    <div class="star">
                        <?php
                        $resultado2 = $mysqli->query("SELECT PlaylistRegister.votos FROM PlaylistRegister WHERE username = '" . $nombreUsuario . "' AND winner =0");
                        $numeroregistros = $resultado2->num_rows;
                        echo '<label style="color:white;">' . $numeroregistros . '</label>';
                        ?>
                    </div>

                </div>
            </section>

            <section class="contenedorVideos">
                <div class="titulo"><label>MIS VIDEOS</label></div>
                <ul id="videos">
                    <?php
                    $resultado2 = $mysqli->query("SELECT * FROM PlaylistRegister  WHERE username = '" . $nombreUsuario . "'");

                    $numeroregistros = $resultado2->num_rows;


                    for ($i = 0; $i < $numeroregistros; $i++) {
                        $i;
                        $resultado2->data_seek($i);
                        $row3 = $resultado2->fetch_row();
                        echo '<li>
                            <img src="http://i1.ytimg.com/vi/' . $row3[1] . '/mqdefault.jpg" />
                           <span><div class="info2">
                            <p class="tituloVideo" title="' . $row3[8] . '"></p>
                           
                            <p class="descripcion">' . $row3[8] . '</p>
                          
                          
                        </div></span>
                       </li>';
                    }
                    ?>
                </ul>

            </section>

            <img src="resources/image/Perfil/pulpo.png" id="pulpoFooter"/>
        </div>
        <div class="conejo"></div>
        <div id="bg"></div>
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
