$(document).ready(function() {
    $("#profil").click(function() {
        $("#dropdown").toggle()
    });
});


document.getElementById('toggleDescription').addEventListener('change', function () {
    const descriptionSection = document.getElementById('descriptionSection');
    descriptionSection.style.display = this.checked ? 'flex' : 'none';
});
