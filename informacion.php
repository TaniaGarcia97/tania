<?php
    session_start();

    echo "Tu nombre es:" . $_SESSION["nombre"] . " tu email: " . $_SESSION["email"] . " tu edad es: " . $_SESSION['edad'] . " y tu país es: " . $_SESSION["pais"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información</title>
</head>
<body>
    <a href="formulario.php">Modifica tus datos</a>
</body>
</html>