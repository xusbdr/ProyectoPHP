
<?php


include("BaseDatos.php");


// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirigir a la página de inicio de sesión si el usuario no está autenticado
    exit();
}

// Array para asociar el ID de página con su nombre
$paginas = array(
    1 => "añadirUsuario.php",
    2 => "bienvenida.php",
    3 => "modificarUsuario.php",
    4 => "cerrarConexion.php"
);

// Obtener el ID de la página actual
$idPagina = array_search(basename($_SERVER['PHP_SELF']), $paginas);

// Obtener la hora actual
$horaVisita = date("H:i:s");

// Obtener la fecha actual
$fechaActual = date("Y-m-d");

// Insertar la visita en la base de datos
$idUsuario = $_SESSION['username'];
$sql = "INSERT INTO visita (idUsuario, idPagina, horaVisita, fechaActual) VALUES ('$idUsuario', '$idPagina', '$horaVisita', '$fechaActual')";
if ($conn->query($sql) === TRUE) {
    echo "Visita registrada correctamente";
} else {
    echo "Error al registrar la visita: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>






