<?php
/*
 * Select sexos
 * @return array
 */
function obtener_select_sexos()
{
    return array(
        'H' => 'Hombre',
        'M' => 'Mujer'
    );
}

/*
 * Select estados civiles
 * @return array
 */
function obtener_select_estadosCiviles()
{
    return array(
        'S' => 'Soltero',
        'C' => 'Casado',
        'D' => 'Divorciado',
        'V' => 'Viudo',
        'U' => 'Union Libre'
    );
}


function obtener_select_estadoCivilFamilia()
{
    return array(
        'C' => 'Casados',
        'S' => 'Soltero',
        'V' => 'Viudos',
        'D' => 'Divorciados',
        'N' => 'No definido',
        'E' => 'Separados'
    );
}

function obtener_selectEtapas()
{
    return array(
        '1'  => 'Ingreso',
        '2'  => 'Valoracion',
        '3'  => 'Terapia',
        ''  => 'Ninguna'
    );
}

function EtapasMenor(){
    return array(
        '1' => 'Ingreso',
        '2' => 'Valoracion',
        '3' => 'Terapia'
    );
}

function obtenerSelectColores(){
    return array(
        '#FFF'     => 'Ninguno',
        '#FFFF66'  => 'Amarillo',
        '#91FF5B'  => 'Verde',
        '#E6E600'  => 'Verde pistache',
        '#6CA7FF'  => 'Azul',
        '#E2E2E2'  => 'Gris',
        '#FF93FF'  => 'Rosa',
        '#FF6666'  => 'Rojo',
        '#2A2A2A'  => 'Negro'
    );
}

function obtenerSelectHoras(){
    return array(
        '0'  => '12',
        '1'  => '1',
        '2'  => '2',
        '3'  => '3',
        '4'  => '4',
        '5'  => '5',
        '6'  => '6',
        '7'  => '7',
        '8'  => '8',
        '9'  => '9',
        '10' => '10',
        '11' => '11'
    );
}


function obtenerSelectHorasMinutos(){
    return array(
        '0'   => '00',
        '10'  => '10',
        '20'  => '20',
        '30'  => '30',
        '40'  => '40',
        '50'  => '50'
    );
}


function obtenerFormasPago(){
    return array(
        'Deposito_efectivo'  => 'Deposito en efectivo',
        'Deposito_cheque'    => 'Deposito en cheque',
        'Vaucher'            => 'Vaucher',
        'Ficha'              => 'Ficha'
    );
}



function obtenerMeses(){
    return array(
        '1'  => 'Enero',
        '2'  => 'Febrero',
        '3'  => 'Marzo',
        '4'  => 'Abril',
        '5'  => 'Mayo',
        '6'  => 'Junio',
        '7'  => 'Julio',
        '8'  => 'Agosto',
        '9'  => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    );
}