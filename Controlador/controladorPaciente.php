<?php
require_once '../Modelo/Paciente.php';

$gestorPaciente = new Paciente();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Paciente') {
    $gestorPaciente->agregarPaciente(
        $_POST['PacIdentificacion'],
        $_POST['PacNombres'],
        $_POST['PacApellidos'],
        // $_POST['PacFechaNacimiento'],
        // $_POST['PacEstado']
    );
} elseif ($elegirAcciones == 'Actualizar paciente') {
    $pacIdentificacion = $_POST['PacIdentificacion'];
    $pacNombres = $_POST['PacNombres'];
    $pacApellidos = $_POST['PacApellidos'];
    $pacFechaNacimiento = $_POST['PacFechaNacimiento'];
    $pacSexo = $_POST['PacSexo'];  // Capturar el valor de pacSexo
    $pacEstado = $_POST['PacEstado'];

    $gestorPaciente->actualizarPaciente($pacIdentificacion, $pacNombres, $pacApellidos, $pacFechaNacimiento, $pacSexo, $pacEstado);
} elseif ($elegirAcciones == 'Buscar Paciente') {
    $resultado = $gestorPaciente->consultarPacientes($_POST['PacIdentificacion']);
}


$resultado = $gestorPaciente->consultarPacientes();
include "../Vista/vistaPaciente.php";
?>
 