<?php 
include("BaseDatos.php");




// Consulta para obtener la lista de usuarios
$resultado = $conexion->query("SELECT * FROM `usuario`");
$lista_usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

// BORRADO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";

    // Confirmación antes de borrar
    if (isset($_POST['confirmacion']) && $_POST['confirmacion'] === 'si') {
        // Consulta de eliminación de usuario
        $sql_usuario = "DELETE FROM usuario WHERE idUsuario=?";
        $sentencia_usuario = $conexion->prepare($sql_usuario);
        $sentencia_usuario->bind_param("i", $txtID);

        // Consulta de eliminación de suscripción
        $sql_suscripcion = "DELETE FROM suscripcion WHERE idUsuario=?";
        $sentencia_suscripcion = $conexion->prepare($sql_suscripcion);
        $sentencia_suscripcion->bind_param("i", $txtID);

        // Consulta de eliminación de páginas del usuario
        $sql_paginas = "DELETE FROM pagina WHERE idUsuario=?";
        $sentencia_paginas = $conexion->prepare($sql_paginas);
        $sentencia_paginas->bind_param("i", $txtID);

        // Consulta de eliminación de visitas del usuario
        $sql_visitas = "DELETE FROM visitas WHERE idUsuario=?";
        $sentencia_visitas = $conexion->prepare($sql_visitas);
        $sentencia_visitas->bind_param("i", $txtID);

        // Ejecutar consultas
        if ($sentencia_usuario->execute() && $sentencia_suscripcion->execute() && $sentencia_paginas->execute() && $sentencia_visitas->execute()) {
            header("Location:usuario.php");
            exit();
        } else {
            echo "Error al ejecutar la consulta: " . $sentencia_usuario->error;
        }
    } else {
        // Mostrar ventana emergente
        echo '<div id="modal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; display: flex; justify-content: center; align-items: center;">
                <div style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); text-align: center;">
                    <p>¿Está seguro de que desea borrar este usuario?</p>
                    <form method="post" action="usuario.php">
                        <input type="hidden" name="txtID" value="' . $txtID . '">
                        <input type="hidden" name="confirmacion" value="si">
                        <button type="submit" class="btn btn-danger" name="delete">Sí</button>
                        <button type="button" onclick="cerrarModal()" class="btn btn-secondary">Cancelar</button>
                    </form>
                </div>
              </div>';
    }
}

?>



<?php 
include("templatesss/header.php"); 
include("estiloUsuario.php");
?>





<br/><br/>


<div class="container">
    <h1>Usuarios</h1>
    <br/>
    

    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="añadirUsuarios.php" role="button">Añadir Usuario</a>
        </div>

        <div class="table-responsive table-container">
            <div class="table-responsive">
                <table >
                    <thead>
                        <tr>
                            <th scope="col">NºSocio</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col">Sexo</th>
                            
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Tipo de Suscripción</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_usuarios as $usuario) {?>
                            <tr>
                                <td><?php echo $usuario['idUsuario']; ?></td>
                                <td><?php echo $usuario['nombre']; ?></td>
                                <td><?php echo $usuario['apellidos']; ?></td>
                                <td><?php echo $usuario['contrasenya']; ?></td>
                                <td><?php echo $usuario['sexo']; ?></td>
                                
                                <td><?php echo $usuario['fechaNacimiento']; ?></td>
                                <td><?php echo $usuario['tipoSuscripcion']; ?></td>
                              

                                <td>
    <?php 
    // Verificar si hay una foto para mostrar
    if (!empty($usuario['foto'])) {
        // Mostrar la foto usando la etiqueta img
        echo '<img src="' . $usuario['foto'] . '" alt="Foto " style="max-width: 100px; max-height: 100px;">';
    } else {
        // Si no hay foto, mostrar un mensaje alternativo
        echo 'No disponible';
    }
    ?>
</td>

                                    <td>
                                  
                                    <a class="btn btn-primary" href="modificarUsuario.php?idUsuario=<?php echo $usuario['idUsuario']; ?>" role="button">Modificar</a>
                                    <form method="post" action="usuario.php">
                                    &nbsp;&nbsp; 
                                        <input type="hidden" name="txtID" value="<?php echo $usuario['idUsuario']; ?>">
                                        <button type="submit" class="btn btn-danger" name="delete">Borrar</button>
                                    </form>                           
                                </td>

                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<script>
    function cerrarModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'none';
    }
</script>
