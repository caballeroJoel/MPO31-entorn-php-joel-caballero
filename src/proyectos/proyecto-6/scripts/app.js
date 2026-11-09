const tipo = document.querySelector("#tipo");

const numero = document.querySelector("#apuestaNumero");
const color = document.querySelector("#apuestaColor");
const par = document.querySelector("#apuestaPar");

tipo.addEventListener("change", () => {

    numero.hidden = true;
    color.hidden = true;
    par.hidden = true;

    numero.disabled = true;
    color.disabled = true;
    par.disabled = true;

    if (tipo.value == "numero") {
        numero.hidden = false;
        numero.disabled = false;
        numero.required = true;
    }

    if (tipo.value == "color") {
        color.hidden = false;
        color.disabled = false;
        color.required = true;
    }

    if (tipo.value == "pares") {
        par.hidden = false;
        par.disabled = false;
        par.required = true;
    }

});


const ruleta = document.querySelector("#ruleta");
const resultado = document.querySelector("#resultado");

if (typeof resultadoRuleta !== "undefined" && resultadoRuleta.animar) {

    const vueltas = 5;
    const gradosFinales = (vueltas * 360) + resultadoRuleta.posicion;

    // Iniciar animación
    ruleta.style.transform = `rotate(${gradosFinales}deg)`;

    // Esperar a que termine la animación
    ruleta.addEventListener("transitionend", () => {

        resultado.classList.remove("hidden");

    }, { once: true });

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

        selecciones.push({
            tipo: tipo,
            numeros: numeros
        });

        elemento.classList.add("seleccionada");

    }

    // Actualizar iluminación permanente
    actualizarSeleccion();

    console.log(selecciones);
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
            "pleno",
            [Number(casilla.dataset.numero)],
            casilla
        );

    });

});


// ==================================
// INICIAR Y ADAPTAR TAMAÑO
// ==================================

generarZonas();

window.addEventListener("resize", generarZonas);
