<?php

    // añado el php de conexion a bbdd
    require_once __DIR__ . '/../conexion.php';

    class Profesor{

        // creo propiedad conexion para almacenarla
        private $conexion;

        private $id;
        private $nombre;
        private $login;
        //private $dni; // tener en cuenta que para lo que vamos a hacer no es necesario el dni, revaluar

        // el constructor lleva ese nombre por defecto en las clases de php  --> __construct
        public function __construct($id = null, $nombre = null, $login = null /*, $dni = null*/){
            $this->conexion = conectar();
            $this->id = $id;
            $this->nombre = $nombre;
            $this->login = $login;
            //$this->dni = $dni;
        }

        //---------------------------------------------------------------------------------------------------

        // creo los getter & setter
        public function getConexion() {return $this->conexion;}
        public function getId() {return $this->id;}
        public function getNombre() {return $this->nombre;}
        public function getLogin() {return $this->login;}
        //public function getDni() {return $this->dni;}

        public function setConexion( $conexion): void {$this->conexion = $conexion;}
        public function setId( $id): void {$this->id = $id;}
        public function setNombre( $nombre): void {$this->nombre = $nombre;}
        public function setLogin( $login): void {$this->login = $login;}
        //public function setDni( $dni): void {$this->dni = $dni;}

        //---------------------------------------------------------------------------------------------------

        public function anadir(){

            $sql = "INSERT INTO profesores (nombre, login) 
                    VALUES ('$this->nombre', '$this->login')";
            return $this->conexion->query($sql);

        }

        public function modificar(){
            
            if (empty($this->id)) return false;

            $sql = "UPDATE profesores 
                    SET nombre = '$this->nombre', login = '$this->login' 
                    WHERE id = '$this->id'";

            return $this->conexion->query($sql);
        }
	
        public function eliminar(){
            if (empty($this->id)) return false;

            $sql = "DELETE FROM profesores WHERE id = '$this->id'";

            return $this->conexion->query($sql);
        }

        //---------------------------------------------------------------------------------------------------


        public function todas(){
            $sql = "SELECT * FROM profesores";
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

            $sql = "SELECT * FROM profesores WHERE id = '$id'";
            $resultado = $this->conexion->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                return $resultado->fetch_assoc(); // array con id, codigo, nombre
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