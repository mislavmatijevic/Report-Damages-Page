$(() => {

    // 
    /* Svaki objekt polja `formItemList` ima iduću strukturu:
    ["name"] = "Popunite ime!" // NIJE OK
    ["surname"] = true // SVE OK
    */
    var formItemList = {};

    $("#hamburger_menu").on("click", () => {
        if ($(document).width() < 1300) {
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
    }

    switch (location.pathname.split('/').slice(-1)[0]) {

        case 'index.php':
        case 'login-page.php': {

            function checkUsername() {
                let value = $("#username").val();
                if (value.length < 3 || value.length > 20) {
                    formItemList["username"] = "Provjerite korisničko ime!";
                }
                else {
                    formItemList["username"] = true;
                }
                checker();
            }
            function checkPassword() {
                let value = $("#password").val();
                var passReg = new RegExp(/^(?=.*[\d])(?=.*[\D])([ -~šđčćžŠĐČĆŽ\d]+){5,}$/);
                if (!passReg.test(value)) {
                    formItemList["password"] = "Provjerite lozinku!";
                } else {
                    formItemList["password"] = true;
                }
                checker();
            }

            $("#username").on("change", checkUsername);
            $("#password").on("change", checkPassword);

            $("#login").on("submit", (e) => {
                checkUsername();
                checkPassword();

                checker();

                if (Object.keys(formItemList).length != 2) {
                    alert("Unesite korisničko ime i lozinku!");
                    e.preventDefault();
                    return;
                }

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
                    $(`#username`).css("border", "2px orange outset");
                } else {
                    formItemList["username"] = true;
                }
                checker();
            }

            function checkName() {
                let value = $("#name").val();
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
                let value = $("#surname").val();
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
                let value = $("#username").val();
                if (value.length > 20) {
                    formItemList["username"] = "Korisničko ime je predugačko";
                    checker();
                } else if (value == "") {
                    formItemList["username"] = "Unesite korisničko ime!";
                    checker();
                }
                else {
                    AJAXCall("./control/UserControl.php", { checkUsername: value }, validateUsernameRegister);
                }
            }
            function checkUsernameChange() {
                let value = $("#username").val();
                if (value.length < 3) {
                    formItemList["username"] = "Korisničko ime je prekratko";
                } else {
                    formItemList["username"] = true;
                }
                checker();
            }
            function checkPasswordInput() {
                let value = $("#password").val();
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
                var ASCIIPasswordReg = new RegExp(/^[ -~šđčćžŠĐČĆŽ]+$/);
                var passRegDigit = new RegExp(/^(?=.*[0-9])([ -~šđčćžŠĐČĆŽ]+){5,}$/);
                let value = $("#password").val();
                if (value.length < 5) {
                    formItemList["password"] = "Lozinka mora imati više od 5 znakova";
                } else if (!ASCIIPasswordReg.test(value)) {
                    formItemList["password"] = "Izbacite specijalne znakove!";
                } else if (!passRegDigit.test(value)) {
                    formItemList["password"] = "Lozinku mora činiti barem 1 broj!";
                } else if (/^[ -~šđčćžŠĐČĆŽ]$/.test(value)) {
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
                let value = $("#email").val();
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
            $("#email").on("change", checkEmail);

            $("#register").on("submit", (e) => {
                checkName();
                checkSurname();
                checkUsernameInput();
                checkUsernameChange();
                checkPasswordInput();
                checkPasswordChange();
                checkConfirmPassword();
                checkEmail();

                checker();

                if (Object.keys(formItemList).length != 6) {
                    alert("Popunite obrazac do kraja!");
                    e.preventDefault();
                    return;
                }

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
