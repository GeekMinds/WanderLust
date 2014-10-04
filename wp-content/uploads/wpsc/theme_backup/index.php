<?php
get_header();
global $wpdb;
$output_dir = wp_upload_dir();
?>
<div id="content" role="main">
        <div id="banner">
            <div id="prev"></div>
            <div id="next"></div>
            <div id="sombra"></div>
            <div id="slideshow">
            <?php
                $sliders = $wpdb->get_results("SELECT * FROM wp_sliders_wander");
                foreach($sliders as $slider){
                    echo '<img src="'. $output_dir["baseurl"] . $slider->_url .'"/> ';
                }
            ?>
            </div>
        </div>
        <div class="clear"></div>
        <div id="pasosMenuContenedor">
            <div class="pasosMenu" id="menu1" rel="1">
                <label>ZAPATOS PARA…</label> 
            </div>
            <div class="pasosMenu paso-disabled" id="menu2" rel="2">
                <label>ESTILOS</label> 
            </div>
            <div class="pasosMenu paso-disabled" id="menu3" rel="3">
                <label>¡CREA TUS WANDERLUST!</label> 
            </div>
        </div>
        <div id="decoracionPunteada">
        </div>
        <div class="clear"></div>
        <div id="contenedorPasos">
            <div id="paso1" class="pasos">
                <a href="javascript:void(0);" id="paraHombres" class="bounceMenu categoria" rel="1">
                    <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/elegirGenero/paraHombre.png" alt="" width="235" height="118"/>
                </a>
                <a href="javascript:void(0);" id="paraMujeres" class="bounceMenu categoria" rel="2">
                    <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/elegirGenero/paraMujer.png" alt="" width="249" height="118"/>
                </a>
                <a href="javascript:void(0);" id="paraNinos" class="bounceMenu categoria" rel="3">
                    <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/elegirGenero/paraNino.png" alt="" width="249" height="134"/>
                </a>
                <div clas="clear"></div>
            </div>
            <div id="paso2" class="pasos"></div>
            <div id="paso3" class="pasos">
                <div id="contenedorZapatoGeneral">
                    <div id="zapatoVistaPrevia"></div>
                    <div id="seleccionEstilo">
                        <div id="tusSelecciones">
                        </div>
                        <div id="estiloTexturas">
                            <label>ESTILOS DE TEXTURAS</label>
                        </div>
                        <div id="conScroll">
                            <?php foreach($tipo_telas as $tipo) {
                                $telas = $wpdb->get_results("SELECT * FROM tela WHERE tipo_tela = ".$tipo->id);
                                if($telas){
                                ?>
                                <div class="tipo-tela">
                                    <label><?php echo $tipo->tipo; ?></label>
                                    <?php foreach($telas as $tela) { ?>
                                        <div class="tela">
                                            <a href="javascript:void(0);" rel="<?php echo $tela->id; ?>"><img src="<?php echo $upload_dir['baseurl'].$tela->imagen; ?>" alt="" width="47" height="46"/></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <a id="guardarBoton" title="Guardar" href=""></a>
                        <a id="limpiarBoton" title="limpiar" href="javascript:void(0);"></a>
                    </div>
                </div>
                <div class="clear"></div>
                <div id="fomulario">
                    <div id="contenedor1">
                        <label id="tituloFormulario">FINALIZASTE?</label>
                        <p class="normal">De ser as&iacute; llena los campos con tu nombre, correo electr&oacute;nico, talla y medida del pie. </p>
                        <p class="normal">Te enviaremos una confirmaci&oacute;n de tu pedido a tu correo. </p>
                    </div>
                    <form action="javascript:void(0);" method="post" id="sendShoe">
                        <div id="contenedor2">
                            <input style="margin-top: 10px;" type="text" name="form-name" id="form-name" placeholder="NOMBRE" class="campoTexto"></input>
                            <input type="text" name="form-mail" id="form-mail" placeholder="CORREO ELECTR&Oacute;NICO" class="campoTexto"></input>
                            <input type="text" name="form-talla" id="form-talla" placeholder="TALLA" class="campoTexto"></input>
                            <input type="text" name="form-medida" id="form-medida" placeholder="MEDIDA PIE" class="campoTexto"></input>
                        </div>
                        <div id="contenedor3">
                            <textarea placeholder="ALGO M&Aacute;S QUE DESEAS AGREGAR" id="campoMensaje" name="campoMensaje"> </textarea>
                            <div id="enviarBotonExterior">
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>    <!-- #content -->
<?php
get_footer();
?>
