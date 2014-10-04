window.fbAsyncInit = function() {
    FB.init({
        appId: '159687390902628', // App ID
        channelUrl: 'f9500d006bd4b1802cee6432cd6950c5',
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true  // parse XFBML
    });
};

(function(d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));

//Funcion de login
function Login()
{

    //if (estado() === false) {
    FB.login(function(response) {
        if (response.authResponse)
        {

            var data = {
                username: response.authResponse.userID
            };
            console.log(data);
            $.ajax({
                type: "POST",
                url: "../MOMO/Funciones/compararUsuarios.php",
                data: data,
                //dataType: 'json',
                success: function(respuesta) {
                    console.log('ya voy llegando');
                    if (respuesta.error) {
                        //registrar
                        console.log("1");
                        iniciarSesion();
                    } else if (!respuesta.error) {
                        //solo loguear
                        console.log("0");
                        getUserInfo();
                    }
                },
                error: function(xhr, textStatus, error) {
                    console.log(xhr.statusText);
                    console.log(textStatus);
                    console.log(error);
                    console.log("entro4");

                }
            });

        } else
        {
            console.log('Authorization failed.');
        }
    },
            {scope: 'email, user_birthday, publish_stream, publish_actions'});
    /* } else {
     alert("Logueado");
     }*/
}
function LoginPublicar()
{

    //if (estado() === false) {
    FB.login(function(response) {
        if (response.authResponse)
        {

        } else
        {
            console.log('Authorization failed.');
        }
    },
            {scope: 'email, user_birthday, publish_stream, publish_actions'});
    /* } else {
     alert("Logueado");
     }*/
}
function getUserInfo() {
    FB.api('/me', function(response) {
        /*"username" : parametro1,
         "name" : parametro2, 
         "lastName" : parametro3,
         "pass" : parametro4, 
         "age": parametro5,
         "email":parametro6,
         "sexo":parametro7,
         "urlImagen:parametro8"*/
        //URL de la imagen desde facebook https://graph.facebook.com/idUser/picture?width=600&height=600
        var url = "https://graph.facebook.com/" + response.id + "/picture?width=600&height=600";
        registrar(response.id, response.first_name, response.last_name, "", response.birthday, response.email, response.gender, url);
        var dataString = {
            username: null,
            password: null,
            responseFB: response
        };
        $.ajax({
            type: "POST",
            url: "Funciones/Login.php",
            data: dataString,
            success: function(response) {

                //console.log(response);
                window.location.href = "index.php"
            },
            error: function(xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
                console.log("entro4");

            }

        });
    });
}
var fecha = function(parametro, control) {
    var fecha = new Date(parametro);
    if (control == true) {
        var dia = fecha.getDate();
    } else {
        var dia = fecha.getDate() + 1;
    }
    var mes = fecha.getMonth() + 1;
    var year = fecha.getFullYear();
    var resultado = dia + "/" + mes + "/" + year;

    return resultado;
}
function registrar(parametro1, parametro2, parametro3, parametro4, parametro5, parametro6, parametro7, parametro8) {
    var parametros = {
        "username": parametro1,
        "name": parametro2,
        "lastName": parametro3,
        "pass": parametro4,
        "age": fecha(parametro5, true),
        "email": parametro6,
        "sexo": parametro7,
        "urlImagen": parametro8
    };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: 'Funciones/Registrar.php',
        type: 'post',
        success: function(response) {
            console.log(response);
            window.location.href = "index.php";
        },
        error: function() {
            console.log("error X_D");
        }
    });
}
function iniciarSesion() {
    FB.api('/me', function(response) {

        var dataString = {
            username: null,
            password: null,
            responseFB: response
        };
        $.ajax({
            type: "POST",
            url: "Funciones/Login.php",
            data: dataString,
            success: function(response) {

                //console.log(response);
                window.location.href = "index.php";
            },
            error: function(xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
                console.log("entro4");

            }

        });
    });
}
//Funcio de Cierre de sesion
function estado() {
    var resultado;
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // the user is logged in and has authenticated your
            // app, and response.authResponse supplies
            // the user's ID, a valid access token, a signed
            // request, and the time the access token 
            // and signed request each expire
            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;
            resultado = true;
            alert('entro1');
        } else if (response.status === 'not_authorized') {
            // the user is logged in to Facebook, 
            // but has not authenticated your app
            resultado = false;
            alert('entro2');
        } else {
            // the user isn't logged in to Facebook.
            resultado = false;
            alert('entro3');
        }
    });
    return resultado;
}
function Logout()
{
    FB.logout(function() {
        window.location.href = "../Login-Registro.php";
    });
}

function publicarVoto(idVideo, tipo) {
    
    if (tipo == '0') {
        console.log('si');
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', function(response) {
                    FB.ui({
                        method: 'feed',
                        link: 'http://www.youtube.com/watch?v=' + idVideo,
                        caption: response.first_name + ' ha votado por este video',
                        description: '   ',
                        app_id: '159687390902628',
                    });
                });
                alert('entro1');
            } else if (response.status === 'not_authorized') {
                FB.login(function(response) {
                    if (response.authResponse)
                    {
                        FB.api('/me', function(response) {
                            FB.ui({
                                method: 'feed',
                                link: 'http://www.youtube.com/watch?v=' + idVideo,
                                caption: response.first_name + ' ha votado por este video',
                                description: '   ',
                                app_id: '159687390902628',
                            });
                        });
                    } else
                    {
                        console.log('Authorization failed.');
                    }
                },
                        {scope: 'email, user_birthday, publish_stream, publish_actions'});
            } else {
                FB.login(function(response) {
                    if (response.authResponse)
                    {
                        FB.api('/me', function(response) {
                            FB.ui({
                                method: 'feed',
                                link: 'http://www.youtube.com/watch?v=' + idVideo,
                                caption: response.first_name + ' ha votado por este video',
                                description: '   ',
                                app_id: '159687390902628',
                            });
                        });
                    } else
                    {
                        console.log('Authorization failed.');
                    }
                },
                        {scope: 'email, user_birthday, publish_stream, publish_actions'});
            }
        });

    } else {
        FB.api('/me', function(response) {
            FB.ui({
                method: 'feed',
                link: 'http://www.youtube.com/watch?v=' + idVideo,
                caption: response.first_name + ' ha votado por este video',
                description: '   ',
                app_id: '159687390902628',
            });
        });
    }

}
function publicarSugirio(idVideo, tipo) {
    
    if (tipo == '0') {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', function(response) {
                    FB.ui({
                        method: 'feed',
                        link: 'http://www.youtube.com/watch?v=' + idVideo,
                        caption: response.first_name + ' ha sugerido este video',
                        description: '   ',
                        app_id: '159687390902628',
                    });
                });
            } else if (response.status === 'not_authorized') {
                FB.login(function(response) {
                    if (response.authResponse)
                    {
                        FB.api('/me', function(response) {
                            FB.ui({
                                method: 'feed',
                                link: 'http://www.youtube.com/watch?v=' + idVideo,
                                caption: response.first_name + ' ha sugerido este video',
                                description: '   ',
                                app_id: '159687390902628',
                            });
                        });
                    } else
                    {
                        console.log('Authorization failed.');
                    }
                },
                        {scope: 'email, user_birthday, publish_stream, publish_actions'});
            } else {
                // the user isn't logged in to Facebook.
                FB.login(function(response) {
                    if (response.authResponse)
                    {
                        FB.api('/me', function(response) {
                            FB.ui({
                                method: 'feed',
                                link: 'http://www.youtube.com/watch?v=' + idVideo,
                                caption: response.first_name + ' ha sugerido este video',
                                description: '   ',
                                app_id: '159687390902628',
                            });
                        });
                    } else
                    {
                        console.log('Authorization failed.');
                    }
                },
                        {scope: 'email, user_birthday, publish_stream, publish_actions'});
            }
        });

    } else {
        FB.api('/me', function(response) {
            FB.ui({
                method: 'feed',
                link: 'http://www.youtube.com/watch?v=' + idVideo,
                caption: response.first_name + ' ha sugerido este video',
                description: '   ',
                app_id: '159687390902628',
            });
        });
    }

}
