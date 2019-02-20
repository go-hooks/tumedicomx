/* 
 * Categorizar 1.0
 * @Author: Daniel Lepe 
 * 
 * Permite configurar algunos helpers de JavaScript para categorizar el sistema.
 */

// Init APP
$(function() {
    
});

function load_related_products(){
    
    var load_related_products_url = $('#productlist').attr('data-source');
    
    // $('#productlist').append(load_related_products_url);
    
    $.ajax({
        url: load_related_products_url,
        cache: false
    }).done(function(html) {
        $('#productlist').append(html);
    });
}