<?php
    require_once realpath(__DIR__ . '/../modelos/Grupo.php');

    function c_listadoGrupos() {
        $g = new Grupo();
        $datos = [
            'grupos' => $g->todas(),
            'g' => $g,  // para poder llamar a tieneHorario() en la vista
        ];
        require realpath(__DIR__ . '/../vistas/listadoGrupos.php');
    }
?>