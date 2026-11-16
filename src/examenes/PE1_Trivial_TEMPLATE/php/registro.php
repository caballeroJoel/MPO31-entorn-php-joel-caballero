<?php

    session_start();

    include "./functions.php";

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $newUser = [
            'username' => $_POST['usuari'],
            'passwd' => $_POST['password'],
            'rpasswd' => $_POST['password2']
        ];

        // mostrarArray($newUser);

        if($newUser['passwd']==$newUser['rpasswd']) {
        
            $repe=false;

            foreach($_SESSION['usuaris'] as $user) {
                if($user['usuari']==$newUser["username"]) {
                    $repe=true;
                }
            }

            if ($repe) {
                $_SESSION['error'] = "existente";
                header('Location: ./../registre.php');
                exit;
            } else {
                if (!empty($_SESSION['usuaris'])) {
                    $t = count($_SESSION['usuaris']);
                    $newId = $_SESSION['usuaris'][$t - 1]['id']+1;
                } else {
                    $newId = 1;
                }

                $user = [
                    "id" => $newId,
                    "usuari" => $newUser["username"],
                    "password" => password_hash( $newUser["passwd"], PASSWORD_DEFAULT ), 
                    "rol" => "jugador"
                ];

                array_push($_SESSION['usuaris'], $user);
                header('Location: ./../login.php');
                exit;

            }

        } else {
            $_SESSION['error'] = "passwd";
            header('Location: ./../registre.php');
            exit;
        }

    } else {
        header('Location: ./../index.php');
        exit;
    }