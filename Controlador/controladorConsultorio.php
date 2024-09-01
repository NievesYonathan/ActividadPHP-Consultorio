<?php
require_once '../Modelo/Consultorio.php';

$gestorConsultorio = new Consultorio();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Iniciar";

if ($elegirAcciones == 'CrearConsultorio') {
    $gestorConsultorio->agregarConsultorio($_POST['ConNombre']);
    $resultadoC = $gestorConsultorio->consultarConsultorios();

} elseif ($elegirAcciones == 'BuscarConsultorio') {
    $resultadoC = $gestorConsultorio->consultarConsultorio($_POST['ConNumero']);

} elseif ($elegirAcciones == 'RefrescarTabla') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $resultadoC = $gestorConsultorio->consultarConsultorios();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
    }

} elseif ($elegirAcciones == 'Iniciar'){
    $resultadoC = $gestorConsultorio->consultarConsultorios();

}

include "../Vista/vistaConsultorio.php";
?>
