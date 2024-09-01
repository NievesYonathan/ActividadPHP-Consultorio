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

        if ($this->Conexion->connect_error) {
            die("Conexión fallida: " . $this->Conexion->connect_error);
        }

        $sql = "SELECT * FROM pacientes WHERE PacIdentificacion = ?";
        $stmt = $this->Conexion->prepare($sql);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->Conexion->error);
        }
        $stmt->bind_param("s", $pacIdentificacion);

        $stmt->execute();
        $resultado = $stmt->get_result();

        if (!$resultado) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }

        $stmt->close();
        $this->Conexion->close();

        return $resultado;
    }

    public function consultarPacientes()
    {
        $this->Conexion = Conectarse();

        $pacEstado = "Activo";
        $sql = "SELECT * from pacientes WHERE pacEstado=?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param('s', $pacEstado);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->Conexion->close();
        return $resultado;
    }
    
    public function consultarPacientesInactivos()
    {
        $this->Conexion = Conectarse();

        $pacEstado = "Inactivo";
        $sql = "SELECT * from pacientes WHERE pacEstado=?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param('s', $pacEstado);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->Conexion->close();
        return $resultado;
    }

    public function actualizarPaciente($pacNombres, $pacApellidos, $pacFechaNacimiento, $pacSexo, $pacEstado, $pacIdentificacion)
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

    public function borrarPaciente($pacIdentificacion)
    {
        $this->Conexion = Conectarse();

        $pacEstado = "Inactivo";

        $sql = "UPDATE pacientes SET PacEstado=? WHERE PacIdentificacion=?";

        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ss", $pacEstado, $pacIdentificacion);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->Conexion->close();

        return $resultado;
    }

}
