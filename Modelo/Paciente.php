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
        $this->pacSexo = $pacSexo;
        $this->pacEstado = $pacEstado;
        $this->Conexion = Conectarse();
    }
    public function agregarPaciente($pacIdentificacion = null, $pacNombre = null, $pacApellido = null, $pacSexo = null, $pacEstado = null)
    {
        $this->Conexion = Conectarse();

        $sql = "INSERT INTO pacientes (PacNombre, PacApellido, PacSexo, PacEstado)
                VALUES (?, ?, ?,?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssss", $pacIdentificacion, $pacNombre, $pacApellido, $pacSexo, $pacEstado);
        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }

    public function consultarPacientes($pacIdentificacion = null)
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


    // public function consultarPacientes($pacIdentificacion)
    // {
    //     $this->Conexion = Conectarse();

    //     $sql = "select * from pacientes where PacIdentificacion ='$pacIdentificacion'";
    //     $resultado = $this->Conexion->query($sql);
    //     $this->Conexion->close();
    //     return $resultado;
    // }

    public function actualizarPaciente($pacIdentificacion, $pacNombres, $pacApellidos, $pacFechaNacimiento, $pacSexo, $pacEstado)
    {
        $this->Conexion = Conectarse();

        $sql = "UPDATE pacientes SET PacIdentificacion=?, PacNombres=?, PacApellidos=?, PacFechaNacimiento=?,PacEstado=? WHERE PacIdentificacion=?";

        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssss", $pacNombres, $pacApellidos, $pacFechaNacimiento, $pacEstado);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->Conexion->close();

        return $resultado;
    }
}
