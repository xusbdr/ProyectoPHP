<?php
// Incluir archivo de conexión a la base de datos
include("BaseDatos.php");

// Consulta para obtener la lista de usuarios
$resultado = $conexion->query("SELECT * FROM `pagina`");
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


<?php
// Incluir archivo de conexión a la base de datos
include("BaseDatos.php");

// Consulta para obtener la información de todas las páginas
$query = "SELECT * FROM pagina";
$resultado = mysqli_query($conexion, $query);

// Verificar si se encontraron resultados
if ($resultado && mysqli_num_rows($resultado) > 0) {
    $paginas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
} else {
    $paginas = array(); // Si no hay resultados, inicializamos la variable como un array vacío
}
?>



<style>



h1 {
    font-family: fantasy;
    font-size: 52px;
    /* Ruta de la imagen */
    background-image: url('imagenes/leta.jpg');
    /* Tamaño de la imagen */
    background-size: cover;
    /* Propiedad que permite recortar el fondo del texto */
    -webkit-background-clip: text;
    background-clip: text;
    /* Color de relleno del texto */
    -webkit-text-fill-color: transparent;
    text-fill-color: transparent;
}






body {
    background-image: url('imagenes/contacto.jpg'); /* Ruta de la imagen */
    background-color: #ADD8E6; /* Color de fondo de respaldo */
  
    background-size: cover; /* Ajustar la imagen al tamaño del contenedor */
    background-position: center; /* Centrar la imagen */
    height: 100vh; /* Hacer que el cuerpo ocupe el 100% de la altura de la ventana */
    margin: 0; /* Eliminar el margen predeterminado */
    padding: 0; /* Eliminar el relleno predeterminado */
}


.card{
            background: rgba(255, 255, 255, 0.2); /* Fondo semitransparente */
            padding: 20px; /* Espaciado interno */
            border-radius: 15px; /* Bordes redondeados */
        }


        table {
            width: 100%; /* Ancho completo de la tabla */
            border-collapse: collapse; /* Colapsar los bordes de la tabla */
            background-color: rgba(255, 255, 255, 0.5); /* Fondo semitransparente */
        }


        th, td{
            padding: 12px; /* Espaciado interno de las celdas */
            border: 1px solid #ddd; /* Borde de 1px sólido */
            background-color: rgba(255, 255, 255, 0.5); /* Fondo semitransparente */
            
        }

        th {
            background-color: #f2f2f2; /* Color de fondo del encabezado */
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.4); /* Fondo semitransparente */
        }

       td{
        font-family:fantasy;
       }

</style>











<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</br></br>
  
   
</head>

<body>

    <h1>Información de las Páginas</h1>

    <?php if (!empty($paginas)) : ?>


        </br>
        
    <div class="container">
        <br/>
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%;">Id Página</th>
                                <th scope="col" style="width: 20%;">Ruta de la Página</th>
                                <th scope="col" style="width: 20%;">Descripción</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_visitas as $registro) : ?>
                                <tr>
                                    <td><?php echo $registro['idpagina']; ?></td>
                                    <td><?php echo $registro['rutapagina']; ?></td>
                                    <td><?php echo $registro['descripcion']; ?></td>
                                  
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php else : ?>
        <p>No se encontraron páginas.</p>
    <?php endif; ?>
</body>
</html>
