<?php
session_start();

// Destruir todas las variables de sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: " . $url_base . "index.php");
exit();
?>

</main>

<footer>
    <!-- place footer content here -->
</footer>

<!-- Bootstrap Bundle with Popper v5.3.2 -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FqGj/sx0LGqGqi/Ozrj+fB1aq8z28cwfeV5z6fTuvzgf9JZ2P2w/hGJLVT9pvrSz"
    crossorigin="anonymous"
></script>
</body>
</html>
