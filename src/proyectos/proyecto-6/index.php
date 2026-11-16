<?php

    session_start();

    require "./php/functions.php";
    require "./php/data.php";

    if(!isset($_SESSION["player"])) {
        header('Location: login.php');
        exit;
    }

    $hayApuesta = false;

    $numeroPartida = 0;

    $html="";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $dineroRaw = $_POST["dinero"] ?? "";
        $tipo = $_POST["tipo"] ?? "";
        $apuesta = $_POST["apuestaMesa"] ?? $_POST["apuesta"] ?? null;
        $tiposValidos = ["numero", "pleno", "color", "pares", "caballo", "cuadro", "docena", "columna", "pasa"];
        $dineroValido = is_string($dineroRaw) && preg_match('/^\d+(?:\.\d{1,2})?$/D', $dineroRaw) === 1;
        $dinero = $dineroValido ? (float) $dineroRaw : 0;
        $apuestaValida = false;

        if (is_string($tipo) && is_string($apuesta)) {
            switch ($tipo) {
                case "numero":
                case "pleno":
                    $apuestaValida = preg_match('/^(?:[0-9]|[12][0-9]|3[0-6])$/D', $apuesta) === 1;
                    break;
                case "color":
                    $apuestaValida = in_array($apuesta, ["red", "black"], true);
                    break;
                case "pares":
                    $apuestaValida = in_array($apuesta, ["par", "impar"], true);
                    break;
                case "docena":
                case "columna":
                    $apuestaValida = in_array($apuesta, ["1", "2", "3"], true);
                    break;
                case "pasa":
                    $apuestaValida = in_array($apuesta, ["1", "2"], true);
                    break;
                case "caballo":
                case "cuadro":
                    $numerosApuesta = [];
                    $cantidadNumeros = $tipo === "caballo" ? 2 : 4;

                    if (preg_match('/^\d+(?:,\d+)*$/D', $apuesta) === 1) {
                        $numerosApuesta = array_map("intval", explode(",", $apuesta));
                        $apuestaValida = count($numerosApuesta) === $cantidadNumeros
                            && count(array_unique($numerosApuesta)) === $cantidadNumeros
                            && min($numerosApuesta) >= 1
                            && max($numerosApuesta) <= 36;

                        if ($apuestaValida) {
                            $coordenadas = array_map(static function ($numero) {
                                return [
                                    intdiv($numero - 1, 3),
                                    2 - (($numero - 1) % 3)
                                ];
                            }, $numerosApuesta);

                            if ($tipo === "caballo") {
                                $columnaDistancia = abs($coordenadas[0][0] - $coordenadas[1][0]);
                                $filaDistancia = abs($coordenadas[0][1] - $coordenadas[1][1]);
                                $apuestaValida = $columnaDistancia + $filaDistancia === 1;
                            } else {
                                $columnas = array_column($coordenadas, 0);
                                $filas = array_column($coordenadas, 1);
                                $columnaMinima = min($columnas);
                                $filaMinima = min($filas);
                                $coordenadasEsperadas = [
                                    [$columnaMinima, $filaMinima],
                                    [$columnaMinima + 1, $filaMinima],
                                    [$columnaMinima, $filaMinima + 1],
                                    [$columnaMinima + 1, $filaMinima + 1]
                                ];

                                foreach ($coordenadasEsperadas as $coordenada) {
                                    if (!in_array($coordenada, $coordenadas, true)) {
                                        $apuestaValida = false;
                                        break;
                                    }
                                }

                                if (max($columnas) !== $columnaMinima + 1 || max($filas) !== $filaMinima + 1) {
                                    $apuestaValida = false;
                                }
                            }
                        }
                    }
                    break;
            }
        }

        $saldoCentimos = is_numeric($_SESSION["player"]["dinero"] ?? null)
            ? (int) round((float) $_SESSION["player"]["dinero"] * 100)
            : 0;
        $apuestaCentimos = $dineroValido ? (int) round($dinero * 100) : 0;

        if (!$dineroValido || $apuestaCentimos < 100 || $apuestaCentimos % 50 !== 0
            || !in_array($tipo, $tiposValidos, true) || !$apuestaValida) {
            $html = "<div class='backBloom'><div class='popAlert perdido'><h2>Apuesta no valida</h2><p>Revisa la cantidad y selecciona una apuesta válida de la mesa.</p><a href='index.php'><button>Volver</button></a></div></div>";
        } elseif ($apuestaCentimos > $saldoCentimos) {
            $saldoActual = number_format($saldoCentimos / 100, 2, ",", ".");
            $html = "<div class='backBloom'><div class='popAlert perdido'><h2>Saldo insuficiente</h2><p>Tu saldo actual es de {$saldoActual} €.</p><a href='index.php'><button>Volver</button></a></div></div>";
        } else {
            $numeroPartida = girarRuleta();
            $hayApuesta = true;

            $resultado = comprobarApuesta(
                $tipo,
                $apuesta,
                $numeroPartida,
                $tablero
            );

            if ($resultado) {
                $tipoGanancia = $tipo === "pleno" ? "numero" : $tipo;
                $profit = round(ganancias($apuestaCentimos / 100, $tipoGanancia, $profitApuesta), 2);
                $saldoCentimos += (int) round($profit * 100);
                $html = "
                <div class='backBloom'>
                    <div class='popAlert ganado'>
                        <h2>¡HAS GANADO!</h2>
                        <p>¡Enhorabuena! Has acertado la apuesta.</p>
                        <span>+".number_format($profit, 2, ",", ".")." €</span>
                        <a href='index.php'><button>Volver</button></a>
                    </div>
                </div>
                ";
            } else {
                $saldoCentimos -= $apuestaCentimos;
                $html = "
                <div class='backBloom'>
                    <div class='popAlert perdido'>
                        <h2>¡HAS PERDIDO!</h2>
                        <p>Lo sentimos! No has acertado la apuesta.</p>
                        <span>-".number_format($apuestaCentimos / 100, 2, ",", ".")." €</span>
                        <a href='index.php'><button>Volver</button></a>
                    </div>
                </div>
                ";
            }

            $_SESSION["player"]["dinero"] = $saldoCentimos / 100;
            foreach ($_SESSION["usuarios"] as &$usuario) {
                if ($usuario["username"] === $_SESSION["player"]["username"]) {
                    $usuario["dinero"] = $_SESSION["player"]["dinero"];
                    break;
                }
            }
            unset($usuario);
        }
    }


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./style/main.css?v=<?= filemtime(__DIR__ . "/style/main.css") ?>">
        <link rel="stylesheet" href="./style/colors.css?v=<?= filemtime(__DIR__ . "/style/colors.css") ?>">

        <title>Document</title>
    </head>
    <body>
        
        <main>
            <div class="sesion">
                <div class="info-usuario">
                    <div class="datos-usuario">
                        <span class="nombre">
                            <?= $_SESSION["player"]["username"]; ?>
                        </span>

                        <span class="saldo">
                            <?= $_SESSION["player"]["dinero"]; ?> €
                        </span>
                    </div>
                </div>

                <a href="./php/logout.php" class="logout">
                    <span>⏻</span>
                    Salir
                </a>
            </div>
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
                            <div data-tipo="columna" data-apuesta="1">2to1</div>
                            <div data-tipo="columna" data-apuesta="2">2to1</div>
                            <div data-tipo="columna" data-apuesta="3">2to1</div>
                        </div>

                        <!-- Docenas -->
                        <div class="docenas">
                            <div data-tipo="docena" data-apuesta="1">1st12</div>
                            <div data-tipo="docena" data-apuesta="2">2nd12</div>
                            <div data-tipo="docena" data-apuesta="3">3rd12</div>
                        </div>

                        <!-- Apuestas exteriores -->
                        <div class="exteriores">
                            <div data-tipo="pasa" data-apuesta="1">1to18</div>
                            <div data-tipo="pares" data-apuesta="par">EVEN</div>
                            <div data-tipo="color" data-apuesta="red"><span class="ficha-roja"></span></div>
                            <div data-tipo="color" data-apuesta="black"><span class="ficha-negra"></span></div>
                            <div data-tipo="pares" data-apuesta="impar">ODD</div>
                            <div data-tipo="pasa" data-apuesta="2">19to36</div>
                        </div>

                    </div>

                </div>

            </div>
        </main>

        <form class="apuesta" action="" method="POST">
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
                <option value="caballo">Caballo</option>
                <option value="cuadro">Cuadro</option>
                <option value="docena">Docena</option>
                <option value="columna">Columna</option>
                <option value="pasa">Falta / Pasa</option>
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

            <input type="hidden" name="apuestaMesa" id="apuestaMesa" disabled>

            <button type="submit">Apostar</button>
        </form>

        <div id="resultado" class="<?= $hayApuesta || $html === "" ? "hidden" : "" ?>">
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
    <script src="./scripts/app.js?v=<?= filemtime(__DIR__ . "/scripts/app.js") ?>"></script>
</html>
