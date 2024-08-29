<?php
require_once '../Modelo/Consultorio.php';

$gestorConsultorio = new Consultorio();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'CrearConsultorio') {
    $gestorConsultorio->agregarConsultorio(
        $_POST['ConNumero'],
        $_POST['ConNombre'],
    );

} elseif ($elegirAcciones == 'BuscarConsultorio') {
    $resultado = $gestorConsultorio->consultarConsultorio($_POST['ConNumero']);

}

    $resultado = $gestorConsultorio->consultarConsultorios();



include "../Vista/vistaConsultorio.php";
?>
