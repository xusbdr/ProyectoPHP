<?php
// index -------
include("BaseDatos.php");

// BORRADO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";

    // Confirmación antes de borrar
    if (isset($_POST['confirmacion']) && $_POST['confirmacion'] === 'si') {
        // Consulta de eliminación de usuario
        $sql_usuario = "DELETE FROM suscripcion WHERE idUsuario=?";
        $sentencia_usuario = $conexion->prepare($sql_usuario);
        $sentencia_usuario->bind_param("i", $txtID);

        // Consulta de eliminación de suscripción
        $sql_suscripcion = "DELETE FROM suscripcion WHERE idUsuario=?";
        $sentencia_suscripcion = $conexion->prepare($sql_suscripcion);
        $sentencia_suscripcion->bind_param("i", $txtID);

        // Ejecutar consultas
        if ($sentencia_usuario->execute() && $sentencia_suscripcion->execute()) {
            header("Location:usuario.php");
            exit();
        } else {
            echo "Error al ejecutar la consulta: " . $sentencia_usuario->error;
        }
    }
}

// Obtener los datos de suscripción de la base de datos
$resultado = $conexion->query("SELECT * FROM `suscripcion`");
$lista_suscripcion = $resultado->fetch_all(MYSQLI_ASSOC);
?>




<?php include("templatesss/header.php"); ?>





<style>
    /* Estilos personalizados */
   
    body {
    background-image: url('imagenes/fondo5.jpg'); /* Ruta de la imagen */
    background-color: #ADD8E6; /* Color de fondo de respaldo */
    background-repeat: no-repeat; /* No repetir la imagen */
    background-size: cover; /* Ajustar la imagen al tamaño del contenedor */
    background-position: center; /* Centrar la imagen */
    height: 120vh; /* Hacer que el cuerpo ocupe el 100% de la altura de la ventana */
    margin: 0; /* Eliminar el margen predeterminado */
    padding: 0; /* Eliminar el relleno predeterminado */
}


h1 {
    font-family: fantasy;
    font-size: 50px;

    /* Ruta de la imagen */
    background-image: url('imagenes/leta.jpg');

    /* Tamaño de la imagen */
    background-size: cover;

    /* Propiedad que permite recortar el fondo del texto */
    -webkit-background-clip: text;

    

    /* Color de relleno del texto */ 
    -webkit-text-fill-color: transparent;
   
}




</style>







<br/><br/><br/>





<div class="container">
    <h1>Suscripciones</h1>

    <br/>

    <div class="card">
        <div class="card-header">
            
        </div>

        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%;">Nº Socio.</th>
                            <th scope="col" style="width: 20%;">Tipo Suscripción</th>
                            <th scope="col" style="width: 20%;">Fecha Inicio</th>
                            <th scope="col" style="width: 20%;">Fecha Fin</th>
                            <th scope="col" style="width: 15%;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_suscripcion as $registro) : ?>
                            <tr>
                                <td><?php echo $registro['idUsuario']; ?></td>
                                <td><?php echo $registro['tipoSuscripcion']; ?></td>
                                <td><?php echo $registro['fechaInicio']; ?></td>
                                <td><?php echo $registro['fechaFin']; ?></td>
                                <td>
                                    <a class="btn btn-primary me-4" href="editarSuscripcion.php?txtID=<?php echo $registro['idUsuario']; ?>" role="button">Modificar</a>
                                    
                                    <button type="button" onclick="abrirModal(<?php echo $registro['idUsuario']; ?>)" class="btn btn-danger" name="delete">Borrar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>








<!-- Ventana modal -->
<div id="modal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; display: none; justify-content: center; align-items: center;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); text-align: center;">
        <p>¿Está seguro de que desea borrar este usuario?</p>
        <form id="deleteForm" method="post" action="usuario.php">
            <input type="hidden" id="deleteUserId" name="txtID" value="">
            <input type="hidden" name="confirmacion" value="si">
            <button type="submit" class="btn btn-danger" name="delete">Sí</button>
            <button type="button" onclick="cerrarModal()" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>
</div>



<?php include("templatesss/footer.php"); ?>





<script>
    function abrirModal(idUsuario) {
        var modal = document.getElementById('modal');
        var deleteUserIdField = document.getElementById('deleteUserId');
        deleteUserIdField.value = idUsuario;
        modal.style.display = 'flex';
    }

    function cerrarModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'none';
    }
</script>