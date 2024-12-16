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

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('requests-search')) {
        toggleCategories(categoryRequest, categoryOffer, requestsContainer, offersContainer);
    } else if (urlParams.has('offers-search')) {
        toggleCategories(categoryOffer, categoryRequest, offersContainer, requestsContainer);
    }
});

//--------- END OF CATEGORIES INSIDE HOME PAGE---------//


//--------- BEGINNING OF FILTER CONDITIONS---------//

$(document).ready(() => {
    const minPrice = $('#minPrice');
    const maxPrice = $('#maxPrice');

    minPrice.on('blur', () => {
        let maxVal = parseFloat(maxPrice.val());
        if (parseFloat(minPrice.val()) > maxVal) {
            minPrice.val(maxVal);
        }
        else if (parseFloat(minPrice.val()) < 0) {
            minPrice.val(0);
        }
    });

    maxPrice.on('blur', () => {
        let minVal = parseFloat(minPrice.val());
        if (parseFloat(maxPrice.val()) < minVal) {
            maxPrice.val(minVal);
        }
        else if (parseFloat(maxPrice.val()) > 10000) {
            maxPrice.val(10000);
        }
    });
});
//--------- END OF FILTER CONDITIONS---------//


//--------- BEGINNING OF THE PAGINATION ---------//
$(document).ready(() => {
    const itemsPerPage = 12;

    function createPaginationWithArrows(container, paginationContainer, cards, totalPages) {
        let currentPage = 0;

        if (totalPages > 1) {
            const leftArrow = $('<i class="fa-solid fa-angles-left"></i>');
            const rightArrow = $('<i class="fa-solid fa-angles-right"></i>');
            paginationContainer.append(leftArrow);

            // ajoute numéros de page
            for (let i = 1; i <= totalPages; i++) {
                const paginationItem = $(`<div class="page-number"><a class="page-link">${i}</a></div>`);
                paginationContainer.append(paginationItem);
            }

            paginationContainer.append(rightArrow);

            const paginationItems = paginationContainer.find('.page-number');

            paginationItems.first().addClass('active');
            container.find(cards).hide().slice(0, itemsPerPage).show();

            // clic sur numéro de page
            paginationItems.click(function () {
                currentPage = $(this).index() - 1;
                updatePagination();
            });

            // clic sur flèche gauche
            leftArrow.click(function () {
                if (currentPage > 0) {
                    currentPage--;
                    updatePagination();
                }
            });

            // clic sur flèche droite
            rightArrow.click(function () {
                if (currentPage < totalPages - 1) {
                    currentPage++;
                    updatePagination();
                }
            });

            function updatePagination() {
                const start = currentPage * itemsPerPage;
                const end = start + itemsPerPage;

                container.find(cards).hide().slice(start, end).show();

                paginationItems.removeClass('active');
                paginationItems.eq(currentPage).addClass('active');
            }
        } else {
            container.find(cards).show();
        }
    }

    // pagination pour les offres
    const offersContainer = $('.offers-container');
    const offersCards = $('.offers-cards-container .offer-card');
    const numberOffers = offersCards.length;
    const offersTotalPages = Math.ceil(numberOffers / itemsPerPage);
    const offersPagination = $('#offers-pagination');
    createPaginationWithArrows(offersContainer, offersPagination, offersCards, offersTotalPages);

    // pagination pour les demandes
    const requestsContainer = $('.requests-container');
    const requestsCards = $('.requests-cards-container .request-card');
    const numberRequests = requestsCards.length;
    const requestTotalPages = Math.ceil(numberRequests / itemsPerPage);
    const requestsPagination = $('#requests-pagination');
    createPaginationWithArrows(requestsContainer, requestsPagination, requestsCards, requestTotalPages);
});
//--------- END OF THE PAGINATION ---------//

//---- BEGINNING OF THE AJAX TO CHECK IF MAIL AND PSEUDONYME WAS ALREADY USED ----//
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

                if(jsonData.uniqueEmail === "false") {
                    alert("L'email que vous avez choisi a déjà été utilisé.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Erreur AJAX :", status, error);
            }
        })
    })
    let usernameInput = document.getElementById('username');
    usernameInput.addEventListener('change', function() {
        $.ajax({
            url: 'php/user/checkCredentials.php',
            type: 'POST',
            data: {fonction: 'uniquePseudonymeJSON', pseudonyme: usernameInput.value},
            success: function(data) {
                const jsonData = JSON.parse(data);

                if(jsonData.uniquePseudonyme === "false") {
                    alert("Le pseudonyme que vous avez choisi a déjà été utilisé.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Erreur AJAX :", status, error);
            }
        })
    })
});

//---- END OF THE AJAX TO CHECK IF MAIL WAS ALREADY USED ----//

//---- BEGINNING OF THE "A PROPOS DE MOI" IN SIGN UP ----//
$(document).ready(() => {
$("#toggleDescription").change(function () {
    if ($(this).is(":checked")) {
        $("#aboutMe").slideDown(); 
    } else {
        $("#aboutMe").slideUp(); 
    }
}).trigger("change"); //assurer que au rechargement de la page, il n'est pas coché.
});
//---- END OF THE "A PROPOS DE MOI" IN SIGN UP ----//

//--------- BEGINNING OF CONTACT PAGE COUNTER---------//

/*
Cela te donne une référence au champ de texte entier dans le DOM, 
c'est-à-dire à tous ses attributs et propriétés. Cela ne récupère pas automatiquement la valeur d’un attribut spécifique comme 
maxlength, mais l'objet entier représentant l'élément <textarea>.
*/

const textarea = document.getElementById("message-contact");
const wordCounter = document.querySelector(".word-counter");
const maxLength = textarea.maxLength;
var restLetter = maxLength - (textarea.value).length;

textarea.addEventListener ('input', () => {
    restLetter = maxLength - (textarea.value).length;
    wordCounter.textContent = `${restLetter} restants`;
})
//--------- END OF CONTACT PAGE COUNTER---------//
