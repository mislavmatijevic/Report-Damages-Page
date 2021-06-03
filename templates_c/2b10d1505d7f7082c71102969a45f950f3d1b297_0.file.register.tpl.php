<?php
/* Smarty version 3.1.39, created on 2021-06-03 11:33:02
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b8a1ce06bf44_17890278',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b10d1505d7f7082c71102969a45f950f3d1b297' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/register.tpl',
      1 => 1622712781,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b8a1ce06bf44_17890278 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['greska']->value != '') {?>
    <div class="greska" style="grid-row-end: -1; grid-column-start: 1; grid-column-end: 3;"><?php echo $_smarty_tpl->tpl_vars['greska']->value;?>
</div>
<?php } elseif ($_smarty_tpl->tpl_vars['poruka']->value != '') {?>
    <div class="poruka" style="grid-row-end: -1; grid-column-start: 1; grid-column-end: 3;"><?php echo $_smarty_tpl->tpl_vars['poruka']->value;?>
</div>
<?php }?>

<section class="section">
    <h1 class="section__title">Registracija</h1>
    <form id="register" name="register" method="POST" class="section-register__form" action="<?php echo $_SERVER['PHP_SELF'];?>
">
        <label for="name">Ime: </label>
        <input id="name" name="name" autofocus type="text" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["name"];?>
" <?php }?> />
        <?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["name"]))) {?>
            <span class="error section-register__form-error"><?php echo $_smarty_tpl->tpl_vars['mistakeField']->value["name"];?>
</span>
        <?php }?>
        <label for="surname">Prezime: </label>
        <input id="surname" name="surname" type="text" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["surname"];?>
" <?php }?> />
        <?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["surname"]))) {?>
            <span class="error section-register__form-error"><?php echo $_smarty_tpl->tpl_vars['mistakeField']->value["surname"];?>
</span>
        <?php }?>
        <label for="username">Korisničko name*: </label>
        <input id="username" name="username" type="text" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["username"];?>
" <?php }?> />
        <?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["username"]))) {?>
            <span class="error section-register__form-error"><?php echo $_smarty_tpl->tpl_vars['mistakeField']->value["username"];?>
</span>
        <?php }?>
        <label for="password">Lozinka*: </label>
        <input id="password" name="password" type="password" size="15" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?>
            value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["password"];?>
" <?php }?> />
        <?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["password"]))) {?>
            <span class="error section-register__form-error"><?php echo $_smarty_tpl->tpl_vars['mistakeField']->value["password"];?>
</span>
        <?php }?>
        <label for="confirm_pass">Potvrda lozinke*: </label>
        <input id="confirm_pass" name="confirm_pass" type="password" size="15" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?>
            value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["confirm_pass"];?>
" <?php }?> />
        <?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["confirm_pass"]))) {?>
            <span class="error section-register__form-error"><?php echo $_smarty_tpl->tpl_vars['mistakeField']->value["confirm_pass"];?>
</span>
        <?php }?>
        <label for="email">Email*: </label>
        <input id="email" name="email" type="text" size="15" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["email"];?>
" <?php }?> />
        <?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["email"]))) {?>
            <span class="error section-register__form-error"><?php echo $_smarty_tpl->tpl_vars['mistakeField']->value["email"];?>
</span>
        <?php }?>
        <div style="position:relative; grid-area: 7 / 3 / span 2 / span 3; display: flex; flex-direction: column">
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            <input class="form_button" name="register" type="submit" value="Registriraj me!" />
        </div>
        <span class=<?php if ($_smarty_tpl->tpl_vars['messageOK']->value) {?> "info" <?php } else { ?> "error" <?php }?>><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
    </form>
</section><?php }
}
