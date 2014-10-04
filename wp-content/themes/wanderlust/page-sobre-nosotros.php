<?php
/* 
 * 
 * Template Name: About us
 */
get_header();
$video = get_post_meta(get_the_ID(), 'aboutVideo', true);
$content = get_post_meta(get_the_ID(), 'aboutContenido', true);
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
                        <label>SOBRE NOSOTROS</label> 
                    </div>
                </div>
                <div class="clear"></div>
                <div id="contenedorTipos">
                    <div id="columnaIzquierda">
                        <?php echo $content; ?>
                    </div>
                    <div id="contenedorVideo">
                        <?php echo $video; ?>
                    </div>
                    <div class="clear"></div>
                </div>
        <div class="clear"></div>
    </div>    <!-- #content -->
<?php
get_footer();
?>
