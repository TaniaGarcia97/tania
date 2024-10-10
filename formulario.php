<?php
    $nombre = $email = $edad = $pais = '';
    $error_nombre = $error_email = $error_edad = $error_pais = False;
    $errores = '';

    if (!empty($_POST['paso'])) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $edad = $_POST['edad'];
        $pais = $_POST['pais'];

        if (empty($nombre)) {
            $errores .= "<span class=\"error\">¡ERROR! No se ha enviado ningún nombre. <br></span>";
            $error_nombre = True;
        } else if (strlen($nombre) < 5) {
            $errores .= "<span class=\"error\">¡ERROR! El nombre debe contener más de 5 caracteres. <br></span>";
            $error_nombre = True;
        } else if (!preg_match("/^[A-Z]{1}[a-z]+/", $nombre)) {
            $errores .= "<span class=\"error\">¡ERROR! El nombre debe comenzar con mayúscula. <br></span>";
            $error_nombre = True;
        }

        if (empty($email)) {
            $errores .= "<span class=\"error\">¡ERROR! No se ha enviado ningún email. <br></span>";
            $error_email = True;
        } else if (!preg_match("/^[\w.-_]+@[\w.-_]+\.[a-z]{2,4}/i", $email)) {
            $errores .= "<span class=\"error\">¡ERROR! El email " . $email . " no tiene un formato válido. <br></span>";
            $error_email = True;
        }

        if (empty($edad)) {
            $errores .= "<span class=\"error\">¡ERROR! No se ha enviado ninguna edad. <br></span>";
            $error_edad = True;
        } else if (!preg_match("/[\d]{1,2}/", $edad)) {
            $errores .= "<span class=\"error\">¡ERROR! La edad debe tener entre 1 y 2 dígitos. <br></span>";
            $error_edad = True;
        } else if ($edad <= 0) {
            $errores .= "<span class=\"error\">¡ERROR! La edad debe ser mayor de 0. <br></span>";
            $error_edad = True;
        }

        if ($pais == '') {
            $errores .= "<span class=\"error\">¡ERROR! Debe escoger un país. <br></span>";
            $error_pais = True;
        }

        if (empty($errores)) {
            session_start();
            $_SESSION["nombre"] = $nombre;
            $_SESSION['email'] = $email;
            $_SESSION['edad'] = $edad;
            $_SESSION['pais'] = $pais;
            header("location: informacion.php");
            exit();
        } else {
            if ($error_nombre) 
                $error_nombre = 'error_nombre';
            
            if ($error_email) 
                $error_email = 'error_email';
            
            if ($error_edad)
                $error_edad = 'error_edad';

            if ($error_pais)
                $error_pais = 'error_pais';
        }

    } 

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <style type"text/css">
        .error_nombre, .error_email, .error_edad, .error_pais {
            color: #ff0000;
            font-weight: bold;
        }
        .error, .ok {
            font-weight: bold;
            color: #fff;
        }
        .error {
            background: #ff0000;
        }
        .ok {
            background: #00ff00;
        }
    </style>
</head>
<body>
    <? echo $errores; ?>
    <form action="formulario.php" method="POST">
        <input type="hidden" name="paso" value="1">
        <p>
            <label for="nombre" class="<?php echo $error_nombre; ?>">Nombre: </label>
            <input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre" value="<? echo $nombre ?>">
        </p>
        <p>
            <label for="email" class="<?php echo $error_email; ?>">Email: </label>
            <input type="email" name="email" id="email" placeholder="Introduce tu email" value="<? echo $email ?>">
        </p>
        <p>
            <label for="edad" class="<?php echo $error_edad; ?>">Edad: </label>
            <input type="number" name="edad" id="edad" placeholder="Introduce tu edad" value="<? echo $edad ?>">
        </p>
        <p> 
            <select name="pais" id="pais" class="<?php echo $error_pais; ?>">
                <option value="">Escoge un país</option>
                <option value="España">España</option>
                <option value="Francia">Francia</option>
                <option value="Alemania">Alemania</option>
                <option value="China">China</option>
                <option value="Irlanda">Irlanda</option>
            </select>
        </p>
        <input type="submit" value="Enviar">
    </form>
    
</body>
</html>