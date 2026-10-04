<?php
    $proyectos = [
        [
            "Landing para clínica dental",
            "Landing page moderna y responsive",
            "Web",
            6,
            7,
            "HTML"
        ],
        [
            "Catálogo de productos",
            "Catálogo de productos artesanales",
            "Ecommerce",
            4,
            5,
            "CSS"
        ],
        [
            "Blog corporativo escuela",
            "Blog con noticias y articulos",
            "CMS",
            3,
            2,
            "PHP"
        ],
        [
            "Auditoría responsive",
            "Revision y mejoras de versión móvil",
            "Calidad",
            5,
            8,
            "Docker"
        ],
        [
            "Ficha de servicio con CTA",
            "Pagina de servicio con formulario",
            "Web",
            2,
            4,
            "WordPress"
        ],
        [
            "Galería de proyectos",
            "Galeria filtrable de proyectos",
            "CMS",
            4,
            3,
            "Shopify"
        ],
        [
            "Tienda online básica",
            "Tienda con productos y pagos",
            "Ecommerce",
            8,
            9
        ],
        [
            "Optimización de imágenes",
            "Optimización de imágenes para web",
            "Calidad",
            3,
            6
        ]
    ];

    $tecnologias = [
        ["HTML", "#fa8232"], 
        ["CSS", "#2196F3"], 
        ["PHP", "#530b9c"], 
        ["Docker", "#0e9780"], 
        ["WordPress", "#393f70"], 
        ["Shopify", "#008512"]
    ];

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
                        
                        if($proyect[4] >= 7) {
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
                        
                        $countHoras+=$proyect[3];
                        
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

            <div class="proyectos-activos">
                <div class="cabezera">
                    <div>
                        <h2>Proyectos activos</h2>
                        <p>Lista de proyectos del curso. Cada tarjeta muestra la información principal y su prioridad</p>
                    </div>
                    <select name="" id="">
                        <option value="Ordenar por codigo">Ordenar por codigo</option>
                        <option value="Ordenar por prioridad">Ordenar por prioridad</option>
                        <option value="Ordenar por horas">Ordenar por horas</option>
                    </select>
                </div>
                
                <div class="display-proyectos">
                    <?php
                        $index = 0;
                        foreach($proyectos as $proyect) {
                            $index++;
                            if($proyect[4] >= 7) {
                                $prioridad = "Alta";
                            } else if($proyect[4] >= 4) {
                                $prioridad = "Media";
                            } else {
                                $prioridad = "Baja";

                            }
                        ?>
                            <div class="container">
                                <div class="head">
                                    <div>
                                        <p>#<?=$index?></p>
                                    </div>
                                    <div>
                                        <p><?=$proyect[0]?></p>
                                    </div>
                                    <div class="prori <?=$prioridad?>">
                                        <p><?=$prioridad?></p>
                                    </div>
                                </div>
                                <div class="body">
                                    <div class="img-pr">
                                        <img src="./src/icons-proyects/folder.png" alt="">
                                    </div>
                                    <div class="content">
                                        <div>
                                            <p>Tipo: <?=$proyect[2]?></p>
                                        </div>
                                        <div>
                                            <span><?=$proyect[1]?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="foot">
                                    <div class="time">
                                        <img src="./src/icons-resume/reloj.png" alt="">
                                        <p><?=$proyect[3]?> h</p>
                                    </div>
                                    <div class="prior">
                                        <div class="graf <?=$prioridad?>">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="txt-prior">
                                            <p>Prioridad:</p>
                                            <p><?=$proyect[4]?>/10</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                    
                </div>
                
                <div class="resume">
                    <div class="resume-proyects">
                        <div class="cabe">
                            <div class="graf">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <div class="txt-cabe">
                                <p>Resumen automático</p>
                                <span>Estadisicas generales de los proyectos</span>
                            </div>
                        </div>
                        <div class="resumen">
                            <div class="tarjeta">
                                <div class="imagen">
                                    <img src="./src/icons-resume/folder.png" alt="">
                                </div>
                                <div>
                                    <p><?= count($proyectos) ?></p>
                                    <span>Proyectos totales</span>
                                </div>
                            </div>
                            <hr>
                            <div class="tarjeta">
                                <div class="imagen">
                                    <img src="./src/icons-resume/caution.png" alt="">
                                </div>
                                <div>
                                    <p><?= $countPrior ?></p>
                                    <span>Prioridad alta</span>
                                </div>
                            </div>
                            <hr>
                            <div class="tarjeta">
                                <div class="imagen">
                                    <img src="./src/icons-resume/reloj.png" alt="">
                                </div>
                                <div>
                                    <p><?= $countHoras ?> h</p>
                                    <span>Horas totales</span>
                                </div>
                            </div>
                            <hr>
                            <?php
                                $proyectosWeb=0;

                                foreach($proyectos as $proyect) {
                                    
                                    if($proyect[2] == "Web") {
                                        $proyectosWeb++;
                                    }
                                    
                                }
                            ?>
                            <div class="tarjeta">
                                <div class="imagen">
                                    <img src="./src/icons-resume/web.png" alt="">
                                </div>
                                <div>
                                    <p><?= $proyectosWeb ?></p>
                                    <span>Proyectos web</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tecnologias">
                        <div class="cabe">
                            <div class="imagen">
                                <img src="./src/icons-resume/code.png" alt="">
                            </div>
                            <div class="txt-cabe">
                                <p>Tecnologias</p>
                                <span>Herramientas utilizadas en los proyectos en curso</span>
                            </div>
                        </div>
                        <div class="listados-tecnos">
                            <!-- <div style="background-color: blue;">
                                <p>HTML</p>
                            </div> -->
                            <?php
                                foreach($tecnologias as $tecno) {
                            ?>
                                <div style="background-color: <?=$tecno[1]?>">
                                    <p><?=$tecno[0]?></p>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>

    <script src="./app/app.js"></script>
    <script src="./app/styles.js"></script>
</html>