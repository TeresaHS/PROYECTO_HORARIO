<?php
    function c_altaHorarioPro() {
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php'); exit; }

        $datos = ['id' => $id];
        require realpath(__DIR__ . '/../vistas/altaHorarioPro.php');
    }
?>