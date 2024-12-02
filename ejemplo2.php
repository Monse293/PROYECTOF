<?php
// Definir las secciones directamente en el archivo PHP
$secciones = [
    1 => 'Introducción a la Programación',
    2 => 'Bases de Datos Relacionales',
    3 => 'HTML , CSS y JavaScript',
    4 => 'Juego: Ahorcado'
];

// Contenido detallado de cada sección
$contenidos = [
    1 => '
        <div class="contenido-seccion programacion">
            <h3>¿Qué es la programación?</h3>
            <p>La programación es el proceso mediante el cual se le da instrucciones a una computadora para realizar tareas específicas. Existen diversos lenguajes de programación que permiten crear aplicaciones, juegos, páginas web y más.</p>
            <h4>Lenguajes populares:</h4>
            <ul>
            <li>Python</li>
                <li>Python</li>
                <li>JavaScript</li>
                <li>Java</li>
                <li>C#</li>
            </ul>
        </div>',
    2 => '
        <div class="contenido-seccion bases-datos">
            <h3>Definición de Bases de Datos Relacionales</h3>
            <p>Las bases de datos relacionales organizan los datos en tablas. Son utilizadas para gestionar grandes cantidades de información. En este tipo de bases de datos, los datos están estructurados en filas y columnas.</p>
            <h4>Características principales:</h4>
            <ul>
                <li>Integridad referencial</li>
                <li>Transacciones ACID</li>
                <li>SQL (Structured Query Language)</li>
            </ul>
        </div>',
    3 => '
        <div class="contenido-seccion html-css">
            <h3>¿Qué es HTML y CSS?</h3>
            <p>HTML es el lenguaje de marcado utilizado para estructurar contenido en la web, mientras que CSS es el lenguaje utilizado para darle estilo y formato a las páginas web.</p>
            <h4>Conceptos clave:</h4>
            <ul>
                <li>HTML: Estructura de la página web</li>
                <li>CSS: Diseño visual y maquetación</li>
                <li>Etiquetas HTML y Selectores CSS</li>
            </ul>
        </div>',
    4 => '
        <div class="contenido-seccion juego">
            <h3>Bienvenido al juego de Ahorcado</h3>
            <p>¡Diviértete mientras aprendes a programar! Haz clic en el siguiente botón para empezar el juego:</p>
            <a href="juego.php">
                <button class="btn-juego">Empezar el juego</button>
            </a>
        </div>'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Programación y Bases de Datos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Lobster&display=swap">
    <style>
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            background-size: cover;  /* Hace que la imagen cubra todo el fondo */
            background-position: center center; /* Centra la imagen en el fondo */
            background-attachment: fixed;
            color: #333;
            margin: 0;
            padding: 0;
            animation: fadeIn 1s ease-in;
            background-image: url("https://th.bing.com/th/id/R.ee91f95ea471266d777c4a6d47e70bab?rik=GMsG4za%2fhw7gxg&pid=ImgRaw&r=0");
        }

        header {
            background: linear-gradient(90deg, #6a82fb, #fc5c7d);
            padding: 30px;
            text-align: center;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-family: 'Lobster', cursive;
            font-size: 4rem;
            margin: 0;
            color: white;
        }

        main {
            padding: 40px 20px;
            text-align: center;
        }
        
        main h2, main p {
            color: white;
        }

        .secciones-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin: 30px auto;
            max-width: 1200px;
        }

        .seccion {
            background: #ffffff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0.95;
            text-align: center;
        }

        .seccion:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            opacity: 1;
        }

        .seccion a {
            color: #6a82fb;
            font-weight: bold;
            text-decoration: none;
            font-size: 1.2rem;
        }

        .seccion a:hover {
            color: #fc5c7d;
            text-decoration: underline;
        }

        button {
            background-color: #6a82fb;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 25px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #fc5c7d;
            transform: scale(1.05);
        }

        footer {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        
    </style>
</head>
<body>
    <header>
        <h1>Educación en Programación y Bases de Datos</h1>
    </header>
    <main>
        <?php
        if (isset($_GET['id']) && array_key_exists($_GET['id'], $secciones)) {
            $id = $_GET['id'];
            echo "<h2>" . htmlspecialchars($secciones[$id]) . "</h2>";
            echo $contenidos[$id];
            echo '<a href="index.php" style="text-decoration: none; color: #6a82fb;">Volver al menú principal</a>';
        } else {
        ?>
            <h2>Bienvenido</h2>
            <p>Selecciona una sección para aprender más sobre programación y bases de datos.</p>
            <div class="secciones-container">
                <?php foreach ($secciones as $id => $titulo) { ?>
                    <div class="seccion">
                        <a href="secciones.php?id=<?php echo $id; ?>"><?php echo htmlspecialchars($titulo); ?></a>
                    </div>
                <?php } ?>
            </div>
        <?php
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Programación y Bases de Datos | Todos los derechos reservados</p>
    </footer>
</body>
</html>
