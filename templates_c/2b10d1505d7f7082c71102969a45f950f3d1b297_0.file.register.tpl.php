<?php
/* Smarty version 3.1.39, created on 2021-06-08 14:55:14
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bf68b2524fd6_27181182',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b10d1505d7f7082c71102969a45f950f3d1b297' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/register.tpl',
      1 => 1623147244,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf68b2524fd6_27181182 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title">Registracija</h1>
    <form id="register" name="register" method="POST" class="section-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
        <label for="name">Ime: </label>
        <input id="name" name="name" autofocus type="text" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["name"];?>
" <?php }?> />

        <span id="error-name" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["name"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["name"];
}?></span>

        <label for="surname">Prezime: </label>
        <input id="surname" name="surname" type="text" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["surname"];?>
" <?php }?> />

        <span id="error-surname" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["surname"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["surname"];
}?></span>

        <label for="username">Korisničko name: </label>
        <input id="username" name="username" type="text" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["username"];?>
" <?php }?> />

        <span id="error-username" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["username"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["username"];
}?></span>

        <label for="password">Lozinka: </label>
        <input id="password" name="password" type="password" size="15" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?>
            value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["password"];?>
" <?php }?> />

        <span id="error-password" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["password"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["password"];
}?></span>

        <label for="confirm_pass">Potvrda lozinke: </label>
        <input id="confirm_pass" name="confirm_pass" type="password" size="15" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?>
            value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["confirm_pass"];?>
" <?php }?> />

        <span id="error-confirm_pass"
            class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["confirm_pass"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["confirm_pass"];
}?></span>

        <label for="email">Email: </label>
        <input id="email" name="email" type="text" size="15" <?php if ((isset($_smarty_tpl->tpl_vars['newUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['newUser']->value["email"];?>
" <?php }?> />

        <span id="error-email" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["email"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["email"];
}?></span>

        <div class="section-form__submit-wrapper">
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            <?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {?><span class=<?php if ($_smarty_tpl->tpl_vars['messageOK']->value) {?> "info" <?php } else { ?> "error-captcha" <?php }?>><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span><?php }?>
            <input id="registerButton" class="form_button" name="register" type="submit" value="Registriraj me!" />
        </div>
    </form>
</section><?php }
}
