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

    public function agregarConsultorio($conNombre = null){
        $this->conexion = Conectarse();

        $sql = 'INSERT INTO consultorios(ConNombre)
                VALUES (?)';
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $conNombre);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }

    public function consultarConsultorio($conNumero = null){
        $this->conexion = Conectarse();

        $sql = "SELECT * FROM consultorios WHERE ConNumero = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $conNumero);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
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