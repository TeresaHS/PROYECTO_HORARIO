<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORARIO - Listado Grupos</title>
    <link rel="icon" type="image/*" href="images/icono.png">
    <link rel="stylesheet" href="css/index.css"/>
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
        <a id="volver"><p>< Volver</p></a>
        <h1>GRUPOS</h1>

        <table id="tablaGrupos">
            <!-- IMPORTANTE: Preguntar a isa si es mejor usar llaves o los dos puntos y su end;-->
            <?php foreach ($datos['grupos'] as $grupo) { ?> <!-- recorro la lista de grupos que me pasa el controlador-->
                <tr>
                    <th><?= $grupo['codigo'] ?></th> <!-- pinta el codigo del grupo (ej: "2DAW")-->
                    <td><?= $grupo['nombre'] ?></td> <!-- pinta el nombre del grupo (ej: "2º F.P.G.S Desarrollo de Aplicaciones Web")-->
                    <?php if ($datos['g']->tieneHorario($grupo['id'])) { ?> <!-- pregunto a la BD si ese grupo ya tiene horario-->
                        <td><a>✎</a><a>Ver</a></td>
                    <?php } else { ?>
                        <td><a href="index.php?accion=altaHorarioMod&id=<?= $grupo['id'] ?>">+</a></td>
                    <?php } ?> 
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer>
        <small>Aplicación de Horario - Teresa Hernández Sánchez - MOCKUP</small>
    </footer>
</body>
</html>