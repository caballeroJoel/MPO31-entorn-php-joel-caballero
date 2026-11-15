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

    function numerosDeApuesta($apuesta) {
        if (is_array($apuesta)) {
            return array_map('intval', $apuesta);
        }

        return array_values(array_filter(
            array_map('intval', explode(',', (string) $apuesta)),
            static fn ($numero) => $numero >= 0 && $numero <= 36
        ));
    }

    function comprobarApuesta($tipo, $apuesta, $numero, $tablero) {
        $numeros = numerosDeApuesta($apuesta);

        switch ($tipo) {
            case 'numero':
            case 'pleno':
                return count($numeros) === 1 && $numeros[0] === $numero;
            case 'color':
                return count($numeros) === 1 && comprovarColor($apuesta, $numero, $tablero);
            case 'pares':
                return count($numeros) === 1 && comprovarPares($apuesta, $numero);
            case 'caballo':
                return count($numeros) === 2 && in_array($numero, $numeros, true);
            case 'cuadro':
                return count($numeros) === 4 && in_array($numero, $numeros, true);
            case 'docena':
                return count($numeros) === 1 && $numeros[0] >= 1 && $numeros[0] <= 3
                    && $numero > 0 && $numero >= (($numeros[0] - 1) * 12 + 1)
                    && $numero <= ($numeros[0] * 12);
            case 'columna':
                return count($numeros) === 1 && $numeros[0] >= 1 && $numeros[0] <= 3
                    && $numero > 0 && ($numero - $numeros[0]) % 3 === 0;
            case 'pasa':
                return count($numeros) === 1 && $numero > 0
                    && (($numeros[0] === 1 && $numero <= 18)
                        || ($numeros[0] === 2 && $numero >= 19));
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
