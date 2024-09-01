<?php
include 'Conexion.php';

class Tratamiento
{
    private $TraNumero;
    private $TraFechaAsignado;
    private $TraDescripcion;
    private $TraFechaInicio;
    private $TraFechaFin;
    private $TraObservaciones;
    private $TraPaciente;
    private $Conexion;

    public function __construct($TraNumero = null, $TraFechaAsignado = null, $TraDescripcion = null, $TraFechaInicio = null, $TraFechaFin = null, $TraObservaciones = null, $TraPaciente = null)
    {
        $this->TraNumero = $TraNumero;
        $this->TraFechaAsignado = $TraFechaAsignado;
        $this->TraDescripcion = $TraDescripcion;
        $this->TraFechaInicio = $TraFechaInicio;
        $this->TraFechaFin = $TraFechaFin;
        $this->TraObservaciones = $TraObservaciones;
        $this->TraPaciente = $TraPaciente;
        $this->Conexion = Conectarse();
    }

    public function agregarTratamiento($TraFechaAsignado, $TraDescripcion, $TraFechaInicio, $TraFechaFin, $TraObservaciones, $TraPaciente)
    {
        $sql = "INSERT INTO tratamientos (TraFechaAsignado, TraDescripcion, TraFechaInicio, TraFechaFin, TraObservaciones, TraPaciente)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssssss", $TraFechaAsignado, $TraDescripcion, $TraFechaInicio, $TraFechaFin, $TraObservaciones, $TraPaciente);
        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }

    public function consultarTratamiento($TraNumero)
    {
        $sql = "SELECT * FROM tratamientos WHERE TraNumero = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $TraNumero);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->Conexion->close();
        return $resultado;
    }

    public function consultarTratamientos()
    {
        $sql = "SELECT * FROM tratamientos";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function borrarTratamiento($TraNumero)
    {
        $sql = "DELETE FROM tratamientos WHERE TraNumero = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $TraNumero);
        $resultado = $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
        return $resultado;
    }

    public function actualizarTratamiento($TraNumero, $TraFechaAsignado, $TraDescripcion, $TraFechaInicio, $TraFechaFin, $TraObservaciones, $TraPaciente)
    {
        $sql = "UPDATE tratamientos SET TraFechaAsignado = ?, TraDescripcion = ?, TraFechaInicio = ?, TraFechaFin = ?, TraObservaciones = ?, TraPaciente = ? WHERE TraNumero = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssssssi", $TraFechaAsignado, $TraDescripcion, $TraFechaInicio, $TraFechaFin, $TraObservaciones, $TraPaciente, $TraNumero);
        $resultado = $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
        return $resultado;
    }

    public function obtenerPacientes()
    {
        $sql = "SELECT PacIdentificacion, CONCAT(PacNombres, ' ', PacApellidos) AS PacNombreCompleto FROM pacientes WHERE PacEstado = 'Activo'";
        $resultado = $this->Conexion->query($sql);
        if ($resultado === false) {
            die("Error en la consulta: " . $this->Conexion->error);
            $stmt->close();
            $this->Conexion->close();
        }
        
        return $resultado;
    }
}
?>

