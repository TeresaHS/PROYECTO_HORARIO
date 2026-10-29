<?php

    // añado el php de conexion a bbdd
    require_once __DIR__ . '/../conexion.php';

    class Grupo{

        // creo propiedad conexion para almacenarla
        private $conexion;

        private $id;
        private $codigo;
        private $nombre;

        // el constructor lleva ese nombre por defecto en las clases de php  --> __construct
        public function __construct($id = null, $codigo = null, $nombre = null){
            $this->conexion = conectar();
            $this->id = $id;
            $this->codigo = $codigo;
            $this->nombre = $nombre;
        }

        //---------------------------------------------------------------------------------------------------

        // creo los getter & setter
        public function getConexion() {return $this->conexion;}
        public function getId() {return $this->id;}
        public function getCodigo() {return $this->codigo;}
        public function getNombre() {return $this->nombre;}

        public function setConexion( $conexion): void {$this->conexion = $conexion;}
        public function setId( $id): void {$this->id = $id;}
        public function setCodigo( $codigo): void {$this->codigo = $codigo;}
        public function setNombre( $nombre): void {$this->nombre = $nombre;}

        //---------------------------------------------------------------------------------------------------

        public function anadir(){

            $sql = "INSERT INTO grupos (codigo, nombre) 
                    VALUES ('$this->codigo', '$this->nombre')";
            return $this->conexion->query($sql);

        }

        public function modificar(){
            
            if (empty($this->id)) return false;

            $sql = "UPDATE grupos 
                    SET codigo = '$this->codigo', nombre = '$this->nombre' 
                    WHERE id = '$this->id'";

            return $this->conexion->query($sql);
        }
	
        public function eliminar(){
            if (empty($this->id)) return false;

            $sql = "DELETE FROM grupos WHERE id = '$this->id'";

            return $this->conexion->query($sql);
        }

        //---------------------------------------------------------------------------------------------------


        public function todas(){
            $sql = "SELECT * FROM grupos";
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

            $sql = "SELECT * FROM grupos WHERE id = '$id'";
            $resultado = $this->conexion->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                return $resultado->fetch_assoc(); // array con id, codigo, nombre
            }
            return null;
        }

        public function tieneHorario($id){
            $sql = 'SELECT * FROM horario WHERE idGrupo = '.$id.'';
            $resultado = $this->conexion->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                return true;
            }
            else return false;
        }

        //---------------------------------------------------------------------------------------------------

        public function __destruct(){
            if ($this->conexion) {
                $this->conexion->close();
            }
        }

    }

?>