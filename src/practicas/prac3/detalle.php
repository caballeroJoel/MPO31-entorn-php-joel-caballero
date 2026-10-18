<?php
    require './php/movies.php';

    // echo "<pre>";
    // print_r ($peliculas);
    // echo "</pre>";

    $diaHoy = date('d/m/Y');   

?>

<!DOCTYPE html>
<html lang="en">
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

                <div class="detalle_movie">
                    <h3><?=$mov_select["nombre"]?></h3>

                    <div class="detalles">
                        <div class="portada-trailer">
                            <img src="<?=$mov_select["imagen"]?>" alt="">
                            <a href="./trailer.php?id=<?=$mov_select["id"]?>">
                                <button>TRAILER</button>
                            </a>
                        </div>

                        <div class="contenido">
                            <span><?=$mov_select["sinopsis"]?></span>

                            <p>Duración: <span><?=$mov_select["duracion"]?> mins</span></p>
                            <p>Director: <span><?=$mov_select["director"]?></span></p>
                            <p>Actores: <span><?php 
                                foreach ($mov_select["reparto"] as $actor) {
                                    echo "$actor, ";
                                }
                            ?></span></p>
                            <p>Calificación: <span><?=$mov_select["calificacion"]?></span></p>
                            <p>Genero: <span><?=$mov_select["genero"]?></span></p>

                            <div>
                                <select name="" id="">
                                    <option value=""><?=$diaHoy;?></option>
                                </select>
                            </div>

                            <div class="horarios">
                                <p>ATMOS</p>
                                <div class="hor">
                                    <?php
                                        foreach($mov_select["horarios"] as $hor):    
                                    ?>
                                            <p><?=$hor?></p>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Dolby_Atmos.png?utm_source=es.wikipedia.org&utm_campaign=index&utm_content=original" alt="">
                            </div>

                        </div>
                    </div>

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