<?php

/*QUITAMOS LA BARRA DE ADMINISTRACION DEL FRONTEND*/
add_filter('show_admin_bar', '__return_false' );
add_action('wp_head', 'blogFavicon');
add_action('get_header', 'get_the_scripts');
add_action('get_header', 'get_the_styles');

function get_the_styles() {
    global $post;    
    wp_enqueue_style('resetStyle', get_bloginfo( 'stylesheet_directory' ).'/css/reset.css');
    wp_enqueue_style('themeStyle', get_bloginfo( 'stylesheet_url' ), array("resetStyle"));
    wp_enqueue_style('home-css', get_bloginfo( 'template_url' ).'/css/home.css');
    wp_enqueue_style('login-css', get_bloginfo( 'template_url' ).'/css/login.css');
    wp_enqueue_style('basic-css', get_bloginfo( 'template_url' ).'/css/basic.css');
        wp_enqueue_script("fancy-login-js", get_template_directory_uri()."/js/functions/login.js", array("jquery"), false, true);
    if (is_home() || is_front_page()){
        wp_enqueue_style('animate-custom-css', get_bloginfo( 'template_url' ).'/css/animate-custom.css');
    }
    
    if(is_page("sobre-nosotros")){
      wp_enqueue_style('sobreNosotrosStyle', get_bloginfo('stylesheet_directory').'/css/sobre-nosotros.css');     
    }elseif (is_page("contactanos")) {
      wp_enqueue_style('contactanosStyle', get_bloginfo('stylesheet_directory').'/css/contactanos.css');    
    }else if(is_page('demo-svg')){
        wp_enqueue_style('demosvgStyle', get_bloginfo('stylesheet_directory').'/css/demoSvg.css');    
    }else if(is_page('perfil-zapato')){
        wp_enqueue_style('perfilZapatoStyle', get_bloginfo('stylesheet_directory').'/css/perfilZapato.css');    
    }
}

function get_the_scripts() {
    global $post;
    wp_enqueue_script("jquey-jqueryActual", get_template_directory_uri()."/js/libs/jquery.js", array("jquery"), false, true);
    wp_enqueue_script("cssBrowserSelector", get_bloginfo( 'stylesheet_directory' ).'/js/libs/css_browser_selector.js', array(), false, true);
    wp_enqueue_script("jquery.cycle.all", get_template_directory_uri()."/js/libs/jquery.cycle.all.js", array("jquery"), false, true);
    wp_enqueue_script("jquey-simplemodal", get_template_directory_uri()."/js/libs/simpleModal.js", array("jquery"), false, true);
    wp_enqueue_script("fancy-login-js", get_template_directory_uri()."/js/functions/login.js", array("jquery"), false, true);
    

    if(is_page('demo-svg')){
        wp_enqueue_script("snapScript", get_template_directory_uri()."/js/libs/snap.svg.js", array("jquery"), false, true);
        wp_enqueue_script("demoScript", get_template_directory_uri()."/js/functions/demo.js", array("jquery"), false, true);
    }else if(is_page('demo2')){
        wp_enqueue_script("snapScript2", get_template_directory_uri()."/js/libs/snap.svg.js", array("jquery"), false, true);
        wp_enqueue_script("demoScript2", get_template_directory_uri()."/js/functions/demoMarv.js", array("jquery"), false, true);
    }else if(is_page('perfil-zapato')){
        wp_enqueue_script("perfilZapatoScript", get_template_directory_uri()."/js/functions/perfilZapato.js", array("jquery"), false, true);
    }
}

function blogFavicon() {
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_url').'/media/imagenes/generales/favicon.ico" />';
}

function setFacebookMetas() {
    global $post, $category;
    if ( is_home() || is_front_page() || is_search() || is_404()) {
        ?>
            <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_bloginfo('url '); ?>" />
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/media/imagenes/generales/share_image.png" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <?php
    } else if (is_category()) {
        ?>
            <meta property="og:title" content="<?php echo get_cat_name($category->cat_ID); ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_category_link($category->cat_ID); ?>" />
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/media/imagenes/generales/share_image.png" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <?php
    } else {
        $image_to_show = array();
        if (has_post_thumbnail( $post->ID )) {
            $image_to_show = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        } else {
            $args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
            $attachments = get_posts($args);


            foreach($attachments as $attachs) {
                if (wp_attachment_is_image($attachs->ID)) {
                    $image_to_show = wp_get_attachment_image_src( $attachs->ID, 'medium' );
                }
            }
        }

        if (count($image_to_show) == 0) {
            $image_to_show = array(get_template_directory_uri()."/media/imagenes/generales/logo.jpg", 0, 0);
        }
        ?>
            <meta property="og:title" content="<?php echo $post->post_title; ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
            <meta property="og:image" content="<?php echo $image_to_show[0]; ?>" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <?php
    }
}
?>
