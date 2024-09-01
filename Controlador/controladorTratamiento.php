<?php
require_once '../Modelo/Tratamiento.php';

$gestorTratamiento = new Tratamiento();

// Obtener la lista de pacientes
$pacientes = $gestorTratamiento->obtenerPacientes();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'CrearTratamiento') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $gestorTratamiento->agregarTratamiento(
            $_POST['TraFechaAsignado'],
            $_POST['TraDescripcion'],
            $_POST['TraFechaInicio'],
            $_POST['TraFechaFin'],
            $_POST['TraObservaciones'],
            $_POST['TraPaciente']
        );
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
    }

} elseif ($elegirAcciones == 'ActualizarTratamiento') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $gestorTratamiento->actualizarTratamiento(
            $_POST['TraNumero'],
            $_POST['TraFechaAsignado'],
            $_POST['TraDescripcion'],
            $_POST['TraFechaInicio'],
            $_POST['TraFechaFin'],
            $_POST['TraObservaciones'],
            $_POST['TraPaciente']
        );
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
    }

} elseif ($elegirAcciones == 'BorrarTratamiento') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $gestorTratamiento->borrarTratamiento($_POST['TraNumero']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
    }
    
} elseif ($elegirAcciones == 'BuscarTratamiento') {
    $resultado = $gestorTratamiento->consultarTratamiento($_POST['TraNumero']);

} else {
    $resultado = $gestorTratamiento->consultarTratamientos();
}

include "../Vista/vistaTratamiento.php";
?>
