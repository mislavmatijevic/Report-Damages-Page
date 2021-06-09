<?php
/* Smarty version 3.1.39, created on 2021-06-09 18:38:21
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c0ee7d193865_86930571',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09ca82ccddb8cac37a9488e440776f28617998b3' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login.tpl',
      1 => 1623147244,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c0ee7d193865_86930571 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title">Prijava</h1>
    <form id="login" name="login" method="POST" class="section-login_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
        <?php if ((isset($_smarty_tpl->tpl_vars['messageCaptcha']->value))) {?><span class="error-captcha"><?php echo $_smarty_tpl->tpl_vars['messageCaptcha']->value;?>
</span><?php }?>
        <label for="username" class="section-login_form-input">Korisničko ime: </label>
        <input id="username" name="username" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value["username"]))) {?> value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["username"];?>
" <?php }?> />
        <span id="error-username" class="error"></span>
        <label for="password" class="section-login_form-password">Lozinka: </label>
        <input id="password" name="password" type="password" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value["password"]))) {?> value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["password"];?>
"
            <?php }?> />
        <span id="error-password" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {
echo $_smarty_tpl->tpl_vars['message']->value;
}?></span>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <div style="text-align: left; margin-left: 15px;">
            <label for="remember">Zapamti me</label>
            <input id="remember" name="remember" type="checkbox" <?php if ((isset($_smarty_tpl->tpl_vars['setRemember']->value))) {?>checked value="1" <?php }?> />
        </div>
        <input id="submitButton" type="submit" name="login" value="Prijava" class="section-login_form-submit" />
    </form>
</section><?php }
}
