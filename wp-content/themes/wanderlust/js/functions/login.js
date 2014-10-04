/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function($){
    $('.btnLogin').click(function(){
        $('#modalLogin').modal({
            containerId: 'contenedorModalLogin'
        });
    });
    $('.crearUsuario').click(function(){
        $.modal.close();
        $('#modalRegistro').modal({
            containerId: 'contenedorModalRegistro'
        });
    });
    $('.recuperar').click(function(){
        $.modal.close();
        $('#modalRecuperar').modal({
            containerId: 'contenedorModalRecuperar'
        });
    });
});

