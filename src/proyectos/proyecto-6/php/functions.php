<?php
    function girarRuleta() {
        return rand(0, 36);
    }

    function comprovarColor($apuestaUser, $numPartida, $numeros) {
        return $apuestaUser == $numeros[$numPartida]["color"];
    }

    function comprovarPares($apuestaUser, $numPartida) {

        if ($numPartida == 0) {
            return false;
        }

        if ($apuestaUser == "par") {
            return $numPartida % 2 == 0;
        }

        if ($apuestaUser == "impar") {
            return $numPartida % 2 != 0;
        }

        return false;
    }

    function ganancias($apuestaInicial, $tipo, $genApuestas) {
        return $apuestaInicial * $genApuestas[$tipo];
    }

    function mostrarArray($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }