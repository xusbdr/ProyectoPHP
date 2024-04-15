
<?php 
include("BaseDatos.php");



$idUsuario = "";
$nombre = "";
$apellidos = "";
$contrasenya = "";
$sexo = "";
$fechaNacimiento = "";
$tipoSuscripcion = ""; 

// MODIFICAR USUARIO
if(isset($_GET['idUsuario'])) { 
    $idUsuario = $_GET['idUsuario'];

    // Consultar la base de datos para obtener los datos del usuario
    $sentencia = $conexion->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
    $sentencia->bind_param("i", $idUsuario);
    $sentencia->execute();
    $resultado = $sentencia->get_result();

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $nombre = $usuario["nombre"];
        $apellidos = $usuario["apellidos"];
        $contrasenya = $usuario["contrasenya"];
        $sexo = $usuario["sexo"];
        $fechaNacimiento = $usuario["fechaNacimiento"];
        $tipoSuscripcion = $usuario["tipoSuscripcion"];
        $foto=$usuario["foto"];

    } else {
        echo "Usuario no encontrado.";
        exit(); // Detener la ejecución del script si no se encuentra el usuario
    }
}
?>


<?php include("templatesss/header50.php"); ?>






<style>
    /* Estilos personalizados */
   
    body {
        background-image: url('imagenes/fondo4.jpg'); /* Ruta de la imagen */
        background-color: #ADD8E6; /* Color de fondo de respaldo */
        background-repeat: no-repeat; /* No repetir la imagen */
        background-size: cover; /* Ajustar la imagen al tamaño del contenedor */
        background-position: center; /* Centrar la imagen */
        height: 60vh; /* Hacer que el cuerpo ocupe el 100% de la altura de la ventana */
        margin: 0; /* Eliminar el margen predeterminado */
        padding: 0; /* Eliminar el rellado predeterminado */
    }

    h1 {
        font-family: fantasy;
        font-size: 45px;
        color: black;
    }
</style>

<br/>
<h1>Modificar Usuario</h1>


<div class="card">
    <div class="card-body">
        <form action="modificarUsuario.php" method="post" enctype="multipart/form-data" onsubmit="redirectToUsuario()">
            <div class="mb-3">
                <label for="idUsuario" class="form-label">ID</label>
                <input type="text" value="<?php echo $idUsuario; ?>" class="form-control" readonly name="idUsuario" id="idUsuario" placeholder="ID" />
                <!-- Campo oculto para enviar el valor de idUsuario -->
                <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="nombre" id="nombre" placeholder="Nombre" />
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label> 
                <input type="text" value="<?php echo $apellidos; ?>" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" />
            </div>

            <div class="mb-3">
                <label for="contrasenya" class="form-label">Contraseña</label>  
                <input type="password" class="form-control" name="contrasenya" id="contrasenya" placeholder="Contraseña" value="<?php echo $contrasenya; ?>" />
            </div>



            

    <div class="mb-3">
    <label for="sexo" class="form-label">Sexo</label>
    <div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sexo" id="masculino" value="masculino" required>
            <label class="form-check-label" for="masculino">Masculino</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sexo" id="femenino" value="femenino" required>
            <label class="form-check-label" for="femenino">Femenino</label>
        </div>
    </div>
</div>



            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>  
                <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>" />
            </div>

            <div class="mb-3">
                <label for="tipoSuscripcion" class="form-label">Tipo de Suscripción</label>
                <select class="form-select" name="tipoSuscripcion" id="tipoSuscripcion">
                    <option value="basica" <?php if($tipoSuscripcion == "basica") echo "selected"; ?>>Básico</option>
                    <option value="premium" <?php if($tipoSuscripcion == "premium") echo "selected"; ?>>Premium</option>
                    <option value="profesional" <?php if($tipoSuscripcion == "profesional") echo "selected"; ?>>Profesional</option>
                </select>
            </div>



            <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input class="form-control" type="file" name="foto" id="foto">
            </div>




            <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="btn" onclick="goBack()">Guardar</button>
            </div>

           <script>
           function goBack() {
           window.history.back();
           }
           </script>



        </form>
       

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $idUsuario = $_POST['idUsuario'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $contrasenya = $_POST['contrasenya'];
            $sexo = $_POST['sexo'];
            $fechaNacimiento = $_POST['fechaNacimiento'];
            $tipoSuscripcion = $_POST['tipoSuscripcion'];
            $foto = $_FILES['foto']['tmp_name'];


            // Preparar y ejecutar la consulta SQL para actualizar los datos del usuario
$sql = "UPDATE usuario SET nombre=?, apellidos=?, contrasenya=?, sexo=?, fechaNacimiento=?, tipoSuscripcion=? , foto=? WHERE idUsuario=?";
$sentencia = $conexion->prepare($sql);
$sentencia->bind_param("sssssssi", $nombre, $apellidos, $contrasenya, $sexo, $fechaNacimiento, $tipoSuscripcion, $foto, $idUsuario);


            $resultado = $sentencia->execute();

            // Verificar si se actualizó correctamente
            if ($resultado) {
                echo "Los datos se actualizaron correctamente.";
            } else {
                echo "Error al actualizar los datos: " . $conexion->error;
            }
        }
        ?>
    </div>
    <div class="card-footer text-muted"></div>
</div>



<script>
function redirectToUsuario() {
    window.location.href = 'usuario.php';
}
</script>
