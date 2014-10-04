<?php
session_start();
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
global $wpdb;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <?php
        /* We add some JavaScript to pages with the comment form
         * to support sites with threaded comments (when in use).
         */
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');
        wp_head();
        if (is_archive()){
            echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/css/archive.css">';
        }
        wp_head();

        ?>
        <script>
            var ajaxurl = '<?php echo admin_url('/admin-ajax.php') ?>';
            var siteURL = "<?php echo get_template_directory_uri(); ?>";
        </script>

    </head>

    <body <?php body_class(); ?>>
        <div id="header">
            <div id="headerContent">
                <a id="logo" href="<?php echo home_url(); ?>" title="Wanderlust">

                <?php
                    $logos = $wpdb->get_results("SELECT * FROM wp_logos_wander");
                    $output_dir = wp_upload_dir();
                    foreach($logos as $logo){
                        echo '<img src="'. $output_dir["baseurl"] . $logo->_url .'"/>';
                    }
                ?>
                </a>
                <div id="menu">
                    <ul id="links">
                        <li class="paginas <?php if (is_home()) {
            echo "menuActivo";
        } ?>"><a href="/perfil-zapato/" id="scroll">crea tus zapatos</a></li>
                        <li class="paginas <?php if (isset($post) && $post->ID == 6) {
            echo "menuActivo";
        } ?>"><a href="/sobre-nosotros/">sobre nosotros</a></li>
                        <li class="paginas <?php if (isset($post) && $post->ID == 4) {
            echo "menuActivo";
        } ?>"><a href="/contactenos/">cont&aacute;ctanos</a></li>
                    </ul>
                    <div id="redesSocialesHeader">
                        <a class="iconoRed" target="_blank" href="https://www.facebook.com/Wanderlustgt"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/media/imagenes/header/facebook1.jpg" alt="" width="28" height="28"/></a>
                        <a class="iconoRed" target="_blank" href="https://twitter.com/wanderlust_wear"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/media/imagenes/header/twitter1.png" alt="" width="28" height="28"/></a>
                        <a class="iconoRed" target="_blank" href="http://instagram.com/wanderlustwear"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/media/imagenes/header/instragram1.png" alt="" width="28" height="28"/></a>
                        <a class="iconoRed" target="_blank" href="http://www.youtube.com/user/Wanderlustgt"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/media/imagenes/header/youtube1.png" alt="" width="28" height="28"/></a>
                    </div>
                </div>

                    <?php
                      if($_SESSION['islogin'] == 1 ){
                        echo '<a class="btnLogOut" id="LogOutbtn" href="/logout">logout</a>';
                      }
                      else{
                        echo '<a class="btnLogin" id="LogInbtn"href="javascript:void(0)">Login</a>';
                      }
                    ?>
                </a>
                <div id="modalLogin">
                    <div id="loginWanderlust">
                        <h1>Login</h1>
                            <label>Nombre:</label>
                            <input type="text" name="nombreCliente" id="nombreCliente" tabindex="1"/>

                            <label>Contraseña</label>
                            <input type="password" name="passwordCliente" id="passwordCliente" tabindex="2"/>
                            <a href="javascript:void(0)" class="recuperar">
                                ¿Has olvidado tu contraseña?
                            </a>
                            <a href="javascript:void(0)" class="crearUsuario">
                                Regístrate
                            </a>
                            <input type="submit" name="iniciarSesion" id="iniciarSesion" value="Iniciar Sesión"/>
                    </div>
                </div>
                <div id="modalRegistro">

                    <h1>Regístrate</h1>
                    <div id="registroWanderlust">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="nombre" tabindex="1"/>

                        <label>Correo electrónico</label>
                        <input type="text" name="password" id="email" tabindex="2"/>

                        <label>Contraseña</label>
                        <input type="password" name="password" id="passwordusuario" tabindex="3"/>

                        <label>Confirmar Contraseña</label>
                        <input type="password" name="password" id="passwordusuario2" tabindex="3"/>

                        <input type="submit" name="registrar" id="registrar" value="Enviar"/>
                    </div>
                </div>
                <div id="modalRecuperar">
                    <h1>Recuperar contraseña</h1>
                    <form method="post" id="recuperarPassword">
                        <label>Escribe tu correo electrónico</label>
                        <input type="text" name="nombre" id="nombre" tabindex="1"/>

                        <input type="submit" name="registrar" id="registrar" value="Enviar"/>
                    </form>
                </div>
            </div>

        </div><!-- #header -->

        <div id="wrapper" class="hfeed">
