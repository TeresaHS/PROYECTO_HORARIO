<?php
require_once 'conexion.php';
require_once 'modelos/Grupo.php';
require_once 'modelos/Hora.php';
require_once 'modelos/Modulo.php';
require_once 'modelos/Profesor.php';
require_once 'modelos/Horario.php';

require_once 'controladores/c_listadoGrupos.php';
require_once 'controladores/c_altaHorarioMod.php';
require_once 'controladores/c_altaHorarioPro.php';

// cojo la accion de la url; si no viene, por defecto listadoGrupos
$accion = $_GET['accion'] ?? 'listadoGrupos';

switch ($accion) {

    case 'listadoGrupos':
        c_listadoGrupos();
        break;

    case 'altaHorarioMod':
        c_altaHorarioMod();
        break;

    case 'altaHorarioPro':
        c_altaHorarioPro();
        break;

    default:
        http_response_code(404); // mando codigo http 404 (pagina no encontrada)
        echo "Acción no encontrada";
        break;
}