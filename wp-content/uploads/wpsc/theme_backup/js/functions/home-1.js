jQuery(document).ready(function($){
    $('.bounceMenu').hover(function(){
        $(this).addClass('animated swing');
    },function(){
        $(this).removeClass('animated swing');
    });
    
    $('.pasosMenu').click(function(){
        var id = $(this).attr("rel");
        $('.pasos:visible').fadeOut("slow", function(){
            $('#paso'+ id).fadeIn("slow");
        })
    })
    $('.categoria').click(function(){
        var idCat = $(this).attr("rel");
        $.ajax({
                data : 'action=estilos&cat='+idCat,
                url : ajaxurl,
                type : 'post',
                success: function(data){
                    console.log("data")
                    $('#paso1').fadeOut("slow", function(){
                        $('#paso2').fadeIn("slow");
                        $("#paso2").html(data);
                    })
                    
                }
           })
        
    })
    $('.estilo-preview a').live("click", function(){
        var idEstilo = $(this).attr("rel");
        $.ajax({
                data : 'action=getSelectorPieza&estilo='+idEstilo,
                url : ajaxurl,
                type : 'post',
                success: function(data){
                    console.log("data")
                    $('#paso2').fadeOut("slow", function(){
                        $('#paso3').fadeIn("slow");
                        $("#zapatoVistaPrevia").html(data);
                    })
                    
                }
           })
        
    })
//    $('.estilos').click(function(){
//        var id = $(this).attr("rel");
//        $('.pasos:visible').fadeOut("slow", function(){
//            $('#paso3').fadeIn("slow");
//        })
//    })
 
});