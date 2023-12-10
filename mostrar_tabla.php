<?php
session_start();

// Obtener la tabla HTML almacenada en la variable de sesión
$tabla_html = isset($_SESSION['tabla_html']) ? $_SESSION['tabla_html'] : "";

// Limpiar la variable de sesión
unset($_SESSION['tabla_html']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Tabla</title>
    <!-- Puedes incluir tu CSS aquí si es necesario -->
</head>
<body>
    <!-- Mostrar la tabla HTML -->
    <?php echo $tabla_html; ?>
</body>
</html>