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
                    <?php foreach($chuleta as $concepto): ?>
                        <div class="concepto" style="background-color: color-mix(in srgb, <?= $asignaturas[$concepto['asigna']]['color'] ?> 60%, white);">
                            <div class="title">
                                <img src="/sources/asigna/<?= $concepto['asigna'] ?>.png" alt="">
                                <span style="color: color-mix(in srgb, <?= $asignaturas[$concepto['asigna']]['color'] ?> 75%, black);"><?= $asignaturas[$concepto['asigna']]['nombre'] ?></span>
                            </div>
                            <div class="content">
                                <div class="info">
                                    <h2><?= $concepto['titulo'] ?></h2>
                                    <p><?= $concepto['desc'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </main>
    </body>
</html>