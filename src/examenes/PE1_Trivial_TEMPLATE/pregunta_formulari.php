<?php
  
	session_start();

	if(!isset($_SESSION["user"]) || $_SESSION["user"]["rol"] !== "admin") {
		header('Location: ./index.php');
		exit;
	}

	include "./php/template.php";

	$preguntaEdit=[ 
		"id" => 0, 
		"categoria" => "", 
		"pregunta" => "", 
		"opcions" => [
			 "", 
			 "", 
			 "", 
			 "" 
		], 
		"correcta" => 0 
	];

	if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["id"])) {
		foreach($_SESSION["preguntes"] as $pregunta) {
			if($pregunta["id"]==$_GET["id"]) {
				$preguntaEdit = $pregunta;
			}
		}

		if($preguntaEdit=="") {
			header('Location: ./admin.php');
            exit;
		}
	}

?>

<!doctype html>
<html lang="ca">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pregunta</title>
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
        <!-- AQUEST HEADER HA DE SER REUTILITZABLE -->

    <?=displayheader()?>
    <main class="contenidor">
      <section class="panell ample-mig">
        <h1>Crear o editar pregunta</h1>
        <p class="subtitol">
          El mateix formulari pot servir per a les dues operacions.
        </p>
        <form action="./php/newPregunta.php" method="post">
          <label class="camp"
            >Categoria<select name="categoria" required>
              <option value="">Selecciona una categoria</option>
              <option value="Geografia" <?php if($preguntaEdit["categoria"]=="Geografia"){echo "selected";} ?> >Geografia</option>
              <option value="Història" <?php if($preguntaEdit["categoria"]=="Història"){echo "selected";}?> >Història</option>
              <option value="Ciència i natura" <?php if($preguntaEdit["categoria"]=="Ciència i natura"){echo "selected";}?>>Ciència i natura</option>
              <option value="Art i cultura" <?php if($preguntaEdit["categoria"]=="Art i cultura"){echo "selected";}?>>Art i cultura</option>
            </select></label
          ><label class="camp"
            >Enunciat<textarea
              name="pregunta"
              required
              placeholder="Escriu l'enunciat..."
            ><?=$preguntaEdit["pregunta"]?></textarea></label
          >
		  <label class="camp"
            >Opció A<input type="text" name="opcio_0" required value="<?=$preguntaEdit["opcions"][0]?>" /></label
          >
		  <label class="camp"
            >Opció B<input type="text" name="opcio_1" required value="<?=$preguntaEdit["opcions"][1]?>"/></label
          >
		  <label class="camp"
            >Opció C<input type="text" name="opcio_2" required value="<?=$preguntaEdit["opcions"][2]?>"/></label
          >
		  <label class="camp"
            >Opció D<input type="text" name="opcio_3" required value="<?=$preguntaEdit["opcions"][3]?>"/></label
          >
		  <label class="camp"
            >Resposta correcta<select name="correcta" required>
              <option value="0" <?php if($preguntaEdit["correcta"]==0){echo "selected";} ?>>A</option>
              <option value="1" <?php if($preguntaEdit["correcta"]==1){echo "selected";} ?>>B</option>
              <option value="2" <?php if($preguntaEdit["correcta"]==2){echo "selected";} ?>>C</option>
              <option value="3" <?php if($preguntaEdit["correcta"]==3){echo "selected";} ?>>D</option>
            </select></label
          >
          <div class="accions">
            <button class="btn" type="submit">Guardar pregunta</button
            ><a class="btn btn-sec" href="admin.php">Cancel·lar</a>
          </div>
		  <input type="hidden" name="id" value="<?=$preguntaEdit["id"]?>">
        </form>
      </section>
    </main>
    <?=displayfooter();?>
  </body>
</html>
