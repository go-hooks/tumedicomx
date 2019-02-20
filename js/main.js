$(document).on('ready', function() {

	
      $("#play").click(function() {
      	  $.fancybox({fitToView: false,autoSize: true,width: '800px',height: '500px',closeClick: false,
              hideOnOverlayClick: true,openEffect: 'none',closeEffect: 'none',
               onComplete: function () {
					        $.fancybox.resize();
					        $.fancybox.center();
					    },
					    href : "#formvarious",
					   afterClose : function(){ // it was onClosed for v1.3.4
					    $("#login_error").hide();
					   }
					  }); // fancybox
         });

	$(".fancybox").fancybox({
	    helpers : {
	        overlay : {
	            locked : false
	        }
	    }
	});
	
	$("#promocion").click();

	$(".openingresar").click(function(){
		$(".ingresar").slideDown(400);
	});
	$(".ingresar .close").click(function(){
		$(".ingresar").slideUp(400);
	});

	$(".catalogopestanas li").click(function(){
		$(".catalogopestanas li").removeClass('activo');
		$(this).addClass('activo');
		var clase = $(this).attr('data-class');
		$('.catalogo').removeClass('activo');
		$(clase).addClass('activo');
	});

	$(".hospitales > h2").click(function(){

		if(!$(this).parent().hasClass('activo')){
			$(".hospitales").removeClass('activo');
			$(this).parent().addClass('activo');
		}else{
			$(".hospitales").removeClass('activo');
		}
	});

	$(".hospitales li > h2").click(function(){

		if(!$(this).parent().hasClass('activo')){
			$(".hospitales li").removeClass('activo');
			$(this).parent().addClass('activo');
		}else{
			$(".hospitales li").removeClass('activo');
		}
	});


	$(".servicios > h2").click(function(){

		if(!$(this).parent().hasClass('activo')){
			$(".servicios").removeClass('activo');
			$(this).parent().addClass('activo');
		}else{
			$(".servicios").removeClass('activo');
		}
	});

	$(".proveedores > h2").click(function(){

		if(!$(this).parent().hasClass('activo')){
			$(".proveedores").removeClass('activo');
			$(this).parent().addClass('activo');
		}else{
			$(".proveedores").removeClass('activo');
		}
	});



})