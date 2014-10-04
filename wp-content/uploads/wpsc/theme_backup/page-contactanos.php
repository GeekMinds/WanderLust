<?php
get_header();

global $wpdb;
    $upload_dir = wp_upload_dir();
    
    if(isset($_POST['submit']) && !empty($_POST['submit'])){
    
    $subject        = 'Contacto desde Sitio Web';
    $from           = (isset($_POST['mail']) && !empty($_POST['mail']))?$_POST['mail']: '';
    $name           = (isset($_POST['name']) && !empty($_POST['name']))?$_POST['name']: '';
    $mensaje           = (isset($_POST['mensaje']) && !empty($_POST['mensaje']))?$_POST['mensaje']: '';
    require_once ('includes/phpmailer/class.phpmailer.php');
    
    $vrBody  = 'Se ha hecho un nuevo pedido desde wanderlust web<br/><br/>';
    $vrBody .= '</strong> Nombre: <strong>'.$name.'<br/>';
    $vrBody .= '</strong> Correo: <strong>'.$from.'<br/>';
    $vrBody .= '</strong> Mensaje: <strong>'.$mensaje.'<br/>';
    $vrBody .= '<br/>';
    $vrBody .= 'wanderlust.com.gt';
    $vrBody .= '<br/>';
    
    $message  = "<html>\n"; 
    $message  = "<head> <title>".$subject."</title> </head>"; 
    $message .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:14px; color:#777777;\">\n"; 
    $message .= $vrBody;
    $message .= "</body>\n"; 
    $message .= "</html>\n"; 

    $mail             = new PHPMailer();
    $body             = $message;
    $body             = eregi_replace("[\]",'',$body);

    // SMTP SALIENTE
    // $mail->IsSMTP();                                                // telling the class to use SMTP
    // $mail->Host       = "mail.wanderlust.com.gt";                  // SMTP server

    // // SMTP SALIENTE GMAIL 
    // $mail->SMTPAuth   = true;                                       // enable SMTP authentication
    // $mail->SMTPSecure = "ssl";                                      // sets the prefix to the servier
    // $mail->Host       = "smtp.gmail.com";                           // sets the SMTP server
    // $mail->Port       = 465;                                        // set the SMTP port for the GMAIL server
    // $mail->Username   = "cindyazucena8@gmail.com";                // SMTP account username
    // $mail->Password   = "";                               // SMTP account password

    // CORREO SALIENTE SIMPLE
     $mail->AddAddress('cindyazucena8@gmail.com', 'Pedidos');
    //$mail->AddAddress('pedidos@wanderlust.com.gt', 'Pedidos');
    $mail->SetFrom  ($from, $name);
    $mail->AddReplyTo($from, $name);
    
    $mail->Subject    = $subject;
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

    $mail->MsgHTML($body);

    if(!$mail->Send()) {
        echo '<script>jQuery(document).ready(function($){alert("Tu mensaje no fue enviado, favor intenta de nuevo!")})</script>';
    } else {
        echo '<script>jQuery(document).ready(function($){alert("Mensaje enviado, Gracias por contactarnos!")})</script>';
    } 
    }

?>
    <div id="content" role="main">
        <div id="banner">
            <div id="prev"></div>
            <div id="next"></div>
            <div id="sombra"></div>
            <div id="slideshow">
                <?php 
                $slds = $wpdb->get_results('SELECT * FROM slider ORDER BY id DESC LIMIT 6');
                foreach ($slds as $sl){
                    echo '<img src="'.$wp_upload_dir['baseurl'].$sl->image.'" width="875" height=""/>';
                }
                ?>
            </div>
        </div>
        <div class="clear"></div>
        <div id="creaTusContenedor">
                    <div id="creaContenedorPequeno">
                        <label>CONTACTO</label> 
                    </div>
                </div>
                <div class="clear"></div>
                <div id="contenedorTipos">
                    <div id="contenedor1">
                        <p>Llámanos al 58967109 </p><div class="clear"></div>
                        <p>o bien escríbenos a info@wanderlust.com.gt</p>
                        <p>Horario de atención de lunes a viernes <br/> de 8 a.m. a 3 p.m.</p>
                    </div>
                    <form action="" method="post">
                        <div id="contenedor2">
                            <input type="text" name="name" id="name" placeholder="NOMBRE" class="campoTexto"></input>
                            <input type="text" name="mail" id="mail" placeholder="CORREO ELECTR&Oacute;NICO" class="campoTexto"></input>
<!--                            <input type="text" placeholder="TALLA" class="campoTexto"></input>
                            <input type="text" placeholder="MEDIDA PIE" class="campoTexto"></input>-->
                        </div>
                        <div id="contenedor3">
                            <textarea name="mensaje" placeholder="ALGO M&Aacute;S QUE DESEAS AGREGAR" id="campoMensaje"> </textarea>
                            <div id="enviarBotonExterior">
                                <input type="submit" value="" name="submit" id="enviaCorreo"></input>
                            </div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
        <div class="clear"></div>
    </div>    <!-- #content -->
<?php
get_footer();
?>
