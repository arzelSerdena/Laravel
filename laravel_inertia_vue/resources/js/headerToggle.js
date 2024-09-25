document.addEventListener("DOMContentLoaded", () => {
    const headerToggles = document.querySelectorAll(".headerToggle");
    const headerHiddenDiv = document.querySelector(".headerHiddenDiv");

    headerToggles.forEach((headerToggle) => {
        headerToggle.addEventListener("click", (event) => {
            event.stopPropagation();
            headerToggle.classList.toggle("active");
            headerHiddenDiv.classList.toggle("opacity-100");
            headerHiddenDiv.classList.toggle("max-h-[1000px]");
        });
    });

    document.addEventListener("click", () => {
        headerToggles.forEach((headerToggle) => {
            headerToggle.classList.remove("active");
        });
        headerHiddenDiv.classList.remove("opacity-100");
        headerHiddenDiv.classList.remove("max-h-[1000px]");
    });
});
