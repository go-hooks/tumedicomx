function total(){$.ajax({type:"POST",url:"carrito-agregar.php",data:{opcion:"total"},success:function(e){$("#carrito").html(e)}})}function total_envio(){var e=$(".radioseguro").hasClass("checked"),t=$(".radioenvio.checked").attr("data-id");$.ajax({type:"POST",url:"carrito-agregar.php",data:{envio:t,seguro:e,opcion:"total_envio"},success:function(e){$(".totalpagar").html(e)}})}function send_email(e){$.post("send.php",$(e).serialize(),function(e){$("#mensajelight p").html(e);open_lightbox("#mensajelight")})}$(document).on("ready",function(){$('#detalles form input[type="button"]').click(function(){$("#detalles form").toggle();send_email("#detalles form")});$("body").on("click",".sharecorreo",function(){open_lightbox("#sharecorreo");var e=$(this).attr("data-url");$('#sharecorreo input[name="url"]').val(e)});$('#sharecorreo input[type="button"]').click(function(){$("#sharecorreo").hide();send_email("#sharecorreo")});$("body").on("click",".notificarme",function(){var e=$(this).attr("data-id");$("#notificameproducto").val(e);open_lightbox("#notificarme")});$("body").on("click",'#notificarme input[type="button"]',function(){$("#notificarme").hide();$.post("send.php",$("#notificarme").serialize(),function(e){$("#mensajelight p").html(e);open_lightbox("#mensajelight")})});$("body").on("click",".agregar",function(){var e=$(this).attr("data-id"),t=$(this).parent().find(".numeric").val();$(this).removeClass("agregar");$(this).addClass("agregado");$(this).html("");$.ajax({type:"POST",url:"carrito-agregar.php",data:{id:e,cantidad:t,opcion:"agregar"},success:function(e){open_lightbox("#mensajelight");$("#mensajelight p").html(e);total()}})});$(".agregartarjeta").click(function(){var e=$("#formtarjeta").valid();if(e){var t=$("#formtarjeta").serialize();$.ajax({type:"POST",url:"carrito-agregar.php",data:t,success:function(e){open_lightbox("#mensajelight");$("#mensajelight p").html("La tarjeta de regalo se ha agragado al carrito");$("#carrito").html(e)}})}});$(".quitar").click(function(){var e=$(this).attr("data-id"),t=confirm("Seguro que deseas quitar este producto del carrito");if(!t)return!1;$.ajax({type:"POST",url:"carrito-agregar.php",data:{id:e,opcion:"quitar"},success:function(e){location.reload()}})});$(".radioenvio").click(function(){var e=$(this).attr("data-id");$(".radioenvio").removeClass("checked");$(this).addClass("checked");$(".costoenvio").html("<b>+</b> $"+$(this).attr("data-value"));total_envio()});$(".radiomeses span").click(function(){var e=$(this).attr("data-id");$(".radiomeses").removeClass("checked");$(this).parent().addClass("checked");$("#meses").val(e);$("#formmeses").submit()});$(".radioseguro").click(function(){if($(this).hasClass("checked")){$(this).removeClass("checked");$(".seguroenvio").html("<b>+</b> $0.00")}else{$(this).addClass("checked");$(".seguroenvio").html("<b>+</b> "+$(".textseguro").val())}total_envio()})});