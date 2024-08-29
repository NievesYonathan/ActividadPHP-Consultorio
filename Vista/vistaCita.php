<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <button class="btn btn-primary mb-3" type="submit" name="Acciones" value="Refrescar tabla">Refrescar tabla</button>
        </form>
        <div class="table-responsive mt-3">

            <p>Buscar Consultorio</p>
            <form class="d-flex" action="../Controlador/controladorConsultorio.php" method="post">
                <input class="form-control me-2" type="number" name="ConNumero" placeholder="Número del Consultorio" aria-label="Search">
                <button class="btn btn-outline-success" type="submit" name="Acciones" value="BuscarConsultorio">Buscar</button>
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
                    while ($fila = mysqli_fetch_assoc($resultado)) {

                        //Solicita todos los datos en caso de cometer error al registrarlo, poder modificarlo.
                        //Permite cambiar el estado en caso de querer  volver activar Medico.

                        echo "<tr>";
                            echo "<td>" . $fila['CitNumero'] . "</td>";
                            echo "<td>" . $fila['CitFecha'] . "</td>";
                            echo "<td>" . $fila['CitHora'] . "</td>";
                            echo "<td>" . $fila['CitPaciente'] . "</td>";
                            echo "<td>" . $fila['CitMedico'] . "</td>";
                            echo "<td>" . $fila['CitConsultorio'] . "</td>";
                            echo "<td>" . $fila['CitEstado'] . "</td>";
                            echo '<td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal' . $fila['CitNumero'] . '">Editar</button>
                                </td>';
                        echo "</tr>";
                        
                        // Modal para editar
                        echo '<div class="modal fade" id="updateModal' . $fila['CitNumero'] . '" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="updateModalLabel">Actualizar Médico - ID: ' . $fila['CitNumero'] . '</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form action="../Controlador/controladorConsultorio.php" method="post">';
                        echo '<input type="hidden" name="CitNumero" value="' . $fila['CitNumero'] . '">';
                        echo '<div class="mb-3">
                                <label class="form-label">Nombres</label>
                                <input class="form-control" name="CitFecha" type="text" value="' . $fila['CitFecha'] . '">
                              </div>';
                        echo '<button class="btn btn-warning" type="submit" name="Acciones" value="Actualizar Medico">Actualizar Consultorio</button>';
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
                    <label for="CitNumero" class="form-label">Número Cita</label>
                    <input class="form-control" id="CitNumero" name="CitNumero" type="number">
                </div>
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
                    <input class="form-control" id="CitPaciente" name="CitPaciente" type="text">
                </div>
                <div class="mb-3">
                    <!-- <label for="CitMedico" class="form-label">Medico</label>
                    <input class="form-control" id="CitMedico" name="CitMedico" type="number"> -->
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
                    <!-- <label for="CitConsultorio" class="form-label">Consultorio</label>
                    <input class="form-control" id="CitConsultorio" name="CitConsultorio" type="number"> -->
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
                    <!-- <label for="CitEstado" class="form-label">Estado</label> -->
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
