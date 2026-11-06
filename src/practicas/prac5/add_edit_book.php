<?php

    require_once 'functions.php';
    exigirAdmin();

    $id = $_GET['id'];
    $editando = $id !== null && $id !== false && isset($_SESSION['libros'][$id]);
    if (isset($_GET['id']) && !$editando) { 
        header('Location: home.php'); 
    }
    $libro = $editando ? $_SESSION['libros'][$id] : ['titulo'=>'','autor'=>'','imagen'=>'','descripcion'=>''];
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = trim($_POST['titulo'] ?? '');
        $autor = trim($_POST['autor'] ?? '');
        $imagen = trim($_POST['imagen'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $libro = compact('titulo','autor','imagen','descripcion');
        if ($titulo === '' || $autor === '') $error = 'El título y el autor son obligatorios.';
        elseif ($imagen !== '' && !filter_var($imagen, FILTER_VALIDATE_URL)) $error = 'La URL de la imagen no es válida.';
        else {
            if ($editando) editarLibro($id,$titulo,$autor,$imagen,$descripcion);
            else agregarLibro($titulo,$autor,$imagen,$descripcion);
            header('Location: home.php'); 
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $editando ? 'Editar' : 'Agregar' ?> libro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="bg-light py-3 mb-4 shadow-sm">
            <div class="container d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="m-0">👋 Bienvenido, <?= $_SESSION['username'] ?></h4>
                    <p class="text-muted m-0">Administrador ✏️</p>
                </div>
                <a href="home.php" class="btn btn-secondary btn-sm">Volver a la Biblioteca</a>
            </div>
        </header>
        <main class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold"><?= $editando ? 'Editar Libro' : 'Agregar Nuevo Libro' ?></h2>
                <p class="lead"><?= $editando ? 'Modifica los datos del libro.' : 'Introduce los datos del nuevo libro.' ?></p>
            </div>
            <?php if ($error): ?>
                <div class="alert alert-danger mx-auto" style="max-width:600px">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <form method="POST" class="mx-auto" style="max-width:600px">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $libro['titulo'] ?>" placeholder="Título" required>
                    <label for="titulo">Título</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="autor" name="autor" value="<?= $libro['autor'] ?>" placeholder="Autor" required>
                    <label for="autor">Autor</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="url" class="form-control" id="imagen" name="imagen" value="<?= $libro['imagen'] ?>" placeholder="URL de la Imagen">
                    <label for="imagen">URL de la Imagen</label>
                </div>
                <div class="form-floating mb-4">
                    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" style="height:150px"><?= $libro['descripcion'] ?></textarea>
                    <label for="descripcion">Descripción</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg"><?= $editando ? 'Guardar cambios' : 'Agregar libro' ?></button>
                </div>
            </form>
        </main>
    </body>
</html>
