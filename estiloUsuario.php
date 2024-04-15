

<style>
    /* Estilos personalizados */
   
    body {
    background-image: url('imagenes/fonsi.jpg'); /* Ruta de la imagen */
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

        .card{
            background: rgba(255, 255, 255, 0.2); /* Fondo semitransparente */
            padding: 15px; /* Espaciado interno */
            border-radius: 15px; /* Bordes redondeados */
        }



 /* Estilos para la tabla */
 .table-container {
        overflow-x: auto; /* Permitir el desplazamiento horizontal si es necesario */
        max-width: 100%; /* Ancho máximo del contenedor */
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
      
       
    .btn-primary:hover {
        background-color: purple; /* Cambiar color de fondo del botón primario al pasar el mouse */
        border-color: #0062cc; /* Cambiar color del borde del botón primario al pasar el mouse */
    }

    .btn-danger {
        background-color: #dc3545; /* Color de fondo del botón borrar */
        border-color: #dc3545; /* Color del borde del botón borrar*/
    }

    .btn-danger:hover {
        background-color: orange; /* Cambiar color de fondo del botón de peligro al pasar el mouse */
        border-color: #bd2130; /* Cambiar color del borde del botón de peligro al pasar el mouse */
    }

</style>
