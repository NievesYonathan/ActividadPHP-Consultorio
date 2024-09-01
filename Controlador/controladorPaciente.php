<?php
session_start();
require_once '../Modelo/Paciente.php';

$gestorPaciente = new Paciente();


$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Iniciar";

    if ($elegirAcciones == 'CrearPaciente') {
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
        
    } elseif ($elegirAcciones == 'ActualizarPaciente' ) {
        $pacIdentificacion = $_POST['PacIdentificacion'];
        $pacNombres = $_POST['PacNombres'];
        $pacApellidos = $_POST['PacApellidos'];
        $pacFechaNacimiento = $_POST['PacFechaNacimiento'];
        $pacSexo = $_POST['PacSexo'];
        $pacEstado = $_POST['PacEstado'];

        $gestorPaciente->actualizarPaciente($pacNombres, $pacApellidos, $pacFechaNacimiento, $pacSexo, $pacEstado, $pacIdentificacion);
        
        $resultadoP = $gestorPaciente->consultarPacientes();
        $_SESSION['resultadoP'] = [];
        while ($fila = mysqli_fetch_assoc($resultadoP)){
            $_SESSION['resultadoP'][] = $fila;
        }
        header('Location: ../Vista/vistaPaciente.php');
        exit;

    } elseif ($elegirAcciones == 'BuscarPaciente') {
            $resultadoP = $gestorPaciente->consultarPaciente($_POST['PacIdentificacion']);
            $_SESSION['resultadoP'] = [];
            while ($fila = mysqli_fetch_assoc($resultadoP)){
                $_SESSION['resultadoP'][] = $fila;
            }
            header('Location: ../Vista/vistaPaciente.php');
            exit;

    }elseif ($elegirAcciones == 'BorrarPaciente') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resultadoP = $gestorPaciente->borrarPaciente($_POST['PacIdentificacion']);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

    } elseif ($elegirAcciones == 'Inactivo') {
        $resultadoP = $gestorPaciente->consultarPacientesInactivos();
        $_SESSION['resultadoP'] = [];
        while ($fila = mysqli_fetch_assoc($resultadoP)){
            $_SESSION['resultadoP'][] = $fila;
        }
        header('Location: ../Vista/vistaPaciente.php');
        exit;   
    
    } elseif ($elegirAcciones == 'RefrescarTabla') {
        $resultadoP = $gestorPaciente->consultarPacientes();
        $_SESSION['resultadoP'] = [];
        while ($fila = mysqli_fetch_assoc($resultadoP)){
            $_SESSION['resultadoP'][] = $fila;
        }
        header('Location: ../Vista/vistaPaciente.php');
        exit;

    } elseif ($elegirAcciones == 'Iniciar') {
        $resultadoP = $gestorPaciente->consultarPacientes();
        $_SESSION['resultadoP'] = [];
        while ($fila = mysqli_fetch_assoc($resultadoP)){
            $_SESSION['resultadoP'][] = $fila;
        }
        header('Location: ../Vista/vistaPaciente.php');
        exit;   
    }

?>
 