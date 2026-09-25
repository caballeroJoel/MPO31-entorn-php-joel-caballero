<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Document</title>
    </head>
    <body class="index">
        <main>
            <h1>Practica 2 - Indice</h1>

            <div class="listado">
                <?php for($i=1; $i<=5; $i++):?>
                    <div>
                        <h2>Ejemplo <?=$i?></h2>
                        <p><a href="./ex<?=$i?>.php">Click para ver el ejemplo <?=$i?></a></p>
                    </div>
                <?php endfor;?>
            </div>

        </main>
    </body>
</html>