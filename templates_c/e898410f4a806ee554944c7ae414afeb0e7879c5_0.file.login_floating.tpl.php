<?php
/* Smarty version 3.1.39, created on 2021-06-02 19:36:10
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login_floating.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b7c18a650b27_98958770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e898410f4a806ee554944c7ae414afeb0e7879c5' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/login_floating.tpl',
      1 => 1622655369,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b7c18a650b27_98958770 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section-login">
    <form id="prijava" name="prijava" method="POST" class="section-login_popup">
        <h1 class="section-login_popup-header">Prijava u sustav</h1>
        <input name="email" placeholder="Email" />
        <input name="password" placeholder="Password" />
        <span class=<?php if ($_smarty_tpl->tpl_vars['messageOK']->value) {?> "info" <?php } else { ?> "error" <?php }?>><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>

        <input type="submit" name="login" value="Prijava" class="section-login_popup-submit" />
    </form>
</section><?php }
}
