<?php
/* 
 * Template Name: demo2
 */
get_header();
$upload_dir = wp_upload_dir();
?>
<div id="contenedorDemo">
    <h1>Crea tus zapatos</h1>
    <img class="logoEleccion" src="<?php echo get_bloginfo("template_url");?>/media/imagenes/elegirGenero/paraHombre.png" alt="zapatos para hombre"/>
    <br style="clear: both"/>
    <canvas id="demoSvg">
        
    </canvas>
</div>
<?php    get_footer(); ?>