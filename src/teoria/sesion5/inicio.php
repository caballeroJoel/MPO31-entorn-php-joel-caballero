<?php
    session_start();

    if($_SERVER['REQUEST_METHOD']!='POST') {
        header('Location: ./registro.php');
        exit;
    }
    if(!isset($_SESSION['user'])) {
        
        header('Location: ./registro.php');
        exit;
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
    <?php
        if($_SESSION['user'][0]==$_POST['usuario'] && password_verify($_POST['password'], $_SESSION['user'][1]) ):
        ?>
            <h1>Bienvenido al Login <?=$_SESSION['user'][0]?></h1>
            <p>Tu contraseña es: <?=$_SESSION['user'][1]?></p>
        <?php
        else:
        ?>
            <p>Contraseña incorrecta</p>
            <p>Intentalo de nuevo</p>
            <a href="./login.php"><button>Login</button></a>
        <?php
        endif;
    ?>
</body>
</html>