<?php
/* Smarty version 3.1.39, created on 2021-06-03 11:28:02
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b8a0a2112c31_44457127',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09ca82ccddb8cac37a9488e440776f28617998b3' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login.tpl',
      1 => 1622712455,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b8a0a2112c31_44457127 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title">Prijava</h1>
    <form id="prijava" name="prijava" method="POST" class="section-login_form" action="<?php echo $_SERVER['PHP_SELF'];?>
">
        <label for="email" class="section-login_form-input">Email: </label>
        <input id="email" name="email" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["email"];?>
" <?php }?>/>
        <label for="password" class="section-login_form-password">Lozinka: </label>
        <input id="password" name="password" type="password" <?php if ((isset($_smarty_tpl->tpl_vars['loginUser']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['loginUser']->value["password"];?>
" <?php }?>/>
        <span class=<?php if ($_smarty_tpl->tpl_vars['messageOK']->value) {?> "info" <?php } else { ?> "error" <?php }?>><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <input type="submit" name="login" value="Prijava" class="section-login_form-submit" />
    </form>
</section><?php }
}
