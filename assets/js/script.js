$(document).ready(function () {
    $("#profil").click(function () {
        $("#dropdown").toggle()
    });
});

//--------- BEGINNING OF THE CHEVRON IN FAQ PAGE ---------//
$(document).ready(function() {
    $(".question").click(function() {
        $(".answer:visible").not($(this)
            .find(".answer"))
            .toggle();

        $(".chevron").not($(this)
            .find(".chevron"))
            .removeClass("up")
            .addClass("down");

        $(this).find(".answer")
            .toggle();

        $(this).find('.chevron')
            .toggleClass('down up');
    });
});
//--------- END OF THE CHEVRON IN FAQ PAGE ---------//


//--------- BEGINNING EYE BUTTON TO SEE PASSWORD---------//
let pwShown = 0;
const passwordContainer = document.getElementById('password');
const eye = document.getElementById('eye');

const editAttributePassword = (valueName) => {
    passwordContainer.setAttribute('type', valueName);
}

if(eye) {
    eye.onclick = () => {
        editAttributePassword(pwShown === 0 ? 'text' : 'password');
        pwShown = pwShown === 0 ? 1 : 0;
    }
}
//--------- END EYE BUTTON TO SEE PASSWORD---------//


//--------- BEGINNING TOGGLE BUTTON ---------//
$(document).ready(() => {
    const aboutMe = $('#aboutMe');
    aboutMe.hide();
    $('#maker-checkbox').change(() => {
        aboutMe.toggle();
    })
});
//--------- END TOGGLE BUTTON ---------//


//--------- BEGINNING OF CATEGORIES INSIDE HOME PAGE---------//
$(document).ready(() => {
    const categoryOffer = $('.category-offer');
    const categoryRequest = $('.category-request');
    const offersContainer = $('.offers-container');
    const requestsContainer = $('.requests-container');
    requestsContainer.hide();

    function toggleCategories(activeCategory, inactiveCategory, showContainer, hideContainer) {
        activeCategory.addClass("active-category").removeClass("inactive-category");
        inactiveCategory.addClass("inactive-category").removeClass("active-category");
        showContainer.show();
        hideContainer.hide();
    }

    categoryOffer.click(() => {
        toggleCategories(categoryOffer, categoryRequest, offersContainer, requestsContainer);
    });

    categoryRequest.click(() => {
        toggleCategories(categoryRequest, categoryOffer, requestsContainer, offersContainer);
    });
});

//--------- END OF CATEGORIES INSIDE HOME PAGE---------//



//--------- BEGINNING OF CONTACT PAGE COUNTER---------//
<<<<<<< Updated upstream
const textarea = document.getElementById("message-contact");//Cela te donne une référence au champ de texte entier dans le DOM, 
//c'est-à-dire à tous ses attributs et propriétés. Cela ne récupère pas automatiquement la valeur d’un attribut spécifique comme 
//maxlength, mais l'objet entier représentant l'élément <textarea>.
=======

/*
Cela te donne une référence au champ de texte entier dans le DOM, 
c'est-à-dire à tous ses attributs et propriétés. Cela ne récupère pas automatiquement la valeur d’un attribut spécifique comme 
maxlength, mais l'objet entier représentant l'élément <textarea>.
*/

const textarea = document.getElementById("message-contact");
>>>>>>> Stashed changes
const wordCounter = document.querySelector(".word-counter");
const maxLength = textarea.maxLength;
var restLetter = maxLength - (textarea.value).length;

textarea.addEventListener ('input', () => {
    restLetter = maxLength - (textarea.value).length;
    wordCounter.textContent = `${restLetter} restants`;
})
<<<<<<< Updated upstream
=======
//--------- END OF CONTACT PAGE COUNTER---------//

>>>>>>> Stashed changes

//--------- END OF CONTACT PAGE COUNTER---------//