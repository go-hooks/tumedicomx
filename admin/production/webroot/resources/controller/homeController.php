<?php

defined('JZ_UPALE') or die('Acceso Incorrecto');

authenticar();

function home_default() {
    return home_bienvenida();
}

function home_bienvenida() {
    // Identificar el modulo por default y cargarlo
    go_to('productos');
}
