<?php
include 'Conexion.php';
class Medico
{
    private $MedIdentificacion;
    private $MedNombres;
    private $MedApellidos;
    private $MedEstado;
    private $Conexion;

    public function __construct($MedIdentificacion = null, $MedNombres = null, $MedApellidos = null, $MedEstado = null)
    {
        $this->MedIdentificacion = $MedIdentificacion;
        $this->MedNombres = $MedNombres;
        $this->MedApellidos = $MedApellidos;
        $this->MedEstado = $MedEstado;
        $this->Conexion = Conectarse();
    }
    public function agregarMedico($MedIdentificacion = null, $MedNombres = null, $MedApellidos = null)
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

 		$sql="select * from medicos where MedIdentificacion ='$MedIdentificacion'";
 		$resultado=$this->Conexion->query($sql);
 		$this->Conexion->close();
 		return $resultado;	
 	}
    public function consultarMedicos()
 	{
        $this->Conexion = Conectarse();

 		$sql="select * from medicos";
 		$resultado=$this->Conexion->query($sql);
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