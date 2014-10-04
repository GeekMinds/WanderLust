<?php

                    require_once("Funciones/conexion.php");
                    $instancia = Conexion::getInstance();
                    $query = "SELECT * FROM voteList ORDER BY votos DESC limit 0, 5";
                    # echo $query;
                    $result = $instancia::getConexion()->query($query);
                    $row_cnt = $result->num_rows;
                    for ($i = 0; $i < $row_cnt; $i++) {
                        $result->data_seek($i);
                        $row = $result->fetch_row();
                        $instancia::getConexion()->query("DELETE FROM voteList WHERE idVoteList = $row[0] ");
                        echo $instancia::getConexion()->affected_rows;
                    }
                    
                    header("Location: http://www.google.com");
                    
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head></head>
    <body>
        <script type="text/javascript">window.location.href="index.php";</script>
    </body>
</html>