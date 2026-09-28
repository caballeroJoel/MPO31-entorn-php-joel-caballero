const menuSelector = document.querySelector("#menuSelector");

menuSelector
    .addEventListener("click", function(e) {
        const item = e.target.closest("#menuSelector > div");

        menuSelector.querySelectorAll(":scope > div").forEach((element) => {
            element.classList.remove("selected");
        });
        
        item.classList.add("selected");
    });