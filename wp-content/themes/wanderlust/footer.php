    </div><!-- #wrapper -->
    <div id="footer" role="contentinfo">
            <div id="footerContent">
                <div id="contenedorConBorde">
                    <div id="contenedorSiguenos">
                        <label>S&Iacute;GUENOS</label>
                        <a class="redFooter" title="" target="_blank" href="http://instagram.com/wanderlustwear">
                           <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/footer/instagram.jpg" alt="" width="32" height="32"/> 
                        </a>
                        <a class="redFooter" title="" target="_blank" href="http://www.youtube.com/user/Wanderlustgt">
                           <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/footer/youtube.jpg" alt="" width="32" height="32"/> 
                        </a>
                        <a class="redFooter" title=""target="_blank"  href="https://www.facebook.com/Wanderlustgt">
                           <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/footer/facebook.jpg" alt="" width="32" height="32"/> 
                        </a>
                        <a style="margin-right: 0;" target="_blank" class="redFooter" title="" href="https://twitter.com/wanderlust_wear">
                           <img src="<?php echo get_bloginfo( 'stylesheet_directory' );?>/media/imagenes/footer/twitter.jpg" alt="" width="32" height="32"/> 
                        </a>
                    </div>
                    <div id="contenedorSuscribete">
                        <label>¡SUSCR&Iacute;BETE!</label>
                        <div class="clear"></div>
                        <p>D&eacute;janos tu e-mail para que<br/>puedas recibir noticias y promociones</p>
                        <input type="text" id="campoEnviar"></input><a id="enviarBoton" title="" href=""></a>
                    </div>
                </div>
                <label id="copyright">Wanderlust Wear ©. Todos los derechos reservados 2013. </label>
            </div>
        </div><!-- #footer -->
<?php      
	wp_footer();
?>
        <script> 
                $("body").on("click", "#registrar" , function() {
                    params = {};
                    
                    params.nombreusuario = $("#nombre").val();
                    params.email = $("#email").val();
                    params.passwordusuario = $("#passwordusuario").val();
                    params.passwordusuario2 = $("#passwordusuario2").val();

                    params.action = "RegisterNewUser";
                    jQuery.ajax({
                        type:"POST",
                        data:params,
                        url:ajaxurl + "?action=RegisterNewUser",
                        success : function (r){
                            if(r.r == 3){
                              alert("usuario ya registrado");
                              return false;
                            }
                            if(r.r == 0){
                              alert("Calves no coinciden");
                              return false;  
                            }
                            if(r.r == 1){
                              $.modal.close()
                              return false;   
                            }


                        },
                        error : function (a,b,c){
                            event.preventDefault();
                            alert("error");
                            return false;
                        },
                        dataType:"json",
                        async:false
                    })
                    return false;



                })
                $("body").on("click","#iniciarSesion", function() {
                    params = {};
                    
                    params.nombreCliente = $("#nombreCliente").val();
                    params.passwordCliente = $("#passwordCliente").val();

                    params.action = "loginSystem";
                    jQuery.ajax({
                        type:"POST",
                        data:params,
                        url:ajaxurl + "?action=loginSystem",
                        success : function (r){
                            
                          if(r.r === 1){
                              window.location.href = r.data;
                          }else{
                              alert(r.data);
                          }
                        },
                        error : function (a,b,c){
                            event.preventDefault();
                            alert("error");
                            return false;
                        },
                        dataType:"json",
                        async:false
                    })
                    return false;

                })
        </script> 
  </body>
</html>
