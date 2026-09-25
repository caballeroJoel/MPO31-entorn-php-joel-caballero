<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Ejercicio 1</title>
    </head>
    <body class="ex1">
        <main class="principal">
            <?php for($i=50; $i<=500; $i+=2): ?>
                <div>
                    <p><?= $i?></p>
                </div>
            <?php endfor; ?>
        </main>
    </body>
</html>