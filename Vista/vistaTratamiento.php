<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tratamientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        <h1 class="mb-3">Tratamientos</h1>
        <a class="btn btn-secondary" href="../index.php">Volver menú principal</a>
        <hr>
        <h3>Lista de Tratamientos</h3>
        <form action="../Controlador/controladorTratamiento.php" method="post">
            <button class="btn btn-primary mb-3" type="submit" name="Acciones" value="Refrescar tabla">Refrescar tabla</button>
        </form>
        <div class="table-responsive mt-3">
            <p>Buscar Tratamiento</p>
            <form class="d-flex" action="../Controlador/controladorTratamiento.php" method="post">
                <input class="form-control me-2" type="number" name="TraNumero" placeholder="Número del Tratamiento" aria-label="Search">
                <button class="btn btn-outline-success" type="submit" name="Acciones" value="BuscarTratamiento">Buscar</button>
            </form>
            <hr>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Número Tratamiento</th>
                        <th>Fecha Asignado</th>
                        <th>Descripción</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Observaciones</th>
                        <th>Paciente</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (isset($resultado) && $resultado->num_rows > 0) {
                        include_once '../Modelo/Paciente.php';

                        $paciente = new Paciente();
                        $namePacienteR = $paciente->consultarPacientes();
    
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($fila['TraNumero']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['TraFechaAsignado']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['TraDescripcion']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['TraFechaInicio']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['TraFechaFin']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['TraObservaciones']) . "</td>";
 
                            mysqli_data_seek($namePacienteR, 0); 
                            while ($paciente = mysqli_fetch_assoc($namePacienteR)) {
                                if ($paciente['PacIdentificacion'] == $fila['TraPaciente']) {
                                    echo "<td>" . $paciente['PacNombres'] . ' ' .  $paciente['PacApellidos'] ."</td>";
                                }
                            }
                            
                            echo '<td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal' . htmlspecialchars($fila['TraNumero']) . '">Editar</button>
                                  </td>';
                            echo '<td>
                                    <form action="../Controlador/controladorTratamiento.php" method="post">
                                        <input type="hidden" name="TraNumero" value="' . htmlspecialchars($fila['TraNumero']) . '">
                                        <button class="btn btn-danger" type="submit" name="Acciones" value="BorrarTratamiento">Eliminar</button>
                                    </form>
                                  </td>';
                            echo "</tr>";

                            // Modal para actualizar tratamiento
                            echo '<div class="modal fade" id="updateModal' . htmlspecialchars($fila['TraNumero']) . '" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">';
                            echo '<div class="modal-dialog">';
                            echo '<div class="modal-content">';
                            echo '<div class="modal-header">';
                            echo '<h5 class="modal-title" id="updateModalLabel">Actualizar Tratamiento - ID: ' . htmlspecialchars($fila['TraNumero']) . '</h5>';
                            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                            echo '</div>';
                            echo '<div class="modal-body">';
                            echo '<form action="../Controlador/controladorTratamiento.php" method="post">';
                            echo '<input type="hidden" name="TraNumero" value="' . htmlspecialchars($fila['TraNumero']) . '">';
                            echo '<div class="mb-3">
                                    <label class="form-label">Fecha Asignado</label>
                                    <input class="form-control" name="TraFechaAsignado" type="date" value="' . htmlspecialchars($fila['TraFechaAsignado']) . '">
                                  </div>';
                            echo '<div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control" name="TraDescripcion">' . htmlspecialchars($fila['TraDescripcion']) . '</textarea>
                                  </div>';
                            echo '<div class="mb-3">
                                    <label class="form-label">Fecha Inicio</label>
                                    <input class="form-control" name="TraFechaInicio" type="date" value="' . htmlspecialchars($fila['TraFechaInicio']) . '">
                                  </div>';
                            echo '<div class="mb-3">
                                    <label class="form-label">Fecha Fin</label>
                                    <input class="form-control" name="TraFechaFin" type="date" value="' . htmlspecialchars($fila['TraFechaFin']) . '">
                                  </div>';
                            echo '<div class="mb-3">
                                    <label class="form-label">Observaciones</label>
                                    <textarea class="form-control" name="TraObservaciones">' . htmlspecialchars($fila['TraObservaciones']) . '</textarea>
                                  </div>';
                            echo '<div class="mb-3">
                                    <label class="form-label">Paciente</label>
                                    <input class="form-control" name="TraPaciente" type="text" value="' . htmlspecialchars($fila['TraPaciente']) . '">
                                  </div>';
                            echo '<button class="btn btn-warning" type="submit" name="Acciones" value="ActualizarTratamiento">Actualizar Tratamiento</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<tr><td colspan="9">No hay tratamientos disponibles</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#addModal">Agregar Tratamiento</button>
        
        <!-- Modal para agregar tratamiento -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Agregar Tratamiento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../Controlador/controladorTratamiento.php" method="post">
                            <div class="mb-3">
                                <label for="TraFechaAsignado" class="form-label">Fecha Asignado</label>
                                <input class="form-control" id="TraFechaAsignado" name="TraFechaAsignado" type="date">
                            </div>
                            <div class="mb-3">
                                <label for="TraDescripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="TraDescripcion" name="TraDescripcion"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="TraFechaInicio" class="form-label">Fecha Inicio</label>
                                <input class="form-control" id="TraFechaInicio" name="TraFechaInicio" type="date">
                            </div>
                            <div class="mb-3">
                                <label for="TraFechaFin" class="form-label">Fecha Fin</label>
                                <input class="form-control" id="TraFechaFin" name="TraFechaFin" type="date">
                            </div>
                            <div class="mb-3">
                                <label for="TraObservaciones" class="form-label">Observaciones</label>
                                <textarea class="form-control" id="TraObservaciones" name="TraObservaciones"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="TraPaciente" class="form-label">Paciente</label>
                                <select class="form-control" id="TraPaciente" name="TraPaciente">
                                    <option value="">Seleccionar Paciente</option>
                                    <?php
                                    // Resetear el puntero de resultados para el dropdown de pacientes
                                    while ($paciente = mysqli_fetch_assoc($pacientes)) { ?>
                                        <option value="<?php echo htmlspecialchars($paciente['PacIdentificacion']); ?>">
                                            <?php echo htmlspecialchars($paciente['PacNombreCompleto']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button class="btn btn-success" type="submit" name="Acciones" value="CrearTratamiento">Crear Tratamiento</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
