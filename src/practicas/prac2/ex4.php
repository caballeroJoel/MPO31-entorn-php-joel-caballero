<?php
    $numrand = rand(0, 100);
    $primo = true;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Ejercicio 4</title>
    </head>
    <body class="ex4">
        <main>
            <div class="num-selec">
                <h1>El numero es <?=$numrand?></h1>
            </div>

            <div class="divis-num">
                <h2>Los divisores de <?=$numrand?> són:</h2>
                <div>
                    <p>1</p>
                    <?php for($i=2; $i<$numrand; $i++):
                        if($numrand % $i == 0):
                            $primo=false; ?>
                            <p><?=$i?></p>
                        <?php endif;
                    endfor;?>
                    <p><?=$numrand?></p>
                </div>
            </div>

            <div class="primo">
                <h2 class="<?php echo ($primo) ? 'correcto': 'incorrecto'; ?>">El <?=$numrand?> <?php echo ($primo) ? '': 'no'; ?> es un numero primo</h2>
            </div>

        </main>
    </body>
</html>