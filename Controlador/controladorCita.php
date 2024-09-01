<?php
session_start();
require_once '../Modelo/Cita.php';

$gestorCita = new Cita();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Iniciar";

if ($elegirAcciones == 'CrearCita') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $gestorCita->agregarCita(
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

} elseif ($elegirAcciones == 'BuscarCitaCa') {
    $resultadoCi = $gestorCita->listaCitasCanceladas();

    $_SESSION['resultadoCi'] = [];
    while ($fila = mysqli_fetch_assoc($resultadoCi)){
        $_SESSION['resultadoCi'][] = $fila;
    }
    header('Location: ../Vista/vistaCita.php');
    exit;
    
} elseif ($elegirAcciones == 'BuscarCitaC') {
    $resultadoCi = $gestorCita->listaCitasCumplidas();

    $_SESSION['resultadoCi'] = [];
    while ($fila = mysqli_fetch_assoc($resultadoCi)){
        $_SESSION['resultadoCi'][] = $fila;
    }
    header('Location: ../Vista/vistaCita.php');
    exit;

} elseif ($elegirAcciones == 'RefrescarTabla') {
    $resultadoCi = $gestorCita->listaCitasAsignadas();
    $_SESSION['resultadoCi'] = [];
    while ($fila = mysqli_fetch_assoc($resultadoCi)){
        $_SESSION['resultadoCi'][] = $fila;
    }
    header('Location: ../Vista/vistaCita.php');
    exit;

} elseif ($elegirAcciones == 'Iniciar') {
    $resultadoCi = $gestorCita->listaCitasAsignadas();
    $_SESSION['resultadoCi'] = [];
    while ($fila = mysqli_fetch_assoc($resultadoCi)){
        $_SESSION['resultadoCi'][] = $fila;
    }
    header('Location: ../Vista/vistaCita.php');
    exit;

}


?>
