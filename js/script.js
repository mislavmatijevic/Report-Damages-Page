$(() => {

    $("#hamburger_menu").on("click", (e) => {

        if ($( window ).width() < 1300) {

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


})