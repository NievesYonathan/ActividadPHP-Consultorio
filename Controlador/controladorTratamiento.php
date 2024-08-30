<?php
require_once '../Modelo/Tratamiento.php';

$gestorTratamiento = new Tratamiento();

// Obtener la lista de pacientes
$pacientes = $gestorTratamiento->obtenerPacientes();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Tratamiento') {
    $gestorTratamiento->agregarTratamiento(
        $_POST['TraFechaAsignado'],
        $_POST['TraDescripcion'],
        $_POST['TraFechaInicio'],
        $_POST['TraFechaFin'],
        $_POST['TraObservaciones'],
        $_POST['TraPaciente']
    );
} elseif ($elegirAcciones == 'Actualizar Tratamiento') {
    $gestorTratamiento->actualizarTratamiento(
        $_POST['TraNumero'],
        $_POST['TraFechaAsignado'],
        $_POST['TraDescripcion'],
        $_POST['TraFechaInicio'],
        $_POST['TraFechaFin'],
        $_POST['TraObservaciones'],
        $_POST['TraPaciente']
    );
} elseif ($elegirAcciones == 'Borrar Tratamiento') {
    $gestorTratamiento->borrarTratamiento($_POST['TraNumero']);
} elseif ($elegirAcciones == 'Buscar Tratamiento') {
    $resultado = $gestorTratamiento->consultarTratamiento($_POST['TraNumero']);
} else {
    $resultado = $gestorTratamiento->consultarTratamientos();
}

include "../Vista/vistaTratamiento.php";
?>
