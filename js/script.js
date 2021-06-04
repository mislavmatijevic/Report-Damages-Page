$(() => {
    $("#hamburger_menu").on("click", (e) => {
        if ($(window).width() < 1300) {
            var a = $(".header__nav-item-hambi");
            if (a.length === 0) {
                $("#hamburger_menu").toggleClass("header__nav__hamburger-active");
                setTimeout(() => {
                    $(".header__nav-item").toggleClass("header__nav-item-hambi");
                }, 50);
            } else {

                $(".header__nav-item").toggleClass("header__nav-item-hambi");
                setTimeout(() => {
                    $("#hamburger_menu").toggleClass("header__nav__hamburger-active");
                }, 50);
            }
        }
    });
    
    switch (location.pathname.split('/').slice(-1)[0]) {
        case 'register.php': {

            $("#username").on("keyup", (e) => {
                AJAXPoziv("../control/")
                console.log($("#username").val());
            });

            break;
        }
    }
})

function AJAXPoziv(argRelativeUrl, argData, successCallback, argType = 'GET') {
    $.ajax({
        url: argRelativeUrl,
        type: argType,
        data: argData,
        dataType: 'JSON',
        success: successCallback,
        error: function (xhr, status, error) {
            console.log("xhr: " + JSON.stringify(xhr) + " status: " + status + " greška: " + error);
        }
    });
}