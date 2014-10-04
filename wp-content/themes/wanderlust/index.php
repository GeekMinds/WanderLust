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

        <div class="clear"></div>
        <div id="contenedorPasos">
            <div id="paso1" class="pasos">
                <a href="/hombre" id="paraHombres" class="bounceMenu categoria" rel="1">
                    <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/elegirGenero/paraHombre.png" alt="" width="235" height="118"/>
                </a>
                <a href="/mujer" id="paraMujeres" class="bounceMenu categoria" rel="2">
                    <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/elegirGenero/paraMujer.png" alt="" width="249" height="118"/>
                </a>
                <a href="/nino" id="paraNinos" class="bounceMenu categoria" rel="3">
                    <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/elegirGenero/paraNino.png" alt="" width="249" height="134"/>
                </a>
                <div clas="clear"></div>
            </div>
            <div id="paso2" class="pasos"></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>    <!-- #content -->
<?php
get_footer();
?>
