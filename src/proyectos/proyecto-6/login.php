<?php

    session_start();

    if(isset($_SESSION["player"])) {
        header("Location: ./index.php");
        exit;
    }

    if(!isset($_SESSION["usuarios"])) {
        $_SESSION["usuarios"] = [
            [
                "username" => "",
                "pass" => "",
                "dinero" => 0,
            ],
        ];
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $accion = $_POST["action"];
        
        if($accion == "login") {

            $user = [
                "username" => $_POST["username"],
                "pass" => $_POST["passwd"]
            ];

            $encotrado = false;

            foreach($_SESSION["usuarios"] as $users) {
                if(
                    $users["username"] == $user["username"] &&
                    $users["pass"] == $user["pass"]
                ) {
                    $encotrado=true;
                    $logn=$users;
                    break;
                }
            }

            if($encotrado) {
                $_SESSION["player"] = $logn;
                header("Location: ./index.php");
                exit;

            } else {
                $_SESSION["error"]="nologin";
            }

        } else if($accion == "registro") {
            $user = [
                "username" => $_POST["username"],
                "pass" => $_POST["passwd"],
                "passr" => $_POST["passwdr"]
            ];

            $repe=false;

            foreach($_SESSION["usuarios"] as $users) {
                if($users["username"]==$user["username"]) {
                    $repe=true;
                }
            }


            if($user["pass"]==$user["passr"] && !$repe){

                $newUser = [
                    "username" => $user["username"],
                    "pass" => $user["pass"],
                    "dinero" => 1000,
                ];

                array_push($_SESSION["usuarios"], $newUser);
                $_SESSION["player"]=$newUser;

                header("Location: ./index.php");
                exit();

            }
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./style/main.css">
        <link rel="stylesheet" href="./style/colors.css">

        <title>Document</title>
    </head>
    <body>
        <div class="contenedor">
            <h1>Bienvenido</h1>

            <!-- LOGIN -->
            <form method="POST" action="#">
                <h2>Iniciar sesión</h2>

                <input type="text" name="username" placeholder="Nombre de usuario" required>

                <input type="password" name="passwd" placeholder="Contraseña" required>

                <button type="submit" name="action" value="login">Iniciar sesión</button>
            </form>

            <hr>

            <!-- REGISTRO -->
            <form method="POST" action="#">
                <h2>Crear cuenta</h2>

                <input type="text" name="username" placeholder="Nombre de usuario" required>

                <input type="password" name="passwd" placeholder="Contraseña" required>

                <input type="password" name="passwdr" placeholder="Repetir contraseña" required>

                <button type="submit" name="action" value="registro">Registrarse</button>
            </form>
        </div>
    </body>
</html>