<?php
    session_start();

    if($_SERVER['REQUEST_METHOD']!="POST") {
        echo "<script>
            alert('ERROR. Error al enviar el formulario');
            window.location.href = './../index.php';
        </script>";
        exit;
    }

    $user = [
        "username" => $_POST['name'],
        "mail" => $_POST['email'],
        "passwd" => $_POST['password'],
        "nivel" => "",
        "room" => "1",
    ];

    $_SESSION['users'] = $user;

    echo "<script>
        alert('Usuario creado correctaemnte');
        window.location.href = './../inicio_juego.php';
    </script>";
    exit;
