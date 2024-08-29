<?php
require_once 'Conexion.php';

class Consultorio {
    private $conNumero;
    private $conNombre;
    private $conexion;

    public function __construct($conNumero = null, $conNombre = null)
    {
        $this->conNumero = $conNumero;
        $this->conNombre = $conNombre;
    }

    public function agregarConsultorio($conNumero = null, $conNombre = null){
        $this->conexion = Conectarse();

        $sql = 'INSERT INTO consultorios(ConNumero, ConNombre)
                VALUES (?,?)';
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("is", $conNumero, $conNombre);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }

    public function consultarConsultorio($conNumero = null){
        $this->conexion = Conectarse();

        $sql = "SELECT * FROM consultorios WHERE ConNumero = $conNumero";
        $res = $this->conexion->query($sql);
        $this->conexion->close();

        return $res;
    }

    public function consultarConsultorios(){
        $this->conexion = Conectarse();

        $sql = "SELECT * FROM consultorios";
        $res = $this->conexion->query($sql);
        $this->conexion->close();

        return $res;
    }
}