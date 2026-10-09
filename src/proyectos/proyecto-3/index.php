<?php
    $asignaturas = [
        "php" => [
            "id" => "php",
            "nombre" => "PHP",
            "color" => "#006eff",
        ],
        "js" => [
            "id" => "js",
            "nombre" => "JavaScript",
            "color" => "#ccb717",
        ],
        "react" => [
            "id" => "react",
            "nombre" => "React",
            "color" => "#61dafb",
        ],
        "html-css" => [
            "id" => "html-css",
            "nombre" => "HTML/CSS",
            "color" => "#699248",
        ],
        "docker" => [
            "id" => "docker",
            "nombre" => "Docker",
            "color" => "#7d338b",
        ],
        "bbdd" => [
            "id" => "bbdd",
            "nombre" => "BBDD",
            "color" => "#911b1b",
        ],
        "proyectos" => [
            "id" => "proyectos",
            "nombre" => "Proyectos",
            "color" => "#96198f",
        ]
    ];
    
    $chuleta = [
        [
            "titulo" => "Variables",
            "desc" => "Sirven para almacenar datos que pueden cambiar durante la ejecución del programa.",
            "img" => "variables",
            "asigna" => "php"
        ],
        [
            "titulo" => "Arrays",
            "desc" => "Permiten almacenar varios valores dentro de una misma variable.",
            "img" => "arrays",
            "asigna" => "php"
        ],
        [
            "titulo" => "Funciones",
            "desc" => "Bloques de código reutilizables que realizan una tarea concreta.",
            "img" => "funciones",
            "asigna" => "php"
        ],
        [
            "titulo" => "POO",
            "desc" => "Paradigma que organiza el código mediante clases y objetos.",
            "img" => "poo",
            "asigna" => "php"
        ],
        [
            "titulo" => "Fetch",
            "desc" => "Permite realizar peticiones HTTP desde JavaScript de forma asíncrona.",
            "img" => "fetch",
            "asigna" => "js"
        ],
        [
            "titulo" => "DOM",
            "desc" => "Representación del documento HTML que JavaScript puede consultar y modificar.",
            "img" => "dom",
            "asigna" => "js"
        ],
        [
            "titulo" => "Arrow Functions",
            "desc" => "Sintaxis abreviada para definir funciones en JavaScript.",
            "img" => "arrow-functions",
            "asigna" => "js"
        ],
        [
            "titulo" => "Destructuring",
            "desc" => "Permite extraer valores de arrays u objetos y guardarlos en variables.",
            "img" => "destructuring",
            "asigna" => "js"
        ],
        [
            "titulo" => "Componentes",
            "desc" => "Son piezas reutilizables de la interfaz que encapsulan estructura y comportamiento.",
            "img" => "componentes",
            "asigna" => "react"
        ],
        [
            "titulo" => "Props",
            "desc" => "Permiten pasar información de un componente padre a uno hijo.",
            "img" => "props",
            "asigna" => "react"
        ],
        [
            "titulo" => "useState",
            "desc" => "Hook que permite crear y modificar estado dentro de un componente.",
            "img" => "use-state",
            "asigna" => "react"
        ],
        [
            "titulo" => "useEffect",
            "desc" => "Hook utilizado para ejecutar efectos secundarios en componentes.",
            "img" => "use-effect",
            "asigna" => "react"
        ],
        [
            "titulo" => "Flexbox",
            "desc" => "Sistema de CSS para distribuir y alinear elementos de forma flexible.",
            "img" => "flexbox",
            "asigna" => "html-css"
        ],
        [
            "titulo" => "Grid",
            "desc" => "Sistema de CSS que permite crear diseños mediante filas y columnas.",
            "img" => "grid",
            "asigna" => "html-css"
        ],
        [
            "titulo" => "Semántica HTML",
            "desc" => "Uso de etiquetas que describen el significado del contenido, como header, main, nav o footer.",
            "img" => "html-semantico",
            "asigna" => "html-css"
        ],
        [
            "titulo" => "Docker Compose",
            "desc" => "Permite definir y ejecutar aplicaciones formadas por varios contenedores.",
            "img" => "docker-compose",
            "asigna" => "docker"
        ],
        [
            "titulo" => "Contenedores",
            "desc" => "Entornos aislados que contienen una aplicación y sus dependencias.",
            "img" => "contenedores",
            "asigna" => "docker"
        ],
        [
            "titulo" => "SELECT",
            "desc" => "Consulta SQL utilizada para obtener datos de una o varias tablas.",
            "img" => "select",
            "asigna" => "bbdd"
        ],
        [
            "titulo" => "JOIN",
            "desc" => "Permite combinar datos de diferentes tablas utilizando una relación entre ellas.",
            "img" => "join",
            "asigna" => "bbdd"
        ],
        [
            "titulo" => "Git",
            "desc" => "Sistema de control de versiones que permite registrar y gestionar los cambios de un proyecto.",
            "img" => "git",
            "asigna" => "proyectos"
        ]
    ];

    $contador_Asign = [
        "php" => 0,
        "js" => 0,
        "react" => 0,
        "html-css" => 0,
        "docker" => 0,
        "bbdd" => 0,
        "proyectos" => 0,
    ];

    $cont=0;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/styles.css">
        <link rel="stylesheet" href="./style/color.css">
        <title>Document</title>
    </head>
    <body>
        <header>
            <div>
                <div class="title">
                    <img src="/sources/code.png" alt="">
                    <h1>Chuleta DAW2</h1>
                </div>
                <div class="menu">
                    <div class="selected">
                        <p>Inicio</p>
                    </div>
                    <div>
                        <p>Conceptos</p>
                    </div>
                    <div>
                        <p>Resumen</p>
                    </div>
                </div>
            </div>
        </header>
        <div class="subheader">
            <div>
                <div>
                    <div class="title">
                        <h1>Chuleta digital DAW2</h1>
                        <p>Conceptos claves de DAW2, en un único lugar</p>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>
        <main>
            <div>
                <div class="asignaturas">
                    <div class="asignatura selected" style="background-color: var(--color-bck-gr-2);">
                        <p>Todas</p>    
                    </div>
                    <?php foreach($asignaturas as $asignatura): ?>
                        <div class="asignatura" style="background-color: color-mix(in srgb, <?= $asignatura['color'] ?> 60%, white);">
                            <p style="color: color-mix(in srgb, <?= $asignatura['color'] ?> 60%, black);"><?= $asignatura['nombre'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="conceptos">
                    <?php 
                        foreach($chuleta as $concepto): 
                            $contador_Asign[$concepto["asigna"]]++;
                            if($contador_Asign[$concepto["asigna"]]<=2):

                    ?>
                                <div class="concepto" style="background-color: color-mix(in srgb, <?= $asignaturas[$concepto['asigna']]['color'] ?> 60%, white);">
                                    <div class="title">
                                        <img src="/sources/asigna/<?= $concepto['asigna'] ?>.png" alt="">
                                        <span style="color: color-mix(in srgb, <?= $asignaturas[$concepto['asigna']]['color'] ?> 75%, black);"><?= $asignaturas[$concepto['asigna']]['nombre'] ?></span>
                                    </div>
                                    <div class="content">
                                        <div class="info">
                                            <h2><?= $concepto['titulo'] ?></h2>
                                            <p><?= $concepto['desc'] ?></p>
                                            <img src="/sources/conceptos/<?=$concepto['img'] ?>.png" alt="">
                                        </div>
                                    </div>
                                </div>
                    <?php
                                $cont++;
                            endif;
                        if($cont==8) {
                            break;
                        }
                        endforeach; 
                    ?>

                </div>

                <div class="resumenes">
                    <div class="res-conceptos">
                        <div class="conc-separados">
                            <div class="title">
                                <img src="/sources/grafico.png" alt="">
                                <p>Resumen de conceptos</p>
                            </div>
                            <div class="listado">
                                <ul>
                                    <?php
                                        $contador = [];

                                        foreach ($chuleta as $item) {
                                            $asignatura = $item["asigna"];

                                            if (!isset($contador[$asignatura])) {
                                                $contador[$asignatura] = [
                                                    "nombre" => $asignatura,
                                                    "cantidad" => 0
                                                ];
                                            }

                                            $contador[$asignatura]["cantidad"]++;
                                        }

                                        // echo "<pre>";
                                        // var_dump($contador);
                                        // echo "</pre>";

                                        foreach($contador as $as):
                                    ?>
                                        <li>
                                            <div>
                                                <div class="circ" style="background-color: <?= $asignaturas[$as["nombre"]]['color'] ?>;"></div>
                                                <span><?=$asignaturas[$as['nombre']]["nombre"]?></span>
                                            </div>
                                            <p><?=$as["cantidad"]?></p>
                                        </li>
                                    <?php 
                                        endforeach; 
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="total-conc">
                            <span>Total de conceptos</span>
                            <p><?= count($chuleta) ?></p>
                        </div>
                    </div>

                    <div class="asignaturas">
                        <div>
                            <div class="title">
                                <img src="/sources/libro.png" alt="">
                                <p>Asignaturas</p>
                            </div>
                            <div class="listado-asgin">
                                <?php
                                    foreach($asignaturas as $as):
                                ?>
                                    <div class="doc" style="background-color: color-mix(in srgb, <?=$as["color"]?> 65%, white)">
                                        <p><?=$as["nombre"]?></p>
                                    </div>
                                <?php
                                    endforeach;
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="destacados">
                        <div>
                            <div class="title">
                                <img src="/sources/diana.png" alt="">
                                <p>Conceptos destacados</p>
                            </div>
                            <div class="listado">
                                <ul>
                                    <?php
                                        $cont=0;
                                        foreach($chuleta as $chu):
                                    ?>
                                            <li>
                                                <img src="/sources/estrella.png" alt="">
                                                <p><?=$chu["titulo"]?></p>
                                            </li>
                                    <?php
                                        $cont++;
                                        if($cont==5) {
                                            break;
                                        }
                                        endforeach;
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>