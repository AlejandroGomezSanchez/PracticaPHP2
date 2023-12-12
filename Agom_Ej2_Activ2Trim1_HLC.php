<?php
session_start();


$tabla_html = isset($_SESSION['tabla_html']) ? $_SESSION['tabla_html'] : "";


unset($_SESSION['tabla_html']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Tabla</title>
    
    <style>
    tr.oficial {
        background-color: #cc0000; 
    }
    tr.jefe_departamento {
        background-color: #33cc33;
    }

    tr.director {
        background-color: #ffcc00; 
    }
    tr.Peon {
        background-color: #3366cc;
    }
    </style>


</head>
<body>
    
    <?php echo $tabla_html; ?>
</body>
</html>