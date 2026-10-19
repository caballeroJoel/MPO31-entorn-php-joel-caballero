<?php

    function generarTablaProductos($productos) {
        ?>
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($productos as $prod):
                    ?>
                            <tr class="<?php if($prod["stock"]==0){echo "table-danger";}?>">
                                <td><?=ucfirst($prod["nombre"])?></td>
                                <td><?=$prod["precio"]?> €</td>
                                <td><?=$prod["stock"]?></td>
                            </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
        <?php
    }

    function muestraInfoContacto($user) {
        ?>
            <div class="container mt-4">
                <div class="row align-items-center">

                    <!-- Imagen a la izquierda -->
                    <div class="col-md-4 text-center">
                        <img
                            src="<?= htmlspecialchars($user["foto"]) ?>"
                            class="img-fluid rounded-circle"
                            style="object-fit: cover;"
                        >
                    </div>

                    <!-- Información a la derecha -->
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p><strong>Nombre:</strong> <?= htmlspecialchars($user["nombre"]) ?></p>
                                <p><strong>Apellidos:</strong> <?= htmlspecialchars($user["apellidos"]) ?></p>
                                <p><strong>Teléfono:</strong> <?= htmlspecialchars($user["telefono"]) ?></p>
                                <p><strong>DNI:</strong> <?= htmlspecialchars($user["dni"]) ?></p>
                                <p><strong>Correo:</strong> <?= htmlspecialchars($user["email"]) ?></p>
                                <p class="mb-0"><strong>Código Socio:</strong> <?= htmlspecialchars($user["codigoSocio"]) ?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php
    }