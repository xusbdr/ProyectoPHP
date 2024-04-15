
<?php 
include("BaseDatos.php");

$fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : '';
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
    padding: 0; /* Eliminar el relleno predeterminado */
}
</style>

<br/><br/><br/><br/>

<div class="card">
    <div class="card-header"> Datos del Usuario</div>

    <div class="card-body">
        <form action="añadirUsuarios.php" method="post" enctype="multipart/form-data"> 
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" required>
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="apellidos" required>
            </div>

            <div class="mb-3">
                <label for="contrasenya" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasenya" id="contrasenya" placeholder="contraseña" required>
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
                <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>" required />
            </div>

            <div class="mb-3">
                <label for="tipoSuscripcion" class="form-label">Tipo de Suscripción</label>
                <select class="form-select form-select-sm" name="tipoSuscripcion" id="tipoSuscripcion" required>
                    <option selected disabled>Seleccionar Tipo de Suscripción</option>
                    <option value="basica">basica</option>
                    <option value="premium">premium</option>
                    <option value="profesional">profesional</option>
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


        if(isset($_POST['btn'])) {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $contrasenya = $_POST['contrasenya'];
            $sexo = $_POST['sexo'];
            $fechaNacimiento = $_POST['fechaNacimiento'];
            $tipoSuscripcion = $_POST['tipoSuscripcion'];


            // Encriptar la contraseña
            $contraEncrip = password_hash($contrasenya, PASSWORD_DEFAULT);


            // Verificar si el usuario ya existe en la base de datos
            $result = $conexion->query("SELECT * FROM usuario WHERE nombre = '$nombre'");
            if ($result->num_rows > 0) {
                echo "El nombre de usuario ya está registrado. Por favor introduzca un nombre de usuario diferente.";
            } else {
                // Validar si el usuario tiene al menos 16 años
                $fechaHoy = new DateTime();
                $fechaNac = new DateTime($fechaNacimiento);
                $edad = $fechaHoy->diff($fechaNac)->y;

                if ($edad >= 16) {
                    // Obtener el nombre del archivo y la ruta temporal del archivo cargado
                    $nombreArchivo = $_FILES['foto']['name'];
                    $rutaTemporal = $_FILES['foto']['tmp_name'];

                    // Mover el archivo cargado al directorio de destino
                    $rutaDestino = 'C:\\wamp64\\www\\ProyectoJesus\\guardaFoto\\' . $nombreArchivo;
                    move_uploaded_file($rutaTemporal, $rutaDestino);

                    // Insertar usuario junto con la ruta de la imagen en la base de datos
                    $sql = "INSERT INTO usuario (nombre, apellidos, contrasenya, sexo, fechaNacimiento, tipoSuscripcion, foto) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("sssssss", $nombre, $apellidos, $contraEncrip, $sexo, $fechaNacimiento, $tipoSuscripcion, $rutaDestino);
                    if ($stmt->execute()) {
                        // Obtener el ID del usuario insertado
                        $idUsuario = $conexion->insert_id;

                        // Insertar suscripción
                        $conexion->query("INSERT INTO suscripcion (idUsuario, tipoSuscripcion, fechaInicio, fechaFin) VALUES ('$idUsuario', '$tipoSuscripcion', NOW(), DATE_ADD(NOW(), INTERVAL 1 YEAR))");

                        echo "Se insertaron correctamente los datos.";
                    } else {
                        echo "Error al ejecutar la consulta: " . $stmt->error;
                    }
                } else {
                    echo "El usuario debe tener al menos 16 años para registrarse como socio.";
                }
            }
        }
        ?>
        <br/>
    </div>
</div>

<?php include("templatesss/footer.php"); ?>


