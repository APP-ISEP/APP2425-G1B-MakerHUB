$(document).ready(function() {
    $("#profil").click(function() {
        $("#dropdown").toggle()
    });
});

$(document).ready(function() {
    $(".question").click(function() {
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