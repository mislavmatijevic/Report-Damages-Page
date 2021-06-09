$(() => {

    // Oblačić za pomoć:
    var helpShown = false;
    var razinaPomoci = 1;
    var firstHelpText = "";
    $("#global-help").hide();
    $("#button-help").on("click", () => {
        if ($("#global-help").is(":visible")) {
            hideHelp();
        } else {
            $("#global-help").show();
            $("#global-help-text").html(firstHelpText);
            razinaPomoci = 1;
        }
        helpShown = !helpShown;
    });
    function hideHelp() {
        $("#global-help").html();
        $("#global-help").attr("style", "");
        $("#global-help").hide();
    }

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

    $(".close-button").on("click", (e) => {
        $(e.target).parent('div').hide();
        $("#overlay").hide();
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

        case 'administration.php': {
            firstHelpText = "Nakon ovoliko puta korisniku se račun blokira i na ovoj stranici treba ga se odblokirati.";

            $("#button-help__next").on("click", () => {
                switch (++razinaPomoci) {
                    case 2: {
                        $("#global-help-text").html("U danima. Ovoliko dana vrijedi link na e-mailu novoregistriranog korisnika. Nakon toga korisnik se briše iz baze.");
                        $("#global-help").attr("style", "top: 1280px");
                        break;
                    }
                    case 3: {
                        $("#global-help-text").html("Vezano uz straničenje. Koliko podataka određenog ispisa dohvatiti iz baze u jednom zahtjevu.");
                        $("#global-help").attr("style", "top: 1370px");
                        break;
                    }
                    case 4: {
                        $("#global-help-text").html("U danima. Nakon nestanka kolačića, potrebno je ponovno prihvatiti uvjete. Nemoguće je koristiti stranicu bez prihvaćanja.");
                        $("#global-help").attr("style", "top: 1410px");
                        break;
                    }
                    case 5: {
                        $("#global-help-text").html("U minutama trajanje sesije. Nakon tog vremena neaktivnosti, sesija prestaje i korisnik se opet mora ulogirati u sustav.");
                        $("#global-help").attr("style", "top: 1480px");
                        break;
                    }
                    default: {
                        hideHelp();
                    }
                }
            });

            var damageCategories = "";

            AJAXCall("config.php", { get_categories: "1" }, fillCategories);
            AJAXCall("block-user.php", { get_blocked: "1" }, fillTableBlocked);

            function fillCategories(value) {
                damageCategories = value;
                AJAXCall("config.php", { get_moderators: "1" }, fillTableModerators);
            }

            $("#virtual-button").on("click", () => {
                AJAXCall("https://barka.foi.hr/WebDiP/pomak_vremena/pomak.php", { format: "json" }, newHourDiff, "GET", true);
            });

            let timeDiff;

            function newHourDiff(value) {
                timeDiff = value.WebDiP.vrijeme.pomak.brojSati;
                AJAXCall("virtual-time.php", { newConfig: JSON.stringify({ virtualTimeOffsetSeconds: timeDiff }) }, informNewTime);
            }

            function informNewTime(value) {
                if (value === false) {
                    $("#global-error").html("Dogodio se problem pri namještanju virtualnog vremena!");
                } else {
                    $("#global-info-text").html(`Vrijeme promijenjeno za ${timeDiff} sati.`);
                    $("#global-info").show();
                    $("#real-time").html(value.realTime);
                    $("#virtual-time").html(value.virtualTime);
                }
            }

            let zadnjaRadnjaBlokiranja = 0;

            function fillTableBlocked(users) {
                let tableInnerHTML = "";
                if (users.length > 0) {
                    users.forEach((value) => {
                        tableInnerHTML +=
                            `
                        <tr class="table__row">
                            <td class="table__row-data">${value.id_korisnik}</td>
                            <td class="table__row-data">${value.email}</td>
                            <td class="table__row-data">${value.korisnicko_ime}</td>
                            <td class="table__row-data">
                                <button class="button-unblock" username="${value.korisnicko_ime}">
                                    Odblokiraj korisnika
                                </button>
                            </td>
                        </tr>
                    `
                    });
                    $("#body-blocked").html(tableInnerHTML);
                    $(".button-unblock").on("click", (e) => {
                        let selectedUsername = e.target.getAttribute("username");
                        zadnjaRadnjaBlokiranja = 0;
                        AJAXCall("block-user.php", { username: selectedUsername, action: 0 }, blockedUser);
                    });
                } else {
                    $("#body-blocked").html("");
                }
            }

            function changeModerator(value) {
                if (value == true) {
                    AJAXCall("config.php", { get_categories: "1" }, fillCategories);
                    $("#global-info-text").html("Situacija promijenjena!");
                    $("#global-info").show();
                    $("#moderator-input").val("");
                } else {
                    $("#global-error").html("Dogodio se problem pri promjeni moderatora!");
                }
            }

            function fillTableModerators(moderators) {
                let tableInnerHTML = "";
                if (moderators.length > 0) {
                    moderators.forEach((moderator) => {

                        let categoriesOptions;
                        damageCategories.forEach((value) => {
                            let manages = "";
                            if ('categories' in moderator) {
                                if (moderator.categories !== null && moderator.categories.find(category => category.id_kategorija_stete == value.id_kategorija_stete)) {
                                    manages = "selected";
                                }
                            }
                            categoriesOptions += `
                            <option value="${value.id_kategorija_stete}" ${manages}>
                            ${value.naziv}
                            </option>
                            `;
                        });

                        tableInnerHTML +=
                            `
                        <tr class="table__row">
                            <td class="table__row-data">${moderator.id_korisnik}</td>
                            <td class="table__row-data">${moderator.email}</td>
                            <td class="table__row-data">${moderator.korisnicko_ime}</td>
                            <td class="table__row-data">
                                <select id="select-categories-${moderator.id_korisnik}" multiple>
                                    ${categoriesOptions}
                                </select>
                                <button class="button-add-moderator-to-category" identificator="${moderator.id_korisnik}">
                                    Promijeni stanje
                                </button>
                            </td>
                            <td class="table__row-data">
                                <button class="button-remove-moderator" identificator="${moderator.korisnicko_ime}">
                                    Skini s pozicije
                                </button>
                            </td>
                        </tr>
                    `
                    });
                    $("#body-moderators").html(tableInnerHTML);
                    $(".button-remove-moderator").on("click", (e) => {
                        let identificator = e.target.getAttribute("identificator");
                        AJAXCall("config.php", { username: identificator, action: 0 }, changeModerator);
                    });
                    $(".button-add-moderator-to-category").on("click", (e) => {
                        let identificator = e.target.getAttribute("identificator");
                        let selectedCategories = $(`#select-categories-${identificator}`).val();
                        AJAXCall("config.php", { id_moderator: identificator, new_categories: selectedCategories }, changeModerator);
                    });
                } else {
                    $("#body-moderators").html("");
                }
            }

            $("#moderator-button").on("click", () => {
                usernameValue = $("#moderator-input").val();
                if (usernameValue == "") {
                    alert("Unesite korisničko ime novog administratora!");
                } else {
                    AJAXCall("config.php", { username: usernameValue, action: 1 }, changeModerator);
                }
            });

            function blockedUser(value) {
                if (value == true) {
                    AJAXCall("block-user.php", { get_blocked: "1" }, fillTableBlocked);
                    $("#global-info-text").html(zadnjaRadnjaBlokiranja ? `Korisnik blokiran!` : `Korisnik odblokiran!`);
                    $("#global-info").show();
                    $("#block-input").val("");
                } else {
                    $("#global-error").html("Dogodio se problem pri blokiranju korisnika!");
                }
            }

            function preformBlock(isTaken) {
                var usernameValue = $("#block-input").val();
                if (!isTaken) {
                    $("#global-error-text").html(`Korisnik s korisničkim imenom ${usernameValue} ne postoji!`);
                    $("#global-error").show();
                } else {
                    if (usernameValue == "") {
                        alert("Niste unijeli korisničko ime!");
                    } else {
                        zadnjaRadnjaBlokiranja = 1;
                        AJAXCall("block-user.php", { username: usernameValue, action: 1 }, blockedUser);
                    }
                }
            }

            $("#block-button").on("click", () => {
                var usernameValue = $("#block-input").val();
                AJAXCall("check-username.php", { checkUsername: usernameValue }, preformBlock);
            });

            AJAXCall("config.php", { get_current_config: "1" }, displayCurrentConfig);

            function displayCurrentConfig(value) {
                $("#maxFailedLogins").val(value.maxFailedLogins);
                $("#maxHoursToAccept").val(value.maxHoursToAccept);
                $("#maxItemsPerPage").val(value.maxItemsPerPage);
                $("#cookieDurationDays").val(value.cookieDurationDays);
                $("#maxSessionLengthMinutes").val(value.maxSessionLengthMinutes);
                $("#virtualTimeOffsetSeconds").val(value.virtualTimeOffsetSeconds);
                $("#captchaSecretKey").val(value.captchaSecretKey);
            }

            function appliedNewConfig(value) {
                AJAXCall("config.php", { get_current_config: "1" }, displayCurrentConfig);
            }

            $("#config-button").on("click", () => {
                newConfigJSON = JSON.stringify({
                    maxFailedLogins: $("#maxFailedLogins").val(),
                    maxHoursToAccept: $("#maxHoursToAccept").val(),
                    maxItemsPerPage: $("#maxItemsPerPage").val(),
                    cookieDurationDays: $("#cookieDurationDays").val(),
                    maxSessionLengthMinutes: $("#maxSessionLengthMinutes").val(),
                    virtualTimeOffsetSeconds: $("#virtualTimeOffsetSeconds").val(),
                    captchaSecretKey: $("#captchaSecretKey").val()
                });
                AJAXCall("config.php", { newConfig: newConfigJSON }, appliedNewConfig);
            });

        }

        case 'donate.php': {
            function checkIsMoney() {
                var value = $("#amount").val();
                var isNumberReg = new RegExp(/^(\d)+(\.((\d){2})+)*$/);
                if (!isNumberReg.test(value)) {
                    formItemList["amount"] = "Unesite ispravan iznos za donaciju.<br>Ako unosite decimalne znamenke, unesite točno dvije odvojene točkom.";
                } else if (value < 10) {
                    formItemList["amount"] = "Donirajte minimalno 10kn.<br>Nemojte biti škrti. Neki ljudi pate, a vi cincarite. Jao. 😠";
                } else {
                    formItemList["amount"] = true;
                };
                checker();
            }

            $("#amount").on("change", () => {
                checkIsMoney();
            });

            $("#button-donate").on("click", (e) => {
                checkIsMoney();
                if (formItemList["amount"] !== true) {
                    e.preventDefault();
                } else {
                    if (!confirm(`Jeste li sigurni da želite uplatiti ${$("#amount").val()} kuna?`)) {
                        e.preventDefault();
                    }
                }
            });
        }

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
                    formItemList["username"] = `Korisničko ime je zauzeto`;
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
                    AJAXCall("check-username.php", { checkUsername: value }, validateUsernameRegister);
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

    /**
     * 
     * @param {string} scriptName Samo naziv skripte
     * @param {string} argData Podaci koji se šalju
     * @param {function} successCallback Callback koji se poziva na uspjeh
     * @param {string} argType GET/POST
     * @param {boolean} foolURL Je li prvi parametar nešto drugo umjesto naziva skripte u folderu control.
     */
    function AJAXCall(scriptName, argData, successCallback, argType = 'POST', fullURL = false) {
        if (!fullURL) {
            scriptName = "./control/" + scriptName;
        }
        $.ajax({
            url: scriptName,
            type: argType,
            data: argData,
            dataType: 'JSON',
            success: successCallback,
            error: function (xhr, status, error) {
                console.log("AJAX PROBLEM\nStatus: " + status + "\nError: " + error + " \nXHR: ");
                console.log(xhr);
                $("#global-error-text").html("AJAX: provjerite konzolu.");
                $("#global-error").show();
            }
        });
    }
});