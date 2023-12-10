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


    echo "Pedro";
    echo "Email";

?>
    <h1>Alta Datos Empleado</h1>
    <form action="/submit_data" method="post">
        <label for="nombre">Nombre: *</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellidos">Apellidos: *</label>
        <input type="text" id="apellidos" name="apellidos" required>

        <label for="fecha_nacimiento">Fecha de nacimiento: *</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

        <label for="sueldo">Sueldo: *</label>
        <input type="text" id="sueldo" name="sueldo" required>

        <label for="categoria">Categoría: *</label>
        <select id="categoria" name="categoria" required>
            <option value="">-- Elige --</option>
            <option value="peon">Peón</option>
            <option value="oficial">Oficial</option>
            <option value="jefe_departamento">Jefe Departamento</option>
            <option value="director">Director</option>
        </select>

        <label for="sexo">Sexo: *</label>
        <label><input type="radio" id="sexo" name="sexo" value="hombre" required> Hombre</label>
        <label><input type="radio" id="sexo" name="sexo" value="mujer" required> Mujer</label>

        <label for="aficiones">Aficiones: *</label>
        <label><input type="checkbox" id="aficiones" name="aficiones" value="natacion"> Natación</label>
        <label><input type="checkbox" id="aficiones" name="aficiones" value="padel"> Pádel</label>
        <label><input type="checkbox" id="aficiones" name="aficiones" value="leer"> Leer</label>

        <input type="submit" value="ENVIAR">


        <input type="reset" value="LIMPIAR">
    </form>
</body>
</html>