jQuery(document).ready(function($){
    jQuery('#slideshow').cycle({ 
        fx:     'fade', 
        speed:  'slow',
        next:   '#next', 
        prev:   '#prev'
    });
    jQuery('#logo').cycle({ 
        fx:     'fade', 
        speed:  3000
    });
    jQuery('.paginas').hover(function(){
        jQuery(this).addClass('animated wiggle');
    },function(){
        jQuery(this).removeClass('animated wiggle');
    })
    
    jQuery('#scroll').click(function(){
        var top = jQuery('#pasosMenuContenedor').offset();
        jQuery(document).scrollTop(top.top);  
    })
});