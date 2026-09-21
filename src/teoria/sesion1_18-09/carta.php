<?php

    $nombre="Joel";
    $apellidos="Caballero Lucia";
    $edad="21";
    $descripcion="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque lorem urna, efficitur ac ante eu, hendrerit faucibus velit. Aliquam iaculis mi et mauris mattis, ac vestibulum urna dapibus. Aliquam vel interdum nibh, faucibus blandit est. Aenean fringilla, urna eu euismod convallis, arcu est sollicitudin eros, id porttitor nunc urna vel ante.";
    $curso="DAW2";
    $dia="18-09-26";

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <title>Carta</title>
    </head>
    <body>
        <?php
            echo("
                <main class='carta'>
                    <div>
                        <img src='./img/".$nombre.".jfif' alt=''>
                        <div>
                            <h1>".$nombre." ".$apellidos."</h1>
                        </div>
                        <p>".$edad." años</p>
                        <p>".$descripcion."</p>
                        <p>Curso: ".$curso."</p>
                        <p>Dia actual: ".$dia."</p>
                    </div>
                </main>
            ");
        ?>
    </body>
</html>
