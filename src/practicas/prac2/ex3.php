<?php
    $numrand = rand(0, 100);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Ejercicio 3</title>
    </head>
    <body class="ex3">
        <main>
            <p class="num-rand <?php echo ($numrand % 2 == 0) ? 'par': 'inpar'; ?> ">El numero es el <?=$numrand?></p>

            <p>El numero es <?php echo ($numrand % 2 == 0) ? 'par': 'inpar'; ?></p>
        </main>
    </body>
</html>