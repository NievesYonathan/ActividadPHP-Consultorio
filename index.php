<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Información Médico -SISMED</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg, #3498db, #8e44ad);
            color: white;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .menu-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }
        .menu-title {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .menu-item {
            margin-bottom: 10px;
        }
        .menu-button {
            font-size: 16px;
            padding: 5px 15px;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-5">
        <div class="text-center mb-4">
            <h1>Sistema del Centro Médico ADSO</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card menu-container">
                    <div class="card-body text-center">
                        <h3 class="menu-title mb-4">Menú de Opciones</h3><hr>
                        <ul class="list-unstyled">
                            <li class="menu-item">
                                <a href="Controlador/controladorMedico.php" class="btn btn-primary btn-block menu-button">Médicos</a>
                            </li><hr>    
                            
                            <li class="menu-item">
                                <a href="Controlador/controladorConsultorio.php" class="btn btn-primary btn-block menu-button">Consultorios</a>
                            </li><hr>                            

                        </ul>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>