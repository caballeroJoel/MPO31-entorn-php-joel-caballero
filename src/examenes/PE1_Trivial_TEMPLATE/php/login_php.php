<?php

    session_start();

    include "./functions.php";

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $reqLogin = [
            "user" => $_POST['usuari'],
            "passwd" => $_POST['password']
        ];

        $encontrado=false;

        foreach($_SESSION['usuaris'] as $user) {
            if(
                $user['usuari']==$reqLogin["user"] &&
                password_verify($reqLogin['passwd'], $user['password'])
            ) {
                $encontrado=true;
                $userF = $user;
            }
        }

        if($encontrado) {
            $_SESSION["user"] = $userF;
            header('Location: ./../index.php');
            exit;
        } else {                
            $_SESSION['error'] = "noLogin";
            header('Location: ./../login.php');
            exit;
        }

    } else {
        header('Location: ./../index.php');
        exit;
    }