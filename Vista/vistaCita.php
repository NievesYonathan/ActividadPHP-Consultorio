<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<style>
    body {
        background-color: #09B7D6;
    }

    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h1, h3 {
        color: #343a40;
    }

    form {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .btn {
        border-radius: 5px;
    }

    table {
        margin-top: 20px;
    }

    th, td {
        vertical-align: middle !important;
        text-align: center;
    }
</style>
    <div class="container mt-5">
        <h1 class="mb-3">Citas</h1>
        <a class="btn btn-secondary" href="../index.php">Volver menú principal</a>
        <hr>
        <h3>Lista de Citas</h3>
        <form action="../Controlador/controladorCita.php" method="post">
            <button class="btn btn-primary mb-3" type="submit" name="Acciones" value="RefrescarTabla">Refrescar tabla</button>
        </form>
        <div class="table-responsive mt-3">

            <p>Buscar Citas</p>
            <form class="d-flex" action="../Controlador/controladorCita.php" method="post">
                <button class="btn btn-outline-success" style="margin-right: 6px;" type="submit" name="Acciones" value="BuscarCitaC">Citas Cumplidas</button>
                <button class="btn btn-outline-success" type="submit" name="Acciones" value="BuscarCitaCa">Citas Cancelada</button>
            </form>
            <hr>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Número Cita</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Medico</th>
                        <th>Consultorio</th>
                        <th>Estado</th>
                        <th>Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../Modelo/Paciente.php';

                    $paciente = new Paciente();
                    $namePacienteR = $paciente->consultarPacientes();

                    include_once '../Modelo/Medico.php';

                    $medico = new Medico();
                    $nameMedico = $medico->consultarMedicos();

                    include_once '../Modelo/Consultorio.php';

                    $consultorio = new Consultorio();
                    $nameConsultorio = $consultorio->consultarConsultorios();
                    
                        foreach ($_SESSION['resultadoCi'] as $fila) {
                            // Reiniciar el puntero del resultado en cada iteración
                            mysqli_data_seek($namePacienteR, 0);
                            mysqli_data_seek($nameMedico, 0);
                            mysqli_data_seek($nameConsultorio, 0);


                        echo "<tr>";
                            echo "<td>" . $fila['CitNumero'] . "</td>";
                            echo "<td>" . $fila['CitFecha'] . "</td>";
                            echo "<td>" . $fila['CitHora'] . "</td>";

                            while ($paciente = mysqli_fetch_assoc($namePacienteR)) {
                                if ($paciente['PacIdentificacion'] == $fila['CitPaciente']) {
                                    echo "<td>" . $paciente['PacNombres'] . ' ' .  $paciente['PacApellidos'] ."</td>";
                                }
                            }
                            
                            while ($medico = mysqli_fetch_assoc($nameMedico)) {
                                if ($medico['MedIdentificacion'] == $fila['CitMedico']) {
                                    echo "<td>" . $medico['MedNombres'] . ' ' .  $medico['MedApellidos'] . "</td>";
                                }
                            }

                            while ($consultorio = mysqli_fetch_assoc($nameConsultorio)) {
                                if ($consultorio['ConNumero'] == $fila['CitConsultorio']) {
                                    echo "<td>" . $consultorio['ConNombre'] . "</td>";
                                }
                            }

                            echo "<td>" . $fila['CitEstado'] . "</td>";
                            echo '<td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal' . $fila['CitNumero'] . '"><i class="fa-solid fa-pen-to-square"></i></button>
                                </td>';
                        echo "</tr>";
                        

                        //Modal para editar
                        echo '<div class="modal fade" id="updateModal' . $fila['CitNumero'] . '" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '    <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Actualizar Cita - ID: ' . $fila['CitNumero'] . '</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>';
                        echo '<div class="modal-body">';
                        echo '<form action="../Controlador/controladorCita.php" method="post">';
                        echo '    <input type="hidden" name="CitNumero" value="' . $fila['CitNumero'] . '">';
                        echo '    <div class="mb-3">
                                    <label class="form-label">Fecha</label>
                                    <input class="form-control" name="CitFecha" type="date" value="' . $fila['CitFecha'] . '">
                                </div>';
                        echo '   <div class="mb-3">
                                        <label for="CitHora" class="form-label">Hora</label>
                                        <input class="form-control" id="CitHora" name="CitHora" type="time" value="' . $fila['CitHora'] . '">
                                    </div>';

                                    
                        echo '      <div class="mb-3">
                                        <label for="CitPaciente" class="form-label">Paciente</label>';
                                        $gestorP = new Paciente();
                                        $resultadoP = $gestorP->consultarPaciente();
                                        $nombrePaciente = '';
                                        while ($filaP = mysqli_fetch_assoc($resultadoP)) {
                                            if ($filaP['PacIdentificacion'] == $fila['CitPaciente']) {
                                                $nombrePaciente = $filaP['PacNombres'] . ' ' . $filaP['PacApellidos'];
                                                break; // Una vez encontrado el paciente, salir del bucle
                                            }
                                        }
                                        ?>
                                        <input class="form-control" id="CitPaciente" name="CitPaciente" type="text" value="<?php echo $nombrePaciente; ?>" disabled>
                                        <?php
                        echo '      </div>';
                        echo '     <div class="mb-3">';
                        echo '          <label class="form-label">Médico</label>
                                        <select class="form-select" name="CitMedico">';
                                            $gestorM = new Medico();                  
                                            $resultadoM = $gestorM->consultarMedicos();
                                            while ($filaM = mysqli_fetch_assoc($resultadoM)) {
                                            ?>
                                            <option value="<?php echo $filaM['MedIdentificacion']; ?>" <?php ($filaM['MedIdentificacion'] == $fila['CitMedico'] ? 'selected' : '') ?>>
                                                <?php echo $filaM['MedNombres']; ?>
                                            </option>
                                            <?php 
                                            } 
                                            
                        echo '          </select>';
                        echo '      </div>';
                        echo '    <div class="mb-3">';
                        echo '          <label class="form-label">Consultorio</label>
                                        <select class="form-select" name="CitConsultorio">';
                                            $gestorC = new Consultorio();                  
                                            $resultadoC = $gestorC->consultarConsultorios();
                                            while ($filaC = mysqli_fetch_assoc($resultadoC)) {?>
                                            <option value="<?php echo $filaC['ConNumero']; ?>" <?php ($filaC['ConNumero'] == $fila['CitConsultorio'] ? 'selected' : '') ?>>
                                                <?php echo $filaC['ConNombre']; ?>
                                            </option>
                                            <?php 
                                            }
                        echo '           </select>';
                        echo '    </div>';
                        echo '<div class="mb-3">
                                    <label class="form-label">Estado</label>
                                    <select class="form-select" name="CitEstado">
                                        <option value="Cumplida" ' . ($fila['CitEstado'] == 'Cumplida' ? 'selected' : '') . '>Cumplida</option>                                
                                        <option value="Asignada" ' . ($fila['CitEstado'] == 'Asignada' ? 'selected' : '') . '>Asignada</option>
                                        <option value="Solicitada" ' . ($fila['CitEstado'] == 'Solicitada' ? 'selected' : '') . '>Solicitada</option>
                                        <option value="Cancelada" ' . ($fila['CitEstado'] == 'Cancelada' ? 'selected' : '') . '>Cancelada</option>
                                    </select>
                                </div>';
                        echo '           </div>';

                        echo '  <div class="modal-footer"> 
                                <button class="btn btn-warning" type="submit" name="Acciones" value="ActualizarCita">Actualizar Cita</button>
                                </div>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr>

        <div>
            <h3>Agregar Cita</h3>
            <form action="../Controlador/controladorCita.php" method="post">
                <div class="mb-3">
                    <label for="CitFecha" class="form-label">Fecha</label>
                    <input class="form-control" id="CitFecha" name="CitFecha" type="date">
                </div>
                <div class="mb-3">
                    <label for="CitHora" class="form-label">Hora</label>
                    <input class="form-control" id="CitHora" name="CitHora" type="time">
                </div>
                <div class="mb-3">
                    <label for="CitPaciente" class="form-label">Paciente</label>
                    <select class="form-select" name="CitPaciente">
                        <option value="">Seleccionar</option>
                        <?php
                        $gestorP = new Paciente();                  
                        $resultado = $gestorP->consultarPacientes();
                        while ($fila = mysqli_fetch_assoc($resultado)) {?>
                        <option value="<?php echo $fila['PacIdentificacion']; ?>">
                            <?php echo $fila['PacNombres']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Médico</label>
                    <select class="form-select" name="CitMedico">
                        <option value="">Seleccionar</option>
                        <?php
                        $gestorM = new Medico();                  
                        $resultado = $gestorM->consultarMedicos();
                        while ($fila = mysqli_fetch_assoc($resultado)) {?>
                        <option value="<?php echo $fila['MedIdentificacion']; ?>">
                            <?php echo $fila['MedNombres']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Consultorio</label>
                    <select class="form-select" name="CitConsultorio">
                        <option value="">Seleccionar</option>
                        <?php
                        $gestorC = new Consultorio();                  
                        $resultado = $gestorC->consultarConsultorios();
                        while ($fila = mysqli_fetch_assoc($resultado)) {?>
                        <option value="<?php echo $fila['ConNumero']; ?>">
                            <?php echo $fila['ConNombre']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input class="form-control" id="CitEstado" name="CitEstado" type="hidden" value="Asignada">
                </div>

                <button class="btn btn-success" type="submit" name="Acciones" value="CrearCita">CrearCita</button>
            </form>
        </div>
    </div>
    <br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
