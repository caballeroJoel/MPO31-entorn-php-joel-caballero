<?php
    session_start();

    include './php/templates.php';
    include './php/funciones.php';
    include './php/data.php';

    if (!isset($_SESSION['basuras'])) {
        $_SESSION['basuras'] = [
            "amarillo" => 0,
            "verde"    => 0,
            "azul"     => 0,
            "marron"   => 0,
            "gris"     => 0
        ];
    }

    if (!isset($_SESSION['objetos'])) {
        $_SESSION['objetos'] = generarColaInicial($listaOriginal);
    }

    if (isset($_GET['seleccionado'])) {

        $color = $_GET['seleccionado'];

        $contenedorCorrecto = $_SESSION['objetos'][0]['contenedor'];

        if ($color == $contenedorCorrecto) {

            if ($_SESSION['basuras'][$color] == 8) {
            
                $_SESSION['mensaje'] = 'Máximo alcanzado para este contenedor';

            } else {
                
                $_SESSION['basuras'][$color]++;
                avanzarColaObjetos($listaOriginal);

            }

        } else {
            $_SESSION['mensaje'] = '¡Contenedor incorrecto! Este objeto no va aquí.';
        }
    }

    $mensaje = '';
    if (isset($_SESSION['mensaje'])) {
        $mensaje = $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/main.css">
        <link rel="stylesheet" href="./style/color.css">
        <title>Recicla</title>
    </head>
    <body>
        <?php if ($mensaje != ''): ?>
            <script>
                alert('<?= $mensaje ?>');
            </script>
        <?php endif; ?>

        <?= headerDisplay(); ?>

        <main>
            <div class="proximos">
                <?php foreach ($_SESSION['objetos'] as $index => $objeto): ?>
                    <div class="<?= $index == 0 ? 'current' : '' ?>">
                        <img src="<?= $objeto['img'] ?>" alt="<?= $objeto['nombre'] ?>">
                    </div>
                <?php endforeach; ?>
            </div>
                
            <div class="contenedores">
                <a href="index.php?seleccionado=amarillo" class="">
                    <img src="./src/contenedor_amarillo.png" alt="">
                    <h3>Plasticos</h3>
                </a>
                <a href="index.php?seleccionado=verde" class="">
                    <img src="./src/contenedor_verde.png" alt="">
                    <h3>Vidrios</h3>
                </a>
                <a href="index.php?seleccionado=azul" class="">
                    <img src="./src/contenedor_azul.png" alt="">
                    <h3>Papeles</h3>
                </a>
                <a href="index.php?seleccionado=marron" class="">
                    <img src="./src/contenedor_marron.png" alt="">
                    <h3>Organico</h3>
                </a>
                <a href="index.php?seleccionado=gris" class="">
                    <img src="./src/contenedor_gris.png" alt="">
                    <h3>Restos</h3>
                </a>
            </div>

            <div class="vacio">
                <a href="dest.php" class="vaciar">Vaciar camion</a>
            </div>

            <div class="tablaTotal">
                <?=cargarTabla($_SESSION['basuras'])?>
            </div>
        </main>

    </body>

</html>