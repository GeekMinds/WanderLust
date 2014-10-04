<?php

$mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");
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