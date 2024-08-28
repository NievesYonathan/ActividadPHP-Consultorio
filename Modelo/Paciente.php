<?php
include 'Conexion.php';
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
        $this->pacIdentificacion = $pacIdentificacion;
        $this->pacSexo = $pacSexo;
        $this->pacEstado = $pacEstado;
        $this->Conexion = Conectarse();
    }
    public function agregarPaciente($MedIdentificacion = null, $MedNombres = null, $MedApellidos = null)
    {
        $this->Conexion = Conectarse();

        $sql = "INSERT INTO Medicos(MedIdentificacion, MedNombres, MedApellidos)
                VALUES (?, ?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("sss", $MedIdentificacion, $MedNombres, $MedApellidos);
        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }
    public function consultarMedico($MedIdentificacion)
    {
        $this->Conexion = Conectarse();

        $sql = "select * from medicos where MedIdentificacion ='$MedIdentificacion'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }
    public function consultarMedicos()
    {
        $this->Conexion = Conectarse();

        $sql = "select * from medicos";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }
    public function borrarMedico($MedIdentificacion, $MedNombres, $MedApellidos, $MedEstado)
    {
        $this->Conexion = Conectarse();

        $sql = "UPDATE medicos SET MedEstado = 'Inactivo' WHERE MedIdentificacion=?";

        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("s", $MedIdentificacion);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->Conexion->close();

        return $resultado;
    }
    public function actualizarMedico($MedIdentificacion, $MedNombres, $MedApellidos, $MedEstado)
    {
        $this->Conexion = Conectarse();

        $sql = "UPDATE medicos SET MedNombres=?, MedApellidos=?, MedEstado=? WHERE MedIdentificacion=?";

        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssss", $MedNombres, $MedApellidos, $MedEstado, $MedIdentificacion);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->Conexion->close();

        return $resultado;
    }
}