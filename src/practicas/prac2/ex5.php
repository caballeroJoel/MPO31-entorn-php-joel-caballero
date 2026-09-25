<?php
    $total=0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Ejercicio 5</title>
    </head>
    <body class="ex5">
        <main>
            <div class="title">
                <h2>Classificación de temperaturas</h2>
            </div>

            <div class="temps">
                <?php for($i=0; $i<7; $i++):
                $num = rand(-10, 50);
                $total+=$num;
                    if($num>25): ?>
                        <div class="calor">
                            <h3><?=$num?>º</h3>
                            <p>Calor</p>
                        </div>
                    <?php elseif($num<10):?>
                        <div class="frio">
                            <h3><?=$num?>º</h3>
                            <p>Frio</p>
                        </div>
                    <?php else:?>
                        <div class="suave">
                            <h3><?=$num?>º</h3>
                            <p>Temperatura suave</p>
                        </div>
                    <?php endif;?>
                <?php endfor; ?>
            </div>
            <div>
                <p>La temperatura media es: <?php $fac=pow(10, 2); echo (floor(($total/7) * $fac)/$fac)?>º</p>
            </div>
        </main>
    </body>
</html>