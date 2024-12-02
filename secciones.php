<?php
$secciones = [
    1 => 'Introducción a la Programación',
    2 => 'Bases de Datos Relacionales',
    3 => 'HTML , CSS y JavaScript',
    4 => 'Juego: Ahorcado'  
];

$contenidos = [
    1 => '
           <!-- Contenido Principal -->
    <main>
          
        <!-- Sección sobre Tipos de Lenguajes de Programación -->
        <div class="tema">
           <h2>¿Qué es la Programación?</h2>
        <p>La programación es el proceso mediante el cual se le da instrucciones a una computadora para realizar tareas específicas. A través de lenguajes de programación, los programadores crean software que ejecuta diversas funciones, desde aplicaciones móviles hasta sitios web interactivos.</p>

        <div class="seccion-contenido">
            <h3>Lenguajes Populares</h3>
            <ul>
                <li>Python</li>
                <li>JavaScript</li>
                <li>Java</li>
                <li>C#</li>
            </ul>

        </div>

        <!-- Sección sobre Tipos de Lenguajes de Programación -->
        <div class="tema">
            <h3>Tipos de Lenguajes de Programación</h3>
            <p>Los lenguajes de programación se clasifican según su nivel de abstracción y su relación con el hardware. Algunos ejemplos son:</p>
            <ul>
                <li><strong>Lenguajes de alto nivel:</strong> Más cercanos al lenguaje humano (Ejemplo: Python, Java).</li>
                <li><strong>Lenguajes de bajo nivel:</strong> Más cercanos al código máquina (Ejemplo: C, C++).</li>
                <li><strong>Lenguajes interpretados:</strong> Se ejecutan línea por línea (Ejemplo: Python, JavaScript).</li>
                <li><strong>Lenguajes compilados:</strong> Se traducen completamente a código ejecutable (Ejemplo: C, C++).</li>
            </ul>
        </div>

        <!-- Sección sobre Algoritmos -->
        <div class="tema">
            <h3>Algoritmos</h3>
            <p>Un algoritmo es un conjunto de pasos para resolver un problema. Los algoritmos pueden clasificarse según su complejidad y eficiencia. Algunos ejemplos comunes son los algoritmos de ordenación (como el ordenamiento rápido) y los algoritmos de búsqueda (como la búsqueda binaria).</p>
        </div>

        <!-- Sección sobre Programación Orientada a Objetos (OOP) -->
        <div class="tema">
            <h3>Programación Orientada a Objetos (OOP)</h3>
            <p>La programación orientada a objetos es un paradigma que organiza el código en objetos que tienen atributos y métodos. Algunos de los conceptos clave son:</p>
            <ul>
                <li><strong>Clases y objetos</strong>: Una clase es una plantilla de un objeto.</li>
                <li><strong>Herencia</strong>: Permite a una clase heredar atributos y métodos de otra.</li>
                <li><strong>Polimorfismo</strong>: Usar una misma interfaz para diferentes tipos de objetos.</li>
                <li><strong>Encapsulación</strong>: Protección de datos mediante el uso de métodos para acceder a ellos.</li>
            </ul>
        </div>

        <!-- Sección sobre Desarrollo Web -->
        <div class="tema">
            <h3>Desarrollo Web</h3>
            <p>El desarrollo web incluye la creación de sitios y aplicaciones para la web. Los principales componentes son:</p>
            <ul>
                <li><strong>Frontend:</strong> Lo que el usuario ve y con lo que interactúa (HTML, CSS, JavaScript).</li>
                <li><strong>Backend:</strong> El servidor que maneja la lógica y bases de datos (Ejemplo: Node.js, Python, Ruby).</li>
                <li><strong>Bases de Datos:</strong> Almacenan y gestionan los datos de la aplicación (Ejemplo: MySQL, MongoDB).</li>
            </ul>
        </div>

        <!-- Sección sobre Desarrollo de Software -->
        <div class="tema">
            <h3>Desarrollo de Software</h3>
            <p>El desarrollo de software abarca todo el ciclo de vida de un producto digital, desde el análisis de requerimientos hasta el mantenimiento del sistema.</p>
        </div>

        <!-- Sección sobre Ciberseguridad -->
        <div class="tema">
            <h3>Ciberseguridad</h3>
            <p>La programación en ciberseguridad se enfoca en la protección de sistemas y aplicaciones mediante técnicas como la criptografía, el análisis de vulnerabilidades y la implementación de protocolos de seguridad.</p>
        </div>

    </main>',
    
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
        
        <h3>¿Qué es una Base de Datos?</h3>
        <p>Una base de datos es un sistema que permite almacenar, organizar y gestionar datos de manera estructurada. Las bases de datos relacionales, como MySQL, organizan la información en tablas con filas y columnas.</p>

        <h3>Conexión a una Base de Datos con PHP</h3>
        <p>Para conectar una aplicación PHP con una base de datos MySQL, usamos la función <code>mysqli_connect()</code>. Aquí tienes un ejemplo básico:</p>
        <pre><code>
&lt;?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$baseDatos = "educativa";

// Conexión a la base de datos
$conexion = new mysqli($servidor, $usuario, $password, $baseDatos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
echo "Conexión exitosa";
?&gt;
        </code></pre>

        <h3>Ejemplo de Consulta de Datos</h3>
        <p>Una vez conectados, podemos ejecutar consultas para obtener datos. Por ejemplo, para obtener una lista de usuarios registrados:</p>
        <pre><code>
&lt;?php
$sql = "SELECT * FROM usuarios";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila["id"] . " - Nombre: " . $fila["nombre"] . "&lt;br&gt;";
    }
} else {
    echo "No se encontraron resultados.";
}
?&gt;
        </code></pre>

        <h3>Conexión y Formulario para Insertar Datos</h3>
        <p>A continuación, se encuentra un ejemplo de un formulario para insertar un nuevo usuario en la base de datos, junto con la conexión a la base de datos:</p>
        
        <form action="insertar.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <button type="submit">Guardar</button>
        </form>
    </div>',

    3 => '
    <div class="contenido-seccion html-css-js">
        <h3>¿Qué es HTML, CSS y JavaScript?</h3>
        <p>HTML, CSS y JavaScript son los pilares fundamentales del desarrollo web. Cada uno tiene un rol específico para crear y dar vida a las páginas web:</p>
        <ul>
            <li><strong>HTML:</strong> Lenguaje de marcado para estructurar el contenido de las páginas web.</li>
            <li><strong>CSS:</strong> Lenguaje de estilo utilizado para darle diseño y formato a las páginas web.</li>
            <li><strong>JavaScript:</strong> Lenguaje de programación que añade interactividad y dinamismo a las páginas.</li>
        </ul>

        <h3>¿Qué hace cada tecnología?</h3>
        <ul>
            <li><strong>HTML:</strong> Define la estructura de la página mediante etiquetas como <code>&lt;h1&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;div&gt;</code>, entre otras.</li>
            <li><strong>CSS:</strong> Permite estilizar el contenido con propiedades como colores, fuentes, márgenes y posiciones.</li>
            <li><strong>JavaScript:</strong> Se utiliza para manejar eventos, validar formularios, actualizar contenido dinámicamente y más.</li>
        </ul>

        <h3>Ejemplo básico de HTML</h3>
        <pre><code>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;Mi primera página&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Hola, mundo&lt;/h1&gt;
    &lt;p&gt;Este es un ejemplo básico de HTML.&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;
        </code></pre>

        <h3>Ejemplo básico de CSS</h3>
        <pre><code>
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    color: #333;
}

h1 {
    color: #1976D2;
}
        </code></pre>

        <h3>Ejemplo básico de JavaScript</h3>
        <pre><code>
&lt;script&gt;
    document.addEventListener("DOMContentLoaded", function() {
        alert("¡Hola, mundo!");
    });
&lt;/script&gt;
        </code></pre>

        <h3>Integración de HTML, CSS y JavaScript</h3>
        <p>Estas tres tecnologías trabajan juntas para crear experiencias web completas:</p>
        <pre><code>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;Página dinámica&lt;/title&gt;
    &lt;style&gt;
        body {
            background-color: #f9f9f9;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #6a82fb;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Bienvenido a mi página&lt;/h1&gt;
    &lt;button onclick="mostrarMensaje()"&gt;Haz clic aquí&lt;/button&gt;
    &lt;script&gt;
        function mostrarMensaje() {
            alert("¡Gracias por hacer clic!");
        }
    &lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;
        </code></pre>
    </div>',


    4 => '
           <p>Bienvenido al juego de Ahorcado. <a href="juego.php">
        <button>Empezar el juego</button>
    </a></p>'  
];

// Verificar si el ID de la sección está presente en la URL
if (isset($_GET['id']) && array_key_exists($_GET['id'], $secciones)) {
    $id = $_GET['id'];
} else {
    // Redirigir al inicio si el ID no es válido
    header("Location: ejemplo2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección: <?php echo htmlspecialchars($secciones[$id]); ?></title>

    <style>
/* Estilos generales */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('https://certitec.eu/wp-content/uploads/2023/03/OOT.jpg'); /* Ruta de la imagen de fondo */
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: #333;
}

/* Encabezado */
header {
    padding: 20px;
    text-align: center;
    background: rgba(255, 255, 255, 0.5); /* Fondo semitransparente */
    color: #1976D2; /* Color azul */
    border-radius: 10px; /* Bordes redondeados */
}

header h1 {
    margin: 0;
    font-size: 3rem;
    animation: fadeIn 2s ease-in-out;
}

/* Efecto de desvanecimiento */
@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

/* Estilos del contenedor principal */
main {
    padding: 40px;
    text-align: center;
    margin: 20px auto;
    max-width: 900px; /* Ancho máximo para centrar el contenido */
    background: rgba(255, 255, 255, 0.5); /* Fondo semitransparente */
    border-radius: 10px; /* Bordes redondeados */
}

h1, h2, h3 {
    color: #6a82fb; /* Color azul claro para los títulos */
}

h1 {
    font-size: 2.5rem;
}

h2 {
    font-size: 2rem;
    margin-bottom: 20px;
}

p {
    font-size: 1.5rem;
    color: #444; /* Color gris oscuro para los párrafos */
    margin-bottom: 30px;
}

.seccion-contenido {
    text-align: left;
    margin: 20px auto;
    max-width: 800px;
}

ul {
    list-style-type: square;
    margin-left: 20px;
    color: #444;
}

.back-button {
    display: inline-block;
    background-color: #1976D2;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    font-size: 1.1rem;
    border-radius: 5px;
    margin-top: 20px;
}

.back-button:hover {
    background-color: #1565C0;
}

.tema {
    background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco con un poco de transparencia */
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: none; /* Eliminamos las sombras */
}

.tema h3 {
    color: #1976D2;
}
</style>
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($secciones[$id]); ?></h1>
    </header>
    
    <main>
        <div class="seccion-contenido">
            <?php echo $contenidos[$id]; ?>
        </div>
        <a href="ejemplo2.php" class="back-button">Volver al inicio</a>
    </main>
</body>
</html>
