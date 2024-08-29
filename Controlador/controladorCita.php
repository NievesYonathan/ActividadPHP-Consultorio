<?php
require_once '../Modelo/Cita.php';

$gestorCita = new Cita();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'CrearCita') {
    $gestorCita->agregarCita(
        $_POST['CitNumero'],
        $_POST['CitFecha'],
        $_POST['CitHora'],
        $_POST['CitPaciente'],
        $_POST['CitMedico'],
        $_POST['CitConsultorio'],
        $_POST['CitEstado']
    );

} elseif ($elegirAcciones == 'ActualizarCita') {
    $CitNumero = $_POST['CitNumero'];
    $CitFecha = $_POST['CitFecha'];
    $CitHora = $_POST['CitHora'];
    $CitPaciente = $_POST['CitPaciente'];
    $CitMedico = $_POST['CitMedico'];
    $CitConsultorio = $_POST['CitConsultorio'];
    $MedEstado = $_POST['CitEstado'];

    $gestorCita->modificarCita($CitNumero, $CitFecha, $CitHora, $CitPaciente, $CitMedico, $CitConsultorio, $MedEstado);

} elseif ($elegirAcciones == 'CancelarCita') {
    $gestorCita->cancelarCita($_POST['CitNumero']);

} elseif ($elegirAcciones == 'BuscarCitaS') {
    $resultado = $gestorCita->listaCitasSolicitadas();

} elseif ($elegirAcciones == 'BuscarCitaC') {
    $resultado = $gestorCita->listaCitasCumplidas();

} else {
    $resultado = $gestorCita->listaCitasAsignadas();

}

include "../Modelo/Medico.php";
include "../Modelo/Consultorio.php";
include "../Vista/vistaCita.php";
?>
