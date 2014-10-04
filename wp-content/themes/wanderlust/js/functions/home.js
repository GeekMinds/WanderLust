jQuery(document).ready(function($) {
    var idEstilo;
    var piezasEstilo;
    var selector_pieza;
    $('.pasosMenu').click(function() {
        var id = $(this).attr("rel");
        $('.pasos:visible').fadeOut("slow", function() {
            $('#paso' + id).fadeIn("slow");
        })
    })

    $('.bounceMenu').hover(function() {
        $(this).addClass('animated swing');
    }, function() {
        $(this).removeClass('animated swing');
    });

    $('#limpiarBoton').click(function() {
//        $('.pasos:visible').fadeOut("slow", function(){
//            $('#paso1').fadeIn("slow");
//            $('#menu1').addClass("paso-disabled");
//            $('#menu2').addClass("paso-disabled");
//        })

        $("#zapatoEstiloPieza").fadeOut("slow", function() {
            $(".imagen-pieza").empty();
            $('.tela-seleccionada').empty();
            $("#zapatoEstiloPieza").show();
            selector_pieza = undefined;
            $('.selector-pieza').removeClass('selector-disabled');
        });

    })

    $('.categoria').click(function() {
        var idCat = $(this).attr("rel");
        $.ajax({
            data: 'action=estilos&cat=' + idCat,
            url: ajaxurl,
            type: 'post',
            success: function(data) {
                $('#paso1').fadeOut("slow", function() {
                    $('#menu2').removeClass("paso-disabled");
                    $('#paso2').fadeIn("slow");
                    $("#paso2").html(data);
                })

            }
        })

    })
    $('.estilo-preview a').live("click", function() {
        var tusSelecciones = '';
        idEstilo = $(this).attr("rel");
        piezasEstilo = parseInt($(this).attr("lang"));
        $.ajax({
            data: 'action=getSelectorPieza&estilo=' + idEstilo,
            url: ajaxurl,
            type: 'post',
            success: function(data) {
                console.log("data")
                $('#paso2').fadeOut("slow", function() {
                    $('#menu3').removeClass("paso-disabled");
                    $('#paso3').fadeIn("slow");
                    $("#zapatoVistaPrevia").html(data);
                    for (var i = 1; i <= piezasEstilo; i++){
                        tusSelecciones += '<div class="tela tela-seleccionada" id="tela-pieza-' + i + '"></div>';
                    }
                    $('#tusSelecciones').html('<label>TUS SELECCIONES</label>'+tusSelecciones);
                })

            }
        })

    })
    /*
     clase = sector_pieza
     rel = id de la tabla pieza
     */
    
    $('.selector-pieza').live("click", function() {
        $('.selector-pieza').addClass('selector-disabled');
        $(this).removeClass('selector-disabled');
        selector_pieza = $(this).attr('rel');

    })

    $('.tela a').live("click", function() {
        if (selector_pieza != undefined) {
            var tela = $(this).attr('rel');
            var thisTela = $(this);

            $.ajax({
                data: 'action=shoe&estilo=' + idEstilo + '&tela=' + tela + '&pieza=' + selector_pieza,
                url: ajaxurl,
                type: 'post',
                success: function(data) {
                    var telahtml = thisTela.parent().html();
                    var cont = 0;
                    var contTelas = $('#tusSelecciones .tela').length;

                    $("#imagen-estilo-pieza-"+selector_pieza).fadeOut("slow", function() {
                        $("#imagen-estilo-pieza-"+selector_pieza).html(data);
                        $("#imagen-estilo-pieza-"+selector_pieza).fadeIn();
                    });

                    if (contTelas) {
                            $('#tela-pieza-' + selector_pieza).html(telahtml);
                    } else {
                        $('#tusSelecciones').append('<div class="tela" id="tela-pieza-' + selector_pieza + '">' + telahtml + '</div>');
                    }
                }
            })
        } else{
            alert("Selecciona una pieza!")
        }
    })

    $('#enviarBotonExterior').live("click",function(){
        var data = $('#sendShoe').serialize();
        var piezas = {};
        $('.imagen-pieza img').each(function(e){
            piezas['pieza'+ e] = $(this).attr("rel");
        })
        var bk = $('.imagen-pieza').parent().attr("rel");
        //data.piezas = piezas;
        var piezasString = JSON.stringify(piezas);
       $.ajax({
            data : 'action=sendShoe&e='+data+'&act=email&piezas='+piezasString+'&bk='+bk,
            url : ajaxurl,
            type : 'post',
            dataType: 'json',
            beforeSend: function(){
                $.fancybox.showActivity();
            },
            success: function(data){
                 console.log(data)
                $.fancybox.hideActivity();
                if(data.error != 'error'){
                    alert('Correo enviado exitosamente');
                    //$("#frmSuscribe #newsletter").val('');
                } 
            }
       })

        // $("#sendShoe").validate({
        //      submitHandler: function(form){
        //          sendData($(form));
        //      }
        // });
    })


});

function sendData(obj){
    console.log("send ")
   jQuery(function($){
       var data = $(this).serialize();
       $.ajax({
            data : 'action=sendShoe&e='+data+'&act=email',
            url : ajaxurl,
            type : 'post',
            dataType: 'json',
            beforeSend: function(){
                $.fancybox.showActivity();
            },
            success: function(data){
                 console.log(data)
                $.fancybox.hideActivity();
                if(data.error != 'error'){
                    alert('Correo enviado exitosamente');
                    //$("#frmSuscribe #newsletter").val('');
                } 
            }
       })
   })
}