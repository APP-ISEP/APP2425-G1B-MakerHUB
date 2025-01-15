$(document).ready(function () {
    $("#profil").click(function () {
        $("#dropdown").toggle()
    });
});

// ALLOWS TO DISPLAY FILENAME IN THE INPUT
function updateFileName(input) {
    const label = input.previousElementSibling.querySelector('.file-label-text');
    const fileName = input.files.length > 0 ? input.files[0].name : 'Choisir un fichier...';
    label.textContent = fileName;
}

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
let pwShown1 = 0;
const passwordContainer1 = document.getElementById('passwordConfirmation');
const eye1 = document.getElementById('eye1');

const editAttributePassword1 = (valueName) => {
    passwordContainer1.setAttribute('type', valueName);
};

if (eye1) {
    eye1.onclick = () => {
        editAttributePassword1(pwShown1 === 0 ? 'text' : 'password');
        pwShown1 = pwShown1 === 0 ? 1 : 0;
    };
}

//--------- BEGINNING TOGGLE BUTTON ---------//
$(document).ready(() => {
    const aboutMe = $('#aboutMe');
    const makerCheckbox = $('#maker-checkbox');

    if (makerCheckbox.is(':checked')) aboutMe.show();

    makerCheckbox.change(() => {
        aboutMe.toggle();
    });
});
//--------- END TOGGLE BUTTON ---------//


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
        else if (parseFloat(maxPrice.val()) > 99999.99) {
            maxPrice.val(99999.99);
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
    const offersContainer = $('.catalog-container');
    const offersCards = $('.items-cards-container .item-card');
    const numberOffers = offersCards.length;
    const offersTotalPages = Math.ceil(numberOffers / itemsPerPage);
    const offersPagination = $('#offers-pagination');

    createPaginationWithArrows(offersContainer, offersPagination, offersCards, offersTotalPages);

    // pagination pour les demandes
    const requestsContainer = $('.catalog-container');
    const requestsCards = $('.items-cards-container .item-card');
    const numberRequests = requestsCards.length;
    const requestTotalPages = Math.ceil(numberRequests / itemsPerPage);
    const requestsPagination = $('#requests-pagination');
    createPaginationWithArrows(requestsContainer, requestsPagination, requestsCards, requestTotalPages);
});

//--------- END OF THE PAGINATION ---------//


//---- BEGINNING OF THE AJAX TO CHECK IF MAIL AND PSEUDONYME WAS ALREADY USED ----//
$(document).ready(() => {
    if (window.location.pathname.includes('sign-up.php')) {
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
        emailInput.addEventListener('change', function () {
            $.ajax({
                url: 'php/user/checkCredentials.php',
                type: 'POST',
                data: {fonction: 'uniqueMailJSON', email: emailInput.value},
                success: function (data) {
                    const jsonData = JSON.parse(data);

                    if (jsonData.uniqueEmail === "false") {
                        alert("L'email que vous avez choisi a déjà été utilisé.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erreur AJAX :", status, error);
                }
            })
        })
        let usernameInput = document.getElementById('username');
        usernameInput.addEventListener('change', function () {
            $.ajax({
                url: 'php/user/checkCredentials.php',
                type: 'POST',
                data: { fonction: 'uniquePseudonymeJSON', pseudonyme: usernameInput.value },
                success: function (data) {
                    const jsonData = JSON.parse(data);

                    if (jsonData.uniquePseudonyme === "false") {
                        alert("Le pseudonyme que vous avez choisi a déjà été utilisé.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erreur AJAX :", status, error);
                }
            })
        })
    }
});


//---- END OF THE AJAX TO CHECK IF MAIL WAS ALREADY USED ----//
//---- BEGINNING OF VALIDATION PASSWORD SIGN_UP ----//

if (window.location.pathname.includes('sign-up.php')) {    
    var motDePasse = document.getElementById('password');
    var motDePasseConfirmed = document.getElementById('passwordConfirmation');

    motDePasseConfirmed.addEventListener('change', function () {
        if (motDePasse.value !== motDePasseConfirmed.value) {
            alert("Les mots de passe ne correspondent pas");
        }
    });
}

//---- END OF VALIDATION PASSWORD SIGN_UP ----//


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

const textarea = document.getElementById("message-contact");
const wordCounter = document.querySelector(".word-counter");
const maxLength = textarea.maxLength;
var restLetter = maxLength - (textarea.value).length;

textarea.addEventListener ('input', () => {
    restLetter = maxLength - (textarea.value).length;
    wordCounter.textContent = `${restLetter} restants`;
})
*/
//--------- END OF CONTACT PAGE COUNTER---------//


//--------- ADMIN FAQ ---------//

xmlhttp = new XMLHttpRequest();
function setFaq() {
    id = document.getElementById("id_faq").value;
    question = document.getElementById("question_faq").value;
    reponse = document.getElementById("reponse_faq").value;

    try{
        if (window.XMLHttpRequest) {
            xmlhttp= new XMLHttpRequest();
    
        } else {
            if (window.ActiveXObject)
                try {
                    xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        return NULL;
                    }
                }
        }

        xmlhttp.onreadystatechange = function ()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                console.log(xmlhttp.responseText);
            
            }
        }
            xmlhttp.open("POST", "./php/faq/setFaq.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id="+id+"&reponse="+reponse+"&question="+question);
            window.location.reload();
    }
    catch(e){
        console.log(e.toString());
    }
}

function deleteFaq(id) {
try{
console.log(id);
if (window.XMLHttpRequest) {
    xmlhttp= new XMLHttpRequest();
} else {
    if (window.ActiveXObject)
        try {
            xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                return NULL;
            }
        }
}

xmlhttp.onreadystatechange = function ()
{
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
        console.log(xmlhttp.responseText);
    }
}
xmlhttp.open("GET", "./php/faq/setFaq.php?id="+id, true);
xmlhttp.send();
xmlhttp.open("POST","./php/faq/setFaq.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("id="+id);
window.location.reload();
}
catch(e){
console.log(e);
}

}

function showPopUp(id) {
if (document.getElementById("popup").style.display == "block")
document.getElementById("popup").style.display = "none";
else{
document.getElementById("popup").style.display = "block";

console.log(id);


xmlhttp.open("GET", "./php/faq/getFaq.php?id_faq=" + id, true);
xmlhttp.onreadystatechange = function () {
if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    
    //console.log(xmlhttp.responseText);
    //document.getElementById("question_faq").value = question;
    //document.getElementById("reponse_faq").value = reponse;
}
};
xmlhttp.send();
}
}

//---- BEGINNING OF THE AJAX TO ADD A PRODUCT IN SHOPPING-CART ----//

document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('#add-shopping-cart');

    // Permet de détecter le clic d'un des boutons de la liste
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = parseInt(this.getAttribute('data-product-id'));

            fetch('modele/shopping-cart/addProduct.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'productId': productId
                })
            })
            .then(response => response.text())
            .then(data => {
                if (data === '1') {
                    alert("Le produit a bien été ajouté dans le panier.");
                } else {
                    alert("Impossible d'ajouter le produit dans le panier.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Une erreur est survenue.");
            });
        });
    });
});

//---- END OF THE AJAX TO ADD A PRODUCT IN SHOPPING-CART ----//


//--Order-history--//
document.addEventListener("DOMContentLoaded", function () {
    const filterDropdown = document.getElementById("filter-status");
    const orderItems = document.querySelectorAll(".item-card");

    filterDropdown.addEventListener("change", function () {
        const selectedStatus = filterDropdown.value;

        orderItems.forEach(order => {
            const orderStatus = order.getAttribute("data-status");

            if (selectedStatus === "all" || orderStatus === selectedStatus) {
                order.style.display = "block"; 
            } else {
                order.style.display = "none"; 
            }
        });
    });
});


function confirmAction(action) {
    let message = '';
    if (action === 'accepter') {
        message = 'Êtes-vous sûr de vouloir accepter ce devis ?';
    } else if (action === 'refuser') {
        message = 'Êtes-vous sûr de vouloir refuser ce devis ?';
    }

    if (confirm(message)) {
        return true;  
    } else {
        return false; 
    }
}
console.log("pipi")