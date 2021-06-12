<?php
/* Smarty version 3.1.39, created on 2021-06-12 17:45:04
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/admin-table-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c4d68004ae89_45958771',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c5cca58a2316e628349ac23a24e8069abc182c7' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/admin-table-list.tpl',
      1 => 1623512703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c4d68004ae89_45958771 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section__admin-controls">
    <h2 class="section__admin-controls__title" style="margin-top: 80px;">Lista tablica</h2>
    <ul id="table-list">
        <li class="table__row">
            <button tableName="<?php echo $_smarty_tpl->tpl_vars['tableName']->value["TABLE_NAME"];?>
"><?php echo $_smarty_tpl->tpl_vars['tableName']->value["TABLE_NAME"];?>
</button>
        </li>
    </ul>
</section><?php }
}
