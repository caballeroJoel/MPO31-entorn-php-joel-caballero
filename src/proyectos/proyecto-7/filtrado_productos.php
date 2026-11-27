<?php
    include_once "./php/funcions.php";
    include_once "./php/templates.php";
    require_once "./php/db/config.php";

    $busqueda = htmlspecialchars($_GET['q'] ?? '');

    try {
        $pdo = db();
    } catch (PDOException $e){
        die("Error de conexion - ". $e->getMessage());
    }

    $sql1="
        SELECT *
        FROM Categorias;
    ";
    $sql2="
        SELECT *
        FROM TiposProducto;
    ";
    $sql3="
        SELECT p.*, i.Ruta
        FROM Productos p
        JOIN Categorias c ON c.IdCategoria = p.IdCategoria
        LEFT JOIN ImagenesProducto i ON i.IdProducto = p.IdProducto AND i.Orden = 1
        WHERE COALESCE(p.Marca, '') LIKE :marca
        AND COALESCE(p.Talla, '') LIKE :talla
        AND (:tipo1 = '' OR c.IdTipo = :tipo2)
        AND (:cat1 = '' OR p.IdCategoria = :cat2);
    ";

    $estados = ['nuevo' => 'Nuevo', 'como nuevo' => 'Como nuevo', 'buen estado' => 'Buen estado', 'usado' => 'Usado'];

    // Los filtros se leen antes de las consultas que los usan
    $filtroTipo       = $_GET['tipo'] ?? '';
    $filtroCategoria  = $_GET['categoria'] ?? '';
    $filtroPrecioMin  = htmlspecialchars($_GET['precio_min'] ?? '');
    $filtroPrecioMax  = htmlspecialchars($_GET['precio_max'] ?? '');
    $filtroEstados    = (array) ($_GET['estado'] ?? []);
    $filtroMarca      = htmlspecialchars($_GET['marca'] ?? '');
    $filtroTalla      = htmlspecialchars($_GET['talla'] ?? '');
    $filtrosAplicados = isset($_GET['tipo']);
    $soloDisponibles  = !$filtrosAplicados || isset($_GET['solo_disponibles']);

    $stmt = $pdo->query($sql1);
    $categorias = $stmt->fetchAll();

    $stmt = $pdo->query($sql2);
    $tipos = $stmt->fetchAll();

    $stmt = $pdo->prepare($sql3);
    $stmt->execute([
        'marca' => '%' . ($_GET['marca'] ?? '') . '%',
        'talla' => '%' . ($_GET['talla'] ?? '') . '%',
        'tipo1' => $filtroTipo,
        'tipo2' => $filtroTipo,
        'cat1'  => $filtroCategoria,
        'cat2'  => $filtroCategoria,
    ]);
    $prods = $stmt->fetchAll();

    // disArray($tipos);
    // disArray($categorias);
    // disArray($prods);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultados de búsqueda - reSell</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles/colors.css">
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>

        <!-- ===== HEADER ===== -->
        <?= displayHeader();?>

        <main class="filtrado">

            <!-- ===== PANEL DE FILTROS ===== -->
            <aside class="filtros">
                <form action="./filtrado_productos.php" method="get">
                    <!-- Mantiene la búsqueda del header al aplicar filtros -->
                    <input type="hidden" name="q" value="<?= $busqueda ?>">

                    <div class="filtros__cabecera">
                        <h2>Filtros</h2>
                        <a href="./filtrado_productos.php?q=<?= urlencode($_GET['q'] ?? '') ?>" class="filtros__limpiar">Limpiar</a>
                    </div>

                    <!-- Tipo de producto -->
                    <div class="filtro">
                        <label class="filtro__titulo" for="tipo">Tipo de producto</label>
                        <select id="tipo" name="tipo">
                            <option value="">Todos</option>
                            <?php foreach ($tipos as $nombre): ?>
                                <option value="<?= $nombre["IdTipo"] ?>" <?= (string) $nombre["IdTipo"] === $filtroTipo ? 'selected' : '' ?>><?= $nombre["Nombre"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Categoría (deshabilitada hasta elegir un tipo; data-tipo indica a qué tipo pertenece) -->
                    <div class="filtro">
                        <label class="filtro__titulo" for="categoria">Categoría</label>
                        <select id="categoria" name="categoria" <?= $filtroTipo === '' ? 'disabled' : '' ?>>
                            <option value="">Todas</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= $cat["IdCategoria"] ?>" data-tipo="<?= $cat["IdTipo"] ?>" <?= (string) $cat["IdCategoria"] === $filtroCategoria ? 'selected' : '' ?>><?= $cat["Nombre"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Precio -->
                    <div class="filtro">
                        <span class="filtro__titulo">Precio (€)</span>
                        <div class="filtro__rango">
                            <input type="number" name="precio_min" min="0" step="1" placeholder="Mín" aria-label="Precio mínimo" value="<?= $filtroPrecioMin ?>">
                            <span>-</span>
                            <input type="number" name="precio_max" min="0" step="1" placeholder="Máx" aria-label="Precio máximo" value="<?= $filtroPrecioMax ?>">
                        </div>
                    </div>

                    <!-- Estado del artículo -->
                    <fieldset class="filtro">
                        <legend class="filtro__titulo">Estado</legend>
                        <?php foreach ($estados as $valor => $texto): ?>
                            <label class="filtro__opcion">
                                <input type="checkbox" name="estado[]" value="<?= $valor ?>" <?= in_array($valor, $filtroEstados, true) ? 'checked' : '' ?>> <?= $texto ?>
                            </label>
                        <?php endforeach; ?>
                    </fieldset>

                    <!-- Marca -->
                    <div class="filtro">
                        <label class="filtro__titulo" for="marca">Marca</label>
                        <input type="text" id="marca" name="marca" placeholder="Ej: Nike, Sony..." value="<?= $filtroMarca ?>">
                    </div>

                    <!-- Talla -->
                    <div class="filtro">
                        <label class="filtro__titulo" for="talla">Talla</label>
                        <input type="text" id="talla" name="talla" placeholder="Ej: 42, M..." value="<?= $filtroTalla ?>">
                    </div>

                    <!-- Solo disponibles -->
                    <div class="filtro">
                        <label class="filtro__opcion">
                            <input type="checkbox" name="solo_disponibles" value="1" <?= $soloDisponibles ? 'checked' : '' ?>> Solo disponibles
                        </label>
                    </div>

                    <button type="submit" class="btn btn--relleno filtros__aplicar">Aplicar filtros</button>
                </form>
            </aside>

            <!-- ===== RESULTADOS ===== -->
            <section class="resultados">
                <div class="resultados__cabecera">
                    <h1>
                        <?php if ($busqueda !== ''): ?>
                            Resultados para "<span><?= $busqueda ?></span>"
                        <?php else: ?>
                            Todos los productos
                        <?php endif; ?>
                    </h1>

                    <div class="resultados__orden">
                        <span class="resultados__total"><?=count($prods);?> productos</span>
                        <select name="orden" aria-label="Ordenar por">
                            <option value="recientes">Más recientes</option>
                            <option value="precio_asc">Precio: menor a mayor</option>
                            <option value="precio_desc">Precio: mayor a menor</option>
                        </select>
                    </div>
                </div>

                <!-- Productos de ejemplo: el backend generará estas tarjetas -->
                <div class="productos__grid">

                    <?php foreach($prods as $prod): ?>
                        <a href="./detalle_producto.php?id=<?=$prod["IdProducto"]?>" class="tarjeta">
                            <div class="tarjeta__imagen"><img src="<?=$prod["Ruta"]?>"></div>
                            <div class="tarjeta__info">
                                <h3 class="tarjeta__titulo"><?=$prod["Nombre"]?></h3>
                                <p class="tarjeta__estado">
                                    <?=$prod["EstadoArticulo"]?> 
                                    · 
                                    Talla <?=$prod["Talla"]??''?></p>
                                <p class="tarjeta__precio"><?=$prod["Precio"]?> €</p>
                            </div>
                        </a>
                    <?php endforeach; ?>

                    <!-- <a href="./detalle_producto.php?id=2" class="tarjeta">
                        <div class="tarjeta__imagen">🎮</div>
                        <div class="tarjeta__info">
                            <h3 class="tarjeta__titulo">Nintendo 64</h3>
                            <p class="tarjeta__estado">Buen estado</p>
                            <p class="tarjeta__precio">80,00 €</p>
                        </div>
                    </a>
                    <a href="./detalle_producto.php?id=3" class="tarjeta">
                        <div class="tarjeta__imagen">
                            👕
                            <span class="tarjeta__etiqueta">Reservado</span>
                        </div>
                        <div class="tarjeta__info">
                            <h3 class="tarjeta__titulo">Camiseta vintage</h3>
                            <p class="tarjeta__estado">Usado · Talla M</p>
                            <p class="tarjeta__precio">12,00 €</p>
                        </div>
                    </a>
                    <a href="./detalle_producto.php?id=4" class="tarjeta">
                        <div class="tarjeta__imagen">👟</div>
                        <div class="tarjeta__info">
                            <h3 class="tarjeta__titulo">Adidas Ultraboost</h3>
                            <p class="tarjeta__estado">Nuevo · Talla 41</p>
                            <p class="tarjeta__precio">90,00 €</p>
                        </div>
                    </a>
                    <a href="./detalle_producto.php?id=5" class="tarjeta">
                        <div class="tarjeta__imagen">🎮</div>
                        <div class="tarjeta__info">
                            <h3 class="tarjeta__titulo">Game Boy Color</h3>
                            <p class="tarjeta__estado">Usado</p>
                            <p class="tarjeta__precio">55,00 €</p>
                        </div>
                    </a>
                    <a href="./detalle_producto.php?id=6" class="tarjeta">
                        <div class="tarjeta__imagen">👕</div>
                        <div class="tarjeta__info">
                            <h3 class="tarjeta__titulo">Camiseta de fútbol</h3>
                            <p class="tarjeta__estado">Como nuevo · Talla L</p>
                            <p class="tarjeta__precio">25,00 €</p>
                        </div>
                    </a> -->
                </div>

                <!-- Mensaje para cuando no haya resultados (ocultar si hay productos) -->
                <!--
                <div class="resultados__vacio">
                    <p>No hemos encontrado productos con estos filtros.</p>
                    <a href="./filtrado_productos.php" class="btn btn--borde">Ver todos los productos</a>
                </div>
                -->
            </section>
        </main>

        <!-- ===== FOOTER ===== -->
        <?=displayFooter();?>

        <script src="js/app.js"></script>
    </body>
</html>
