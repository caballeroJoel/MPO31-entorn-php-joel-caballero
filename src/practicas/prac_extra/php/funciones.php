<?php

    function cargarTabla($camion) {
        return "
        
            <table>
                <tr>
                    <th>Color</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                </tr>
                <tr>
                    <td>Amarillo</td>
                    <td>Residuos plasticos</td>
                    <td><span>".$camion["amarillo"]."</span>/8</td>
                </tr>
                <tr>
                    <td>Verde</td>
                    <td>Residuos de vidrio</td>
                    <td><span>".$camion["verde"]."</span>/8</td>
                </tr>
                <tr>
                    <td>Azul</td>
                    <td>Papel y carton</td>
                    <td><span>".$camion["azul"]."</span>/8</td>
                </tr>
                <tr>
                    <td>Marron</td>
                    <td>Residuos organicos</td>
                    <td><span>".$camion["marron"]."</span>/8</td>
                </tr>
                <tr>
                    <td>Gris</td>
                    <td>Residuos no reciclables</td>
                    <td><span>".$camion["gris"]."</span>/8</td>
                </tr>
            </table>
    
        ";
    }

    function generarColaInicial($listaMaestra) {
        $cola;

        for ($i = 0; $i < 5; $i++) {
            $key = array_rand($listaMaestra);
            $cola[] = $listaMaestra[$key];
        }

        return $cola;
    }

    function avanzarColaObjetos($listaObj) {
        array_shift($_SESSION['objetos']);
        $key = array_rand($listaObj);
        $_SESSION['objetos'][] = $listaObj[$key]; 
    }