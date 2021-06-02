<?php
/* Smarty version 3.1.39, created on 2021-06-02 17:28:41
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b7a3a9184124_34223504',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd9a97a98b5629b7e5c4a56e57e6db1e56e753aa' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/header.tpl',
      1 => 1622647709,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b7a3a9184124_34223504 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords">
    <title>Stranica za štete</title>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/jquery.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/script.js"><?php echo '</script'; ?>
>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a href="rss.php" class="header__rss-container">
                <img src="multimedija/rss.png" alt="Rss kanal" class="header__rss">
            </a>
            <nav id="hamburger_menu" class="header__nav">
                <div class="header__nav__hamburger-line"></div>
                <div class="header__nav__hamburger-line"></div>
                <div class="header__nav__hamburger-line"></div>
                <a href="index.html" class="header__nav-item">Početna stranica</a>
                <a href="login.html" class="header__nav-item">Prijava</a>
                <a href="register.html" class="header__nav-item">Registracija</a>
                <a href="#" class="header__nav-item">Javni pozivi</a>
                <a href="#" class="header__nav-item">Statistika</a>
                <a href="#" class="header__nav-item">Dokumentacija</a>
                <a href="#" class="header__nav-item">O autoru</a>
            </nav>
        </div>
    </header>

    <main><?php }
}
