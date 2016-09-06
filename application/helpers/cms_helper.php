<?php

function btn_edit($uri) {
    return anchor($uri, '<i class="glyphicon glyphicon-edit"></i>');
}

function btn_delete($uri) {
    return anchor($uri, '<i class="glyphicon glyphicon-remove"></i>', array('onclick' => "return confirm('¿Desea eliminar este registro?');"));
}

function get_unidades($u = null) {
    $unidades = array('g' => 'Gramo', 'k' => 'Kilo', 'l' => 'Litro', 'm' => 'Mililitro', 'u' => 'Unidad', 'c' => 'C. Cubicos');
    if ($u) {
        return $unidades[$u];
    } else {
        return $unidades;
    }
}

function get_envases($e = null) {
    $envase = array(1 => 'Bolsa de Papel', 2 => 'Envase de Vidrio Nuevo', 3 => 'Intercambio Envase');
    if ($e) {
        return $envase[$e];
    } else {
        return $envase;
    }
}

function get_status($s = null) {
    $status = array('P'=>'Pendiente', 'C'=>'Coodinado', 'E'=>'Entregado');
    return ($s) ? $status[$s] : $status;
}

function get_fp($fp = null) {
    $forma = array(1=>'Contra Entrega', 2=>'Giro');
    return ($fp) ? $forma[$fp] : $forma;
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
