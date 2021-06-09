<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords">
    <title>{$pageTitle}</title>
    <link type="text/css" rel="stylesheet" href="{$relativePath}css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="{$relativePath}js/jquery.js"></script>
    <script type="text/javascript" src="{$relativePath}js/script.js"></script>
</head>

{if isset($messageCookie)}
    <div id="overlay"></div>
    <form id="global-request" method="POST" action="index.php">
        <h4>Pozdrav i dobrodošli na stranicu za štete!</h4>
        <p>Ovu poruku vidite jer nam treba vaše odobrenje za prikaz kolačića.</p>
        <p>Stranica je namijenjena žrtvama nesreća u kojima su izgubili vrijednu imovinu.</p>
        <ul>
            <li>Kao neregistrirani korisnik imate mogućnost donirati sredstva anonimno (pamti se Vaša IP adresa).</li>
            <li>Kao registrirani korisnik možete prijaviti štetu na donaciju.</li>
        </ul>
        <p>Zatvaranjem ovoga prozora prihvaćate kolačiće na ovoj stranici.</p>
        <button class="button" type="submit" name="accept-cookies" value="true">Prihvaćam kolačiće</button>
    </form>
{else}

    <body>
        <header class="header">
            <div class="header__inner">
                <a href="rss.php" class="header__rss-container">
                    <img src="{$relativePath}media/rss.png" alt="Rss kanal" class="header__rss">
                </a>
                <nav id="hamburger_menu" class="header__nav">
                    <div class="header__nav__hamburger-line"></div>
                    <div class="header__nav__hamburger-line"></div>
                    <div class="header__nav__hamburger-line"></div>
                    <a href="{$relativePath}index.php" class="header__nav-item">Početna stranica</a>
                    {if $smarty.session.lvl == 4}
                        <!-- Neregistrirani -->
                        <a href="{$relativePath}login-page.php" class="header__nav-item header__nav-item-login">Prijava</a>
                        <a href="{$relativePath}register.php" class="header__nav-item">Registracija</a>
                    {/if}
                    {if $smarty.session.lvl == 1}
                        <!-- Neregistrirani -->
                        <a href="{$relativePath}administration.php" class="header__nav-item">Administriranje stranice</a>
                    {/if}
                    <a href="#" class="header__nav-item">Dokumentacija</a>
                    <a href="#" class="header__nav-item">O autoru</a>
                    {if $smarty.session.lvl < 4}
                        <a href="{$relativePath}/control/logout.php" class="header__nav-item header__nav-item-logout">Odjava</a>
                    {/if}
                </nav>
                <span class="header__nav-message">{$userHelloMessage}</span>
            </div>

            <div id="global-error">
                <p id="global-error-text">
                    {if isset($messageGlobal)}
                        {$messageGlobal}
                    {/if}
                </p>
                <div class="close-button">X</div>
            </div>
            <div id="global-info">
                <p id="global-info-text">
                    {if isset($infoGlobal)}
                        {$infoGlobal}
                    {/if}
                </p>
                <div class="close-button">X</div>
            </div>
        </header>

        <main>
        {/if}