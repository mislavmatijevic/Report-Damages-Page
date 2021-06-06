$(() => {

    // 
    /* Svaki objekt polja `formItemList` ima iduću strukturu:
    ["name"] = "Popunite ime!" // NIJE OK
    ["surname"] = true // SVE OK
    */
    var formItemList = {};

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

            var ok = false;

            function checker() {
                ok = true;
                Object.keys(formItemList).forEach((fieldName) => {
                    if (formItemList[fieldName] == true) {
                        $(`#${fieldName}`).css("border", "2px green outset");
                        $(`#error-${fieldName}`).html("");
                    } else {
                        $(`#${fieldName}`).css("border", "2px red outset");
                        $(`#error-${fieldName}`).html(formItemList[fieldName]);
                        ok = false;
                    }
                });
                console.log(formItemList);
            }

            function validateUsername(isTaken) {
                if (isTaken) {
                    formItemList["username"] = `Korisničko ime "${value}" zauzeto`;
                    checker();
                    $(`#username`).css("border", "2px orange outset");
                } else {
                    formItemList["username"] = true;
                    checker();
                }
            }

            $("#name").on("input", () => {
                value = $("#name").val();
                if (value == "") {
                    formItemList["name"] = "Popunite ime!";
                } else if (value.length > 25) {
                    formItemList["name"] = "Ime je predugačko";
                } else {
                    formItemList["name"] = true;
                }
                checker();
            });
            $("#surname").on("input", () => {
                value = $("#surname").val();
                if (value == "") {
                    formItemList["surname"] = "Popunite prezime!";
                } else if (value.length > 50) {
                    formItemList["surname"] = "Prezime je predugačko";
                } else {
                    formItemList["surname"] = true;
                }
                checker();
            });
            $("#username").on("input", () => {
                value = $("#username").val();
                if (value.length > 20) {
                    formItemList["username"] = "Korisničko ime je predugačko";
                }
                else {
                    AJAXCall("./control/UserControl.php", { checkUsername: value }, validateUsername);
                }
                checker();
            });
            $("#username").on("change", () => {
                value = $("#username").val();
                if (value.length < 3) {
                    formItemList["username"] = "Korisničko ime je prekratko";
                }
                checker();
            });

            var passRegLetters = new RegExp(/^([\w]+){5,}$/);
            var passRegDigit = new RegExp(/^(?=.*[\d])([\w]+){5,}$/);
            var passRegLetter = new RegExp(/^(?=.*[\D])([\w]+){5,}$/);

            $("#password").on("input", () => {
                value = $("#password").val();
                if (value == "") {
                    formItemList["password"] = "Popunite lozinku!";
                } else if (value.length > 50) {
                    formItemList["password"] = "Lozinka je predugačka";
                } else {
                    formItemList["password"] = true;
                }
                checker();
            });

            $("#password").on("change", () => {
                value = $("#password").val();
                if (!passRegLetters.test(value)) {
                    formItemList["password"] = "Lozinka mora imati više od 5 znakova!";
                } else if (!passRegDigit.test(value)) {
                    formItemList["password"] = "Lozinku mora činiti barem 1 broj!";
                } else if (!passRegLetter.test(value)) {
                    formItemList["password"] = "Lozinku mora činiti barem 1 slovo!";
                } else if ($("#confirm_pass").val() != "" && $("#confirm_pass").val() != $("#password").val()) { // Provjeri i confirm pass od prije.
                    formItemList["confirm_pass"] = "Lozinke se ne poklapaju!";
                } else if ($("#confirm_pass").val() != "" && $("#confirm_pass").val() === $("#password").val()) {
                    formItemList["confirm_pass"] = true;
                } else {
                    formItemList["password"] = true;
                }
                checker();
            });

            $("#confirm_pass").on("change", () => {
                if ($("#confirm_pass").val() == "") {
                    formItemList["confirm_pass"] = "Ponovite lozinku!";
                } else if ($("#confirm_pass").val() != $("#password").val()) {
                    formItemList["confirm_pass"] = "Lozinke se ne poklapaju!";
                } else {
                    formItemList["confirm_pass"] = true;
                }
                checker();
            });

            var mailReg = new RegExp(/^[^.]([a-z0-9A-Z.\+\"\_\-]{1,64})[^.]@[^\-\_\-](?=.{1,255}$)([a-z0-9A-Z\-\+\.)+([a-z0-9A-Z]+)$/);
            $("#email").on("input", () => {
                value = $("#email").val();
                if (value == "") {
                    formItemList["email"] = "Unesite mail!";
                } else if (value.length > 45) {
                    formItemList["email"] = "Email je predugačak";
                } else if (!mailReg.test(value)) {
                    formItemList["email"] = "Unesite ispravan email!";
                } else {
                    formItemList["email"] = true;
                }
                checker();
            });

            $("#register").submit((e) => {
                checker();
                if (Object.keys(formItemList).length != 6) {
                    e.preventDefault();
                    alert("Popunite obrazac do kraja!");
                } else if (!ok) {
                    e.preventDefault();
                    alert("Ispravite unose po naputcima!");
                }
            });

            break;
        }
    }

    function AJAXCall(argRelativeUrl, argData, successCallback, argType = 'GET') {
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
});
