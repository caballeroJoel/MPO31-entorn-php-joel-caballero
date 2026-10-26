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
            alert('No hay usuarios registrados.');
            window.location.href = './../index.php';
        </script>";
        exit;
    }

    $user = $_SESSION['users'];

    if($user['mail']==$_POST["email"] && $user['passwd']==$_POST["password"]) {
        $us=$user;
        $encontrado=true;
    }    

    if(!$encontrado) {
        echo "<script>
            alert('El emailo la contraseña no son corectos.');
            window.location.href = './../index.php';
        </script>";
        exit;
    }

    echo "<script>
        alert('Usuario encontrado!');
        window.location.href = './../inicio_juego.php';
    </script>";
    exit;