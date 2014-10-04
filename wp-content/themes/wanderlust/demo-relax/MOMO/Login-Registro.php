<?
    session_start();
    $jsonLogin = $_SESSION['loginUser'];
    $obje = json_decode($jsonLogin);
    if($obje!=null){
        header ("Location: index.php");
    };
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/Login-registro.css"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/Facebook.js"></script>
        <script type="text/javascript" src="js/Funciones.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#wrapper').on('click', '.back', function() {


                    $('#contenedorRegistro').hide(1000);
                    $('#formulario').show(1000);
                    $('#feis').show(1000);
                    $('#registerfeis').hide(1000);
                });
                $('#wrapper').on('click', '.new', function() {


                    $('#contenedorRegistro').show(1000);
                    $('#formulario').hide(1000);
                    $('#feis').hide(1000);
                    $('#registerfeis').show(1000);
                });


            });
        </script>
        <script>

            $(document).ready(function() {

                $('#contenedorRegistro').hide();
                $('#registerfeis').hide();
                $('#error').hide();

            });
        </script>
        <script>
            $(function() {
                $("#login").click(function() {
                    var username = $("#u").val();
                    var password = $("#p").val();
                    var dataString = {
                        "username":username,
                        "password":password,
                    }
                    if (username == '' || password == '')
                    {
                        console.log("entro2");
                        $('.success').fadeIn(200).hide();
                        $('.error').fadeOut(200).show();

                    }
                    else
                    {
                        $.ajax({
                            type: "POST",
                            url: "Funciones/LoginSimple.php",
                            data: dataString,
                            dataType: 'json',
                            success: function(response) {
                                if (response.error == 1) {
                                    $('#error').fadeOut(200).show();
                                } else if (response.error == 0) {
                                    window.location.href = "index.php";
                                    $('#error').fadeOut(200).hide();
                                }
                            },
                            error: function(xhr, textStatus, error) {
                                console.log(xhr.statusText);
                                console.log(textStatus);
                                console.log(error);
                                console.log("entro4");

                            }

                        });
                    }
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <div id="headerLR">
        </div>
        <div id="wrapper">
            <section id="header">
                <section id="logo"></section>
                
            </section>
            <img src="resources/image/Login-Registro/perro.png" id="perro"/>
            <section id="contenedorRegistro">
                <section id="headerRegistro">
                    <label>
                        Sing Up
                    </label>
                </section>
                <form id="formularioRegistro">
                    <label>Username:</label>
                    <input type='text' id="username" /><br/>
                    <label>Name:</label>
                    <input type='text' id="name" /><br/>
                    <label>Last Name:</label>
                    <input type='text' id="lastName" /><br/>
                    <label>Password:</label>
                    <input type='password' id="pass" /><br/>
                    <label>Confirmar:</label>
                    <input type='password' id="pass2" /><br/>
                    <label>Edad:</label>
                    <input type='date' id="edad" /><br/>
                    <label>E-Mail:</label>
                    <input type='email' id="mail" /><br/>
                    <label>Sexo:</label>
                    <input type="radio" name="sex" value="Femenino"/>F <input type="radio" name="sex" value="Masculino"/>M </br>
                    <input type="submit" value="START!" class="register" onClick="registrarSimple($('#username').val(), $('#name').val(), $('#lastName').val(), $('#pass').val(), $('#edad').val(), $('#mail').val(), null);
                return false;"/>
                </form>
                <input class="back" value="BACK"/>
            </section>
            <section id="formulario">
                <section class="headerForm">
                    <label>Login</label>
                </section>
                <form class="login">
                    <label>User</label>
                    <input type="text" id="u"/></br>
                    <label>Password</label>
                    <input type="password" id="p"/>
                    <input type="submit" value="START!" class="letsgologin" id="login"/>
                    <label id="error" style="color:white;">Error de Autenticacion</label>
                </form>
                <input class="new" value="NEW?"/>
            </section>
        </div>
        <section id="centro">
            <img src="resources/image/Login-Registro/fondoCentro.png" id="fondoCentro"/>
        </section>
        <div id="footerLR">
            <section id="flecha"> 
            </section>
            <section id="fbRegister">
                <div id="feis" onclick="Login()"></div>
                <div id="registerfeis" onclick="Login()"></div>
            </section>
        </div>
    </body>
</html>

