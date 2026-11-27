<?php
    include_once "./php/templates.php";
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>reSell - Compra y vende productos de segunda mano</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles/colors.css">
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>

        <!-- ===== HEADER ===== -->
        <?= displayHeader();?>
        <main>
            <!-- ===== HERO ===== -->
            <section class="hero">
                <h1>Dale una segunda vida a tus cosas</h1>
                <p>Compra y vende productos de segunda mano de forma fácil y segura.</p>
                <a href="#" class="btn btn--relleno">Empieza a vender</a>
            </section>

            <!-- ===== PRODUCTOS (de ejemplo) ===== -->
            <section class="productos">
                <h2>Productos destacados</h2>
                <div class="productos__grid">
                    <article class="tarjeta">
                        <div class="tarjeta__imagen">👟</div>
                        <div class="tarjeta__info">
                            <h3 class="tarjeta__titulo">Zapatillas deportivas</h3>
                            <p class="tarjeta__estado">Como nuevo</p>
                            <p class="tarjeta__precio">45,00 €</p>
                        </div>
                    </article>
                    <article class="tarjeta">
                        <div class="tarjeta__imagen">🎧</div>
                        <div class="tarjeta__info">
                            <h3 class="tarjeta__titulo">Auriculares inalámbricos</h3>
                            <p class="tarjeta__estado">Buen estado</p>
                            <p class="tarjeta__precio">30,00 €</p>
                        </div>
                    </article>
                    <article class="tarjeta">
                        <div class="tarjeta__imagen">🧥</div>
                        <div class="tarjeta__info">
                            <h3 class="tarjeta__titulo">Chaqueta vaquera</h3>
                            <p class="tarjeta__estado">Usado</p>
                            <p class="tarjeta__precio">20,00 €</p>
                        </div>
                    </article>
                    <article class="tarjeta">
                        <div class="tarjeta__imagen">🎮</div>
                        <div class="tarjeta__info">
                            <h3 class="tarjeta__titulo">Mando de consola</h3>
                            <p class="tarjeta__estado">Como nuevo</p>
                            <p class="tarjeta__precio">35,00 €</p>
                        </div>
                    </article>
                </div>
            </section>
        </main>

        <!-- ===== FOOTER ===== -->
        <?=displayFooter();?>

        <script src="js/app.js"></script>
    </body>
</html>
