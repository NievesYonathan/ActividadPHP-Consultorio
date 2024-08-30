<?php
require_once 'Conexion.php';

class Paciente
{
    private $pacIdentificacion;
    private $pacNombre;
    private $pacApellido;
    private $pacFechaNacimiento;
    private $pacSexo;
    private $pacEstado;
    private $Conexion;

    public function __construct($pacIdentificacion = null, $pacNombre = null, $pacApellido = null, $pacFechaNacimiento = null, $pacSexo = null, $pacEstado = null)
    {
        $this->pacIdentificacion = $pacIdentificacion;
        $this->pacNombre = $pacNombre;
        $this->pacApellido = $pacApellido;
        $this->pacFechaNacimiento = $pacFechaNacimiento;
        $this->pacSexo = $pacSexo;
        $this->pacEstado = $pacEstado;
        $this->Conexion = Conectarse();
    }
    public function agregarPaciente($pacIdentificacion = null, $pacNombre = null, $pacApellido = null, $pacFechaNacimiento = null, $pacSexo = null)
    {
        $this->Conexion = Conectarse();

        $pacEstado = "Activo";

        $sql = "INSERT INTO pacientes (PacIdentificacion, PacNombres, PacApellidos, PacFechaNacimiento, PacSexo, PacEstado)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssssss", $pacIdentificacion, $pacNombre, $pacApellido, $pacFechaNacimiento, $pacSexo, $pacEstado);
        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }

    public function consultarPaciente($pacIdentificacion = null)
    {
        $this->Conexion = Conectarse();

        if ($pacIdentificacion) {
            $sql = "SELECT * FROM pacientes WHERE PacIdentificacion = ?";
            $stmt = $this->Conexion->prepare($sql);
            $stmt->bind_param("s", $pacIdentificacion);
        } else {
            $sql = "SELECT * FROM pacientes";
            $stmt = $this->Conexion->prepare($sql);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();
        $this->Conexion->close();

        return $resultado;
    }


    public function consultarPacientes()
    {
        $this->Conexion = Conectarse();

        $sql = "select * from pacientes";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function actualizarPaciente($pacIdentificacion, $pacNombres, $pacApellidos, $pacFechaNacimiento, $pacSexo, $pacEstado)
    {
        $this->Conexion = Conectarse();

        $sql = "UPDATE pacientes SET PacNombres=?, PacApellidos=?, PacFechaNacimiento=?, PacSexo=?, PacEstado=? WHERE PacIdentificacion=?";

        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssssss", $pacNombres, $pacApellidos, $pacFechaNacimiento, $pacSexo, $pacEstado, $pacIdentificacion);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->Conexion->close();

        return $resultado;
    }
}
