<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médico</title>
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
        <h1 class="mb-3">Médicos</h1>
        <a class="btn btn-secondary" href="../index.php">Volver menú principal</a>
        <hr>
        <h3>Lista de Médicos</h3>
        <form action="../Controlador/controladorPaciente.php" method="post">
            <button class="btn btn-primary mb-3" type="submit" name="Acciones" value="Refrescar tabla">Refrescar tabla</button>
        </form>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Identificación Médico</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>FechaNacimiento</th>
                        <th>Estado</th>
                        <th>Actualizar</th>
                        <th>Cambio Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = mysqli_fetch_assoc($resultado)) {

                        //Solicita todos los datos en caso de cometer error al registrarlo, poder modificarlo.
                        //Permite cambiar el estado en caso de querer  volver activar Paciente.

                        echo "<tr>";
                        echo "<td>" . $fila['PacIdentificacion'] . "</td>";
                        echo "<td>" . $fila['PacNombres'] . "</td>";
                        echo "<td>" . $fila['PacApellidos'] . "</td>";
                        echo "<td>" . $fila['PacFechaNacimiento'] . "</td>";
                        echo "<td>" . $fila['PacEstado'] . "</td>";
                        echo '<td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal' . $fila['PacIdentificacion'] . '">Editar</button>
                              </td>';
                        echo '<td>
                                <form action="../Controlador/controladorPaciente.php" method="post">
                                    <input type="hidden" name="pacIdentificacion" value="' . $fila['PacIdentificacion'] . '">
                                    <button class="btn btn-danger" type="submit" name="Acciones" value="Borrar Paciente">Cambiar</button>
                                </form>
                              </td>';
                        echo "</tr>";
                        echo '<div class="modal fade" id="updateModal' . $fila['PacIdentificacion'] . '" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="updateModalLabel">Actualizar paciente - ID: ' . $fila['PacIdentificacion'] . '</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form action="../Controlador/controladorPaciente.php" method="post">';
                        echo '<input type="hidden" name="pacIdentificacion" value="' . $fila['PacIdentificacion'] . '">';
                        echo '<div class="mb-3">
                                <label class="form-label">Nombres</label>
                                <input class="form-control" name="pacNombres" type="text" value="' . $fila['PacNombres'] . '">
                              </div>';
                        echo '<div class="mb-3">
                                <label class="form-label">Apellidos</label>
                                <input class="form-control" name="pacApellidos" type="text" value="' . $fila['PacApellidos'] . '">
                              </div>';

                              echo '<div class="mb-3">
                              <label class="form-label">FechaNacimiento</label>
                              <input class="form-control" name="pacFechaNacimiento" type="text" value="' . $fila['PacFechaNacimiento'] . '">
                            </div>';

                          


                        echo '<div class="mb-3">
                              <label class="form-label">Estado</label>
                              <select class="form-select" name="pacEstado">
                                  <option value="Activo">Activo</option>
                                  <option value="Inactivo">Inactivo</option>
                              </select>
                            </div>';
                        echo '<button class="btn btn-warning" type="submit" name="Acciones" value="Actualizar paciente">Actualizar paciente</button>';
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
        <div>
            <h3>Agregar</h3>
            <form action="../Controlador/controladorPaciente.php" method="post">
                <div class="mb-3">
                    <label for="PacIdentificacion" class="form-label">Identificación paciente</label>
                    <input class="form-control" id="PacIdentificacion" name="PacIdentificacion" type="text">
                </div>
                <div class="mb-3">
                    <label for="PacNombres" class="form-label">Nombres</label>
                    <input class="form-control" id="PacNombres" name="PacNombres" type="text">
                </div>
                <div class="mb-3">
                    <label for="PacApellidos" class="form-label">Apellidos</label>
                    <input class="form-control" id="PacApellidos" name="PacApellidos" type="text">
                </div>
                <button class="btn btn-success" type="submit" name="Acciones" value="Crear Paciente">Crear paciente</button>
            </form>
        </div>
    </div>
    <br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
