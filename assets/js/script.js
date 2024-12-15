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

//---- BEGINNING OF THE AJAX TO CHECK IF MAIL WAS ALREADY USED ----//
$(document).ready(() => {
    let timer;

    $("#passwordInfo").on("click", function () {
        clearTimeout(timer);
        $("#password-tooltip").fadeIn("slow");
    });

    $("#passwordInfo").on("mouseout", function () {
        timer = setTimeout(function () {
            $("#password-tooltip").fadeOut("slow");
        }, 2000);
    });

    let emailInput = document.getElementById('email');
    emailInput.addEventListener('change', function() {
        $.ajax({
            url: 'php/user/checkCredentials.php',
            type: 'POST',
            data: {fonction: 'uniqueMailJSON', email: emailInput.value},
            success: function(data) {
                const jsonData = JSON.parse(data);
                //console.log("Succès :", jsonData);
                //console.log(jsonData.unique);

                if(jsonData.unique === "false") {
                    alert("L'email que vous avez choisi a déjà utilisé");
                }
            },
            error: function(xhr, status, error) {
                console.error("Erreur AJAX :", status, error);
            }
        })
    })
});

//---- END OF THE AJAX TO CHECK IF MAIL WAS ALREADY USED ----//
