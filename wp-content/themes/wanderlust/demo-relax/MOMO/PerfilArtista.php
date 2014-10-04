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
        <link type="text/css" href="css/PerfilArtista.css" rel="stylesheet">
        <link type="text/css" href="css/PaginaPrincipal.css" rel="stylesheet">
    </head>

    <body class="Cuerpo">




        <div >

            <header class="encabezadoprincipal" >
                <?php
                $mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");

                $adios = $_GET['artist'];
                $resultado2 = $mysqli->query("SELECT  * FROM  Artist WHERE idArtist= $adios");
                $resultado2->data_seek(0);
                $row1 = $resultado2->fetch_row();
                ?>

                <div class="logo" ></div>    

            </header>
            <section id="menu">
                <div id="sb-search" class="sb-search">
                    <form action="busqueda.php" method="GET">
                        <input class="sb-search-input" placeholder="Search video..." type="search" value="" name="q" id="search">
                        <input id='searchBtn' class="sb-search-submit" type="submit" value="">
                        <div style="color: transparent;" class="sb-icon-search"><span style="top: -10px;" class="sb-icon-search"></span></div>
                    </form>

                </div> 
                <ul>
                    <li><a href="index.php">Pagina Principal</a></li>
                    <li><a href="Noticias.php">Noticias</a></li>
                    <li><a href="Perfil.php">Perfil</a></li>
                </ul>
            </section>
            <div class="Central">
                <div class="imagenIzquierda" ></div>  

                <div class="stuff" >

                    <div class="nombreArtista" >
                        <?php
                        echo '<label class="nombreArtistaLabel">' . $row1[1] . '</label>';
                        ?>
                    </div>
                    <div class="imagneArtista">
                        <?php
                        echo '<img class="tamañoImagen" src="image/' . $row1[3] . '">';
                        ?>
                    </div>
                    <div class="imagenDerecha" ></div>

                    <div class="descripcionArtista" >
<?php
echo '<label class="biografialabel">' . $row1[4] . '</label>';
?>

                    </div>
                    <div class="encabezado" ></div>
                    <div class="videosArtista" >
                        <ul id="videos">
<?php
$resultado2 = $mysqli->query("SELECT * FROM Song INNER JOIN Artist ON Artist.idArtist = Song.idArtist WHERE Artist.idArtist = $adios");
/* $resultado2 = $mysqli->query("SELECT TOP 10 Song.title,Song.played FROM Song  ORDER BY played DESC"); */
$numeroregistros = $resultado2->num_rows;




for ($i = 0; $i < $numeroregistros; $i++) {
    $i;
    $resultado2->data_seek($i);
    $row3 = $resultado2->fetch_row();


    echo '<li>
                            <div class="video">
                          <img src="http://i1.ytimg.com/vi/' . $row3[5] . '/mqdefault.jpg" />
                            </div>
                            <div class="info">

                            </div>
                        </li>';
}
?>
                        </ul>
                    </div>

                </div>
                <footer class="pie" >
                </footer>
                <div class="imagen1"></div>

            </div>
        </div>
    </body>
</html>
