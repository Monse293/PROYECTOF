<?php
session_start();

// Parámetros de conexión
$servidor = "localhost"; // Nombre del servidor o dirección IP
$usuario = "root";       // Usuario de la base de datos
$password = "";          // Contraseña del usuario
$baseDatos = "juego";   // Nombre de la base de datos
$port= 3310;

// Crear conexión
$conn = new mysqli($servidor, $usuario, $password, $baseDatos ,$port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Mensaje opcional
echo "Conexión exitosa a la base de datos '$baseDatos'.";
// Variables iniciales
$mensaje = "";
$intentos_restantes = $_SESSION['intentos_restantes'] ?? 6;
$progreso = $_SESSION['progreso'] ?? "";
$palabra = $_SESSION['palabra'] ?? "";
$jugador_id = $_SESSION['jugador_id'] ?? null;

// Manejar el registro del jugador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
    $nombre = trim($_POST['nombre']);
    if ($nombre) {
        // Registrar al jugador en la base de datos
        $stmt = $conn->prepare("INSERT INTO jugadores (nombre) VALUES (?)");
        $stmt->bind_param('s', $nombre);
        $stmt->execute();
        $jugador_id = $conn->insert_id;

        // Guardar jugador en la sesión
        $_SESSION['jugador_id'] = $jugador_id;
        $_SESSION['nombre_jugador'] = $nombre;

        // Reiniciar juego para comenzar
        session_unset();
        $_SESSION['jugador_id'] = $jugador_id;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Obtener palabras de la base de datos
if (!$palabra && $jugador_id) {
    $resultado = $conn->query("SELECT palabra FROM palabras");
    $palabras_db = $resultado->fetch_all(MYSQLI_ASSOC);
    $palabra = $palabras_db[array_rand($palabras_db)]['palabra'];
    $progreso = str_repeat('_', strlen($palabra));
    $_SESSION['palabra'] = $palabra;
    $_SESSION['progreso'] = $progreso;
    $_SESSION['intentos_restantes'] = $intentos_restantes;
}

// Manejar la letra ingresada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['letra'])) {
    $letra = strtolower($_POST['letra']);
    if (strpos($palabra, $letra) !== false) {
        // Actualizar progreso si la letra es correcta
        for ($i = 0; $i < strlen($palabra); $i++) {
            if ($palabra[$i] === $letra) {
                $progreso[$i] = $letra;
            }
        }
        $mensaje = "¡Bien hecho! La letra '$letra' está en la palabra.";
    } else {
        // Reducir intentos si la letra es incorrecta
        $intentos_restantes--;
        $mensaje = "¡Incorrecto! La letra '$letra' no está en la palabra.";
    }

    // Actualizar progreso en sesión
    $_SESSION['progreso'] = $progreso;
    $_SESSION['intentos_restantes'] = $intentos_restantes;

    // Verificar condiciones de victoria o derrota
    if ($progreso === $palabra) {
        $mensaje = "¡Felicidades! Adivinaste la palabra '$palabra'.";

        // Registrar partida en la base de datos
        $stmt = $conn->prepare("INSERT INTO partidas (jugador_id, palabra, intentos_restantes, progreso, estado) VALUES (?, ?, ?, ?, 'Ganado')");
        $stmt->bind_param('isis', $jugador_id, $palabra, $intentos_restantes, $progreso);
        $stmt->execute();

        session_destroy(); // Reiniciar juego
    } elseif ($intentos_restantes <= 0) {
        $mensaje = "¡Perdiste! La palabra era '$palabra'.";

        // Registrar partida en la base de datos
        $stmt = $conn->prepare("INSERT INTO partidas (jugador_id, palabra, intentos_restantes, progreso, estado) VALUES (?, ?, ?, ?, 'Perdido')");
        $stmt->bind_param('isis', $jugador_id, $palabra, $intentos_restantes, $progreso);
        $stmt->execute();

        session_destroy(); // Reiniciar juego
    }
}

// Reiniciar juego al agregar palabra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nueva_palabra'])) {
    $nueva_palabra = strtolower(trim($_POST['nueva_palabra']));
    $stmt = $conn->prepare("INSERT INTO palabras (palabra) VALUES (?)");
    $stmt->bind_param('s', $nueva_palabra);
    $stmt->execute();
    $mensaje = "¡Palabra '$nueva_palabra' añadida exitosamente!";
    session_destroy(); // Reiniciar juego para cargar nueva palabra
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego: Ahorcado</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        text-align: center;
        background: linear-gradient(135deg, #1e1e2f, #3a3a5e);
        color: #ffffff;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background: rgba(46, 46, 79, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    h1 {
        font-size: 2.5em;
        margin-bottom: 20px;
        color: #f4b400;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }

    .progreso {
        font-size: 2.5em;
        letter-spacing: 15px;
        margin: 30px 0;
        color: #ffdf70;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
    }

    .mensaje {
        color: #f4b400;
        font-size: 1.5em;
        margin: 20px 0;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
    }

    .ahorcado {
        margin: 30px 0;
    }

    input, button {
        padding: 15px 20px;
        margin: 10px 5px;
        border-radius: 5px;
        border: none;
        font-size: 1rem;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.3);
    }

    input {
        width: 200px;
        background-color: #2e2e4f;
        color: #ffffff;
        text-align: center;
    }

    input::placeholder {
        color: #cccccc;
    }

    button {
        background-color: #5c67d8;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button:hover {
        background-color: #4950b5;
        transform: scale(1.05);
    }

    .form-nueva-palabra {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .form-nueva-palabra label {
        color: #ffdf70;
        font-size: 1.2rem;
    }

    .back-button {
        display: inline-block;
        padding: 15px 30px;
        background-color: #ff7f50;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.2rem;
        cursor: pointer;
        text-decoration: none;
        margin-top: 30px;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background-color: #e0664d;
        transform: scale(1.1);
    }

    @media (max-width: 600px) {
        h1 {
            font-size: 2rem;
        }
        
        .progreso {
            font-size: 2rem;
        }

        input, button {
            width: 100%;
            font-size: 1rem;
        }
    }
</style>

</head>
<body>
    <div class="container">
        <h1>Juego: Ahorcado</h1>

        <?php if (!$jugador_id): ?>
            <form method="POST">
                <label for="nombre">Ingresa tu nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <button type="submit">Iniciar Juego</button>
            </form>
        <?php else: ?>
            <div class="ahorcado">
                <p><strong>Intentos restantes:</strong> <?= $intentos_restantes ?></p>
            </div>

            <div class="progreso">
                <?= htmlspecialchars($progreso) ?>
            </div>

            <?php if ($intentos_restantes > 0 && $progreso !== $palabra): ?>
                <form method="POST">
                    <label for="letra">Ingresa una letra:</label>
                    <input type="text" id="letra" name="letra" maxlength="1" required>
                    <button type="submit">Enviar</button>
                </form>
            <?php endif; ?>

            <?php if ($progreso === $palabra || $intentos_restantes <= 0): ?>
                <form method="POST">
                    <button onclick="window.location.reload()">Volver a jugar</button>
                </form>
            <?php endif; ?>

            <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>

            <form method="POST" class="form-nueva-palabra">
                <label for="nueva_palabra">Añadir nueva palabra:</label>
                <input type="text" id="nueva_palabra" name="nueva_palabra" required>
                <button type="submit">Añadir</button>
            </form>
        <?php endif; ?>
    </div>
    <form method="POST">
    <a href="ejemplo2.php" class="back-button">Volver al inicio</a>
</form>
</body>
</html>
ese es el juego