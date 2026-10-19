<?php
    include "./includes/header.php";
    include "./includes/funciones.php";
    include "./data/productos.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mercadona productos</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous"
    >
</head>

<body>

    <?php

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    ?>
            <script>
                alert("Debes rellenar el formulario antes");
                window.location.href = "./inicio.php";
            </script>
    <?php
        exit;
    }

        if($_SERVER["REQUEST_METHOD"]=="POST") {
            $user = [
                "nombre" => $_POST["nombre"],
                "apellidos" => $_POST["apellidos"],
                "telefono" => $_POST["telefono"],
                "dni" => $_POST["dni"],
                "codigoSocio" => $_POST["codigoSocio"],
                "email" => $_POST["correo"],
                "foto" => ""
            ];

            if($_POST["foto"]=="" || !$_POST["foto"]) {
                $user["foto"] = "https://definicion.de/wp-content/uploads/2019/07/perfil-de-usuario.png";
            } else {    
                $user["foto"] = $_POST["foto"];
            }
        }

        mostrarHeader($user);

    ?>

    <div class="container">

        <div>
            <h2>Productos disponibles</h2>

            <?php
                generarTablaProductos($productos);
            ?>
        </div>

        <!-- Aquí incluye los datos de contacto del cliente con un toast live -->

        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-secondary"
            data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"
        >
            Mi perfil 🖐
        </button>

        <!-- Modal que al clicar aparece info de contacto -->
        <div
            class="modal fade"
            id="staticBackdrop"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Información de contacto
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>

                    <div class="modal-body">
                        <?php
                            muestraInfoContacto($user);
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal con la lista de productos que están disponibles -->
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <!-- Aquí la lista de productos -->
        </div>

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"
    ></script>

</body>

<?php
    include "./includes/footer.php";
?>

</html>