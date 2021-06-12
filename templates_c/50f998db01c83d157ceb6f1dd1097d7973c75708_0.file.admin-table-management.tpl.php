<?php
/* Smarty version 3.1.39, created on 2021-06-12 16:30:23
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/admin-table-management.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c4c4ff62d4c0_69971821',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50f998db01c83d157ceb6f1dd1097d7973c75708' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/admin-table-management.tpl',
      1 => 1623508222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c4c4ff62d4c0_69971821 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section__admin-controls__table-controls">
    <?php if ((isset($_smarty_tpl->tpl_vars['tableData']->value))) {?>
        <table>
            <caption><?php echo $_smarty_tpl->tpl_vars['tableName']->value;?>
</caption>
            <thead>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tableHeader']->value, 'tableHeaderInfo', false, 'index');
$_smarty_tpl->tpl_vars['tableHeaderInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['tableHeaderInfo']->value) {
$_smarty_tpl->tpl_vars['tableHeaderInfo']->do_else = false;
?>
                    <?php if ($_smarty_tpl->tpl_vars['index']->value == 0) {?>
                        <th>id</th>
                    <?php } else { ?>
                        <th><?php echo $_smarty_tpl->tpl_vars['tableHeaderInfo']->value["Field"];?>
 (<?php echo $_smarty_tpl->tpl_vars['tableHeaderInfo']->value["Type"];?>
)</th>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tableData']->value, 'tableDataInfo');
$_smarty_tpl->tpl_vars['tableDataInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tableDataInfo']->value) {
$_smarty_tpl->tpl_vars['tableDataInfo']->do_else = false;
?>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
                        <tr>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tableHeader']->value, 'tableHeaderInfo', false, 'index');
$_smarty_tpl->tpl_vars['tableHeaderInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['tableHeaderInfo']->value) {
$_smarty_tpl->tpl_vars['tableHeaderInfo']->do_else = false;
?>
                                <td>
                                    <input <?php if ($_smarty_tpl->tpl_vars['index']->value == 0) {?> disabled <?php }?> name="<?php echo $_smarty_tpl->tpl_vars['tableHeaderInfo']->value["Field"];?>
"
                                        value="<?php echo $_smarty_tpl->tpl_vars['tableDataInfo']->value[$_smarty_tpl->tpl_vars['tableHeaderInfo']->value["Field"]];?>
" />
                                    <?php if ($_smarty_tpl->tpl_vars['index']->value == 0) {?>
                                        <button type="submit" style="background-color: green;" name="change"
                                            value="<?php echo $_smarty_tpl->tpl_vars['tableDataInfo']->value[$_smarty_tpl->tpl_vars['tableHeaderInfo']->value["Field"]];?>
">Promijeni</button>
                                        <button type="submit" style="background-color: red;" name="delete"
                                            value="<?php echo $_smarty_tpl->tpl_vars['tableHeaderInfo']->value["Field"];?>
-<?php echo $_smarty_tpl->tpl_vars['tableDataInfo']->value[$_smarty_tpl->tpl_vars['tableHeaderInfo']->value["Field"]];?>
">Ukloni</button>
                                    <?php }?>
                                </td>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tr>
                    </form>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <tr>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tableHeader']->value, 'tableHeaderInfo', false, 'index');
$_smarty_tpl->tpl_vars['tableHeaderInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['tableHeaderInfo']->value) {
$_smarty_tpl->tpl_vars['tableHeaderInfo']->do_else = false;
?>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['index']->value != 0) {?><input style="color: darkgreen" placeholder="NULL" name="<?php echo $_smarty_tpl->tpl_vars['tableHeaderInfo']->value["Field"];?>
"
                                        value="Unesite <?php echo $_smarty_tpl->tpl_vars['tableHeaderInfo']->value["Field"];?>
" />
                                <?php } else { ?>
                                    <input type="submit" style="background-color: green;" name="new" value="Dodaj" />
                                <?php }?>
                            </td>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </form>
                </tr>
            </tbody>
        </table>
    <?php }?>

</section><?php }
}
