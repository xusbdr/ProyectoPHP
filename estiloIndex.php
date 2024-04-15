

<style>
   
   
    body {
    background-image: url('imagenes/FONDO2.jpg'); /* Ruta de la imagen */
    background-color: #ADD8E6; /* Color de fondo de respaldo */
    background-repeat: no-repeat; /* No repetir la imagen */
    background-size: cover; /* Ajustar la imagen al tamaño del contenedor */
    background-position: center; /* Centrar la imagen */
    height: 100vh; /* Hacer que el cuerpo ocupe el 100% */
    margin: 0; 
    padding: 0; 
}



.custom-card {
    background-image: url('imagenes/fondo3.png'); /* Ruta de la imagen de fondo */
    border: 5px solid #BFC9CA;
    padding: 20px; 
    position: relative; /* Para posicionar el contenido relativo a este contenedor */
    border-radius: 15px;
    background-size: cover; /* Ajustar la imagen al tamaño del contenedor */
    background-position: center; /* Centrar la imagen */
}



    .card-header {
        color: black; 
        background-color: #EAE2F8; /* Color de fondo para el encabezado */
        padding: 10px; 
        border: 3px solid #BFC9CA;
        font-family:arial;
        font-size:17px;
        border-radius:15px;


    }



    .custom-card::before {
        content: "JMBR";
        font-size: 48px;
        color: rgba(0, 0, 0, 0.6); /* Color de la marca de agua */
        position: absolute;
        bottom: 20px;
        right: 20px;
        z-index: 0;
    }

    .card-body {
        position: relative; /* Para posicionar el contenido relativo a este contenedor */
        z-index: 1; /* Colocar el contenido sobre la marca de agua */
    }

    .form-label {
    font-weight: bold; /* Hacer el texto en negrita */
    font-size:25px;
    font-family:cursive;
}



.btn-primary {
    background-color: #17a2b8; /* Color de fondo del botón */
    border-color: black; /* Color del borde del botón */
    color: white; /* Color del texto del botón */
    padding: 8px 60px; 
    border-width: 3px; /* Establecer el ancho del borde a 2 píxeles */
}

.btn-primary:hover {
    background-color: #138496; /* Cambio de color de fondo al pasar el mouse sobre el botón */
    border-color:pink; /* Cambio de color del borde al pasar el mouse sobre el botón */
    color: white; /* Color del texto del botón */
    border-width: 3px;
}


 /* Estilos para el enlace "Registrarse" */
 .registrarse {
            color: white;
            text-decoration: none;
            font-size: 25px;
          
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
        }

        .registrarse:hover {
            background-color: orange; /* Cambio de color de fondo al pasar el mouse sobre el enlace */
        }


</style>

