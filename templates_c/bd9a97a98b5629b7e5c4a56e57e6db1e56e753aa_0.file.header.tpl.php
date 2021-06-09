<?php
/* Smarty version 3.1.39, created on 2021-06-09 11:19:15
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c08793476450_38146149',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd9a97a98b5629b7e5c4a56e57e6db1e56e753aa' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/header.tpl',
      1 => 1623230345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c08793476450_38146149 (Smarty_Internal_Template $_smarty_tpl) {
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
</head>

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
        <?php if ((isset($_smarty_tpl->tpl_vars['messageGlobal']->value))) {?>
            <div class="error" id="global-error">
                <?php echo $_smarty_tpl->tpl_vars['messageGlobal']->value;?>

                <div id="close-button">X</div>
            </div>
        <?php }?>
    </header>


    <main><?php }
}
