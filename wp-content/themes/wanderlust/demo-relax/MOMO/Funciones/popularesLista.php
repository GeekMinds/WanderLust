<?
$mysqli = new mysqli("localhost", "baking_momolol", 'VP$,s$kUCE!s', "baking_momolol");
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
