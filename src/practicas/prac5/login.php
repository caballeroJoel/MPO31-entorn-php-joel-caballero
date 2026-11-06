<?php
require_once 'functions.php';
$usuarios = [
    ['username'=>'admin','password'=>'adminpass','role'=>'admin'],
    ['username'=>'reader','password'=>'readerpass','role'=>'lector']
];
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $photo = trim($_POST['photo'] ?? '');
    foreach ($usuarios as $usuario) {
        if ($username === $usuario['username'] && $password === $usuario['password']) {
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['role'] = $usuario['role'];
            $_SESSION['photo'] = $photo;
            header('Location: home.php'); exit;
        }
    }
    $error = 'Usuario o contraseña incorrectos.';
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Biblioteca Virtual - Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <section>
            <?php for ($i=0;$i<180;$i++): ?>
                <span></span>
            <?php endfor; ?>
            <div class="signin">
                <div class="content text-center">
                    <h2>Inicia sesión</h2>
                    <form method="POST" action="login.php" class="form w-100">
                        <div class="inputBox">
                            <input class="w-100" placeholder="Username" type="text" name="username" required>
                        </div>
                        <div class="inputBox">
                            <input class="w-100" placeholder="Password" type="password" name="password" required>
                        </div>
                        <div class="inputBox">
                            <input class="w-100" placeholder="URL de foto de perfil" type="url" name="photo">
                        </div>
                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        <div class="inputBox">
                            <input class="btn mt-2" type="submit" value="Iniciar">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>
