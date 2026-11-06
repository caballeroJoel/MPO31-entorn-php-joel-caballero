<?php
require_once 'functions.php';
exigirLogin();
$admin = $_SESSION['role'] === 'admin';
$libros = $_SESSION['libros'];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Biblioteca Virtual - Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="bg-light py-3 mb-4 shadow-sm">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <?php if (!empty($_SESSION['photo'])): ?>
                        <img src="<?= $_SESSION['photo'] ?>" alt="Foto de perfil" style="width:64px;height:64px;object-fit:cover;border-radius:50%" referrerpolicy="no-referrer">
                    <?php endif; ?>
                    <div>
                        <h4 class="m-0">👋 Bienvenido, <?= $_SESSION['username'] ?>!</h4>
                        <p class="text-muted m-0"><?= $admin ? 'Administrador ✏️' : 'Lector 📚' ?></p>
                    </div>
                </div>
                <a href="logout.php" class="btn btn-warning btn-sm">Cerrar sesión ❌</a>
            </div>
        </header>
        <main class="container pb-5">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold">Biblioteca Virtual</h1>
                <p class="lead">Disfruta explorando nuestra colección de libros</p>
            </div>
            <?php if ($admin): ?>
                <div class="text-center mb-4">
                    <a href="add_edit_book.php" class="btn btn-outline-success btn-lg">➕ Agregar Nuevo Libro</a>
                </div>
            <?php endif; ?>
            <?php if (!$libros): ?>
                <p class="text-center">Todavía no hay libros en la biblioteca.</p>
            <?php endif; ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($libros as $id=>$libro): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <?php if ($libro['imagen'] !== ''): ?>
                                <img src="<?= $libro['imagen'] ?>" class="card-img-top" alt="Portada de <?= $libro['titulo'] ?>" style="height:350px;object-fit:contain;background:#f8f9fa" loading="lazy">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $libro['titulo'] ?></h5>
                                <p class="card-text"><strong>Autor:</strong> <?= $libro['autor'] ?></p>
                                <p class="card-text"><?= nl2br($libro['descripcion']) ?></p>
                            </div>
                            <?php if ($admin): ?>
                                <div class="card-footer d-flex justify-content-between">
                                    <a href="add_edit_book.php?id=<?= $id ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                                    <form action="delete_book.php" method="POST" onsubmit="return confirm('¿Eliminar este libro?')">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <button class="btn btn-outline-danger btn-sm" type="submit">Eliminar</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </body>
</html>
