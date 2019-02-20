Event.observe(window, "load", function() {
    cargoFormValidation = new Validation('coloniaform', {useTitles:false});
    /*$('btn_reset').observe('click', function(event) {
        cargoFormValidation.reset();
        event.stop();
        //return false;
    });*/
});
