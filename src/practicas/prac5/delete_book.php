<?php
require_once 'functions.php';
exigirAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    if ($id !== false && $id !== null) {
        eliminarLibro($id);
    }
}
header('Location: home.php');
exit;
