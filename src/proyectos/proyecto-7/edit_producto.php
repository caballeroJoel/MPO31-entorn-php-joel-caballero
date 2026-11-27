<?php
    include_once "./php/funcions.php";
    include_once "./php/templates.php";
    require_once "./php/db/config.php";

    try {
        $pdo = db();
    } catch (PDOException $e){
        die("Error de conexion - ". $e->getMessage());
    }

    $estadosArticulo = ['nuevo' => 'Nuevo', 'como nuevo' => 'Como nuevo', 'buen estado' => 'Buen estado', 'usado' => 'Usado'];
    $estadosAnuncio  = ['disponible' => 'Disponible', 'reservado' => 'Reservado', 'vendido' => 'Vendido'];

    $categorias = $pdo->query("
        SELECT c.IdCategoria, c.Nombre, t.Nombre AS Tipo
        FROM Categorias c
        JOIN TiposProducto t ON t.IdTipo = c.IdTipo
        ORDER BY t.Nombre, c.Nombre;
    ");
    $categorias = $categorias->fetchAll();
    $idsCategoria = array_column($categorias, 'IdCategoria');

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?: filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $prod = false;
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM Productos WHERE IdProducto = :id;");
        $stmt->execute(['id' => $id]);
        $prod = $stmt->fetch();
    }

    $errores = [];

    if ($prod && $_SERVER["REQUEST_METHOD"] == "POST") {
        // Datos del formulario (trim quita espacios sobrantes)
        $datos = [
            'Nombre'         => trim($_POST['nombre'] ?? ''),
            'Descripcion'    => trim($_POST['descripcion'] ?? ''),
            'Marca'          => trim($_POST['marca'] ?? ''),
            'Talla'          => trim($_POST['talla'] ?? ''),
            'Precio'         => trim($_POST['precio'] ?? ''),
            'EstadoArticulo' => $_POST['estado_articulo'] ?? '',
            'EstadoAnuncio'  => $_POST['estado_anuncio'] ?? '',
            'IdCategoria'    => $_POST['categoria'] ?? '',
        ];

        // Validación: nunca fiarse de lo que llega del navegador
        if ($datos['Nombre'] === '' || mb_strlen($datos['Nombre']) > 100) {
            $errores[] = "El nombre es obligatorio (máximo 100 caracteres).";
        }
        if (mb_strlen($datos['Marca']) > 50) {
            $errores[] = "La marca no puede tener más de 50 caracteres.";
        }
        if (mb_strlen($datos['Talla']) > 10) {
            $errores[] = "La talla no puede tener más de 10 caracteres.";
        }
        if (!is_numeric($datos['Precio']) || $datos['Precio'] < 0) {
            $errores[] = "El precio tiene que ser un número igual o mayor que 0.";
        }
        if (!array_key_exists($datos['EstadoArticulo'], $estadosArticulo)) {
            $errores[] = "Elige un estado del artículo válido.";
        }
        if (!array_key_exists($datos['EstadoAnuncio'], $estadosAnuncio)) {
            $errores[] = "Elige un estado del anuncio válido.";
        }
        if (!in_array($datos['IdCategoria'], $idsCategoria)) {
            $errores[] = "Elige una categoría válida.";
        }

        if (!$errores) {
            // FechaVenta: la BBDD exige que exista solo si está vendido (CHECK chk_venta)
            $sql = "
                UPDATE Productos SET
                    Nombre = :nombre,
                    Descripcion = :descripcion,
                    Marca = :marca,
                    Talla = :talla,
                    Precio = :precio,
                    EstadoArticulo = :estadoArticulo,
                    EstadoAnuncio = :estadoAnuncio,
                    FechaVenta = CASE WHEN :estadoAnuncio2 = 'vendido' THEN COALESCE(FechaVenta, NOW()) ELSE NULL END,
                    IdCategoria = :categoria
                WHERE IdProducto = :id;
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nombre'         => $datos['Nombre'],
                'descripcion'    => $datos['Descripcion'] !== '' ? $datos['Descripcion'] : null,   // vacío -> NULL
                'marca'          => $datos['Marca'] !== '' ? $datos['Marca'] : null,
                'talla'          => $datos['Talla'] !== '' ? $datos['Talla'] : null,
                'precio'         => $datos['Precio'],
                'estadoArticulo' => $datos['EstadoArticulo'],
                'estadoAnuncio'  => $datos['EstadoAnuncio'],
                'estadoAnuncio2' => $datos['EstadoAnuncio'],
                'categoria'      => $datos['IdCategoria'],
                'id'             => $id,
            ]);

            header("Location: ./detalle_producto.php?id=$id");
            exit;
        }

        // Si hay errores, el formulario se vuelve a pintar con lo que escribió el usuario
        $prod = array_merge($prod, $datos);
    }

    if (!$prod) {
        http_response_code(404);
    }

    function e($texto) {
        return htmlspecialchars($texto ?? '');
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar <?= $prod ? e($prod['Nombre']) : 'producto' ?> - reSell</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles/colors.css">
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>

        <!-- ===== HEADER ===== -->
        <?= displayHeader();?>

        <main class="detalle editar">

            <?php if (!$prod): ?>
                <div class="resultados__vacio">
                    <p>Este producto no existe o ya no está publicado.</p>
                    <a href="./filtrado_productos.php" class="btn btn--borde">Ver todos los productos</a>
                </div>
            <?php else: ?>

                <nav class="detalle__migas" aria-label="Ruta">
                    <a href="./filtrado_productos.php">Productos</a> ›
                    <a href="./detalle_producto.php?id=<?= $id ?>"><?= e($prod['Nombre']) ?></a> ›
                    Editar
                </nav>

                <section class="detalle__info">
                    <h1 class="detalle__titulo">Editar producto</h1>

                    <?php if ($errores): ?>
                        <ul class="editar__errores" role="alert">
                            <?php foreach ($errores as $error): ?>
                                <li><?= e($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <form action="./edit_producto.php" method="post">
                        <input type="hidden" name="id" value="<?= $id ?>">

                        <div class="filtro">
                            <label class="filtro__titulo" for="nombre">Nombre *</label>
                            <input type="text" id="nombre" name="nombre" maxlength="100" required value="<?= e($prod['Nombre']) ?>">
                        </div>

                        <div class="filtro">
                            <label class="filtro__titulo" for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion"><?= e($prod['Descripcion']) ?></textarea>
                        </div>

                        <div class="editar__fila">
                            <div class="filtro">
                                <label class="filtro__titulo" for="marca">Marca</label>
                                <input type="text" id="marca" name="marca" maxlength="50" value="<?= e($prod['Marca']) ?>">
                            </div>
                            <div class="filtro">
                                <label class="filtro__titulo" for="talla">Talla</label>
                                <input type="text" id="talla" name="talla" maxlength="10" placeholder="Vacío si no aplica" value="<?= e($prod['Talla']) ?>">
                            </div>
                        </div>

                        <div class="editar__fila">
                            <div class="filtro">
                                <label class="filtro__titulo" for="precio">Precio (€) *</label>
                                <input type="number" id="precio" name="precio" min="0" step="0.01" required value="<?= e($prod['Precio']) ?>">
                            </div>
                            <div class="filtro">
                                <label class="filtro__titulo" for="categoria">Categoría *</label>
                                <select id="categoria" name="categoria" required>
                                    <?php $tipoActual = null; ?>
                                    <?php foreach ($categorias as $cat): ?>
                                        <?php if ($cat['Tipo'] !== $tipoActual): ?>
                                            <?php if ($tipoActual !== null): ?></optgroup><?php endif; ?>
                                            <optgroup label="<?= e($cat['Tipo']) ?>">
                                            <?php $tipoActual = $cat['Tipo']; ?>
                                        <?php endif; ?>
                                        <option value="<?= $cat['IdCategoria'] ?>" <?= (string) $cat['IdCategoria'] === (string) $prod['IdCategoria'] ? 'selected' : '' ?>><?= e($cat['Nombre']) ?></option>
                                    <?php endforeach; ?>
                                    <?php if ($tipoActual !== null): ?></optgroup><?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="editar__fila">
                            <div class="filtro">
                                <label class="filtro__titulo" for="estado_articulo">Estado del artículo *</label>
                                <select id="estado_articulo" name="estado_articulo" required>
                                    <?php foreach ($estadosArticulo as $valor => $texto): ?>
                                        <option value="<?= $valor ?>" <?= $valor === $prod['EstadoArticulo'] ? 'selected' : '' ?>><?= $texto ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="filtro">
                                <label class="filtro__titulo" for="estado_anuncio">Estado del anuncio *</label>
                                <select id="estado_anuncio" name="estado_anuncio" required>
                                    <?php foreach ($estadosAnuncio as $valor => $texto): ?>
                                        <option value="<?= $valor ?>" <?= $valor === $prod['EstadoAnuncio'] ? 'selected' : '' ?>><?= $texto ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="editar__botones">
                            <a href="./detalle_producto.php?id=<?= $id ?>" class="btn btn--borde">Cancelar</a>
                            <button type="submit" class="btn btn--relleno">Guardar cambios</button>
                        </div>
                    </form>
                </section>
            <?php endif; ?>
        </main>

        <!-- ===== FOOTER ===== -->
        <?=displayFooter();?>

        <script src="js/app.js"></script>
    </body>
</html>
