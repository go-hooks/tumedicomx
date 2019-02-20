<?php

/*
 * Daniel Lepe
 * SUSTAM 2014
 * 
 * Ayudante que manda a la salida del template principal el paginado local.
 * */

function paginate_position() {
    global $pagination;
    if (empty($pagination) || !isset($pagination['fetched'])) {
        return false;
    }

    return sprintf('<div class="paginator_details">Mostrando %s de %s registros</div>', $pagination['fetched'], $pagination['rows']);
}

/*
 * Paginate Helper, funciona con la variable pagination de db utils y otras.
 * 
 * Recibe el parámetro group, donde se especifica el máximo de botones en grupo
 * en el array de opciones se puede establecer bootstrap-false, al darlo de alta
 * el paginador omitirá las clases de bootrap.
 * 
 * Daniel Lepe 2014
 */

function paginate_helper($group = 5, $options = array()) {
    global $pagination;


    if (empty($pagination) || $pagination['pages'] < 2) {
        return false;
    }


    // $group debe ser un impar

    if (es_par($group)) {
        $group--;
    }

    $positions = ($group - 1) / 2;
    if (!isset($options['bootstrap-false'])) {
        echo '<div class="pagination-holder paginator"><ul class="pagination pagination-sm">';
    } else {
        echo '<div class=" paginator "><ul>';
    }


    // Si hay mas paginas a la izquierda antes del límite a mostrer, imprime botón de retorno rápido

    $diff = 0;
    if ($pagination['current'] - $positions > 1) {
        $diff = 1;

        if (!isset($options['bootstrap-false'])) {
            $content = "<span class='glyphicon glyphicon-backward'></span>&nbsp;";
        } else {
            $content = "<<";
        }

        $class = "";
        echo sprintf("<li class='%s'><a href='%s'>%s</a></li>", $class, generate_page_number(1), $content);
    }


    // Imprime páginas a la izquierda
    $start = $pagination['current'] - $positions + $diff;

    if (($pagination['current'] + ($group - 1) / 2) >= $pagination['pages']) {
        $start -= $pagination['current'] + ($group - 1) / 2 - $pagination['pages'];
    }

    if ($start < 1) {
        $start = 1;
    }

    while ($start < $pagination['current']) {
        $content = $start;
        $class = "";
        echo sprintf("<li class='%s'><a href='%s'>%s</a></li>", $class, generate_page_number($start), $content);

        $start++;
    }

    // Equaliza para simetría:
    if ($pagination['current'] - $positions <= 0) {
        $positions = $positions + abs($pagination['current'] - $positions - 1);
    }




    // Imprime página actual

    $content = $pagination['current'];

    $class = "active current";
    echo sprintf("<li class='%s'><a href='%s'>%s</a></li>", $class, generate_page_number($pagination['current']), $content);


    // Imprime páginas a la derecha
    $start = $pagination['current'] + 1;

    while (($start <= $pagination['pages']) && $positions > 0) {
        $content = $start;
        $class = "";
        echo sprintf("<li class='%s'><a href='%s'>%s</a></li>", $class, generate_page_number($start), $content);

        $start++;
        $positions--;
        // Predice si habrá FF para reducir un espacio
        if ($positions == 1 && $start + $positions <= $pagination['pages']) {
            $positions--;
        }
    }

    // Imprime última página
    if ($start < $pagination['pages']) {
        if (!isset($options['bootstrap-false'])) {
            $content = "<span class='glyphicon glyphicon-forward'></span>&nbsp;";
        } else {
            $content = ">>";
        }
        $class = "";
        echo sprintf("<li class='%s'><a href='%s'>%s</a></li>", $class, generate_page_number($pagination['pages']), $content);
    }
    echo '</ul></div>';
}

// Devuelve verdadero si el campo y la direccion dadas son correctas, si $direction 
// no se especifica devuelve como resultado la direcciÃ³n:
// asc:desc
// Si no corresponde devuelve falso

function pagination_is($field, $direction = NULL) {
    if ($direction != NULL) {
        $direction = paginate_convert_direction($direction);
    }
    
    // debug("o=$field:$direction");
    
    if ($direction != NULL && stristr($_SERVER['REQUEST_URI'], "o=$field:$direction")) {
        return TRUE;
    } elseif (stristr($_SERVER['REQUEST_URI'], "o=$field:")) {
        if (stristr($_SERVER['REQUEST_URI'], "o=$field:d") && $direction == NULL) {
            return 'desc';
        } elseif (stristr($_SERVER['REQUEST_URI'], "o=$field:a") && $direction == NULL) {
            return 'asc';
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function paginate_convert_direction($direction) {
    switch ($direction) {
        case 'desc': case 'down': case 'd':
            $direction = 'd';
            break;
        case 'asc': case 'up': case 'a':
            $direction = 'a';
            break;
        default :
            $direction = 'a';
            break;
    }
    return $direction;
}

/*
 * Devuelve un link preformateado para el paginador actual
 */

function paginate_sort($field, $direction) {

    $direction = paginate_convert_direction($direction);

    if (stristr($_SERVER['REQUEST_URI'], 'o=')) {
        return preg_replace("/o=\w*:\w/i", "o=" . "$field:$direction", $_SERVER['REQUEST_URI']);
    } elseif (stristr($_SERVER['REQUEST_URI'], '?')) {
        $str = $_SERVER['REQUEST_URI'] . "?o=" . "$field:$direction";
        return preg_replace('/\?\?/', '?', $str);
    } else {
        return $_SERVER['REQUEST_URI'] . "?o=" . "$field:$direction";
    }
}

function generate_page_number($number) {
    if (stristr($_SERVER['REQUEST_URI'], 'p=')) {
        return preg_replace("/p=\d*/", "p=" . $number, $_SERVER['REQUEST_URI']);
    } elseif (stristr($_SERVER['REQUEST_URI'], '?')) {
        $str = $_SERVER['REQUEST_URI'] . "&p=" . $number;
        return preg_replace('/\?\?/', '?', $str);
    } else {
        return $_SERVER['REQUEST_URI'] . "?p=" . $number;
    }
}

?>