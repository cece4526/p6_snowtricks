function afficherDiv() {
    const mediaDiv = document.getElementById("mediaResponsive");
    mediaDiv.classList.remove("d-none");
    toggleButton.classList.add("d-none");
}

// Écouteur d'événement pour le bouton
const toggleButton = document.getElementById("toggleButton");
toggleButton.addEventListener("click", afficherDiv);
