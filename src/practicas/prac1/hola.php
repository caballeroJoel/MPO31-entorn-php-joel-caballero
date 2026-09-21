<?php

    $aboutme = "Me llamo Joel Caballero y soy una persona a la que le gusta disfrutar de diferentes hobbies, pero sobre todo de la música, el deporte y la informática. Juego a voleibol hace ya 2-3 años, es un deporte que adoro entre otros porque además de mantenerme activo, me despeja la cabeza cunado lo necesito y me hace sentir bien. Entre semana, de lunes a viernes por las mañanas, trabajo como informático en TUSGSAL, la empresa de autobuses de Badalona, donde voy aprendiendo y ganando experiencia en el mundo de la informática.<br><br>De cara al futuro, uno de mis principales objetivos es llegar a ser desarrollador Full Stack y poder trabajar en alguna empresa extranjera. Me gustaría tener la oportunidad de trabajar en otro entorno, seguir aprendiendo, mejorar como profesional y conseguir un buen sueldo. Además, me está empezando a gustar mucho el mundo de los DJ y tengo pensado comprarme muy pronto una mesa de mezclas para empezar a practicar. Soy una persona con ganas de aprender, mejorar y conseguir poco a poco todo lo que me propongo.";

    // phpInfo();

    function miNombre() {
        return "Joel Caballero Lucia";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Document</title>
    </head>
    <body>
        <header>
            <div>
                <img src="./img/fpllefia.png" alt="">
            </div>
            <div>
                <h1>MOP31. Pp01 1. Primers passos a PHP</h1>
            </div>
        </header>

        <main>
            <div>
                <div class="measf">
                    <img src="./img/joel.jpg" alt="">
                    <h2><?php miNombre()?></h2>
                </div>
                <div class="aboutme">
                    <p><?=$aboutme?></p>
                </div>
            </div>
        </main>

        <footer>
            <h4><?php echo miNombre()?></h4>
            <p>La fecha de hoy es: <?=date("d/m/Y")?></p>
        </footer>

    </body>
</html>