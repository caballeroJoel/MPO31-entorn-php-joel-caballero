<?php
    $proyectos = [
        [
            "Landing para clínica dental",
            "Web",
            6,
            7,
            "HTML"
        ],
        [
            "Catálogo de productos artesanales",
            "Ecommerce",
            4,
            5,
            "CSS"
        ],
        [
            "Blog corporativo escuela",
            "CMS",
            3,
            2,
            "PHP"
        ],
        [
            "Auditoría responsive",
            "Calidad",
            5,
            8,
            "Docker"
        ],
        [
            "Ficha de servicio con CTA",
            "Web",
            2,
            4,
            "WordPress"
        ],
        [
            "Galería de proyectos",
            "CMS",
            4,
            3,
            "Shopify"
        ],
        [
            "Tienda online básica",
            "Ecommerce",
            8,
            9
        ],
        [
            "Optimización de imágenes",
            "Calidad",
            3,
            6
        ]
    ];

    $tecnologias = ["HTML", "CSS", "PHP", "Docker", "WordPress", "Shopify"];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./styles/color.css">
        <title>Document</title>
    </head>
    <body>
        <header>
            <div class="title">
                <img src="./src/icono.png" alt="">
                <div class="title-names">
                    <h1>Panel interno de proyectos</h1>
                    <h3>Agencia digital · Gestión de proyectos de estudio</h3>
                </div>
            </div>
            <div class="main-menu" id="menuSelector">
                <div class="selected" id="inicio">
                    <img src="./src/icons-menu/home.png" alt="">
                    <p>Inicio</p>
                </div>
                <div class="" id="proyectos">
                    <img src="./src/icons-menu/lista.png" alt="">
                    <p>Proyectos</p>
                </div>
                <div class="" id="tecnos">
                    <img src="./src/icons-menu/stack.png" alt="">
                    <p>Tecnologias</p>
                </div>
                <div class="" id="info">
                    <img src="./src/icons-menu/info.png" alt="">
                    <p>Info</p>
                </div>
            </div>
        </header>
        <main>
            <div class="resume-proyectos">
                <div class="container proyectos">
                    <div>
                        <img src="./src/icons-resume/folder.png" alt="">
                    </div>
                    <div class="content">
                        <p class="list"><?=count($proyectos)?></p>
                        <p>Proyectos</p>
                        <span>Proyectos registrados</span>
                    </div>
                </div>

                <?php
                    $countPrior=0;

                    foreach($proyectos as $proyect) {
                        
                        if($proyect[3] >= 7) {
                            $countPrior++;
                        }
                        
                    }
                ?>
                <div class="container priori">
                    <div>
                        <img src="./src/icons-resume/caution.png" alt="">
                    </div>
                    <div class="content">
                        <p class="list"><?=$countPrior?></p>
                        <p>Prioridad alta</p>
                        <span>Proyectos con prioridad alta  </span>
                    </div>
                </div>

                <?php
                    $countHoras=0;

                    foreach($proyectos as $proyect) {
                        
                        $countHoras+=$proyect[2];
                        
                        
                    }
                ?>
                <div class="container horas">
                    <div>
                        <img src="./src/icons-resume/reloj.png" alt="">
                    </div>
                    <div class="content">
                        <p class="list"><?=$countHoras?> h</p>
                        <p>Horas estimadas</p>
                        <span>Suma total de horas de proyectos</span>
                    </div>
                </div>

                <div class="container tecnos">
                    <div>
                        <img src="./src/icons-resume/code.png" alt="">
                    </div>
                    <div class="content">
                        <p class="list"><?=count($tecnologias)?></p>
                        <p>Tecnologias</p>
                        <span>Tecnologias utilizadas</span>
                    </div>
                </div>
            </div>
        </main>
    </body>

    <script src="./app/app.js"></script>
    <script src="./app/styles.js"></script>
</html>