$(document).ready(function () {
    $("#profil").click(function () {
        $("#dropdown").toggle()
    });
});

//--------- BEGINNING OF THE CHEVRON IN FAQ PAGE ---------//
$(document).ready(function () {
    $(".question").click(function () {
        $(".answer").not($(this)
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

//--------- BEGINNING OF THE TOGGLE DESCRIPTION IN EDIT PROFIL PAGE ---------//
document.getElementById('toggleDescription').addEventListener('change', function () {
    const descriptionSection = document.getElementById('descriptionSection');
    descriptionSection.style.display = this.checked ? 'flex' : 'none';
});

//--------- END OF THE TOGGLE DESCRIPTION IN EDIT PROFIL PAGE ---------//

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