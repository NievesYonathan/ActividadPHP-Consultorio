<?php
require_once '../Modelo/Cita.php';

$gestorCita = new Cita();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'CrearCita') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $gestorCita->agregarCita(
        $_POST['CitNumero'],
        $_POST['CitFecha'],
        $_POST['CitHora'],
        $_POST['CitPaciente'],
        $_POST['CitMedico'],
        $_POST['CitConsultorio'],
        $_POST['CitEstado']
    );
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
    }

} elseif ($elegirAcciones == 'ActualizarCita') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $CitNumero = $_POST['CitNumero'];
    $CitFecha = $_POST['CitFecha'];
    $CitHora = $_POST['CitHora'];
    $CitMedico = $_POST['CitMedico'];
    $CitConsultorio = $_POST['CitConsultorio'];
    $CitEstado = $_POST['CitEstado'];

    $gestorCita->modificarCita($CitNumero, $CitFecha, $CitHora, $CitMedico, $CitConsultorio, $CitEstado);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
    }

} elseif ($elegirAcciones == 'CancelarCita') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $gestorCita->cancelarCita($_POST['CitNumero']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
    }

} elseif ($elegirAcciones == 'BuscarCitaS') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $resultado = $gestorCita->listaCitasSolicitadas();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
    }

} elseif ($elegirAcciones == 'BuscarCitaC') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $resultadoCi = $gestorCita->listaCitasCumplidas();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
} else {
    $resultado = $gestorCita->listaCitasAsignadas();
}



include "../Modelo/Medico.php";
include "../Modelo/Consultorio.php";
include "../Vista/vistaCita.php";
?>
