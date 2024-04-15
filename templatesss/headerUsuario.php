<?php
// Start the session
session_start();

// Base URL
$url_base = "http://localhost/ProyectoJesus/";

// Verificar si se ha iniciado sesión y obtener el nombre de usuario y la foto del usuario desde la sesión
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = '';
}

if(isset($_SESSION['foto'])) {
    $foto = $_SESSION['foto'];
} else {
    $foto = '';
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <style>
    .welcome-container {
        font-family:fantasy;
    }
    </style>

</head>

<body>
    <header>
   
    </header>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>index">Principal</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo isset($usuario['username']) ? $usuario['username'] : ''; ?>modificarUsuario">Modificar</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>contacto">Contacto</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>cerrarConexion">Cerrar Sesión</a>
            </li>

            &nbsp;
          
            <div class="welcome-container">
                <?php if(!empty($username)): ?>
                    <li class="nav-item">
                        <span class="nav-link disabled">Bienvenido <?php echo $username; ?></span>
                    </li>
                <?php endif; ?>
            </div>


            <!-- Mostrar la foto del usuario -->
            <div class="welcome-container">
                <?php if(!empty($foto)): ?>
                    <img src="<?php echo $foto; ?>" alt="Foto de perfil" class="rounded-circle" style="width: 40px; height: 40px;">
                <?php endif; ?>
            </div>

        </ul>
    </nav>

    <main class="container">
        <!-- Your main content here -->
    </main>
</body>
</html>
