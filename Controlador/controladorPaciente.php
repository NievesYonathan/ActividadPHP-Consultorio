<?php
require_once '../Modelo/Paciente.php';

$gestorPaciente = new Paciente();


$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Paciente') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $gestorPaciente->agregarPaciente(
            $_POST['PacIdentificacion'],
            $_POST['PacNombres'],
            $_POST['PacApellidos'],
            $_POST['PacFechaNacimiento'],
            $_POST['PacSexo']
        );
    
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
    
} if (isset($_POST['PacIdentificacion'], $_POST['PacNombres'], $_POST['PacApellidos'], $_POST['PacFechaNacimiento'], $_POST['PacSexo'], $_POST['PacEstado'])) {
    $pacIdentificacion = $_POST['PacIdentificacion'];
    $pacNombres = $_POST['PacNombres'];
    $pacApellidos = $_POST['PacApellidos'];
    $pacFechaNacimiento = $_POST['PacFechaNacimiento'];
    $pacSexo = $_POST['PacSexo'];
    $pacEstado = $_POST['PacEstado'];

    $gestorPaciente->actualizarPaciente($pacIdentificacion, $pacNombres, $pacApellidos, $pacFechaNacimiento, $pacSexo, $pacEstado);
} 
 elseif ($elegirAcciones == 'Buscar Paciente') {
    $resultado = $gestorPaciente->consultarPacientes($_POST['PacIdentificacion']);
}


$resultado = $gestorPaciente->consultarPacientes();
include "../Vista/vistaPaciente.php";

?>
 