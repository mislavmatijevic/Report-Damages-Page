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

<body>
    <header class="header">
        <div class="header__inner">
            <a href="rss.php" class="header__rss-container">
                <img src="{$relativePath}multimedija/rss.png" alt="Rss kanal" class="header__rss">
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
                <a href="#" class="header__nav-item">Javni pozivi</a>
                <a href="#" class="header__nav-item">Statistika</a>
                <a href="#" class="header__nav-item">Dokumentacija</a>
                <a href="#" class="header__nav-item">O autoru</a>
                {if $smarty.session.lvl < 4}
                    <a href="{$relativePath}/control/logout.php" class="header__nav-item header__nav-item-logout">Odjava</a>
                {/if}
            </nav>
            <span style="color: orange">{$userHelloMessage}</span>
        </div>
    </header>

    <main>