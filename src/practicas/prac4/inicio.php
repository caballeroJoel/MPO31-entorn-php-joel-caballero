<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bienvenido a Mercadona</title>

    <!-- Link CSS Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous"
    >
</head>

<body>

    <div class="container-fluid">
        <div class="container text-center my-5">
            <h1>Bienvenido a Mercadona</h1>
            <p>Por favor, completa el siguiente formulario para continuar tu compra.</p>
        </div>

        <div class="container">
            
            <form action="index.php" method="POST">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        name="nombre"
                        placeholder="Introduce tu nombre"
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input
                        type="text"
                        class="form-control"
                        id="apellidos"
                        name="apellidos"
                        placeholder="Introduce tus apellidos"
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Número de teléfono</label>
                    <input
                        type="tel"
                        class="form-control"
                        id="telefono"
                        name="telefono"
                        placeholder="Introduce tu teléfono"
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input
                        type="text"
                        class="form-control"
                        id="dni"
                        name="dni"
                        placeholder="Introduce tu DNI"
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="codigoSocio" class="form-label">Código de socio</label>
                    <input
                        type="text"
                        class="form-control"
                        id="codigoSocio"
                        name="codigoSocio"
                        placeholder="Introduce tu código de socio"
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico</label>
                    <input
                        type="email"
                        class="form-control"
                        id="correo"
                        name="correo"
                        placeholder="Introduce tu correo electrónico"
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto de perfil</label>
                    <input
                        type="text"
                        class="form-control"
                        id="foto"
                        name="foto"
                        placeholder="Introduce url para la foto de perfil"
                    >
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn btn-success">
                    Continuar
                </button>

            </form>
            <!-- AQUÍ PUEDES USAR UN FORM DE BOOTSTRAP 5 SENCILLO PARA PEDIR LOS DATOS:
                 - NOMBRE
                 - APELLIDOS
                 - NÚMERO DE TELÉFONO
                 - DNI
                 - CÓDIGO DE SOCIO
                 - CORREO ELECTRÓNICO
            -->
        </div>
    </div>

    <?php
        include "./includes/footer.php";
    ?>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"
    ></script>

</body>

</html>