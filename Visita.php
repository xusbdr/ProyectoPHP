<?php
// Incluir archivo de conexión a la base de datos
include("BaseDatos.php");

// Consulta para obtener la lista de usuarios
$resultado = $conexion->query("SELECT * FROM `visitas`");
$lista_visitas = $resultado->fetch_all(MYSQLI_ASSOC);

// Verificar si el usuario está autenticado
session_start();
if (!isset($_SESSION['username'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header("Location: index.php");
    exit();
}
?>

<?php include("templatesss/header.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Visitas</title>
</head>
<body>
    <h1>Registro de Visitas por Usuario</h1>

    <div class="container">
        <br/>
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%;">Usuario</th>
                                <th scope="col" style="width: 20%;">Página Visitada</th>
                                <th scope="col" style="width: 20%;">Fecha Visita</th>
                                <th scope="col" style="width: 20%;">Hora Visita</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_visitas as $registro) : ?>
                                <tr>
                                    <td><?php echo $registro['idUsuario']; ?></td>
                                    <td><?php echo $registro['idPagina']; ?></td>
                                    <td><?php echo $registro['fechaVisita']; ?></td>
                                    <td><?php echo $registro['horaVisita']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
