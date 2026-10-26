<?php
    session_start();
    include "./../php/templates.php";

    if(!isset($_SESSION['users'])) {
        echo "<script>
            alert('Debes inicar sesión antes de empezar.');
            window.location.href = './../index.php';
        </script>";
        exit;
    }

    if($_SESSION['users']['room']!=4) {
        $room = $_SESSION['users']['room'];
        echo "<script>
            alert('No estas en este nivel.\\nVamos a tu nivel correspondiente.');
            window.location.href = './room".$room.".php';
        </script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Escape Room - ¡Lo habéis conseguido!</title>
</head>

<body class="bg-zinc-950 text-white">

    <?php
        headerMain($_SESSION['users']);
    ?>

    <main class="min-h-[calc(100vh-85px)] flex items-center justify-center p-6">

        <div class="w-full max-w-2xl text-center space-y-8">

            <!-- Icono de victoria -->
            <div class="flex justify-center">
                <div class="flex h-24 w-24 items-center justify-center rounded-full
                            border-2 border-red-600 bg-red-950
                            shadow-lg shadow-red-900/40">
                    <span class="text-5xl">🔓</span>
                </div>
            </div>

            <!-- Mensaje principal -->
            <div class="space-y-4">
                <p class="text-sm font-bold uppercase tracking-[0.35em] text-red-500">
                    Misión completada
                </p>

                <h1 class="text-4xl font-black uppercase tracking-wide sm:text-6xl">
                    ¡Lo habéis
                    <span class="text-red-600">conseguido!</span>
                </h1>

                <p class="mx-auto max-w-lg text-lg leading-relaxed text-zinc-400">
                    Habéis resuelto todos los enigmas, superado cada desafío
                    y conseguido escapar a tiempo. ¡Enhorabuena, equipo!
                </p>
            </div>

            <!-- Botones -->
            <div class="flex flex-col justify-center gap-4 sm:flex-row">

                <a href="./../inicio_juego.php"
                   class="rounded bg-red-700 px-8 py-3 font-bold
                          transition hover:bg-red-600">
                    Volver al inicio
                </a>

            </div>

            <!-- Pie -->
            <p class="text-xs tracking-wider text-zinc-600">
                ESCAPE ROOM · FIN DE LA MISIÓN
            </p>

        </div>

    </main>

</body>
</html>
