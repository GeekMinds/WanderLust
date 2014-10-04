<?php
$mysqli = new mysqli("10.200.10.193", "root", "root", "momolol", 8889);
                            $numeroregistros = $mysqli->query("SELECT COUNT(*) FROM voteList ");
                            $resultado2 = $mysqli->query("SELECT voteList.idVideo, voteList.username, voteList.votos FROM voteList");
                            $numeroregistros->data_seek();
                            $numero = $numeroregistros->fetch_row();
                            for ($i = 0; $i < $numero[0]; $i++) {
                                $resultado2->data_seek($i);
                                $row3 = $resultado2->fetch_row();
                                echo '<div class="ca-item ">
                                <div class="ca-item-main" >
                                    <img src="http://i1.ytimg.com/vi/' . $row3[0] . '/mqdefault.jpg" class="imgVideos"/>
                                    <span class="spanVideos"> <label class="votar"></label></br><label class="etiquetaVotar">Votar</label></span>
                                </div>
                            </div>';
                            } ?>
