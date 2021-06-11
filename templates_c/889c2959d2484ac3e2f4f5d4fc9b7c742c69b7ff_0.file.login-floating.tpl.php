<?php
/* Smarty version 3.1.39, created on 2021-06-11 11:45:31
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login-floating.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c330bbd20354_25763052',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '889c2959d2484ac3e2f4f5d4fc9b7c742c69b7ff' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login-floating.tpl',
      1 => 1623404731,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c330bbd20354_25763052 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section-login">
    <form id="login" name="login" method="POST" class="section-login_popup" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
        <h1 class="section-login_popup-header">Prijava u sustav</h1>
        <input id="username" name="username" placeholder="Korisničko ime" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value["username"]))) {?> value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["username"];?>
"
            <?php }?> />
        <span id="error-username" class="error"></span>
        <input id="password" name="password" type="password" placeholder="Password" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value["password"]))) {?>
            value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["password"];?>
" <?php }?> />
        <span id="error-password" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {
echo $_smarty_tpl->tpl_vars['message']->value;
}?></span>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <?php if ((isset($_smarty_tpl->tpl_vars['messageCaptcha']->value))) {?><span class="error-captcha"><?php echo $_smarty_tpl->tpl_vars['messageCaptcha']->value;?>
</span><?php }?>
        <div style="text-align: left; margin-left: 15px;">
            <label for="remember">Zapamti me</label>
            <input id="remember" name="remember" type="checkbox" <?php if ((isset($_smarty_tpl->tpl_vars['setRemember']->value))) {?>checked value="1"<?php }?> />
        </div>
        <input id="submitButton" type="submit" name="login" value="Prijava" class="section-login_popup-submit button" />
    </form>
    <form id="testing_form" name="testing" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
        <input name="testing" type="hidden" value="testing" />
        <input type="submit" name="admin" value="Admin" />
        <input type="submit" name="moderator" value="Moderator" />
        <input type="submit" name="registered" value="Korisnik" />
    </form>
</section><?php }
}
