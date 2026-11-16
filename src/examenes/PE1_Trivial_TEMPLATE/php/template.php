<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    function displayheader() {
        $header = '
            <header class="cap">
                <div class="contenidor navegacio">
                    <a class="marca" href="index.php">Trivial Pe1</a>
                    <nav class="enllacos">
                        <a href="index.php">Inici</a>
                        <a href="registre.php">Registre</a>
                        <a href="login.php">Login</a>
                        <a href="joc.php">Joc</a>
        ';

        if (
            isset($_SESSION['user']) &&
            $_SESSION['user']['rol'] === "admin"
        ) {
            $header .= '
                        <a href="admin.php">Administració</a>
            ';
        }

        $header .= '
                    </nav>
                </div>
            </header>
        ';

        return $header;
    }

    function displayfooter() {
        return '
            <footer class="peu">
                AQUEST FOOTER HA DE SER REUTILITZABLE
            </footer>
        ';
    }
