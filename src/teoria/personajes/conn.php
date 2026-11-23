<?php
    require_once('./config.php');

    
    try {
        $pdo = db();
    } catch (PDOException $e){
        die("Error de conexion - ". $e->getMessage());
    }

    $sql = "
        SELECT *
        FROM videojocs
    ";

    $stmt = $pdo->query($sql);
    $videojocs = $stmt->fetchAll();

    echo "<pre>";
    print_r($videojocs);
    echo "</pre>";

    echo "<table border=1>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Genere</th>
        </tr>";

    foreach($videojocs as $peso) {
        ?>
            <tr>
                <td><?=$peso["id"]?></td>
                <td><?=$peso["nom"]?></td>
                <td><?=$peso["genere"]?></td>
            </tr>
        <?
    }
    
    echo "</table>";