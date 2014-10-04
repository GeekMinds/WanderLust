function validarEmail(email) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!expr.test(email))
        return false;
    return true;
}
function fecha(parametro, control) {
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
function registrarSimple(parametro1, parametro2, parametro3, parametro4, parametro5, parametro6, parametro7, parametro8) {
    console.log("Entro");
    if ($('input:radio[name=sex]:checked').val() != null && $('#username').val() != "" && $('#name').val() != "" && $('#lastName').val() != "" && $('#pass').val() != "" && $('#edad').val() != "" && $('#mail').val() != "") {
        if ($('#pass').val() == $('#pass2').val()) {
            if (validarEmail(parametro6) != false) {
                var parametros = {
                    "username": parametro1,
                    "name": parametro2,
                    "lastName": parametro3,
                    "pass": parametro4,
                    "age": fecha(parametro5, false),
                    "email": parametro6,
                    "sexo": $('input:radio[name=sex]:checked').val(),
                    "urlImagen": ""
                };
                $.ajax({
                    data: parametros,
                    url: 'Funciones/Registrar.php',
                    type: 'post',
                    success: function(response) {
                        var dataString = {
                            "username": parametro1,
                            "password": parametro4,
                        }
                        $.ajax({
                            type: "POST",
                            url: "Funciones/LoginSimple.php",
                            data: dataString,
                            dataType: 'json',
                            success: function(response) {
                                if (response.error == 0) {
                                    window.location.href = "index.php";

                                }
                            },
                            error: function(xhr, textStatus, error) {
                                console.log(xhr.statusText);
                                console.log(textStatus);
                                console.log(error);
                                console.log("entro4");

                            }

                        });
                    },
                    error: function() {
                        //$("#resultado").html("Error x_D");
                        alert('Error Fatal');
                    }
                });

            } else {
                alert("Correo Invalido");
            }
            ;

        } else {
            alert("Las contraseñas no coinsiden");
        }

    } else if (parametro7 != null) {
        console.log(parametro5);

    } else {
        alert("Algunos campos estan vacios");
    }
}

