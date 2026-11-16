const tipo = document.querySelector("#tipo");

const numero = document.querySelector("#apuestaNumero");
const color = document.querySelector("#apuestaColor");
const par = document.querySelector("#apuestaPar");
const apuestaMesa = document.querySelector("#apuestaMesa");

function actualizarControles() {
    [numero, color, par].forEach(control => {
        control.hidden = true;
        control.disabled = true;
        control.required = false;
    });

    const controles = { numero, color, pares: par };
    const control = controles[tipo.value];

    if (control) {
        control.hidden = false;
        control.disabled = false;
        control.required = true;
    }
}

tipo.addEventListener("change", () => {
    apuestaMesa.disabled = true;
    apuestaMesa.value = "";
    actualizarControles();
});

actualizarControles();


const ruleta = document.querySelector("#ruleta");
const resultado = document.querySelector("#resultado");

if (typeof resultadoRuleta !== "undefined" && resultadoRuleta.animar) {

    const vueltas = 5;
    const gradosFinales = (vueltas * 360) + resultadoRuleta.posicion;

    const temporizadorResultado = window.setTimeout(() => {
        resultado.classList.remove("hidden");
    }, 5500);

    ruleta.addEventListener("transitionend", event => {
        if (event.target !== ruleta || event.propertyName !== "transform") {
            return;
        }

        window.clearTimeout(temporizadorResultado);
        resultado.classList.remove("hidden");
    }, { once: true });

    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            ruleta.style.transform = `rotate(${gradosFinales}deg)`;
        });
    });

}


const numerosDiv = document.querySelector(".numeros");
const zonasDiv = document.querySelector("#zonas");

const casillas = [...document.querySelectorAll(".numero")];

// Guardamos las apuestas seleccionadas
const selecciones = [];


// ==================================
// CREAR UNA ZONA DE APUESTA
// ==================================

function crearZona(tipo, numeros, x, y) {

    const zona = document.createElement("div");

    zona.classList.add("zona");

    zona.dataset.tipo = tipo;
    zona.dataset.numeros = numeros.join(",");

    zona.style.left = `${x}px`;
    zona.style.top = `${y}px`;

    // Iluminar números al pasar el ratón
    zona.addEventListener("mouseenter", () => {

        numeros.forEach(num => {
            document.querySelector(
                `.numero[data-numero="${num}"]`
            ).classList.add("iluminado");
        });

    });

    // Quitar iluminación
    zona.addEventListener("mouseleave", () => {

        document.querySelectorAll(".numero").forEach(num => {
            num.classList.remove("iluminado");
        });

    });

    // Seleccionar apuesta
    zona.addEventListener("click", () => {

        seleccionar(tipo, numeros, zona);

    });

    zonasDiv.appendChild(zona);
}


// ==================================
// SELECCIONAR / DESELECCIONAR
// ==================================

function seleccionar(tipo, numeros, elemento) {

    const indice = selecciones.findIndex(apuesta => {

        return apuesta.tipo === tipo &&
            apuesta.numeros.join(",") === numeros.join(",");

    });

    // Si ya estaba seleccionada, quitarla
    if (indice !== -1) {

        selecciones.splice(indice, 1);
        elemento.classList.remove("seleccionada");

    } else {

        // El formulario representa una tirada y, por tanto, una apuesta.
        document.querySelectorAll(".seleccionada").forEach(item => {
            item.classList.remove("seleccionada");
        });
        selecciones.splice(0, selecciones.length);

        selecciones.push({
            tipo: tipo === "pleno" ? "numero" : tipo,
            numeros: numeros,
            elemento: elemento
        });

        elemento.classList.add("seleccionada");

    }

    // Actualizar iluminación permanente
    actualizarSeleccion();
    sincronizarFormulario();

    console.log(selecciones);
}

function sincronizarFormulario() {
    const seleccion = selecciones[0];

    if (!seleccion) {
        apuestaMesa.disabled = true;
        apuestaMesa.value = "";
        return;
    }

    tipo.value = seleccion.tipo;
    actualizarControles();

    const valor = seleccion.tipo === "color" || seleccion.tipo === "pares"
        ? seleccion.numeros[0]
        : seleccion.numeros.join(",");

    if (seleccion.tipo === "numero") {
        numero.value = seleccion.numeros[0];
    } else if (seleccion.tipo === "color") {
        color.value = valor;
    } else if (seleccion.tipo === "pares") {
        par.value = valor;
    } else {
        apuestaMesa.value = valor;
        apuestaMesa.disabled = false;
    }
}


// ==================================
// ACTUALIZAR NÚMEROS SELECCIONADOS
// ==================================

function actualizarSeleccion() {

    casillas.forEach(casilla => {

        const num = Number(casilla.dataset.numero);

        const seleccionado = selecciones.some(apuesta => {
            return apuesta.numeros.includes(num);
        });

        casilla.classList.toggle("seleccionado", seleccionado);

    });

}


// ==================================
// GENERAR ZONAS
// ==================================

function generarZonas() {

    zonasDiv.innerHTML = "";

    const rectContenedor = zonasDiv.getBoundingClientRect();

    // Matriz de números: 3 filas y 12 columnas
    const matriz = [];

    for (let fila = 0; fila < 3; fila++) {

        matriz[fila] = [];

        for (let columna = 0; columna < 12; columna++) {

            matriz[fila][columna] = casillas[fila * 12 + columna];

        }

    }


    // ==================================
    // CABALLOS ENTRE COLUMNAS
    // Ejemplo: 3 y 6
    // ==================================

    for (let fila = 0; fila < 3; fila++) {

        for (let columna = 0; columna < 11; columna++) {

            const num1 = matriz[fila][columna];
            const num2 = matriz[fila][columna + 1];

            const r1 = num1.getBoundingClientRect();
            const r2 = num2.getBoundingClientRect();

            const x = (r1.right + r2.left) / 2 - rectContenedor.left;
            const y = (r1.top + r1.bottom) / 2 - rectContenedor.top;

            crearZona(
                "caballo",
                [
                    Number(num1.dataset.numero),
                    Number(num2.dataset.numero)
                ],
                x,
                y
            );

        }

    }


    // ==================================
    // CABALLOS ENTRE FILAS
    // Ejemplo: 3 y 2
    // ==================================

    for (let fila = 0; fila < 2; fila++) {

        for (let columna = 0; columna < 12; columna++) {

            const num1 = matriz[fila][columna];
            const num2 = matriz[fila + 1][columna];

            const r1 = num1.getBoundingClientRect();
            const r2 = num2.getBoundingClientRect();

            const x = (r1.left + r1.right) / 2 - rectContenedor.left;
            const y = (r1.bottom + r2.top) / 2 - rectContenedor.top;

            crearZona(
                "caballo",
                [
                    Number(num1.dataset.numero),
                    Number(num2.dataset.numero)
                ],
                x,
                y
            );

        }

    }


    // ==================================
    // CUADROS
    // Ejemplo: 3, 6, 2 y 5
    // ==================================

    for (let fila = 0; fila < 2; fila++) {

        for (let columna = 0; columna < 11; columna++) {

            const num1 = matriz[fila][columna];
            const num2 = matriz[fila][columna + 1];
            const num3 = matriz[fila + 1][columna];
            const num4 = matriz[fila + 1][columna + 1];

            const r1 = num1.getBoundingClientRect();
            const r4 = num4.getBoundingClientRect();

            const x = (r1.right + num2.getBoundingClientRect().left) / 2
                - rectContenedor.left;

            const y = (r1.bottom + num3.getBoundingClientRect().top) / 2
                - rectContenedor.top;

            crearZona(
                "cuadro",
                [
                    Number(num1.dataset.numero),
                    Number(num2.dataset.numero),
                    Number(num3.dataset.numero),
                    Number(num4.dataset.numero)
                ],
                x,
                y
            );

        }

    }

}


// ==================================
// PLENOS
// ==================================

casillas.forEach(casilla => {

    casilla.addEventListener("click", () => {

        seleccionar(
            "numero",
            [Number(casilla.dataset.numero)],
            casilla
        );

    });

});

document.querySelector(".cero").addEventListener("click", event => {
    seleccionar("numero", [0], event.currentTarget);
});

document.querySelectorAll("[data-tipo][data-apuesta]").forEach(elemento => {
    elemento.addEventListener("click", () => {
        const tipoApuesta = elemento.dataset.tipo;
        const valor = elemento.dataset.apuesta;
        const numeros = (tipoApuesta === "color" || tipoApuesta === "pares")
            ? [valor]
            : [Number(valor)];

        seleccionar(tipoApuesta, numeros, elemento);
    });
});


// ==================================
// INICIAR Y ADAPTAR TAMAÑO
// ==================================

generarZonas();

window.addEventListener("resize", generarZonas);
