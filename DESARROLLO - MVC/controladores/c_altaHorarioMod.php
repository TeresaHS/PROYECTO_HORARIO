<?php
    require_once realpath(__DIR__ . '/c_horario.php');
    require_once realpath(__DIR__ . '/../modelos/Grupo.php');

    function c_altaHorarioMod() {
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php'); exit; }

        $datos = prepararHorarioGrupo($id);

        $g = new Grupo();
        $datos['grupo'] = $g->obtener($id);

        require realpath(__DIR__ . '/../vistas/altaHorarioMod.php');
    }
?>