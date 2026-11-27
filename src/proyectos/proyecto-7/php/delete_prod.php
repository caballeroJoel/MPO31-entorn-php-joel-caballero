<?php

    require_once __DIR__ . "/db/config.php";
    include_once __DIR__ . "/funcions.php";

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if($_SERVER["REQUEST_METHOD"]=="GET" && $id) {
        try {
            $pdo = db();
        } catch (PDOException $e){
            die("Error de conexion - ". $e->getMessage());
        }

        $stmt = $pdo->prepare("DELETE FROM Productos WHERE IdProducto = :id;");
        $stmt->execute(['id' => $id]);
    }

    header("Location: ./../filtrado_productos.php");
    exit;