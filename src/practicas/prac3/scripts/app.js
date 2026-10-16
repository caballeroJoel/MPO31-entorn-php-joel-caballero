const content = document.querySelector("#contentCartelera");

content.addEventListener("mouseover", (event) => {
    if (event.target.closest(".movie")) {
        const mov = event.target.closest(".movie");

        if (mov && !mov.contains(event.relatedTarget)) {
            const imagen = mov.style.backgroundImage;

            mov.dataset.imagenOriginal = imagen;

            mov.style.backgroundImage =
                `linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), ${imagen}`;

            mov.firstElementChild?.classList.remove("hidden");
        }
    }
});

content.addEventListener("mouseout", (event) => {
    const mov = event.target.closest(".movie");

    if (mov && !mov.contains(event.relatedTarget)) {
        mov.style.backgroundImage = mov.dataset.imagenOriginal;
        mov.firstElementChild?.classList.add("hidden");
    }
});