<?php
require_once '../Modelo/Medico.php';


$gestorMedico = new Medico();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Medico') {
    $gestorMedico->agregarMedico(
        $_POST['MedIdentificacion'],
        $_POST['MedNombres'],
        $_POST['MedApellidos']
    );
} elseif ($elegirAcciones == 'Actualizar Medico') {
    $MedIdentificacion = $_POST['MedIdentificacion'];
    $MedNombres = $_POST['MedNombres'];
    $MedApellidos = $_POST['MedApellidos'];
    $MedEstado = $_POST['MedEstado'];

    $gestorMedico->actualizarMedico($MedIdentificacion, $MedNombres, $MedApellidos, $MedEstado);

} elseif ($elegirAcciones == 'Borrar Medico') {
    $gestorMedico->borrarMedico($_POST['MedIdentificacion'],null,null,'Inactivo');

} elseif ($elegirAcciones == 'Buscar Medico') {
    $resultado = $gestorMedico->consultarMedico($_POST['MedIdentificacion']);
}

$resultado = $gestorMedico->consultarMedicos();
include "../Vista/vistaMedico.php";
?>
