<?php
    require './php/movies.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./styles/sty.css">
        <link rel="stylesheet" href="./styles/colors.css">

        <title>Document</title>
    </head>
    <body>
        
        <?php require './templates/header.php'; ?>

        <main>

            <?php
                $mov_select = buscarPeliculaPorId($peliculas, $_GET["id"]);

                if($mov_select):
            ?>      

                <div class="trailer-movie">
                    <h1><?=$mov_select["nombre"]?></h1>
                    <iframe
                        src="<?=$mov_select["trailer"]?>?autoplay=1&mute=1"
                        title="Tráiler de Interestelar"
                        frameborder="0"
                        allow="autoplay; encrypted-media; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

            <?php
                else:
                    require './templates/error404.php';
                endif;
            ?>

        </main>

        <?php require './templates/footer.php'; ?>
        
    </body>
</html>