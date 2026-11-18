<?php
$numeroInicial = 24;
$enigma1 = "";
$enigma2 = "";
$resultado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeroInicial = (int) ($_POST["numero_inicial"] ?? 24);
    $enigma1 = trim($_POST["enigma1"] ?? "");
    $enigma2 = trim($_POST["enigma2"] ?? "");

    if ($enigma1 !== "" && $enigma2 !== "") {
        $resultado = $numeroInicial + strlen($enigma1) + strlen($enigma2);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reto Albert - Caja Fuerte 2627</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .contenedor {
            background: #1e1e1e;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            margin-top: 0;
            color: #f1c40f;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #444;
            background: #2c2c2c;
            color: #fff;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #2ecc71;
        }
        .resultado {
            margin-top: 20px;
            padding: 15px;
            background: #252525;
            border-left: 4px solid #f1c40f;
            border-radius: 5px;
            text-align: center;
            font-size: 20px;
        }
        .resultado span {
            font-size: 28px;
            font-weight: bold;
            color: #2ecc71;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2>Reto Albert: Caja Fuerte 2627</h2>

        <form action="" method="POST">
            <label for="numero_inicial">Número inicial</label>
            <input type="number" id="numero_inicial" name="numero_inicial" value="<?= htmlspecialchars((string)$numeroInicial) ?>" required>

            <label for="enigma1">Enigma 1</label>
            <input type="text" id="enigma1" name="enigma1" value="<?= htmlspecialchars($enigma1) ?>" placeholder="Respuesta Enigma 1" required>

            <label for="enigma2">Enigma 2</label>
            <input type="text" id="enigma2" name="enigma2" value="<?= htmlspecialchars($enigma2) ?>" placeholder="Respuesta Enigma 2" required>

            <button type="submit">Calcular</button>
        </form>

        <?php if ($resultado !== null): ?>
            <div class="resultado">
                Número oculto: <span><?= $resultado ?></span>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>