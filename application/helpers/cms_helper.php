<?php

function btn_edit($uri) {
    return anchor($uri, '<i class="glyphicon glyphicon-edit"></i>');
}

function btn_delete($uri) {
    return anchor($uri, '<i class="glyphicon glyphicon-remove"></i>', array('onclick' => "return confirm('¿Desea eliminar este registro?');"));
}

function get_unidades($u = null) {
    $unidades = array('g' => 'Gramo', 'k' => 'Kilo', 'l' => 'Litro', 'm' => 'Mililitro', 'u' => 'Unidad');
    if ($u) {
        return $unidades[$u];
    } else {
        return $unidades;
    }
}

function getCopy($objeto) {
    if ($objeto == NULL) {
        return null;
    } else {
        $new = new stdClass();
        foreach ($objeto as $clave => $valor) {
            $new->$clave = $valor;
        }
        return $new;
    }
}
