$(document).ready(function() {
    $("#profil").click(function() {
        $("#dropdown").toggle()
    });
});

//--------- BEGINNING EYE BUTTON TO SEE PASSWORD---------//
function show() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'text');
}

function hide() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'password');
}

var pwShown = 0;

document.getElementById("eye").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
    }
}, false);
//--------- END EYE BUTTON TO SEE PASSWORD---------//

document.getElementById('toggleDescription').addEventListener('change', function () {
    const descriptionSection = document.getElementById('descriptionSection');
    descriptionSection.style.display = this.checked ? 'flex' : 'none';
});
