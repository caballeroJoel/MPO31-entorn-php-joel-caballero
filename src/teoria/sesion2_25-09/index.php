<?php

    // $edad = 18;
    $asigna = 9;

    // if($edad >= 18) {
    //     echo "Eres mayor, puedes pasar";
    // } else {
    //     echo "Eres menor, no puedes";    
    // }

    if($asigna >= 10): ?>
        <p>Repites</p>
    <?php else: ?>
        <p>Pasas</p>
    <?php endif; 


    $bola = 0;

    if($bola==0): ?>
        <p>Bola ha caido en el zero</p>
    <?php elseif($bola % 2==0): ?>
        <p>Numero par</p>
    <?php else: ?>
        <p>Numero inpar</p>
    <?php endif; ?>


<?php 

    for($i=0; $i<5; $i+=2): ?>
        <div>Bloque <?=$i+1?></div>
    <?php endfor;?>


    
    


