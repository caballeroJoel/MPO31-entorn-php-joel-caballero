<?php
    session_start();

    include "./php/template.php";
    
    $txtError="";

    if(isset($_SESSION['error'])) {
        $txtError = $_SESSION['error'];
        unset($_SESSION['error']);
    }

?>
<!doctype html>
<html lang="ca">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registre</title>
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
        <!-- AQUEST HEADER HA DE SER REUTILITZABLE -->

    <?=displayheader()?>
    <main class="contenidor">
      <section class="panell ample-mig">
        <h1>Registre de jugador</h1>
        <p class="subtitol">Crea un compte per poder jugar.</p>
        <form action="./php/registro.php" method="post">
          <label class="camp"
            >Nom d'usuari<input
              class="<?php if($txtError=="existente"){echo "error-login";}?>"
              type="text"
              name="usuari"
              placeholder="Ex.: anna"
              required /></label
          ><label class="camp"
            >Contrassenya<input
              class="<?php if($txtError=="passwd"){echo "error-login";}?>"
              type="password"
              name="password"
              required /></label
          ><label class="camp"
            >Repeteix la contrassenya<input
              class="<?php if($txtError=="passwd"){echo "error-login";}?>"
              type="password"
              name="password2"
              required /></label
          ><button class="btn" type="submit">Registrar-me</button>
        </form>
        <p class="nota">
          Els nous comptes han de tenir sempre el rol de jugador.
        </p>
      </section>
    </main>
    <?=displayfooter();?>
  </body>
</html>
