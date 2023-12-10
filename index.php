<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Datos Empleado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="reset"] {
            width: 100%;
            padding: 10px;
            background-color: #ff0000;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="reset"]:hover {
            background-color: #cc0000;
        }

        form {
            max-width: 600px;
            margin: 0 auto;


        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $sueldo = $_POST["sueldo"];

    if (empty($nombre) || empty($apellidos) || empty($fecha_nacimiento) || empty($sueldo)) {
        echo "<p style='color: red;'>Todos los campos son obligatorios.</p>";
    } else {
        // Validar el nombre
        if (!preg_match("/^[a-zA-Z]+(?:-[a-zA-Z]+)?$/", $nombre) || strlen($nombre) < 3) {
            echo "<p style='color: red;'>El nombre debe tener al menos 3 letras en la palabra, no se permiten números ni caracteres especiales, al menos una palabra.</p>";
        } else {
            // Validar los apellidos
            if (!preg_match("/^[a-zA-Z]+(?:-[a-zA-Z]+)?(\s[a-zA-Z]+(?:-[a-zA-Z]+)?)?$/", $apellidos) || substr_count($apellidos, ' ') < 1) {
                echo "<p style='color: red;'>Los apellidos deben constar de al menos dos palabras, cumpliendo los mismos requerimientos que el nombre.</p>";
            } else {
                // Validar la fecha de nacimiento
                $fecha_actual = new DateTime();
                $fecha_nacimiento_obj = DateTime::createFromFormat('d/m/Y', $fecha_nacimiento);
                
                if (!$fecha_nacimiento_obj || $fecha_nacimiento_obj > $fecha_actual || $fecha_nacimiento_obj < new DateTime('1950-01-01')) {
                    echo "<p style='color: red;'>La fecha de nacimiento no es válida o el empleado no tiene al menos 18 años.</p>";
                } elseif (!preg_match("/^[0-9]+$/", $sueldo)) {
                    echo "<p style='color: red;'>El campo de sueldo solo debe contener letras.</p>";
                } else {
                    // Puedes realizar otras validaciones aquí si es necesario

                    // Si todo está bien, puedes procesar los datos o redirigir a otra página
                    echo "<p style='color: green;'>Datos enviados correctamente.</p>";
                }
            }
        }
    }
}
?>





    <h1>Alta Datos Empleado</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="nombre">Nombre: *</label>
        <input type="text" id="nombre" name="nombre" >

        <label for="apellidos">Apellidos: *</label>
        <input type="text" id="apellidos" name="apellidos" >

        <label for="fecha_nacimiento">Fecha de nacimiento: *</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" >

        <label for="sueldo">Sueldo: *</label>
        <input type="text" id="sueldo" name="sueldo" >

        <label for="categoria">Categoría: *</label>
        <select id="categoria" name="categoria" >
            <option value="">-- Elige --</option>
            <option value="peon">Peón</option>
            <option value="oficial">Oficial</option>
            <option value="jefe_departamento">Jefe Departamento</option>
            <option value="director">Director</option>
        </select>

        <label for="sexo">Sexo: *</label>
        <label><input type="radio" id="sexo" name="sexo" value="hombre" > Hombre</label>
        <label><input type="radio" id="sexo" name="sexo" value="mujer" > Mujer</label>

        <label for="aficiones">Aficiones: *</label>
        <label><input type="checkbox" id="aficiones" name="aficiones" value="natacion"> Natación</label>
        <label><input type="checkbox" id="aficiones" name="aficiones" value="padel"> Pádel</label>
        <label><input type="checkbox" id="aficiones" name="aficiones" value="leer"> Leer</label>

        <input type="submit" value="ENVIAR">


        <input type="reset" value="LIMPIAR">
    </form>
</body>
</html>