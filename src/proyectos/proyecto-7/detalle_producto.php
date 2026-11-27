<?php
    include_once "./php/funcions.php";
    include_once "./php/templates.php";
    require_once "./php/db/config.php";

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    try {
        $pdo = db();
    } catch (PDOException $e){
        die("Error de conexion - ". $e->getMessage());
    }

    $prod = false;
    $imagenes = [];

    if ($id) {
        $sql = "
            SELECT p.*, c.Nombre AS Categoria, c.IdCategoria, t.Nombre AS Tipo, t.IdTipo,
                   u.Nombre AS Vendedor, u.Ciudad
            FROM Productos p
            JOIN Categorias c    ON c.IdCategoria = p.IdCategoria
            JOIN TiposProducto t ON t.IdTipo = c.IdTipo
            JOIN Usuarios u      ON u.IdUsuario = p.IdUsuario
            WHERE p.IdProducto = :id;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $prod = $stmt->fetch();

        $stmt = $pdo->prepare("SELECT Ruta FROM ImagenesProducto WHERE IdProducto = :id ORDER BY Orden;");
        $stmt->execute(['id' => $id]);
        $imagenes = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    if (!$prod) {
        http_response_code(404);
    }

    // Atajo para escapar todo lo que viene de la BBDD (lo escriben los usuarios)
    function e($texto) {
        return htmlspecialchars($texto ?? '');
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $prod ? e($prod['Nombre']) : 'Producto no encontrado' ?> - reSell</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles/colors.css">
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>

        <!-- ===== HEADER ===== -->
        <?= displayHeader();?>

        <main class="detalle">

            <?php if (!$prod): ?>
                <div class="resultados__vacio">
                    <p>Este producto no existe o ya no está publicado.</p>
                    <a href="./filtrado_productos.php" class="btn btn--borde">Ver todos los productos</a>
                </div>
            <?php else: ?>

                <!-- Migas de pan: enlazan al filtrado por tipo y por categoría -->
                <nav class="detalle__migas" aria-label="Ruta">
                    <a href="./filtrado_productos.php">Productos</a> ›
                    <a href="./filtrado_productos.php?tipo=<?= $prod['IdTipo'] ?>"><?= e($prod['Tipo']) ?></a> ›
                    <a href="./filtrado_productos.php?tipo=<?= $prod['IdTipo'] ?>&categoria=<?= $prod['IdCategoria'] ?>"><?= e($prod['Categoria']) ?></a>
                </nav>

                <div class="detalle__contenido">

                    <!-- ===== GALERÍA ===== -->
                    <section class="detalle__galeria">
                        <div class="detalle__imagen">
                            <?php if ($imagenes): ?>
                                <img src="<?= e($imagenes[0]) ?>" alt="<?= e($prod['Nombre']) ?>">
                            <?php endif; ?>
                            <?php if ($prod['EstadoAnuncio'] !== 'disponible'): ?>
                                <span class="tarjeta__etiqueta"><?= ucfirst($prod['EstadoAnuncio']) ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if (count($imagenes) > 1): ?>
                            <div class="detalle__miniaturas">
                                <?php foreach ($imagenes as $i => $ruta): ?>
                                    <img src="<?= e($ruta) ?>" alt="<?= e($prod['Nombre']) ?> - foto <?= $i + 1 ?>">
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>

                    <!-- ===== INFORMACIÓN ===== -->
                    <section class="detalle__info">
                        <h1 class="detalle__titulo"><?= e($prod['Nombre']) ?></h1>
                        <p class="detalle__precio"><?= number_format($prod['Precio'], 2, ',', '.') ?> €</p>

                        <dl class="detalle__datos">
                            <dt>Estado</dt>      <dd><?= ucfirst($prod['EstadoArticulo']) ?></dd>
                            <?php if ($prod['Marca']): ?>
                                <dt>Marca</dt>   <dd><?= e($prod['Marca']) ?></dd>
                            <?php endif; ?>
                            <?php if ($prod['Talla']): ?>
                                <dt>Talla</dt>   <dd><?= e($prod['Talla']) ?></dd>
                            <?php endif; ?>
                            <dt>Categoría</dt>   <dd><?= e($prod['Tipo']) ?> · <?= e($prod['Categoria']) ?></dd>
                            <dt>Publicado</dt>   <dd><?= date('d/m/Y', strtotime($prod['FechaPublicacion'])) ?></dd>
                        </dl>

                        <?php if ($prod['Descripcion']): ?>
                            <h2 class="detalle__subtitulo">Descripción</h2>
                            <p class="detalle__descripcion"><?= nl2br(e($prod['Descripcion'])) ?></p>
                        <?php endif; ?>

                        <div class="detalle__vendedor">
                            <span class="detalle__avatar"><?= e(mb_substr($prod['Vendedor'], 0, 1)) ?></span>
                            <div>
                                <p class="detalle__vendedor-nombre"><?= e($prod['Vendedor']) ?></p>
                                <?php if ($prod['Ciudad']): ?>
                                    <p class="detalle__vendedor-ciudad"><?= e($prod['Ciudad']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ($prod['EstadoAnuncio'] === 'vendido'): ?>
                            <p class="detalle__aviso">Este producto ya se ha vendido.</p>
                        <?php endif; ?>

                        <!-- Acciones (aún sin funcionalidad) -->
                        <div class="detalle__acciones">
                            <a href="./edit_producto.php?id=<?=$prod["IdProducto"]?>" class="detalle__accion" aria-label="Editar producto" title="Editar">&#9998;</a>
                            <a href="./php/delete_prod.php?id=<?=$prod["IdProducto"]?>" class="detalle__accion detalle__accion--eliminar" aria-label="Eliminar producto" title="Eliminar">&#10005;</a>
                        </div>
                    </section>
                </div>
            <?php endif; ?>
        </main>

        <!-- ===== FOOTER ===== -->
        <?=displayFooter();?>

        <script src="js/app.js"></script>
    </body>
</html>
