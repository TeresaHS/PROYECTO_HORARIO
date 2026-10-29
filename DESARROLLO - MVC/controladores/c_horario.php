<?php

    // __DIR__ = carpeta de este archivo (no falla) realpath = ruta limpia y absoluta (require_once no duplica)
    require_once realpath(__DIR__ . '/../modelos/Hora.php'); 
    require_once realpath(__DIR__ . '/../modelos/Modulo.php');
    require_once realpath(__DIR__ . '/../modelos/Horario.php');

    function prepararHorarioGrupo($idGrupo) {

        $horaM = new Hora();
        $moduloM = new Modulo();
        $horarioM = new Horario();

        return [
            'idGrupo' => $idGrupo,
            'horas' => $horaM->todas(),
            'modulos' => $moduloM->modulosGrupo($idGrupo),
            'asignado' => $horarioM->porGrupo($idGrupo),
        ];

        /*
        $datos = [
            'idGrupo'  => 5,

            'horas'    => [ ... ],   // lista de las 3 horas
            'modulos'  => [ ... ],   // lista de los 2 módulos del grupo
            'asignado' => [ ... ],   // mapa [idHora][dia] => fila del horario
        ];
        */
    }

    /*

    EJEMPLO

    $datos['idGrupo']
    ---------------------------------------------------------
    5
    __________________________________________________________________________________________________

    $datos['horas'] — lista plana (array indexado)
    Viene de (new Hora())->todas():
    ---------------------------------------------------------

    [
        0 => ['id' => 1, 'hora' => '08:15 - 09:10'],
        1 => ['id' => 2, 'hora' => '09:10 - 10:05'],
        2 => ['id' => 3, 'hora' => '10:05 - 11:00'],
    ]
    __________________________________________________________________________________________________

    $datos['modulos'] — lista plana (array indexado)
    Viene de (new Modulo())->modulosGrupo(5):
    ---------------------------------------------------------

    [
        0 => ['id' => 10, 'codigo' => '0369', 'nombre' => 'DASP - Digitalización Aplicada', 'horas' => ...],
        1 => ['id' => 11, 'codigo' => '0483', 'nombre' => 'PROG - Programación',            'horas' => ...],
    ]
    __________________________________________________________________________________________________

    $datos['asignado'] — mapa bidimensional [idHora][dia]
    Viene de (new Horario())->porGrupo(5), que reindexa el resultado del SQL:
    ---------------------------------------------------------

    [
        1 => [                                          // idHora = 1
            'L' => [
                'id'             => 1,
                'dia'            => 'L',
                'idGrupo'        => 5,
                'idModulo'       => 10,
                'idProfesor'     => 2,
                'idHora'         => 1,
                'codigoModulo'   => '0369',
                'nombreModulo'   => 'DASP - Digitalización Aplicada',
                'nombreProfesor' => 'Ana',
            ],
            'M' => [
                'id'             => 2,
                'dia'            => 'M',
                'idGrupo'        => 5,
                'idModulo'       => 11,
                'idProfesor'     => 4,
                'idHora'         => 1,
                'codigoModulo'   => '0483',
                'nombreModulo'   => 'PROG - Programación',
                'nombreProfesor' => 'Luis',
            ],
        ],
        2 => [                                          // idHora = 2
            'L' => [
                'id'             => 3,
                'dia'            => 'L',
                'idGrupo'        => 5,
                'idModulo'       => 11,
                'idProfesor'     => 4,
                'idHora'         => 2,
                'codigoModulo'   => '0483',
                'nombreModulo'   => 'PROG - Programación',
                'nombreProfesor' => 'Luis',
            ],
        ],
    ]
    __________________________________________________________________________________________________

    */

?>