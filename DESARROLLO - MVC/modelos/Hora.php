<?php

    // añado el php de conexion a bbdd
    require_once __DIR__ . '/../conexion.php';

    // IMPORTANTE require_once 'conexion.php'; PUEDE QUE NECESITE ESTO PORQUE EN LA GENERACIÓN DE TABLA PARA HORARIO SE LLAMA SIMULTANEAMENTE A CONECTAR DESDE VARIAS CLASES

    class Hora{

        // creo propiedad conexion para almacenarla
        private $conexion;

        private $id;
        private $hora;

        // el constructor lleva ese nombre por defecto en las clases de php  --> __construct
        public function __construct($id = null, $hora = null){
            $this->conexion = conectar();
            $this->id = $id;
            $this->hora = $hora;
        }

        //---------------------------------------------------------------------------------------------------

        // creo los getter & setter
        public function getConexion() {return $this->conexion;}
        public function getId() {return $this->id;}
        public function getHora() {return $this->hora;}

        public function setConexion( $conexion): void {$this->conexion = $conexion;}
        public function setId( $id): void {$this->id = $id;}
        public function setHora( $hora): void {$this->hora = $hora;}

        //---------------------------------------------------------------------------------------------------

        public function anadir(){

            $sql = "INSERT INTO horas (hora) 
                    VALUES ('$this->hora', '$this->hora')";
            return $this->conexion->query($sql);

        }

        public function modificar(){
            
            if (empty($this->id)) return false;

            $sql = "UPDATE horas 
                    SET hora = '$this->hora'
                    WHERE id = '$this->id'";

            return $this->conexion->query($sql);
        }
	
        public function eliminar(){
            if (empty($this->id)) return false;

            $sql = "DELETE FROM horas WHERE id = '$this->id'";

            return $this->conexion->query($sql);
        }

        //---------------------------------------------------------------------------------------------------


        public function todas(){
            $sql = "SELECT * FROM horas";
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

            $sql = "SELECT * FROM horas WHERE id = '$id'";
            $resultado = $this->conexion->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                return $resultado->fetch_assoc(); // array con id, hora
            }
            return null;
        }

        //---------------------------------------------------------------------------------------------------

        public function __destruct(){
            if ($this->conexion) {
                $this->conexion->close();
            }
        }

    }

?>