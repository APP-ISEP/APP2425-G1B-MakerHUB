// Fonction pour ouvrir la modale avec l'image
function openModal(imageSrc) {
    var modal = document.getElementById("imageModal");
    var modalImage = document.getElementById("modalImage");
    modal.style.display = "block"; // Afficher la modale
    modalImage.src = imageSrc; // Définir la source de l'image dans la modale
}

// Fonction pour fermer la modale
function closeModal() {
    var modal = document.getElementById("imageModal");
    modal.style.display = "none"; // Masquer la modale
}
