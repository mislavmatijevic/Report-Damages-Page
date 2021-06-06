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

    switch (location.pathname.split('/').slice(-1)[0]) {

        case 'index.php':
        case 'login-page.php': {

            function checkUsername() {
                value = $("#username").val();
                if (value.length < 3 || value.length > 20) {
                    formItemList["username"] = "Provjerite korisničko ime!";
                }
                else {
                    formItemList["username"] = true;
                }
                checker();
            }
            function checkPassword() {
                value = $("#password").val();
                var passReg = new RegExp(/^(?=.*[\d])(?=.*[\D])([\w\d]+){5,}$/);
                if (!passReg.test(value)) {
                    formItemList["password"] = "Provjerite lozinku!";
                } else {
                    formItemList["password"] = true;
                }
                checker();
            }

            $("#username").on("change", checkUsername);
            $("#password").on("change", checkPassword);

            $("#login").submit((e) => {
                if (Object.keys(formItemList).length != 2) {
                    alert("Unesite korisničko ime i lozinku!");
                    e.preventDefault();
                    return;
                }

                checkUsername();
                checkPassword();

                checker();

                if (!ok) {
                    alert("Provjerite Vaše podatke!");
                    e.preventDefault();
                    return;
                }
            });
            break;
        }

        case 'register.php': {

            function validateUsernameRegister(isTaken) {
                if (isTaken) {
                    formItemList["username"] = `Korisničko ime "${value}" zauzeto`;
                    checker();
                    $(`#username`).css("border", "2px orange outset");
                } else {
                    formItemList["username"] = true;
                    checker();
                }
            }

            function checkName() {
                value = $("#name").val();
                if (value == "") {
                    formItemList["name"] = "Popunite ime!";
                } else if (value.length > 25) {
                    formItemList["name"] = "Ime je predugačko";
                } else {
                    formItemList["name"] = true;
                }
                checker();
            }
            function checkSurname() {
                value = $("#surname").val();
                if (value == "") {
                    formItemList["surname"] = "Popunite prezime!";
                } else if (value.length > 50) {
                    formItemList["surname"] = "Prezime je predugačko";
                } else {
                    formItemList["surname"] = true;
                }
                checker();
            }
            function checkUsernameInput() {
                value = $("#username").val();
                if (value.length > 20) {
                    formItemList["username"] = "Korisničko ime je predugačko";
                } else if (value == "") {
                    formItemList["username"] = "Unesite korisničko ime!";
                }
                else {
                    AJAXCall("./control/UserControl.php", { checkUsername: value }, validateUsernameRegister);
                }
                checker();
            }
            function checkUsernameChange() {
                value = $("#username").val();
                if (value.length < 3) {
                    formItemList["username"] = "Korisničko ime je prekratko";
                }
                checker();
            }
            function checkPasswordInput() {
                value = $("#password").val();
                if (value == "") {
                    formItemList["password"] = "Popunite lozinku!";
                } else if (value.length > 50) {
                    formItemList["password"] = "Lozinka je predugačka";
                } else {
                    formItemList["password"] = true;
                }
                checker();
            }
            function checkPasswordChange() {
                var passRegLetters = new RegExp(/^([\w]+){5,}$/);
                var passRegDigit = new RegExp(/^(?=.*[\d])([\w]+){5,}$/);
                var passRegLetter = new RegExp(/^(?=.*[\D])([\w]+){5,}$/);
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
            }
            function checkConfirmPassword() {
                if ($("#confirm_pass").val() == "") {
                    formItemList["confirm_pass"] = "Ponovite lozinku!";
                } else if ($("#confirm_pass").val() != $("#password").val()) {
                    formItemList["confirm_pass"] = "Lozinke se ne poklapaju!";
                } else {
                    formItemList["confirm_pass"] = true;
                }
                checker();
            }
            function checkEmail() {
                var mailReg = new RegExp(/^[^.]([a-z0-9A-Z.\+\"\_\-]{1,64})[^.]@[^\-\_\-](?=.{1,255}$)([a-z0-9A-Z\-\+\.)+([a-z0-9A-Z]+)$/);
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
            }

            $("#name").on("input", checkName);
            $("#surname").on("input", checkSurname);
            $("#username").on("input", checkUsernameInput);
            $("#username").on("change", checkUsernameChange);
            $("#password").on("input", checkPasswordInput);
            $("#password").on("change", checkPasswordChange);
            $("#confirm_pass").on("change", checkConfirmPassword);
            $("#email").on("input", checkEmail);

            $("#register").submit((e) => {
                if (Object.keys(formItemList).length != 6) {
                    alert("Popunite obrazac do kraja!");
                    e.preventDefault();
                    return;
                }

                checkName();
                checkSurname();
                checkUsernameInput();
                checkUsernameChange();
                checkPasswordInput();
                checkPasswordChange();
                checkConfirmPassword();
                checkEmail();

                checker();

                if (!ok) {
                    alert("Ispravite unose po naputcima!");
                    e.preventDefault();
                    return;
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
