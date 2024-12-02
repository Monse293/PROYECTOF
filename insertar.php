insertar: <?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "educativa");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];

// Insertar datos en la tabla
$sql = "INSERT INTO usuarios (nombre) VALUES ('$nombre')";

if ($conexion->query($sql) === TRUE) {
    echo "Usuario agregado correctamente.";
    echo "<br><a href='seccion.php?id=2'>Volver</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?> esta funciona para el pequeño formulario que aparece en la información de base de datos