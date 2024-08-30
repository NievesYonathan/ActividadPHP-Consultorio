<?php
require_once '../Modelo/Paciente.php';

$gestorPaciente = new Paciente();



if (isset($_POST['Acciones'])) {
    $elegirAcciones = $_POST['Acciones'];

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
        
    } elseif ($elegirAcciones == 'ActualizarPaciente' and isset($_POST['PacIdentificacion'], $_POST['PacNombres'], $_POST['PacApellidos'], $_POST['PacFechaNacimiento'], $_POST['PacSexo'], $_POST['PacEstado'])) {
        $pacIdentificacion = $_POST['PacIdentificacion'];
        $pacNombres = $_POST['PacNombres'];
        $pacApellidos = $_POST['PacApellidos'];
        $pacFechaNacimiento = $_POST['PacFechaNacimiento'];
        $pacSexo = $_POST['PacSexo'];
        $pacEstado = $_POST['PacEstado'];

        $resultadoP = $gestorPaciente->actualizarPaciente($pacIdentificacion, $pacNombres, $pacApellidos, $pacFechaNacimiento, $pacSexo, $pacEstado);
    
    } elseif ($elegirAcciones == 'BuscarPaciente') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resultadoP = $gestorPaciente->consultarPaciente($_POST['PacIdentificacion']);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

    } elseif ($elegirAcciones == 'RefrescarTabla') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resultadoP = $gestorPaciente->consultarPaciente();
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    } 
} else {
    $resultadoP = $gestorPaciente->consultarPaciente();
}




include "../Vista/vistaPaciente.php";

?>
 