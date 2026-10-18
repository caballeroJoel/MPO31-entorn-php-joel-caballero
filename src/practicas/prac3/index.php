<?php
    require './php/movies.php';

    // echo "<pre>";
    // print_r ($peliculas);
    // echo "</pre>";

    $diaHoy = date('d/m/Y');

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
            <div class="banner-main">
                <img src="https://base44.app/api/apps/6a6b932a6515b43d2f69d8d1/files/mp/public/6a6b932a6515b43d2f69d8d1/e1d4eb8a4_banner-cinesenior-ocine.jpg" alt="">
            </div>

            <div class="cartelera">
                <div class="head">
                    <h2>Cartelera OCINE FPLlefia</h2>
                    <div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <div class="content" id="contentCartelera">
                    <?php
                        foreach($peliculas as $movie):
                    ?>
                        <div 
                            id="<?=$movie["id"];?>" 
                            class="movie"
                            style="background-image: url('<?=$movie["imagen"]?>');"    
                        >   
                            <div class="card hidden">
                                <div class="carac-movie">
                                    <h3><?=$movie["nombre"];?></h3>
                                    <p><?= $diaHoy;?></p>
                                    <div class="horarios">
                                        <?php
                                            foreach($movie["horarios"] as $horario):
                                                // echo $horario;
                                        ?>
                                            <a href="">
                                                <div class="hor">
                                                    <?=$horario?>
                                                </div>
                                            </a>
                                        <?php
                                            endforeach;
                                        ?>
                                    </div>
                                </div>
                                <div class="butons">
                                    <a href="./trailer.php?id=<?=$movie["id"];?>"><button>Trailer</button></a>       
                                    <a href="./detalle.php?id=<?=$movie["id"];?>"><button>+ Info</button></a>
                                </div>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    ?>

                </div>
            </div>

        </main>

        <?php require './templates/footer.php'; ?>
        
    </body>
    <script src="./scripts/app.js"></script>
</html>