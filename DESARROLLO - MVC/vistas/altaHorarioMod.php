<?php
    // $datos viene del controlador c_altaHorarioMod()
    $dias = ['L','M','X','J','V'];
    $id = $datos['idGrupo'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Alta Horario - Modulos</title>
    <link rel="icon" type="image/*" href="images/icono.png">
    <link rel="stylesheet" href="css/index.css"/>
    <!--Fuentes de google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>Inicio</li>
                <li id="indiceActivo">Grupos</li>
                <li>Profesores</li>
                <li>Cerrar Sesión</li>
            </ul>
        </nav>
    </header>
    <main>
        <a id="volver" href="index.php?accion=listadoGrupos"><p>< Volver</p></a>
        <h1><?= $datos['grupo']['codigo'] ?></h1> <!--en vez de abrir php y hacer echo, este es un atajo que pinta directamente-->

        <form id="formHorario" method="POST" action="index.php?accion=altaHorarioPro&id=<?= $id ?>">
            <table id="tablaHorario">
                <thead>
                    <tr>
                        <th></th>
                        <th>LUNES</th>
                        <th>MARTES</th>
                        <th>MIÉRCOLES</th>
                        <th>JUEVES</th>
                        <th>VIERNES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos['horas'] as $hora) { ?>
                        <tr>
                            <td><?= $hora['hora'] ?></td>

                            <?php foreach ($dias as $dia) { ?>
                                <?php $sel = $datos['asignado'][$hora['id']][$dia] ?? null; ?>
                                <td>
                                    <select name="mod[<?= $dia ?>][<?= $hora['id'] ?>]" id="mod-<?= $dia ?>-<?= $hora['id'] ?>">
                                        <option value="">Seleccionar módulo</option>
                                        <?php foreach ($datos['modulos'] as $m) { ?>
                                            <?php $selected = ($sel && $sel['idModulo'] == $m['id']) ? ' selected' : ''; ?>
                                            <option value="<?= $m['id'] ?>"<?= $selected ?>><?= $m['nombre'] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <section id="botonesEdicion">
                <a id="restablecer">RESTABLECER</a>
                <input type="submit" id="modificar" value="MODIFICAR PROFESORES">
            </section>
        </form>
    </main>
    <footer>
        <small>Los modulos son del grupo seleccionado</small>
    </footer>
</body>
</html>