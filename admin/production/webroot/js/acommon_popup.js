Event.observe(window, "load", function(){
    $('close_popup').observe('click', function(event) {
        window.close();
        event.stop();
    });
}); 
