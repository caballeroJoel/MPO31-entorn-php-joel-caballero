<?php
  session_start();

  include "./php/template.php";

  
  if (!isset($_SESSION['pregunta_actual'])) {
      $_SESSION['pregunta_actual'] = 0;
      $_SESSION['puntuacio'] = 0;
      $_SESSION['resposta_feta'] = false;
  }

  $preguntes = $_SESSION['preguntes'];

  $total = count($preguntes);
  $actual = $_SESSION['pregunta_actual'];

  if (isset($_POST['comprovar']) && !$_SESSION['resposta_feta']) {

      if (isset($_POST['resposta'])) {

          if ($_POST['resposta'] == $preguntes[$actual]['correcta']) {
              $_SESSION['puntuacio']++;
              $correcte = true;
          } else {
              $correcte = false;
          }

          $_SESSION['resposta_feta'] = true;
      }
  }

  if (isset($_POST['seguent'])) {
      $_SESSION['pregunta_actual']++;
      $_SESSION['resposta_feta'] = false;
  }

  if (isset($_POST['reiniciar'])) {
      $_SESSION['pregunta_actual'] = 0;
      $_SESSION['puntuacio'] = 0;
      $_SESSION['resposta_feta'] = false;
  }

  $actual = $_SESSION['pregunta_actual'];

?>

<!doctype html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trivial</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?= displayheader() ?>

    <main class="contenidor">
        <section class="panell">

            <?php if ($actual < $total) { ?>

                <h1>Hola, <?=$_SESSION["user"]["usuari"]?>!</h1>

                <p class="subtitol">
                    Respon la pregunta i continua avançant.
                </p>

                <div class="estadistiques">

                    <span>
                        <strong>Puntuació:</strong>
                        <?= $_SESSION['puntuacio'] ?> punts
                    </span>

                    <span>
                        <strong>Progrés:</strong>
                        <?= $actual + 1 ?> de <?= $total ?>
                    </span>

                    <span>
                        <strong>Pendents:</strong>
                        <?= $total - $actual - 1 ?>
                    </span>

                </div>

                <span class="etiqueta">
                    <?= $preguntes[$actual]['categoria'] ?>
                </span>

                <h2 style="margin-top: 15px">
                    <?= $preguntes[$actual]['pregunta'] ?>
                </h2>

                <?php if (!$_SESSION['resposta_feta']) { ?>

                    <form method="post">

                        <?php foreach ($preguntes[$actual]['opcions'] as $i => $opcio) { ?>

                            <label class="resposta">

                                <input
                                    type="radio"
                                    name="resposta"
                                    value="<?= $i ?>"
                                    required
                                >

                                <?= $opcio ?>

                            </label>

                        <?php } ?>

                        <button class="btn" type="submit" name="comprovar">
                            Comprovar resposta
                        </button>

                    </form>

                <?php } else { ?>

                    <div class="alerta">

                        <?php
                        if ($correcte) {
                            echo "Molt bé! La resposta és correcta.";
                        } else {
                            echo "Resposta incorrecta. La resposta correcta és: ";
                            echo $preguntes[$actual]['opcions'][$preguntes[$actual]['correcta']];
                        }
                        ?>

                    </div>

                    <form method="post">

                        <button class="btn" type="submit" name="seguent">
                            Següent pregunta
                        </button>

                    </form>

                <?php } ?>

            <?php } else { ?>

                <h1>Partida acabada!</h1>

                <p class="subtitol">
                    Has acabat totes les preguntes.
                </p>

                <h2>
                    La teva puntuació és:
                    <?= $_SESSION['puntuacio'] ?> de <?= $total ?> punts
                </h2>

                <form method="post">

                    <button class="btn" type="submit" name="reiniciar">
                        Tornar a jugar
                    </button>

                </form>

            <?php } ?>

        </section>
    </main>

    <?=displayfooter();?>

</body>
</html>
