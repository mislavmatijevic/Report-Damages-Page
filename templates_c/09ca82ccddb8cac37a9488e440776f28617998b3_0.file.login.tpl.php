<?php
/* Smarty version 3.1.39, created on 2021-06-03 22:37:32
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b93d8cf0f3b8_51762137',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09ca82ccddb8cac37a9488e440776f28617998b3' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login.tpl',
      1 => 1622751133,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b93d8cf0f3b8_51762137 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title">Prijava</h1>
    <form id="prijava" name="prijava" method="POST" class="section-login_form" action="<?php echo $_SERVER['PHP_SELF'];?>
">
        <label for="username" class="section-login_form-input">Korisničko ime: </label>
        <input id="username" name="username" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["username"];?>
" <?php }?>/>
        <label for="password" class="section-login_form-password">Lozinka: </label>
        <input id="password" name="password" type="password" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["password"];?>
" <?php }?>/>
        <?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {?><span class="error"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span><?php }?>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <?php if ((isset($_smarty_tpl->tpl_vars['messageCaptcha']->value))) {?><span class="error"><?php echo $_smarty_tpl->tpl_vars['messageCaptcha']->value;?>
</span><?php }?>
        <input type="submit" name="login" value="Prijava" class="section-login_form-submit" />
    </form>
</section><?php }
}