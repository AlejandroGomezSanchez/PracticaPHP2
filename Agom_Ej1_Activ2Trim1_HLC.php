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

        input[type="text"],
        input[type="date"],
        select {
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

        label.checkbox {
            display: inline-block;
            margin-right: 10px;
        }
        tr.Peon {
        background-color: #3366cc; 
    }

    tr.oficial {
        background-color: #cc0000; 
        }

    tr.jefe_departamento {
        background-color: #33cc33; 
    }

    tr.director {
        background-color: #ffcc00; 
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
        $categoria = $_POST["categoria"];
        $sexo = $_POST["sexo"];
        $aficiones = $_POST["aficiones"];

        $empleado = array(
            "nombre" => $nombre,
            "apellidos" => $apellidos,
            "fecha_nacimiento" => $fecha_nacimiento,
            "sueldo" => $sueldo,
            "categoria" => $categoria,
            "sexo" => $sexo,
            "aficiones" => $aficiones

        );


        $sexo = isset($_POST["sexo"]) ? $_POST["sexo"] : "";

        if (empty($nombre) || empty($apellidos) || empty($fecha_nacimiento) || empty($sueldo) || empty($categoria)) {
            echo "<p style='color: red;'>Todos los campos son obligatorios.</p>";
        } else {
            
            if (!preg_match("/^[a-zA-Z]+(?:-[a-zA-Z]+)?$/", $nombre) || strlen($nombre) < 3) {
                echo "<p style='color: red;'>El nombre debe tener al menos 3 letras en la palabra, no se permiten números ni caracteres especiales, al menos una palabra.</p>";
            } else {
                
                if (!preg_match("/^[a-zA-Z]+(?:-[a-zA-Z]+)?(\s[a-zA-Z]+(?:-[a-zA-Z]+)?)?$/", $apellidos) || substr_count($apellidos, ' ') < 1) {
                    echo "<p style='color: red;'>Los apellidos deben constar de al menos dos palabras, cumpliendo los mismos requerimientos que el nombre.</p>";
                } elseif (!preg_match("/^[0-9]+$/", $sueldo)) {
                    echo "<p style='color: red;'>El campo de sueldo solo debe contener números.</p>";
                } else {
                    
                    $fecha_nacimiento_timestamp = strtotime($fecha_nacimiento);
                    $edad_minima_timestamp = strtotime('1950-01-01');
                    $fecha_actual = date('Y-m-d');
                    $fechaMaxima = strtotime($fecha_actual) - 18 * 365 * 24 * 60 * 60; // 18 años en segundos

                    if ($fecha_nacimiento_timestamp > $edad_minima_timestamp && $fecha_nacimiento_timestamp < $fechaMaxima) {
                        
                        $sueldo_minimo = 0;
                        $sueldo_maximo = 0;

                        switch ($categoria) {
                            case 'peon':
                                $sueldo_minimo = 600;
                                $sueldo_maximo = 1200;
                                break;
                            case 'oficial':
                                $sueldo_minimo = 900;
                                $sueldo_maximo = 1500;
                                break;
                            case 'jefe_departamento':
                                $sueldo_minimo = 1400;
                                $sueldo_maximo = 2500;
                                break;
                            case 'director':
                                $sueldo_minimo = 2000;
                                $sueldo_maximo = 3000;
                                break;
                            default:
                                echo "<p style='color: red;'>Categoría de empleado no válida.</p>";
                                return;
                        }

                        if ($sueldo >= $sueldo_minimo && $sueldo <= $sueldo_maximo) {
                            
                            echo "<p style='color: green;'>Datos enviados correctamente.</p>";

                            
if (file_exists('Agom_ArchEmpl_Activ2Trim1_HLC.json')) {
    $empleadosJson = file_get_contents('empleados.json');
    $empleados = json_decode($empleadosJson, true);
} else {
    $empleados = [];
}


$empleados[] = $empleado;


$empleadosJson = json_encode($empleados);


file_put_contents('Agom_ArchEmpl_Activ2Trim1_HLC.json', $empleadosJson);

                            $tabla_html = "
                            <table border='1'>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Sueldo</th>
                                <th>Categoría</th>
                                <th>Sexo</th>
                                <th>Aficiones</th>
                            </tr>";

                            
                            $totalSal = 0;
                            $cont = 0;
                            foreach ($empleados as $empleado) {
                                $cont = $cont+1;
                                $nombre = $empleado['nombre'];
                                $apellidos = $empleado['apellidos'];
                                $fecha_nacimiento = $empleado['fecha_nacimiento'];
                                $sueldo = $empleado['sueldo'];
                                $categoria = $empleado['categoria'];
                                $sexo = $empleado['sexo'];
                                $aficiones = $empleado['aficiones'];
                                $totalSal += $sueldo;
                                
                                $clase_css = '';
                            
                                switch ($categoria) {
                                    case 'peon':
                                        $clase_css = 'Peon';
                                        break;
                                    case 'oficial':
                                        $clase_css = 'oficial';
                                        break;
                                    case 'jefe_departamento':
                                        $clase_css = 'jefe_departamento';
                                        break;
                                    case 'director':
                                        $clase_css = 'director';
                                        break;
                                    default:
                                        echo "<p style='color: red;'>Categoría de empleado no válida.</p>";
                                        return;
                                }
                            
                                $tabla_html .= "
                                    <tr class='$clase_css'>
                                        <td>$nombre</td>
                                        <td>$apellidos</td>
                                        <td>$fecha_nacimiento</td>
                                        <td>$sueldo</td>
                                        <td>$categoria</td>
                                        <td>$sexo</td>
                                        <td>$aficiones</td>
                                    </tr>";
                                    
                            }

                            $mediaSal = $totalSal / $cont;
                            $tabla_html .= "<tr>
                                                <td>Suma de salarios:</td>
                                                <td>$totalSal</td>
                                                <td>Media de salarios:</td>
                                                <td>$mediaSal</td>
                                                </tr>";  
                            $tabla_html .= "</table>";


                            
                            session_start();
                            $_SESSION['tabla_html'] = $tabla_html;

                            
                            header("Location: Agom_Ej2_Activ2Trim1_HLC.php");
                            exit();

                            
                        } else {
                            echo "<p style='color: red;'>El sueldo debe estar entre $sueldo_minimo y $sueldo_maximo para la categoría seleccionada.</p>";
                        }
                    } else {
                        echo "<p style='color: red;'>La fecha de nacimiento debe ser posterior a 1950 y el empleado debe tener más de 18 años.</p>";
                    }
                }
            }
        }
    }




    ?>








    <h1>Alta Datos Empleado</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nombre">Nombre: *</label>
        <input type="text" id="nombre" name="nombre">

        <label for="apellidos">Apellidos: *</label>
        <input type="text" id="apellidos" name="apellidos">

        <label for="fecha_nacimiento">Fecha de nacimiento: *</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">

        <label for="sueldo">Sueldo: *</label>
        <input type="text" id="sueldo" name="sueldo">

        <label for="categoria">Categoría: *</label>
        <select id="categoria" name="categoria">
            <option value="">-- Elige --</option>
            <option value="peon">Peón</option>
            <option value="oficial">Oficial</option>
            <option value="jefe_departamento">Jefe Departamento</option>
            <option value="director">Director</option>
        </select>

        <label for="sexo">Sexo: *</label>
        <label><input type="radio" id="sexo" name="sexo" value="hombre"> Hombre</label>
        <label><input type="radio" id="sexo" name="sexo" value="mujer"> Mujer</label>

        <label for="aficiones">Aficiones: *</label>
        <label class="checkbox"><input type="checkbox" id="aficiones" name="aficiones" value="Deportes"> Deportes</label>
        <label class="checkbox"><input type="checkbox" id="aficiones" name="aficiones" value="Lectura"> Lectura</label>
        <label class="checkbox"><input type="checkbox" id="aficiones" name="aficiones" value="Musica"> Musica</label>
        <label class="checkbox"><input type="checkbox" id="aficiones" name="aficiones" value="Cine"> Cine</label>
        <label class="checkbox"><input type="checkbox" id="aficiones" name="aficiones" value="Idiomas"> Idiomas</label>

        <input type="submit" value="ENVIAR">


        <input type="reset" value="LIMPIAR">
    </form>
</body>

</html>