<?php

    // añado el php de conexion a bbdd
    require_once __DIR__ . '/../conexion.php';

    class Horario{

        // creo propiedad conexion para almacenarla
        private $conexion;

        private $id;
        private $dia; // 'L','M','X','J','V'
        private $idGrupo;
        private $idModulo;
        private $idProfesor;
        private $idHora;

        // el constructor lleva ese nombre por defecto en las clases de php  --> __construct
        public function __construct($id = null, $dia = null, $idGrupo = null, $idModulo = null, $idProfesor = null, $idHora = null){
            $this->conexion = conectar();
            $this->id = $id;
            $this->dia = $dia;
            $this->idGrupo = $idGrupo;
            $this->idModulo = $idModulo;
            $this->idProfesor = $idProfesor;
            $this->idHora = $idHora;
        }

        //---------------------------------------------------------------------------------------------------

        // creo los getter & setter
        public function getConexion() {return $this->conexion;}
        public function getId() {return $this->id;}
        public function getDia() {return $this->dia;}
        public function getIdGrupo() {return $this->idGrupo;}
        public function getIdModulo() {return $this->idModulo;}
        public function getIdProfesor() {return $this->idProfesor;}
        public function getIdHora() {return $this->idHora;}

        public function setConexion( $conexion): void {$this->conexion = $conexion;}
        public function setId( $id): void {$this->id = $id;}
        public function setDia( $dia): void {$this->dia = $dia;}
        public function setIdGrupo( $idGrupo): void {$this->idGrupo = $idGrupo;}
        public function setIdModulo( $idModulo): void {$this->idModulo = $idModulo;}
        public function setIdProfesor( $idProfesor): void {$this->idProfesor = $idProfesor;}
        public function setIdHora( $idHora): void {$this->idHora = $idHora;}

        //---------------------------------------------------------------------------------------------------

        public function anadir(){

            $sql = "INSERT INTO horario (dia, idGrupo, idModulo, idProfesor, idHora) 
                    VALUES ('$this->dia', '$this->idGrupo', '$this->idModulo', '$this->idProfesor', '$this->idHora')";
            return $this->conexion->query($sql);

        }

        public function modificar(){
            
            if (empty($this->id)) return false;

            $sql = "UPDATE horario 
                    SET dia = '$this->dia', idGrupo = '$this->idGrupo', idModulo = '$this->idModulo', idProfesor = '$this->idProfesor', idHora = '$this->idHora' 
                    WHERE id = '$this->id'";

            return $this->conexion->query($sql);
        }
	
        public function eliminar(){
            if (empty($this->id)) return false;

            $sql = "DELETE FROM horario WHERE id = '$this->id'";

            return $this->conexion->query($sql);
        }

        //---------------------------------------------------------------------------------------------------


        public function todas(){
            $sql = "SELECT * FROM horario";
            $resultado = $this->conexion->query($sql);

            $lista = [];
            if ($resultado && $resultado->num_rows > 0){
                // para que sea solo un array asociativo
                while ($fila = $resultado->fetch_assoc()){
                    $lista[] = $fila;
                }
            }
            return $lista;
        }

        public function obtener($id){

            $sql = "SELECT * FROM horario WHERE id = '$id'";
            $resultado = $this->conexion->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                return $resultado->fetch_assoc(); // array con id, dia, idGrupo, idModulo, idProfesor, idHora
            }
            return null;
        }

        /**
         * Devuelve el horario de un grupo indexado por [idHora][dia],
         * listo para pintar la tabla en la vista.
         * Ejemplo: $horario[3]['L'] => fila con idModulo, idProfesor, codigo, modulo, profesor...
         */
        public function porGrupo($idGrupo){

            $sql = "SELECT h.id, h.dia, h.idGrupo, h.idModulo, h.idProfesor, h.idHora,
                           mo.codigo AS codigoModulo, mo.nombre AS nombreModulo,
                           p.nombre AS nombreProfesor
                    FROM horario h
                    INNER JOIN modulos mo   ON mo.id = h.idModulo
                    INNER JOIN profesores p ON p.id  = h.idProfesor
                    WHERE h.idGrupo = '$idGrupo'";

            //Uso alias porque sino, al hacer fetch_assoc() tendría dos columnas llamadas nombre (la del módulo y la del profesor) y la segunda pisaría a la primera en el array asociativo

            $resultado = $this->conexion->query($sql);

            $lista = [];
            if ($resultado && $resultado->num_rows > 0){
                while ($fila = $resultado->fetch_assoc()){

                    //$lista[1]['L'] = $fila; ejemplo
                    $lista[$fila['idHora']][$fila['dia']] = $fila;

                    /* $lista queda:
                    [
                        1 => [
                            'L' => [
                                'id'             => 1,
                                'dia'            => 'L',
                                'idHora'         => 1,
                                'idModulo'       => 10,
                                'nombreModulo'   => 'DASP - Digitalización Aplicada',
                                'nombreProfesor' => 'Ana',
                                 etc
                            ],
                        ],
                    ]
                    */

                }
            }
            return $lista;
        }

        //---------------------------------------------------------------------------------------------------

        public function __destruct(){
            if ($this->conexion) {
                $this->conexion->close();
            }
        }

    }

?>