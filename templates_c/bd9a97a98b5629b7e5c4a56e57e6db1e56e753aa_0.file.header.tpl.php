<?php
/* Smarty version 3.1.39, created on 2021-06-11 00:35:20
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c293a8734c54_72356531',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd9a97a98b5629b7e5c4a56e57e6db1e56e753aa' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/header.tpl',
      1 => 1623364476,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c293a8734c54_72356531 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords">
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
    <?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js" async defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
js/jquery.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
js/script.js"><?php echo '</script'; ?>
>
    <?php if (($_SERVER['PHP_SELF'] == "/administration.php")) {?>
        <?php echo '<script'; ?>
 type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"><?php echo '</script'; ?>
>
    <?php }?>
</head>

<?php if ((isset($_smarty_tpl->tpl_vars['messageCookie']->value))) {?>
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
<?php } else { ?>

    <body>
        <header class="header">
            <div class="header__inner">
                <a href="rss.php" class="header__rss-container">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
media/rss.png" alt="Rss kanal" class="header__rss">
                </a>
                <nav id="hamburger_menu" class="header__nav">
                    <div class="header__nav__hamburger-line"></div>
                    <div class="header__nav__hamburger-line"></div>
                    <div class="header__nav__hamburger-line"></div>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
index.php" class="header__nav-item">Početna stranica</a>
                    <?php if ($_SESSION['lvl'] == 4) {?>
                        <!-- Neregistrirani -->
                        <a href="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
login-page.php" class="header__nav-item header__nav-item-login">Prijava</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
register.php" class="header__nav-item">Registracija</a>
                    <?php }?>
                    <?php if ($_SESSION['lvl'] == 1) {?>
                        <!-- Neregistrirani -->
                        <a href="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
administration.php" class="header__nav-item">Administriranje stranice</a>
                    <?php }?>
                    <a href="#" class="header__nav-item">Dokumentacija</a>
                    <a href="#" class="header__nav-item">O autoru</a>
                    <?php if ($_SESSION['lvl'] < 4) {?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
/control/logout.php" class="header__nav-item header__nav-item-logout">Odjava</a>
                    <?php }?>
                </nav>
                <span class="header__nav-message"><?php echo $_smarty_tpl->tpl_vars['userHelloMessage']->value;?>
</span>
            </div>

            <div id="global-error">
                <p id="global-error-text">
                    <?php if ((isset($_smarty_tpl->tpl_vars['messageGlobal']->value))) {?>
                        <?php echo $_smarty_tpl->tpl_vars['messageGlobal']->value;?>

                    <?php }?>
                </p>
                <div class="close-button">X</div>
            </div>
            <div id="global-info">
                <p id="global-info-text">
                    <?php if ((isset($_smarty_tpl->tpl_vars['infoGlobal']->value))) {?>
                        <?php echo $_smarty_tpl->tpl_vars['infoGlobal']->value;?>

                    <?php }?>
                </p>
                <div class="close-button">X</div>
            </div>
        </header>

        <main>
        <?php }
}
}
