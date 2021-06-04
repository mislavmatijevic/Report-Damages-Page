<?php
/* Smarty version 3.1.39, created on 2021-06-04 23:05:39
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login-floating.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60ba95a35fb6a3_19622511',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '889c2959d2484ac3e2f4f5d4fc9b7c742c69b7ff' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login-floating.tpl',
      1 => 1622840632,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60ba95a35fb6a3_19622511 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section-login">
    <form id="login" name="login" method="POST" class="section-login_popup" action="<?php echo $_SERVER['PHP_SELF'];?>
">
        <h1 class="section-login_popup-header">Prijava u sustav</h1>
        <input name="username" placeholder="Korisničko ime" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["username"];?>
" <?php }?> />
        <input name="password" type="password" placeholder="Password" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value))) {?>
            value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["password"];?>
" <?php }?> />
        <?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {?><span class="error"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span><?php }?>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <?php if ((isset($_smarty_tpl->tpl_vars['messageCaptcha']->value))) {?><span class="error"><?php echo $_smarty_tpl->tpl_vars['messageCaptcha']->value;?>
</span><?php }?>
        <input type="submit" name="login" value="Prijava" class="section-login_popup-submit" />
    </form>
    <form id="testing_form" name="testing" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>
">
        <input name="testing" type="hidden" value="testing" />
        <input type="submit" name="admin" value="Admin" />
        <input type="submit" name="moderator" value="Moderator" />
        <input type="submit" name="registered" value="Korisnik" />
    </form>
</section><?php }
}
