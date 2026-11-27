// =====================================================
//  Filtros: la categoría depende del tipo de producto
// =====================================================
document.addEventListener('DOMContentLoaded', () => {
    const selectTipo = document.getElementById('tipo');
    const selectCategoria = document.getElementById('categoria');

    // Solo existe en filtrado_productos.php
    if (!selectTipo || !selectCategoria) return;

    // Copia de todas las categorías (menos "Todas") para poder reconstruir la lista
    const todasCategorias = Array.from(selectCategoria.querySelectorAll('option[data-tipo]'));

    function actualizarCategorias() {
        const tipo = selectTipo.value;
        const seleccionada = selectCategoria.value;

        // Dejar solo la opción "Todas"
        selectCategoria.querySelectorAll('option[data-tipo]').forEach(op => op.remove());

        if (tipo === '') {
            selectCategoria.value = '';
            selectCategoria.disabled = true;
            return;
        }

        // Añadir solo las categorías del tipo elegido
        todasCategorias
            .filter(op => op.dataset.tipo === tipo)
            .forEach(op => selectCategoria.appendChild(op));

        // Mantener la categoría elegida si pertenece al tipo; si no, "Todas"
        const sigueValida = todasCategorias.some(op => op.value === seleccionada && op.dataset.tipo === tipo);
        selectCategoria.value = sigueValida ? seleccionada : '';
        selectCategoria.disabled = false;
    }

    selectTipo.addEventListener('change', actualizarCategorias);

    // Al cargar la página (por si ya viene un tipo en la URL)
    actualizarCategorias();
});
