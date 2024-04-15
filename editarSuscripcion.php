<?php 
include("BaseDatos.php");



// MODIFICAR ----------------------------
if(isset($_GET['txtID'])) { 
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";

    
    $sentencia = $conexion->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
    $sentencia->bind_param("i", $txtID);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $registro = $resultado->fetch_assoc();
    $tiposuscripcion = $registro["tipoSuscripcion"];
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
    $tiposuscripcion = isset($_POST["tiposuscripcion"]) ? $_POST["tiposuscripcion"] : "";
    $sentencia = $conexion->prepare("UPDATE suscripcion SET tipoSuscripcion=? WHERE idUsuario=?");
    $sentencia->bind_param("si", $tiposuscripcion, $txtID);
    $sentencia->execute();
    header("Location:suscripcion.php");
    exit(); 
}






// --------





?>

<?php include("templatesss/header.php"); ?>





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


h1{

    font-family:fantasy;   
    font-size:35px;
    color:gold;
}


.custom-background {
    background-image: url('imagenes/fondo3.png'); /* Ruta de la imagen de fondo */
    border: 8px solid #BFC9CA;
    padding: 20px; /* Añadir relleno para espacio dentro del contenedor */
    position: relative; /* Para posicionar el contenido relativo a este contenedor */
    border-radius: 15px;
    background-size: cover; /* Ajustar la imagen al tamaño del contenedor */
    background-position: center; /* Centrar la imagen */
}


.form-label {
    font-weight: bold; /* Hacer el texto en negrita */
    font-size:25px;
    font-family:fantasy;
}




.btn-info {
    background-color: #17a2b8; /* Color de fondo del botón */
    border-color: black; /* Color del borde del botón */
    color: white; /* Color del texto del botón */
    padding: 8px 60px; 
    border-width: 3px; /* Establecer el ancho del borde a 2 píxeles */
}

.btn-info:hover {
    background-color: #138496; /* Cambio de color de fondo al pasar el mouse sobre el botón */
    border-color:gold; /* Cambio de color del borde al pasar el mouse sobre el botón */
    color: white; /* Color del texto del botón */
    border-width: 3px;
}

</style>



<br/><br/><br/><br/>
<br/><br/>


<div class="card custom-background">

<br/> 
<h1>&nbsp;&nbsp;&nbsp;  Modificar tipo de suscripcion</h1>

<br/>

    <div class="card-body">
        
        <form action="editarsuscripcion.php" method="post" enctype="multipart/form-data">
           
        <div class="mb-3">
            
                <label for="txtID" class="form-label">Número de Socio</label>
                <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" />
           
           
                <!-- Campo oculto para enviar el valor de txtID -->
                <input type="hidden" name="txtID" value="<?php echo $txtID; ?>">
           
            </div>

            <div class="mb-3">
                <label for="tiposuscripcion" class="form-label">Tipo de Suscripción</label>
                <select class="form-select" name="tiposuscripcion" id="tiposuscripcion">
                    <?php
                    // Opciones de tipo de suscripción
                    $opciones_suscripcion = array("basico", "premium", "profesional");

                    // Iterar sobre las opciones y generar etiquetas <option>
                    foreach ($opciones_suscripcion as $opcion) {
                        // Verificar si la opción es la seleccionada
                        $selected = ($opcion == $tiposuscripcion) ? "selected" : "";
                        echo "<option value='$opcion' $selected>$opcion</option>";
                    }
                    ?>
                </select>
            </div>

            <br/>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-info">Guardar</button>

           

        
        
        </form>
    </div>

    <div class="card-footer text-muted"></div>
</div>


<?php include("templatesss/footer.php"); ?>


