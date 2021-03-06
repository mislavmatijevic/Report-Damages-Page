<?php
/* Smarty version 3.1.39, created on 2021-06-06 14:15:52
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/html/templates/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bcbc78bc2f14_27744592',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '269616519e8f0597ed1407cb273f5534a0b990ce' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/html/templates/header.tpl',
      1 => 1622972672,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bcbc78bc2f14_27744592 (Smarty_Internal_Template $_smarty_tpl) {
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
index.php" class="header__nav-item">Po??etna stranica</a>
                <?php if ($_SESSION['lvl'] == 4) {?>
                    <!-- Neregistrirani -->
                    <a href="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
login-page.php" class="header__nav-item header__nav-item-login">Prijava</a>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
register.php" class="header__nav-item">Registracija</a>
                <?php }?>
                <a href="#" class="header__nav-item">Javni pozivi</a>
                <a href="#" class="header__nav-item">Statistika</a>
                <a href="#" class="header__nav-item">Dokumentacija</a>
                <a href="#" class="header__nav-item">O autoru</a>
                <?php if ($_SESSION['lvl'] < 4) {?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['relativePath']->value;?>
/control/logout.php" class="header__nav-item header__nav-item-logout">Odjava</a>
                <?php }?>
            </nav>
            <span style="color: $highlightColor"><?php echo $_smarty_tpl->tpl_vars['userHelloMessage']->value;?>
</span>
        </div>
    </header>

    <main><?php }
}
