<?php

require_once 'Conexion.php';

class Cita{
    private $citNumero;
    private $citFecha;
    private $citHora;
    private $citPaciente;
    private $citMedico;
    private $citConsultorio;
    private $citEstado;
    private $conexion;

    public function __construct($citNumero = null, $citFecha = null, $citHora = null, $citPaciente = null, $citMedico = null, $citConsultorio = null, $citEstado = null)
    {
        $this->citNumero = $citNumero;
        $this->citFecha = $citFecha;
        $this->citHora = $citHora;
        $this->citPaciente = $citPaciente;
        $this->citMedico = $citMedico;
        $this->citConsultorio = $citConsultorio;
        $this->citEstado = $citEstado;
    }

    public function agregarCita($citNumero = null, $citFecha = null, $citHora = null, $citPaciente = null, $citMedico = null, $citConsultorio = null, $citEstado = null){
        $this->conexion = Conectarse();

        $sql = "INSERT INTO citas(CitNumero, CitFecha, CitHora, CitPaciente, CitMedico, CitConsultorio, CitEstado)
                VALUES (?,?,?,?,?,?,?)";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("issssis", $citNumero, $citFecha, $citHora, $citPaciente, $citMedico, $citConsultorio, $citEstado);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }

    public function modificarCita($citNumero = null, $citFecha = null, $citHora = null, $citMedico = null, $citConsultorio = null, $citEstado = null){
        $this->conexion = Conectarse();

        $sql = "UPDATE citas SET CitFecha=?, CitHora=?, CitMedico=?, CitConsultorio=?, CitEstado=? WHERE CitNumero=?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssisi", $citFecha, $citHora, $citMedico, $citConsultorio, $citEstado, $citNumero);
        $resultado = $stmt->execute();
        $stmt->close();
        $this->conexion->close();

        return $resultado;
    }

    public function cancelarCita($citNumero = null){
        $this->conexion = Conectarse();

        $citEstado = "Cancelada";

        $sql = " UPDATE citas SET CitEstado=? WHERE CitNumero=?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("si", $citEstado, $citNumero);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }

    public function listaCitasAsignadas(){
        $this->conexion = Conectarse();

        $citEstado = "Asignada";

        $sql = "SELECT * FROM citas WHERE CitEstado = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $citEstado);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->conexion->close();

        return $resultado;
    }

    public function listaCitasSolicitadas(){
        $this->conexion = Conectarse();

        $citEstado = "Solicitada";

        $sql = "SELECT * FROM citas WHERE CitEstado = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $citEstado);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->conexion->close();

        return $resultado;
    }

    public function listaCitasCumplidas(){
        $this->conexion = Conectarse();

        $citEstado = "Cumplida";

        $sql = "SELECT * FROM citas WHERE CitEstado = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $citEstado);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->conexion->close();

        return $resultado;
    }
}