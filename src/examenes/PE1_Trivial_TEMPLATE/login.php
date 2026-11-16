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
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
        <!-- AQUEST HEADER HA DE SER REUTILITZABLE -->

    <?=displayheader()?>
    <main class="contenidor">
      <section class="panell ample-mig">
        <h1>Iniciar sessió</h1>
        <p class="subtitol">Accedeix com a jugador o administrador.</p>
        <form action="./php/login_php.php" method="post">
          <label class="camp"
            >Nom d'usuari<input 
            class="<?php if($txtError=="noLogin"){echo "error-login";}?>"
            name="usuari" 
            type="text" 
            required /></label
          ><label class="camp"
            >Contrasenya<input
            class="<?php if($txtError=="noLogin"){echo "error-login";}?>"
              name="password"
              type="password"
              required /></label
          ><button class="btn" type="submit">Entrar</button>
        </form>
        <p class="nota">
          La versió PHP ha de verificar la contrasenya i redirigir segons el
          rol.
        </p>
      </section>
    </main>
    <?=displayfooter();?>
  </body>
</html>
