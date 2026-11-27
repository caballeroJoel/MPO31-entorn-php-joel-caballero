<?php

    function displayHeader() {
        return "
            <header class='header'>
                <div class='header__contenedor'>
                    <a href='./' class='logo'>re<span>Sell</span></a>

                    <form class='buscador' action='./filtrado_productos.php' method='get' role='search'>
                        <input type='search' name='q' placeholder='Buscar productos...' aria-label='Buscar productos'>
                        <button type='submit'>Buscar</button>
                    </form>

                    <nav class='usuario'>
                        <a href='#' class='btn btn--borde'>Iniciar sesión</a>
                        <a href='#' class='btn btn--relleno'>Registrarse</a>
                    </nav>
                </div>
            </header>
        ";
    }

    function displayFooter() {
        return '
            <footer class="footer">
                <p>&copy; 2026 reSell. Todos los derechos reservados.</p>
            </footer>
        ';
    }