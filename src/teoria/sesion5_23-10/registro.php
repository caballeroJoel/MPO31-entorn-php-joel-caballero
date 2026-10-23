<?php

    session_start();

    if($_SERVER['REQUEST_METHOD']=='POST') {
        $_SESSION['user'] = [
            $_POST['usuario'],
            password_hash($_POST['password'], PASSWORD_DEFAULT)
        ];
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="./registro.php" method="POST">
            <label for="usuario">Nombre de usuario:</label>
            <input name="usuario" type="text">
            <label for="password">Contraseña</label>
            <input name="password" type="password">
            <input type="submit">
        </form>

        <a href="./login.php">
            <button>Login</button>
        </a>
        <a href="./inicio.php">
            <button>Inicio</button>
        </a>
    </body>
</html>