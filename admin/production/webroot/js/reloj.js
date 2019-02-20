Event.observe(window, "load", function() {
    div_date = $('current-date');
    fechaActual = new Date();

    new Ajax.Request('index.php?request=rpc/fecha-actual&nocache=' + Math.random(), {
        method: 'post',
        asynchronous: true,
        onSuccess: function(resp) {
            var json = resp.responseText.evalJSON(true);
            fechaActual = new Date(json.fecha_actual);

            mostrarFechaActual();
        }
    });
});

function mostrarFechaActual() {
    var dias = new Array(
        "Domingo", "Lunes", "Martes", "Mi&eacute;rcoles",
        "Jueves", "Viernes", "S&aacute;bado", "Domingo"
    );

    var meses = new Array(
        "Enero","Febrero","Marzo","Abril","Mayo","Junio",
        "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"
    );

    var anio = fechaActual.getFullYear();

    var horas    = fechaActual.getHours();
    var minutos  = fechaActual.getMinutes();
    var segundos = fechaActual.getSeconds();

    if (horas <= 9) { 
        horas    = "0" + horas; }
    if (minutos <= 9) { 
        minutos  = "0" + minutos; }
    if (segundos <= 9) {
        segundos = "0" + segundos; }

    var str_fecha = dias[fechaActual.getDay()] + ", "
                  + fechaActual.getDate() + " de "
                  + meses[fechaActual.getMonth()]
                  + " de " + anio + ", a las "
                  + horas + ":" + minutos + ":" + segundos;

    div_date.innerHTML = str_fecha;
    fechaActual.setSeconds(fechaActual.getSeconds() + 1);
    setTimeout("mostrarFechaActual()", 1000);
}
