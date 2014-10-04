<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

	Class Core_Wanderlust{

		public function __construct(){
            add_action('wp_ajax_RegisterNewUser',           array($this ,'RegisterNewUser'));
    		add_action('wp_ajax_nopriv_RegisterNewUser',    array($this ,'RegisterNewUser'));
            add_action('wp_ajax_loginSystem',               array($this ,'loginSystem'));
            add_action('wp_ajax_nopriv_loginSystem',        array($this ,'loginSystem'));
            add_action('wp_ajax_upload_img',                array($this ,'upload_img'));

		}


        protected function getParameters($post_request = array()) {
            $parameters = array();
            foreach ($post_request as $key => $val) {
                $parameters[strtolower($key)] = $val;
            }
            return $parameters;
        }

      	public function upload_img() {
            $output_dir = wp_upload_dir();
            if (isset($_FILES["myfile"])) {
                $ret = array();
                $error = $_FILES["myfile"]["error"];
                if (!is_array($_FILES["myfile"]["name"])) {
                    $fileName = $_FILES["myfile"]["name"];
                    $fileName = str_replace(' ','-', $fileName);
                    move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir['path'] . '/' . $fileName);
                    $ret[] = $fileName;
                } else {
                    $fileCount = count($_FILES["myfile"]["name"]);
                    for ($i = 0; $i < $fileCount; $i++) {
                        $fileName = $_FILES["myfile"]["name"][$i];
                        move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir['path'] . '/' . $fileName);
                        $ret[] = $fileName;
                    }
                }
                $toEnconde['ret'] = "" . $output_dir['url'] . '/' . $fileName . "";
                $toEnconde['name'] = $output_dir['subdir'] . '/' . $fileName;
                echo json_encode($toEnconde);
                die();
            }
        }

        public function RegisterNewUser(){
            $paramentros = $this->getParameters($_POST);
            global $wpdb;
            $email = $paramentros['email'];

            $oldUser = $wpdb->get_var("SELECT * FROM _inv_users where email_inv_userscol = '$email' ;");

            if($oldUser){
                $toEncode['r'] = 3;
                echo json_encode($toEncode);
                die();
            }
            else if($paramentros['passwordusuario'] == $paramentros['passwordusuario2'])
            {

                $newPass = hash('ripemd160', $paramentros['passwordusuario']);
                $arrayToSave = array(
                    'id_inv_users' => $paramentros[''],
                    'name_inv_userscol' => $paramentros['nombreusuario'],
                    'email_inv_userscol' => $paramentros['email'],
                    'password_inv_userscol' => $newPass,
                    'register_date_inv_users' => date('Y-m-d', time())
                );

                if($paramentros['newsletter'] == 'on'){
                    $arrayToSave['newsLetter_inv_userscol'] = 1;
                }
                else
                {
                    $arrayToSave['newsLetter_inv_userscol'] = 0;
                }

                $wpdb->insert('_inv_users',$arrayToSave);

                $theString = $paramentros['email'] .'|' . $paramentros['nombreusuario'];

                $enc = $this->encrypt_decrypt('encrypt',$theString);


                $xhtml ='<html xmlns="http://www.w3.org/1999/xhtml" class="dj_webkit dj_chrome dj_contentbox">
	                			<head>
					                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					                <style type="text/css">/* Enable image placeholders */@-moz-document url-prefix(http), url-prefix(file) { img:-moz-broken{-moz-force-broken-image-icon:1; width:24px;height:24px;}</style>
				                </head>
				                	<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" class="mcd np has-repeatables">
				                    	<center>
					                        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0;padding:0;background-color:#dceaee;background-image:url(https://ci6.googleusercontent.com/proxy/jW2nNEY-oVZBcrQQOi-JsblsGdDZ95TT7ztbNGydq8aDSrVSOjcjqpXtf5_eL5CzR1H3IUod6OP3i_s9URnqtuGJfjt1Rtx6NnMVNFYNpPht3S0cBtu06UOnLtIOpRcLo0Lu-qAuyA=s0-d-e1-ft#http://gallery.mailchimp.com/27aac8a65e64c994c4416d6b8/images/bg_sw_greenblue.png);background-repeat:repeat;height:100%!important;width:100%!important">
					                        <tbody>
					                        <tr>
				                            <td align="center" valign="top" style="padding-top:20px; padding-bottom:40px;">
				                                <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
				                                    <tbody>
				                                    <tr>
				                                        <td align="center" valign="top" style="border-collapse:collapse">
				                                            <!-- // BEGIN HEADER -->
				                                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader">
				                                                <tbody><tr>
				                                                    <td align="center" valign="top">
				                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
				                                                            <tbody><tr>
				                                                                <td class="headerContent">
				                                                                    <div class="edit-image" mc:edit="header_image" mc:type="imageText" mc:max-height="0" mc:max-width="600px" id="uniqName_17_2" widgetid="uniqName_17_2"><div class="tpl-image-content" id="tpl-image-content-header_image"><div>
				                                                                    <img src="http://wl-demo.geekminds.gt/wp-content/themes/wanderlust/media/imagenes/header/logos4.jpg" alt="" border="0" style="margin: 0px; padding: 0px; max-width: 600px;" id="headerImage campaign-icon"></div></div></div>
				                                                                </td>
				                                                            </tr>
				                                                        </tbody></table>
				                                                    </td>
				                                                </tr>
				                                            </tbody></table>
				                                            <!-- END HEADER \\ -->
				                                        </td>
				                                    </tr>
				                                    <tr>
				                                        <td align="center" valign="top">
				                                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody" background-color: #ffffff;border-bottom: 0;>
				                                                <tbody>
				                                                	<tr>
				                                                    	<td align="center" valign="top">
				                                                        	<table border="0" cellpadding="20" cellspacing="0" width="100%">
			                                                            		<tbody>
			                                                            				<tr>
				                                                                			<td valign="top" class="bodyContent" mc:edit="body_content" mc:type="text" id="uniqName_17_3" widgetid="uniqName_17_3" style="border-collapse:collapse;color:#808080;font-family:Georgia;font-size:19px;line-height:150%;text-align:center"><div class="edit-content"><div class="tpl-content">
				                                                                    			<h1 style="color:#e95c41;display:block;font-family:Georgia;font-size:30px;font-style:normal;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:center">Confirmacion de Registro</h1>
				                                                                        			Por motivos de seguridad la pagina Wanderlus Wear, necesita verificar que tu email es un email valido, Sigue el link abajo para confirmar tu correo electronico y asi tener acceso a tu cuenta en "Wanderlust Wear"
				                                                            				</td>
				                                                            			</tr>
				                                                            		<tr>
				                                                                		<td align="center" valign="top" style="padding-top:0; padding-bottom:40px;" style="padding-top:0;padding-bottom:40px;border-collapse:collapse">
				                                                                    		<table border="0" cellpadding="15" cellspacing="0" class="templateButton" style="background-color:#e95c41;border:0;border-radius:5px">
				                                                                        		<tbody>
			                                                                        				<tr>
				                                                                            			<td align="center" valign="middle" class="templateButtonContent"  style="padding-left:25px;padding-right:25px;border-collapse:collapse;color:#ffffff;font-family:Georgia;font-size:15px;font-weight:normal;letter-spacing:.5px;text-align:center;text-decoration:none" mc:type="text" id="uniqName_17_4" widgetid="uniqName_17_4"><div class="edit-content"><div class="tpl-content">
					                                                                                		<a style="color:#ffffff;font-family:Georgia;font-size:15px;font-weight:normal;letter-spacing:.5px;text-align:center;text-decoration:none"  href="' .get_bloginfo('url').'/confirmar-email/?AccessKey=' .$enc. '" target="_blank">Confirmar Email</a>
					                                                                            		</td>
					                                                                        		</tr>
				    	                                                                		</tbody>
				        	                                                            	</table>
				            	                                                    	</td>
				                	                                            	</tr>
				                                                        		</tbody>
				                                                        	</table>
				                                                    	</td>
				                                                	</tr>
				                                            	</tbody>
				                                            </table>
				                                        </td>
				                                    </tr>
		                            			</td>
				                        	</tr>
			                    		</tbody>
		                    		</table>
		                		</center>
			            	</body>
		            	</html>';

                $nombre = $paramentros['nombreusuario'] . ' ' . $paramentros['apellidousuario'];
                $email  = '';
                $subject = 'Wanderlust Wear Confirmacion email ';
                $emailTo =  $paramentros['email'];
                $this->Send_Mail($nombre,$email,$subject,$xhtml,$emailTo,'','');

                //$toEncode['d'] = encrypt_decrypt('decrypt', 'robertoh@mnc.gt' );
                $toEncode['r'] = 1;
                $toEncode["data"] = "Usuario Registrado Correctamente";
                echo json_encode($toEncode);
                die();
            }
            else{
                $toEncode['r'] = 0;
                echo json_encode($toEncode);
                die();
            }
        }



        private function Send_Mail($nombre,$email,$subject,$xhtml,$emailTo,$attachment,$AttName)
        {
            require 'class.phpmailer.php';
            $address = $emailTo; //PARA QUIEN SE ENVIA
            $mail = new PHPMailer();
            //Set who the message is to be sent from
            $mail->setFrom('info@wanderlust.com.gt', $subject);
            //Set an alternative reply-to address
            $mail->addReplyTo($email, $nombre);
            //Set who the message is to be sent to
            $mail->addAddress($address, $subject);
            //Set the subject line
            $mail->Subject = $subject;
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->msgHTML($xhtml);
            //Replace the plain text body with one created manually
            $mail->AltBody = '';
            //Attach an image file
            if ($attachment != "")
            {
                $mail->addAttachment(get_site_url().'/wp-content/uploads'.$attachment,$AttName);
            }
            if(!$mail->send()){
                echo json_encode('error');
                die();
            }else{}
        }


        public function encrypt_decrypt($action, $string) {
            $output = false;
            $encrypt_method = "AES-256-CBC";
            $secret_key = '"d0be2dc421be4fcd0172e5afceea3970e2f3d940"';
            $secret_iv = '"d0be2dc421be4fcd0172e5afceea3970e2f3d940"';
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            if( $action == 'encrypt' ) {
                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                $output = base64_encode($output);
            }
            else if( $action == 'decrypt' ){
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
            return $output;
        }

        public function loginSystem(){
            session_start();
            $params = $this->getParameters($_POST);
            global $wpdb;
            $id = $wpdb->get_var("SELECT password_inv_userscol FROM _inv_users where email_inv_userscol = '". $params['nombrecliente'] ."' and valid_inv_userscol = 1;");
            if($id){
                $newPass = hash('ripemd160', $params['passwordcliente']);
                if($id === $newPass){
                    $_SESSION['islogin'] = 1;
                    $_SESSION['validEmail'] = 3;
                    $toEncode['r'] = 1;
                    $toEncode['data'] = '/perfil-zapato/';
                    echo json_encode($toEncode);
                    die();
                }
            }
            else
            {
                $toEncode['r'] = 0;
                $toEncode['data'] = 'Usuario no Encontrado';
                echo json_encode($toEncode);
                die();
            }
            $toEncode['r'] = 0;
            $toEncode['data'] = 'Usuario o Contraseña Invalido, favor intenta de nuevo';
            echo json_encode($toEncode);
            die();
        }
            protected function wp_wanderlust_logos_add($params = array()){
                echo '<div class="col_6"><h1>Agregar Logo</h1>
                        <input type="text" name="logo_nombre" id="logo_nombre" />
                        <br />
                        <br />
                        <div id="paraEsconderNumerosImg">
                            <div id="upload">
                            </div>
                        </div>
                        <div id="imgUpNumeros"></div>
                        <br />
                        <br />
                        <button id="SalvarLogos">Guardar</button>
                    </div>';
            }

            protected function wp_wanderlust_logos_edit($params = array()){
                global $wpdb;
                $params = $this->getParameters($_GET);
                $logo = $wpdb->get_row("SELECT * FROM wp_logos_wander WHERE _id=" . $params["id"]);
                echo '<div class="col_6"><h1>Agregar Logo</h1>
                    <input type="text" name="logo_nombre" id="logo_nombre" value="'. $logo->_name .'" data-id="'.$logo->_id.'"/>
                    <br />
                    <br />
                    <div id="paraEsconderNumerosImg" style="display:none">
                        <div id="upload">
                        </div>
                    </div>
                    <div id="imgUpNumeros">
                        <fieldset class="col_12" id="" data-id="'.$logo->_url .'">
                            <legend>Image <a id="eliminarImagen" style="padding-left: 50px;margin-left: 5px;padding: 2px;margin-bottom: 2px;" class="button"><i class="icon-remove-sign"></i></a></legend>
                            <div class="col_12"><img class="col_12"src="/wp-content/uploads/' . $logo->_url  .'"><br />
                        </fieldset>
                    </div>
                    <br />
                    <br />
                    <button id="SalvarLogos">Guardar</button>
                </div>';
                ?>
                <?php
            }

            protected function wp_wanderlust_logos_listar(){
                ?>
                    <h1>Listado de Logos: </h1>
                    <button class="green"> <a style="text-transform:none ; text-decoration: none ; color: white ;"href="?page=Logos&action=add">Agregar</a></button>
                    <br />
                    <br />
                    <table class="sortable" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr class="alt first last">
                                <th rel="0" value="Nombre de la Imagen">Name<span class="arrow up"></span></th>
                                <th rel="1" value="Actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                            <?php
                                global $wpdb;
                                $logos = $wpdb->get_results("SELECT * FROM wp_logos_wander ");

                                foreach($logos as $logo){
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $logo->_name; ?>
                                    </td>
                                    <td>
                                        <a href="?page=Logos&action=edit&id=<?php echo $logo->_id; ?>"><i class="icon-pencil"></i></a>
                                        <a href="?page=Logos&action=delete&id=<?php echo $logo->_id; ?>"><i class="icon-minus-sign"></i></a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tr>
                        </tbody>
                    </table>
                <?php
            }

            protected function wp_wanderlust_sliders_lsitar(){
                ?>
                    <h1>Adminsitracion de Sliders</h1>
                    <button class="green"> <a style="text-transform:none ; text-decoration: none ; color: white ;"href="?page=Sliders&action=add">Agregar</a></button>
                    <br />
                    <br />
                    <table class="sortable" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr class="alt first last">
                                <th rel="0" value="Nombre de la Imagen">Name<span class="arrow up"></span></th>
                                <th rel="1" value="Actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                            <?php
                                global $wpdb;
                                $logos = $wpdb->get_results("SELECT * FROM wp_sliders_wander ");

                                foreach($logos as $logo){
                            ?>
                                <tr>
                                    <td>

                                        <?php $base_url = wp_upload_dir(); echo "<img src='".$base_url["baseurl"].$logo->_url ."' width= '60%'>"; ?>
                                    </td>
                                    <td>

                                        <a href="?page=Sliders&action=delete&id=<?php echo $logo->_id; ?>"><i class="icon-minus-sign"></i></a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tr>
                        </tbody>
                    </table>
                <?php
            }

            protected function wp_wanderlust_sliders_add(){

                echo '<div class="col_6"><h1>Agregar Sliders</h1>
                        <br />
                        <br />
                        <div id="paraEsconderNumerosImg">
                            <div id="sliders">
                            </div>
                        </div>
                        <div id="imgUpNumeros"></div>
                        <br />
                        <br />
                        <button id="SalvarSliders">Guardar</button>
                    </div>';

            }


            protected function wp_wanderlust_logos_del($params = array()){
                echo "delete";
            }

            protected function wp_wanderlust_sliders_del(){
                global $wpdb;
                $params = $this->getParameters($_GET);
                $wpdb->delete( 'wp_sliders_wander', array( '_id' => $params["id"] ) );
                echo "<meta http-equiv='refresh' content='0;url=?page=Sliders'>";
            }

            protected function wp_wanderlust_telas_listar(){
								phpinfo();
								die();
                ?>
                    <h1>Adminsitracion de Telas</h1>
                    <button class="green"> <a style="text-transform:none ; text-decoration: none ; color: white ;"href="?page=Telas&action=add">Agregar</a></button>
                    <br />
                    <br />
                    <table class="sortable" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr class="alt first last">
                                <th rel="0" value="Nombre de la Imagen">Name<span class="arrow up"></span></th>
                                <th rel="1" value="Actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                            <?php
                                global $wpdb;
                                $logos = $wpdb->get_results("SELECT * FROM wp_telas_wander ");
                                foreach($logos as $logo){
                            ?>
                                <tr>
                                    <td>
                                        <?php $base_url = wp_upload_dir(); echo "<img src='".$base_url["baseurl"].$logo->_url_v ."' width= '25%' height='150px'>"; ?>
                                    </td>
                                    <td>
                                        <a href="?page=Telas&action=delete&id=<?php echo $logo->_id; ?>"><i class="icon-minus-sign"></i></a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tr>
                        </tbody>
                    </table>
                <?php
            }


            protected function wp_wanderlust_telas_add(){

                echo '<div class="col_6"><h1>Agregar Telas</h1>
										<input type="text" name="tela_nombre" id="tela_nombre" />
                    <br />
                    <br />
                    <div id="paraEsconderNumerosImg">
                        <div id="telas">
                        </div>
                    </div>
										<div id="paraEsconderNumerosImgR">
											<div id="telasR">
											</div>
										</div>
										<div id="paraEsconderNumerosImgL">
											<div id="telasL">
											</div>
										</div>
										<div id="paraEsconderNumerosImgH">
											<div id="telasH">
											</div>
										</div>
                    <div id="imgUpNumeros"></div>
										<div id="imgUpNumerosR"></div>
										<div id="imgUpNumerosL"></div>
										<div id="imgUpNumerosH"></div>
                    <br />
                    <br />
                    <button id="SalvarTelas">Guardar</button>
                </div>';

            }

						protected function wp_wanderlust_telas_edit(){

							global $wpdb;
							$params = $this->getParameters($_GET);
							$logo = $wpdb->get_row("SELECT * FROM wp_telas_wander WHERE _id=" . $params["id"]);
							echo '<div class="col_6"><h1>Agregar Logo</h1>
									<input type="text" name="logo_nombre" id="tela_nombre" value="'. $logo->_name .'" data-id="'.$logo->_id.'"/>
									<br />
									<br />
									<div id="paraEsconderNumerosImg" style="display:none">
											<div id="upload">
											</div>
									</div>
									<div id="imgUpNumeros">
											<fieldset class="col_12" id="" data-id="'.$logo->_url .'">
													<legend>Image <a id="eliminarImagen" style="padding-left: 50px;margin-left: 5px;padding: 2px;margin-bottom: 2px;" class="button"><i class="icon-remove-sign"></i></a></legend>
													<div class="col_12"><img class="col_12"src="/wp-content/uploads/' . $logo->_url  .'"><br />
											</fieldset>
									</div>
									<br />
									<br />
									<button id="SalvarTelas">Guardar</button>
							</div>';
							?>
							<?php


						}

						protected function wp_wanderlust_telas_del(){
							global $wpdb;
							$params = $this->getParameters($_GET);
							$wpdb->delete( 'wp_telas_wander', array( '_id' => $params["id"] ) );
							echo "<meta http-equiv='refresh' content='0;url=?page=Telas'>";
						}

						protected function wp_wanderlust_zapatos_listar(){

							?>
									<h1>Adminsitracion de Zapatos</h1>
									<button class="green"> <a style="text-transform:none ; text-decoration: none ; color: white ;"href="?page=Zapatos&action=add">Agregar</a></button>


									<br />
									<br />
									<table class="sortable" cellspacing="0" cellpadding="0">
											<thead>
													<tr class="alt first last">
															<th rel="0" value="Nombre de la Imagen">Name<span class="arrow up"></span></th>
															<th rel="1" value="Actions">Actions</th>
													</tr>
											</thead>
											<tbody>
													<tr class="">
													<?php
															global $wpdb;
															$logos = $wpdb->get_results("SELECT * FROM wp_zapatos_wander ");

															foreach($logos as $logo){
													?>
															<tr>
																	<td>

																			<?php $base_url = wp_upload_dir(); echo "<img src='".$base_url["baseurl"].$logo->_url ."' width= '60%'>"; ?>
																	</td>
																	<td>
																			<a href="?page=Zapatos&action=delete&id=<?php echo $logo->_id; ?>"><i class="icon-minus-sign"></i></a>
																	</td>
															</tr>
													<?php
															}
													?>
													</tr>
											</tbody>
									</table>
							<?php
						}

						protected function wp_wanderlust_zapatos_add(){

							echo '
							<div class="col_12"><h1>Agregar Zapatos</h1>
									<label>Nombre para este Estilo de Zapato </label><br />
									<input type="text" name="zapato_nombre" id="zapato_nombre" />
									<br />
									<br />
									<div class ="col_12">
										<div class ="col_2">
											<label>Zapato para </label>
											<select id="tipo_sexo">';
							$taxonomies = array(
							    'category'
							);
							$args = array(
							    'orderby'           => 'name',
							    'order'             => 'ASC',
							    'hide_empty'        => false,
							    'hierarchical'      => true,
							);
							$terms = get_terms( $taxonomies, $args ) ;
							foreach($terms as $la_cat){
								echo '<option value="'. $la_cat->term_id .'"> '. $la_cat->name .'</option>';
							}
							echo 	'</select><br />
											<br />
											<label>Orna Tipo </label>
											<select id="tipo_orna">
												<option value="delgada">Delgada </option>
												<option value="fuerte">Fuerte </option>
												<option value="ambas">Ambas </option>
											</select>
											<br />
											<br />
											<div id="paraEsconderNumerosImg">
													<div id="zapatos">Subir</div>
											</div>
										</div>
										<div class="col_10" id="lateral_derecho">

										</div>
									</div>
									<div id="imgUpNumeros_zapatos">
										<fieldset class="col_12" id="elZapato" style="display:none;">
												<legend>Image
													<a id="eliminarImagenZapatos" style="padding-left: 50px;margin-left: 5px;padding: 2px;margin-bottom: 2px;" class="button">
														<i class="icon-remove-sign"></i>
													</a>
												</legend>
												<div class="col_12" id="page_div" ></div>
												<br />
										</fieldset>
									</div>
									<br />
									<br />
									<button id="SalvarZapato">Guardar</button>
							</div>';
						}

						protected function listar_tipos_de_telas(){

						}




	}
