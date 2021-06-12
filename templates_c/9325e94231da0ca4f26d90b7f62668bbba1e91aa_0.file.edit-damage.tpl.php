<?php
/* Smarty version 3.1.39, created on 2021-06-11 23:06:28
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/edit-damage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c3d054c14828_35161797',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9325e94231da0ca4f26d90b7f62668bbba1e91aa' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/edit-damage.tpl',
      1 => 1623445588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c3d054c14828_35161797 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title">Uređivanje javnog poziva "<?php echo $_smarty_tpl->tpl_vars['publicCallInfo']->value["naziv"];?>
"</h1>
</section>

<section class="section" style="padding-top: 64px;">
    <form id="register" name="register" method="POST" class="section-form"
        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
" enctype="multipart/form-data">
        <input name="public-call-identifier" type="hidden" value=<?php echo $_smarty_tpl->tpl_vars['publicCallInfo']->value["id_javni_poziv"];?>
 />

        <label for="name">Naziv javnog poziva: </label>
        <input id="name" name="name" autofocus type="text" <?php if ((isset($_smarty_tpl->tpl_vars['newDamage']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['newDamage']->value["name"];?>
" <?php }?> />

        <span id="error-name" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["name"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["name"];
}?></span>

        <label for="description">Detaljniji opis: </label>
        <textarea id="description" name="description" type="text" rows="10"
            cols="30"><?php if ((isset($_smarty_tpl->tpl_vars['newDamage']->value))) {
echo $_smarty_tpl->tpl_vars['newDamage']->value["description"];
}?></textarea>

        <span id="error-description"
            class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["description"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["description"];
}?></span>

        <label for="tags">Oznake: </label>
        <input id="tags" name="tags" type="text" placeholder="poplava pomoć ..." <?php if ((isset($_smarty_tpl->tpl_vars['newDamage']->value))) {?>
            value="<?php echo $_smarty_tpl->tpl_vars['newDamage']->value["tags"];?>
" <?php }?> />

        <span id="error-tags" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["tags"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["tags"];
}?></span>
    </form>
</section><?php }
}
