<?php
    session_start();
    include "./../php/templates.php";
    include "./../php/data/preguntas.php";

    if(!isset($_SESSION['users'])) {
        echo "<script>
            alert('Debes inicar sesión antes de empezar.');
            window.location.href = './../index.php';
        </script>";
        exit;
    }

    if($_SESSION['users']['room']!=2) {
        $room = $_SESSION['users']['room'];
        echo "<script>
            alert('No estas en este nivel.\\nVamos a tu nivel correspondiente.');
            window.location.href = './room".$room.".php';
        </script>";
        exit;
    }

    if($_SERVER['REQUEST_METHOD']=="POST") {
        
        $respuesta = strtolower(trim($_POST['respuesta'] ?? ''));

        $respuestaCorrecta = $acertijos[$_SESSION['users']['nivel']][1]['respuesta'];

        if (str_contains($respuesta, $respuestaCorrecta)) {
            $_SESSION['users']['room']=3;    
            echo "<script>
                alert('Respuesta correcta.');
                window.location.href = './room3.php';
            </script>";
        } else {
            echo "<script>
                alert('Respuesta incorrecta.');
                window.location.href = './room2.php';
            </script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="https://cdn.tailwindcss.com"></script>

        <title>Document</title>
    </head>
    <body>
        
        <?php
            headerMain($_SESSION['users']);
        ?>
        
        <section class="flex min-h-[calc(100vh-85px)] items-center justify-center bg-zinc-950 px-6 py-12 text-white">

            <div class="w-full max-w-2xl">

                <!-- Información de la habitación -->
                <div class="mb-8 flex items-center justify-between border-b border-zinc-800 pb-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-600">
                            RED CASE · EXPEDIENTE 002
                        </p>
                        <h2 class="mt-2 text-xl font-bold">La habitación del misterio</h2>
                    </div>

                    <span class="border border-red-900 bg-red-950/40 px-3 py-2 text-xs font-bold uppercase tracking-wider text-red-500">
                        Nivel <?=$_SESSION["users"]["nivel"]?>
                    </span>
                </div>

                <!-- Pregunta -->
                <div class="border border-zinc-800 bg-zinc-900 p-8 text-center sm:p-12">

                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full border border-red-800 bg-red-950/30 text-3xl">
                        ?
                    </div>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-zinc-500">
                        Prueba de investigación
                    </p>

                    <h1 class="mt-5 text-2xl font-bold leading-relaxed sm:text-3xl">
                        <?= $acertijos[$_SESSION['users']['nivel']][1]["pregunta"] ?>
                    </h1>

                    <p class="mx-auto mt-4 max-w-md text-sm leading-relaxed text-zinc-400">
                        Analiza las pistas, utiliza la lógica y encuentra la respuesta correcta para avanzar.
                    </p>

                    <!-- Formulario de respuesta -->
                    <form action="#" method="POST" class="mx-auto mt-8 max-w-md space-y-4">

                        <input
                            type="text"
                            name="respuesta"
                            placeholder="Escribe tu respuesta..."
                            autocomplete="off"
                            required
                            class="w-full rounded border border-zinc-700 bg-zinc-950 px-4 py-4 text-center text-white placeholder-zinc-600 outline-none transition focus:border-red-600"
                        />

                        <button
                            type="submit"
                            class="w-full rounded bg-red-700 px-6 py-4 text-sm font-bold uppercase tracking-[0.2em] transition hover:bg-red-600"
                        >
                            Comprobar respuesta →
                        </button>

                    </form>

                    <p class="mt-6 text-xs text-zinc-600">
                        Una respuesta incorrecta puede costarte tiempo.
                    </p>

                </div>

                <!-- Pie de habitación -->
                <div class="mt-6 flex items-center justify-between text-xs text-zinc-600">
                    <span>HABITACIÓN 02</span>
                    <span>OBJETIVO: RESOLVER EL ENIGMA</span>
                </div>

            </div>

        </section>


    </body>
</html>