<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Ejercicio 2</title>
    </head>
    <body class="ex2">
        <main>
            <?php for($i=1; $i<=11; $i++):
                
                    $r = rand(100, 250);
                    $g = rand(100, 250);
                    $b = rand(100, 250);

                ?>
                <div style="background-color: rgb(<?=$r?>, <?=$g?>, <?=$b?>);" class="tabla">
                <p>Tabla del <?=$i?></p>
                    <?php for($j=1; $j<=10; $j++) :?>
                        <div class="opera">
                            <p><?=$i?> x <?=$j?> = <?=$i*$j?></p>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </main>
    </body>
</html>