<?php
/* Smarty version 3.1.39, created on 2021-06-08 11:50:36
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/acceptanceStats.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bf3d6c3d45b6_50471620',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82dd7793a3b2583ab88f92b35aad5656f7ff2bbe' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/acceptanceStats.tpl',
      1 => 1623088134,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf3d6c3d45b6_50471620 (Smarty_Internal_Template $_smarty_tpl) {
?><table class="table">
    <caption>Stanje kategorija</caption>
    <thead>
        <tr>
            <th class="table__head">Naziv kategorije</th>
            <th class="table__head">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['acceptanceStats']->value, 'row', false, 'key');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
            <tr class="table__row">
                <?php if (!(isset($_smarty_tpl->tpl_vars['acceptanceStats']->value[$_smarty_tpl->tpl_vars['key']->value-1]["naziv"])) || ((isset($_smarty_tpl->tpl_vars['acceptanceStats']->value[$_smarty_tpl->tpl_vars['key']->value-1]["naziv"])) && $_smarty_tpl->tpl_vars['acceptanceStats']->value[$_smarty_tpl->tpl_vars['key']->value-1]["naziv"] != $_smarty_tpl->tpl_vars['row']->value["naziv"])) {?>
                    <td class="table__row-data"
                        <?php if ((isset($_smarty_tpl->tpl_vars['acceptanceStats']->value[$_smarty_tpl->tpl_vars['key']->value+1]["naziv"])) && $_smarty_tpl->tpl_vars['acceptanceStats']->value[$_smarty_tpl->tpl_vars['key']->value+1]["naziv"] == $_smarty_tpl->tpl_vars['row']->value["naziv"]) {?>
                            <?php if ((isset($_smarty_tpl->tpl_vars['acceptanceStats']->value[$_smarty_tpl->tpl_vars['key']->value+2]["naziv"])) && $_smarty_tpl->tpl_vars['acceptanceStats']->value[$_smarty_tpl->tpl_vars['key']->value+2]["naziv"] == $_smarty_tpl->tpl_vars['row']->value["naziv"]) {?>
                            rowspan="3" <?php } else { ?> rowspan="2" 
                            <?php }?> 
                        <?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value["naziv"];?>
</td>
                <?php }?>
                <td class="table__row-data"><?php echo $_smarty_tpl->tpl_vars['row']->value["count"];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value["status"];?>
</td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table><?php }
}
