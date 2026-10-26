<?php
    session_start();

    if($_SERVER['REQUEST_METHOD']!="POST") {
        echo "<script>
            alert('ERROR. Error al enviar el formulario');
            window.location.href = './../index.php';
        </script>";
        exit;
    }

    if(!isset($_SESSION['users'])) {
        echo "<script>
            alert('Debes iniciar sesión.');
            window.location.href = './../index.php';
        </script>";
        exit;
    }

    $_SESSION['users']['nivel'] = $_POST['dificultad'];
    $_SESSION['users']['room'] = 1;

    // print_r($_SESSION['users']);

    echo "<script>
        alert('Dificultad ajustada!');
        window.location.href = './../rooms/room1.php';
    </script>";
    exit;