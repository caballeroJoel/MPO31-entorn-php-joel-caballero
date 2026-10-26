<?php
    session_start();
    include "./php/templates.php";

    // echo "<pre>";
    // print_r($_SESSION['users']);
    // echo "</pre>";

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://cdn.tailwindcss.com"></script>

        <title>Scape room - Inicio</title>
    </head>
    <body>
        <?php 
            if(!isset($_SESSION['users'])) {
                $u=null;
            } else {
                $u=$_SESSION['users'];
            }
            headerMain(null);
        ?>

        <div class="min-h-[calc(100vh-85px)] flex items-center justify-center bg-zinc-950 text-white p-6">

            <div class="w-full max-w-sm space-y-8">

                <!-- Login -->
                <form action="./php/auth.php" method="POST" class="space-y-4">
                    <h2 class="text-2xl font-bold text-red-600">Iniciar sesión</h2>

                    <input
                        type="email"
                        name="email"
                        placeholder="Correo electrónico"
                        required
                        class="w-full rounded border border-zinc-700 bg-zinc-900 p-3 outline-none focus:border-red-600"
                    />

                    <input
                        type="password"
                        name="password"
                        placeholder="Contraseña"
                        required
                        class="w-full rounded border border-zinc-700 bg-zinc-900 p-3 outline-none focus:border-red-600"
                    />

                    <button
                        type="submit"
                        class="w-full rounded bg-red-700 p-3 font-bold hover:bg-red-600"
                    >
                        Entrar
                    </button>
                </form>

                <hr class="border-zinc-800" />

                <!-- Registro -->
                <form action="./php/regis.php" method="POST" class="space-y-4">
                    <h2 class="text-2xl font-bold text-red-600">Crear cuenta</h2>

                    <input
                        type="text"
                        name="name"
                        placeholder="Nombre"
                        required
                        class="w-full rounded border border-zinc-700 bg-zinc-900 p-3 outline-none focus:border-red-600"
                    />

                    <input
                        type="email"
                        name="email"
                        placeholder="Correo electrónico"
                        required
                        class="w-full rounded border border-zinc-700 bg-zinc-900 p-3 outline-none focus:border-red-600"
                    />

                    <input
                        type="password"
                        name="password"
                        placeholder="Contraseña"
                        required
                        class="w-full rounded border border-zinc-700 bg-zinc-900 p-3 outline-none focus:border-red-600"
                    />

                    <button
                        type="submit"
                        class="w-full rounded bg-red-700 p-3 font-bold hover:bg-red-600"
                    >
                        Registrarse
                    </button>
                </form>

            </div>
            </div>
    </body>
</html>