<?php
/*
Plugin Name: Wanderlust Admin
Plugin URI: www.geekminds.gt
Description: Plugin Creado para Adminsitrar Zapatos, Telas, Usuarios y mas del sitio web
Author: Roberto Castellanos | Geek Minds
Version: 1.1
*/

    include "functions/incFuncTelas.php";

    if( ! array_key_exists( 'Wander-Admin', $GLOBALS ) ) {

        Class Init_Wanderlust extends Core_Wanderlust{

            public function __construct(){
                add_action('admin_menu',            array($this , 'crear_menu'));
                add_action('admin_menu',            array($this , 'wp_styles'));
                add_action('init',                  array($this , 'crear_tablas'));
                add_action("wp_ajax_ProcessLogo",   array($this ,"process_logos"));
                add_action("wp_ajax_ProcessSliders",array($this , "ProcessSliders"));
                add_action("wp_ajax_ProcessTelas",  array($this , "ProcessTelas"));
                add_action("wp_ajax_ObtenerTelas",  array($this , "ObtenerTelas"));
                add_action("wp_ajax_ProcessZapatos",array($this , "ProcessZapatos" ));
                parent::__construct();
            }

            public function crear_menu(){
                    add_menu_page('GeekAdmin', 'GeekAdmin','manege_options' , 'wanderlust-admin');
                    add_submenu_page( 'wanderlust-admin', __( 'Telas', 'wanderlust-admin' ), __( 'Telas', 'wanderlust-admin' ), 'manage_options', "Telas", array($this ,"wp_wanderlust_telas"));
                    add_submenu_page( "wanderlust-admin", __( "Logos", "wanderlust-admin" ), __( "Logos", "wanderlust-admin" ), "manage_options", "Logos", array($this ,"wp_wanderlust_logos"));
                    add_submenu_page( "wanderlust-admin", __( "Sliders", "wanderlust-admin" ), __( "Sliders", "wanderlust-admin" ), "manage_options", "Sliders", array($this ,"wp_wanderlust_sliders"));
                    add_submenu_page( "wanderlust-admin", __( "Zapatos", "wanderlust-admin" ), __( "Zapatos", "wanderlust-admin" ), "manage_options", "Zapatos", array($this ,"wp_wanderlust_zapatos"));
            }


            public function wp_styles(){
                     $pathV = array('plugin'=> WP_CONTENT_URL . "/plugins/wanderlust",
                            'js'            => WP_CONTENT_URL . "/plugins/wanderlust/js/",
                            'css'           => WP_CONTENT_URL . "/plugins/wanderlust/css/");
                    wp_enqueue_style( "wp_wanderlust", $pathV['css'].'kickstart.css', array());
                    wp_enqueue_style( "uploadfile", $pathV['css'].'uploadfile.css', array());
                    wp_enqueue_script("jQueryUi", $pathV['js']."jquery.min.js", array("jquery"), false, true);
                    wp_enqueue_script("uploader", $pathV['js']."uploadfile.js", array("jquery"), false, true);
                    wp_enqueue_script("kickstart", $pathV['js']."kickstart.js", array("jquery"), false, true);
                    wp_enqueue_script("wl_script", $pathV['js']."functions/wl_script.js", array("jquery"), false, true);

            }

            public function crear_tablas(){
                global $wpdb;
                $wpdb->query('CREATE TABLE IF NOT EXISTS `Telas` (
                                `idTelas` int(10) NOT NULL AUTO_INCREMENT,
                                `Nombre` varchar(1045) NOT NULL,
                                `idTiempoDisponible` int(10) NOT NULL,
                                PRIMARY KEY (`idTelas`)
                              ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ');

                $wpdb->query('CREATE TABLE IF NOT EXISTS `TiepomDisponibilidad` (
                                `idTiempos` int(10) NOT NULL AUTO_INCREMENT,
                                `NombreTiempo` varchar(1045) NOT NULL,
                                `DiasEspera` decimal(8,2) NOT NULL,
                                PRIMARY KEY (`idTiempos`)
                              ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');

                $wpdb->query('CREATE TABLE IF NOT EXISTS `VistasDeTela` (
                                `idTelas` int(10) NOT NULL AUTO_INCREMENT,
                                `idVista` int(10) NOT NULL,
                                `TipoDeVista` int(10) NOT NULL,
                                `NombreDeLaVista` varchar(300) NOT NULL,
                                `url` varchar(1045) NOT NULL,
                                PRIMARY KEY (`idTelas`)
                              ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ');

                $wpdb->query('CREATE  TABLE IF NOT EXISTS `_inv_users` (
                                `id_inv_users` INT NOT NULL AUTO_INCREMENT ,
                                `name_inv_userscol` VARCHAR(1045) NOT NULL ,
                                `email_inv_userscol` VARCHAR(1045) NOT NULL ,
                                `password_inv_userscol` VARCHAR(1045) NOT NULL ,
                                PRIMARY KEY (`id_inv_users`) );');
                $wpdb->query('CREATE TABLE IF NOT EXISTS `wp_logos_wander` (
                              `_id` int(11) NOT NULL AUTO_INCREMENT,
                              `_name` varchar(256) NOT NULL,
                              `_url` varchar(1024) NOT NULL,
                              PRIMARY KEY (`_id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');

                $wpdb->query('CREATE TABLE IF NOT EXISTS `wp_sliders_wander` (
                              `_id` int(11) NOT NULL AUTO_INCREMENT,
                              `_url` varchar(1024) NOT NULL,
                              PRIMARY KEY (`_id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');

                $wpdb->query('CREATE TABLE IF NOT EXISTS `wp_telas_wander` (
                              `_id` int(11) NOT NULL AUTO_INCREMENT,
                              `_url_v` varchar(1024) NOT NULL,
                              `_url_r` varchar(1024) NOT NULL,
                              `_url_l` varchar(1024) NOT NULL,
                              `_url_h` varchar(1024) NOT NULL,
                              `_name` varchar(1024) NOT NULL,
                              PRIMARY KEY (`_id`)
                            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
');

                $wpdb->query('CREATE TABLE IF NOT EXISTS `wp_zapatos_wander` (
                              `_id` int(11) NOT NULL AUTO_INCREMENT,
                              `_name` varchar(256) NOT NULL,
                              `_url` varchar(1024) NOT NULL,
                              PRIMARY KEY (`_id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');

                $wpdb->query('ALTER TABLE `_inv_users` ADD COLUMN `valid_inv_userscol` INT NOT NULL DEFAULT 0   ;');
                $wpdb->query('ALTER TABLE `_inv_users` ADD COLUMN `register_date_inv_users` DATETIME NOT NULL  AFTER `valid_inv_userscol` ;');
                $wpdb->query('ALTER TABLE `wp_telas_wander` ADD COLUMN `_name` varchar(1024) NOT NULL ;');

            }

            public function wp_wanderlust_telas(){
                $params = parent::getParameters($_GET);
                if(isset($_GET['action']) && !empty($_GET['action']))
                {
                    switch  ($params['action']) {
                        case "add":
                            $this->wp_wanderlust_telas_add();
                            break;

                        case "edit":
                            $this->wp_wanderlust_telas_edit();
                            break;
                         case "delete":
                            $this->wp_wanderlust_telas_del();
                            break;
                        }
                }
                else
                {
                    $this->wp_wanderlust_telas_listar();
                }
            }

            public function wp_wanderlust_logos(){
                $params = parent::getParameters($_GET);
                if(isset($params['action']) && !empty($params['action']))
                {
                    switch  ($params['action']) {
                        case "add":
                            $this->wp_wanderlust_logos_add();
                            break;

                        case "edit":
                            $this->wp_wanderlust_logos_edit();
                            break;
                         case "delete":
                            $this->wp_wanderlust_logos_del();
                            break;
                        }
                }
                else{
                    $this->wp_wanderlust_logos_listar();
                }
            }



            public function process_logos(){
                global $wpdb;
                $params = $this->getParameters($_POST);
                if( isset($params["logo_id"]) && !empty($params["logo_id"]) ){
                    $wpdb->update("wp_logos_wander", array( "_name" => $params["logo_name"], "_url" => $params["logo_url"] ), array( '_id' => $params["logo_id"] ) );
                    $toEncode["r"] = 2;
                }else{
                    $wpdb->insert("wp_logos_wander", array( "_name" => $params["logo_name"], "_url" => $params["logo_url"] ));
                    $toEncode["r"] = 1;
                }
                echo json_encode($toEncode);
                die();
            }

            public function ProcessSliders(){
                global $wpdb;
                $params = $this->getParameters($_POST);
                if( isset( $params["urls"] ) ) {
                    foreach($params["urls"] as $url){
                        $wpdb->insert("wp_sliders_wander", array( "_url" => $url ));
                    }
                    $toEncode["r"] = 1;
                }else{
                    $toEncode["r"] = 0;
                }
                echo json_encode($toEncode);
                die();
            }

            public function ProcessTelas(){
              global $wpdb;
              $params = $this->getParameters($_POST);
              if( isset($params["tela_id"]) && !empty($params["tela_id"]) ){
                  $wpdb->update("wp_telas_wander", array( "_name" => $params["tela_nombre"], "_url" => $params["tela_url"] ), array( '_id' => $params["tela_id"] ) );
                  $toEncode["r"] = 2;
              }else{
                  $wpdb->insert("wp_telas_wander",
                              array( "_name" => $params["tela_nombre"],
                                      "_url_v" => $params["urls"][0],
                                      "_url_r" => $params["urls"][1],
                                      "_url_l" => $params["urls"][2],
                                      "_url_h" => $params["urls"][3]
                                    )
                                );

                  $toEncode["r"] = 1;
              }
              echo json_encode($toEncode);
              die();
            }


            public function wp_wanderlust_sliders(){
                $params = parent::getParameters($_GET);
                if(isset($params['action']) && !empty($params['action']))
                {
                    switch  ($params['action']) {
                        case "add":
                            $this->wp_wanderlust_sliders_add();
                            break;

                        case "edit":
                            $this->wp_wanderlust_sliders_edit();
                            break;
                         case "delete":
                            $this->wp_wanderlust_sliders_del();
                            break;
                        }
                }
                else{
                    $this->wp_wanderlust_sliders_lsitar();
                }
            }

            public function wp_wanderlust_zapatos(){

              $params = parent::getParameters($_GET);
              if(isset($params['action']) && !empty($params['action']))
              {
                  switch  ($params['action']) {
                      case "add":
                          $this->wp_wanderlust_zapatos_add();
                          break;

                      case "edit":
                          $this->wp_wanderlust_zapatos_edit();
                          break;
                       case "delete":
                          $this->wp_wanderlust_zapatos_del();
                          break;
                      }
              }
              else{
                  $this->wp_wanderlust_zapatos_listar();
              }

            }

            public function ObtenerTelas(){
              global $wpdb;
              $telas = $wpdb->get_results("SELECT * FROM wp_telas_wander");
              $i = 0;
              foreach($telas as $tela){
                  $toEncode["data"][$i]["id"]   = $tela->_id;
                  $toEncode["data"][$i]["name"] = $tela->_name;
                  $i++;
              }
              echo json_encode($toEncode);
              die();
            }

            public function ProcessZapatos(){
              global $wpdb;
              $params = parent::getParameters($_POST);
              $zapatoArgs = array(
                  'post_title' => wp_strip_all_tags( $params["zapato_name"]),
                  'post_content' =>$params["svg"]  ,
                  'post_type' => 'post',
                  'post_status' => 'publish'
              );
              $insert_zapato = wp_insert_post($zapatoArgs);
              add_post_meta($insert_zapato, 'orna', $params["orna"]);
              foreach($params["secciones"] as $seccion){
                  add_post_meta($insert_zapato, 'seccion',$seccion );
              }
              wp_set_post_terms( $insert_zapato, $params["para"], "category" );
              $toEncode["r"] = "Exito al Guardar";
              echo json_encode($toEncode);
              die();
            }
        }
        $GLOBALS['Wander-Admin'] = new Init_Wanderlust();
    }
