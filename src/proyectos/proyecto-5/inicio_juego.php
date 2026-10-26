<?php
    session_start();
    include "./php/templates.php";

    if(!isset($_SESSION['users'])) {
        echo "<script>
            alert('Debes inicar sesión antes de empezar.');
            window.location.href = './index.php';
        </script>";
        exit;
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

        
        <section class="min-h-[calc(100vh-85px)] flex items-center justify-center bg-zinc-950 px-6 py-12 text-white">
            <div class="w-full max-w-md space-y-6 rounded-lg border border-zinc-800 bg-zinc-900 p-8">

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-600">
                        Red Case · Nuevo caso
                    </p>

                    <h2 class="mt-3 text-3xl font-bold">
                        ¿Estás preparado?
                    </h2>

                    <p class="mt-2 text-sm text-zinc-400">
                        Selecciona la dificultad y demuestra tus habilidades como investigador.
                    </p>
                </div>

                <form action="./php/set_difi.php" method="POST" class="space-y-5">

                    <div>
                        <label for="dificultad" class="mb-2 block text-sm font-semibold">
                            Nivel de dificultad
                        </label>

                        <select
                            id="dificultad"
                            name="dificultad"
                            required
                            class="w-full rounded border border-zinc-700 bg-zinc-950 p-3 text-white outline-none focus:border-red-600"
                        >
                            <option value="" disabled selected>Selecciona una dificultad</option>
                            <option value="facil">Fácil</option>
                            <option value="medio">Medio</option>
                            <option value="dificil">Difícil</option>
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded bg-red-700 px-5 py-3 font-bold uppercase tracking-widest transition hover:bg-red-600"
                    >
                        Iniciar juego →
                    </button>

                </form>

                <p class="text-center text-xs text-zinc-500">
                    Cada pista cuenta. Cada decisión importa.
                </p>

            </div>
        </section>

    </body>
</html>