<?php 
include("templatesss/header50.php");
include("estiloIndex.php");

session_start();

// Definir el límite de intentos fallidos y el tiempo de bloqueo en segundos
$intentosMaximos = 3;
$tiempoBloqueo = 15; // segundos

// Verificar si se han enviado datos de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han proporcionado nombre de usuario y contraseña
    if (isset($_POST["nombre"]) && isset($_POST["contrasenya"])) {
        // Verificar si el usuario está bloqueado
        if(isset($_SESSION['bloqueo']) && $_SESSION['bloqueo'] > time()) {
            echo "Tu cuenta está bloqueada. Por favor, intenta nuevamente más tarde.";
            exit();
        }

        // Sanitizar y escapar los datos de entrada del formulario para prevenir inyección de SQL
        $conexion = mysqli_connect("127.0.0.1", "root", "123456", "web"); // Ajusta los valores según tu configuración
        $username = mysqli_real_escape_string($conexion, $_POST["nombre"]);
        $password = mysqli_real_escape_string($conexion, $_POST["contrasenya"]);

        // Consultar la base de datos para encontrar un usuario con el nombre proporcionado
        $query = "SELECT * FROM usuario WHERE nombre = '$username'";
        $result = mysqli_query($conexion, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Usuario encontrado, verificar la contraseña
            $user = mysqli_fetch_assoc($result);
            if ($password === $user["contrasenya"]) {
                // Contraseña correcta, iniciar sesión
                $_SESSION["username"] = $user["nombre"];
                
                // Restablecer los intentos fallidos si el inicio de sesión fue exitoso
                unset($_SESSION['intentosFallidos']);

                // Redirigir al usuario a usuario.php si las credenciales son las de administrador
                if ($username === "jesus" && $password === "1") {
                    header("Location: usuario.php");
                    exit();
                }

                // Si no es administrador, redirigir a otra página
                header("Location: bienvenida.php");
                exit();
            } else {
                // Incrementar el contador de intentos fallidos
                if (!isset($_SESSION['intentosFallidos'])) {
                    $_SESSION['intentosFallidos'] = 1;
                } else {
                    $_SESSION['intentosFallidos']++;
                }

                // Verificar si se ha alcanzado el límite de intentos fallidos
                if ($_SESSION['intentosFallidos'] >= $intentosMaximos) {
                    // Establecer el tiempo de bloqueo
                    $_SESSION['bloqueo'] = time() + $tiempoBloqueo;
                    echo "Has excedido el número máximo de intentos de inicio de sesión. Tu cuenta está bloqueada por $tiempoBloqueo segundos.";
                    exit(); // Detener el script
                } else {
                    // Mostrar un mensaje de error
                    echo "Nombre de usuario o contraseña incorrectos. Intento $_SESSION[intentosFallidos] de $intentosMaximos.";
                }
            }
        } else {
            // Mostrar un mensaje de error si el usuario no se encuentra en la base de datos
            echo "Usuario no encontrado.";
        }

        // Cierra la conexión a la base de datos después de usarla
        mysqli_close($conexion);
    } 
}
?>






<br/><br/><br/><br/>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="background-image"></div>
              
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasenya" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasenya" name="contrasenya" required>
                    </div>

                    <br/>
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                
                    <br/>  <br/>
            
                <a class="registrarse" href="<?php echo $url_base; ?>añadirUsuarios">Registrarse</a>
           

            

                </form>
            </div>
        </div>
    </div>
</div>

