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


//--------- BEGINNING OF THE PAGINATION ---------//
// TODO
$(document).ready(() => {
    const itemsPerPage = 16;

    function createPagination(container, paginationContainer, cards, totalPages) {
        if (totalPages > 1) {
            // ajout numéro des pages
            for (let i = 1; i <= totalPages; i++) {
                const paginationItem = $(`<div class="page-number"><a class="page-link">${i}</a></div>`);
                paginationContainer.append(paginationItem);
            }

            const paginationItems = paginationContainer.find('.page-number');
            paginationItems.first().addClass('active');

            // fix l'affichage de la première page
            paginationItems.click(function() {
                const page = $(this).index();
                const start = page * itemsPerPage;
                const end = start + itemsPerPage;
                container.find(cards).hide().slice(start, end).show();
                paginationItems.removeClass('active')   ;
                $(this).addClass('active');
            });
        }
    }

    // Offers pagination
    const offersContainer = $('.offers-container');
    const offersCards = $('.offers-cards-container .offer-card');
    const numberOffers = offersCards.length
    const offersTotalPages = Math.ceil(numberOffers / itemsPerPage);
    const offersPagination = $('#offers-pagination');
    createPagination(offersContainer, offersPagination, offersCards, offersTotalPages);


    // Requests pagination
    const requestsContainer = $('.requests-container');
    const requestsCards = $('.requests-cards-container .request-card');
    const numberRequests = requestsCards.length
    const requestTotalPages = Math.ceil(numberRequests / itemsPerPage);
    const requestsPagination = $('#requests-pagination');
    createPagination(requestsContainer, requestsPagination, requestsCards, requestTotalPages);
});
//--------- END OF THE PAGINATION ---------//
