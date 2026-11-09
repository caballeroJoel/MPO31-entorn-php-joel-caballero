<?php

    require "./php/functions.php";
    require "./php/data.php";

    $hayApuesta = false;

    $numeroPartida = 0;

    $html="";

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["dinero"], $_GET["tipo"], $_GET["apuesta"]) ) {

        $numeroPartida = girarRuleta();
        // $numeroPartida = 3;
        $hayApuesta = true;

        $apuestaUser = [
            "dinero" => $_GET["dinero"],
            "tipo" => $_GET["tipo"],
            "apuesta" => $_GET["apuesta"]
        ];
        
        // mostrarArray($apuestaUser);

        switch ($apuestaUser["tipo"]) {

            case "numero":
                $resultado = $apuestaUser["apuesta"] == $numeroPartida;
            break;

            case "color":
                $resultado = comprovarColor(
                    $apuestaUser["apuesta"],
                    $numeroPartida,
                    $tablero
                );

            break;

            case "pares":
                $resultado = comprovarPares(
                    $apuestaUser["apuesta"],
                    $numeroPartida
                );
            break;

            default:
                $resultado = false;
        }
        
        $profit=0;

        if($resultado) {
            $profit = ganancias($apuestaUser["dinero"], $apuestaUser["tipo"], $profitApuesta);
            $html= "
            <div class='backBloom'>
                <div class='popAlert ganado'>
                    <h2>¡HAS GANADO!</h2>
                    <p>¡Enhorabuena! Has acertado la apuesta.</p>
                    <span>+$profit €</span>
                    <a href='index.php'><button>Volver</button></a>
                </div>
            </div>
            ";
        } else {
            $html= "
            <div class='backBloom'>
                <div class='popAlert perdido'>
                    <h2>¡HAS PERDIDO!</h2>
                    <p>Lo sentimos! No has acertado la apuesta.</p>
                    <span>-".$apuestaUser['dinero']." €</span>
                    <a href='index.php'><button>Volver</button></a>
                </div>
            </div>
            ";
        }
    }


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./style/main.css">
        <link rel="stylesheet" href="./style/colors.css">

        <title>Document</title>
    </head>
    <body>
        
        <main>
            <div class="wheel">
                <img src="./src/wheel.webp" alt="" id="ruleta">

                <div class="bola" id="bola"></div>
            </div>
            <div class="tablero">
                <!-- <img src="./src/table.jpg" alt=""> -->

                <div class="contenedor-ruleta">

                    <div class="mesa">

                        <!-- Parte superior: números -->
                        <div class="cero">0</div>

                        
                        <div class="numeros">

                            <!-- Primera fila -->
                            <div class="numero negro" data-numero="3">3</div>
                            <div class="numero rojo" data-numero="6">6</div>
                            <div class="numero negro" data-numero="9">9</div>
                            <div class="numero rojo" data-numero="12">12</div>
                            <div class="numero negro" data-numero="15">15</div>
                            <div class="numero rojo" data-numero="18">18</div>
                            <div class="numero negro" data-numero="21">21</div>
                            <div class="numero rojo" data-numero="24">24</div>
                            <div class="numero negro" data-numero="27">27</div>
                            <div class="numero rojo" data-numero="30">30</div>
                            <div class="numero negro" data-numero="33">33</div>
                            <div class="numero rojo" data-numero="36">36</div>

                            <!-- Segunda fila -->
                            <div class="numero rojo" data-numero="2">2</div>
                            <div class="numero negro" data-numero="5">5</div>
                            <div class="numero rojo" data-numero="8">8</div>
                            <div class="numero negro" data-numero="11">11</div>
                            <div class="numero rojo" data-numero="14">14</div>
                            <div class="numero negro" data-numero="17">17</div>
                            <div class="numero rojo" data-numero="20">20</div>
                            <div class="numero negro" data-numero="23">23</div>
                            <div class="numero rojo" data-numero="26">26</div>
                            <div class="numero negro" data-numero="29">29</div>
                            <div class="numero rojo" data-numero="32">32</div>
                            <div class="numero negro" data-numero="35">35</div>

                            <!-- Tercera fila -->
                            <div class="numero negro" data-numero="1">1</div>
                            <div class="numero rojo" data-numero="4">4</div>
                            <div class="numero negro" data-numero="7">7</div>
                            <div class="numero rojo" data-numero="10">10</div>
                            <div class="numero negro" data-numero="13">13</div>
                            <div class="numero rojo" data-numero="16">16</div>
                            <div class="numero negro" data-numero="19">19</div>
                            <div class="numero rojo" data-numero="22">22</div>
                            <div class="numero negro" data-numero="25">25</div>
                            <div class="numero rojo" data-numero="28">28</div>
                            <div class="numero negro" data-numero="31">31</div>
                            <div class="numero rojo" data-numero="34">34</div>

                            <!-- Aquí se generan las zonas invisibles -->
                            <div class="zonas" id="zonas"></div>

                        </div>


                        <!-- Pagos 2:1 -->
                        <div class="pagos">
                            <div>2to1</div>
                            <div>2to1</div>
                            <div>2to1</div>
                        </div>

                        <!-- Docenas -->
                        <div class="docenas">
                            <div>1st12</div>
                            <div>2nd12</div>
                            <div>3rd12</div>
                        </div>

                        <!-- Apuestas exteriores -->
                        <div class="exteriores">
                            <div>1to18</div>
                            <div>EVEN</div>
                            <div><span class="ficha-roja"></span></div>
                            <div><span class="ficha-negra"></span></div>
                            <div>ODD</div>
                            <div>19to36</div>
                        </div>

                    </div>

                </div>

            </div>
        </main>

        <form class="apuesta" action="" method="GET">
            <h2>Realizar apuesta</h2>

            <label for="dinero">Cantidad a apostar (€)</label>
            <input 
                type="number" 
                id="dinero" 
                name="dinero" 
                placeholder="Ej: 10"
                min="1"
                step="0.5"
                required
            >

            <label for="tipo">Tipo de apuesta</label>
            <select name="tipo" id="tipo" required>
                <option value="numero">Número</option>
                <option value="color">Color</option>
                <option value="pares">Par / Impar</option>
            </select>

            <label for="apuesta">Tu apuesta</label>

            <input
                type="number"
                name="apuesta"
                id="apuestaNumero"
                placeholder="Introduce un número (0-36)"
                min="0"
                max="36"
            >

            <select name="apuesta" id="apuestaColor" hidden disabled>
                <option value="red">Rojo</option>
                <option value="black">Negro</option>
            </select>

            <select name="apuesta" id="apuestaPar" hidden disabled>
                <option value="par">Par</option>
                <option value="impar">Impar</option>
            </select>

            <button type="submit">Apostar</button>
        </form>

        <div id="resultado" class="hidden">
            <?= $html ?>
        </div>

    </body>

    <script>
        const resultadoRuleta = <?= json_encode([
            "animar" => $hayApuesta,
            "numero" => $numeroPartida,
            "posicion" => $tablero[$numeroPartida]["pos"]
        ]) ?>;
    </script>
    <script src="./scripts/app.js"></script>
</html>