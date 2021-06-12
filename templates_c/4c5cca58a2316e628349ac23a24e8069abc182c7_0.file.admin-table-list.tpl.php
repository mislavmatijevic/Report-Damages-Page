<?php
/* Smarty version 3.1.39, created on 2021-06-12 12:47:58
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/admin-table-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c490de5c3801_44983634',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c5cca58a2316e628349ac23a24e8069abc182c7' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/admin-table-list.tpl',
      1 => 1623494877,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c490de5c3801_44983634 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section__admin-controls">
    <h2 class="section__admin-controls__title">Blokiranje korisnika</h2>


    <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allTableNames']->value, 'tableName');
$_smarty_tpl->tpl_vars['tableName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tableName']->value) {
$_smarty_tpl->tpl_vars['tableName']->do_else = false;
?>
            <li class="table__row">
                <a
                    href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
?table-name=<?php echo $_smarty_tpl->tpl_vars['tableName']->value["TABLE_NAME"];?>
"><?php echo $_smarty_tpl->tpl_vars['tableName']->value["TABLE_NAME"];?>
</a>
            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
</section><?php }
}
