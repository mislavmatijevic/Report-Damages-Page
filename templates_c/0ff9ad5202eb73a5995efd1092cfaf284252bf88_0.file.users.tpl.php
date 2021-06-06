<?php
/* Smarty version 3.1.39, created on 2021-06-06 22:41:23
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bd32f3b7a831_57379886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0ff9ad5202eb73a5995efd1092cfaf284252bf88' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/users.tpl',
      1 => 1623011928,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bd32f3b7a831_57379886 (Smarty_Internal_Template $_smarty_tpl) {
?><table class="table">
    <caption>Popis korisnika</caption>
    <thead>
        <tr>
            <th class="table__head">Korisničko ime</th>
            <th class="table__head">Prezime</th>
            <th class="table__head">Ime</th>
            <th class="table__head">Lozinka (SHA256)</th>
        </tr>
    </thead>
    <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['userList']->value, 'user');
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
?>
            <tr class="table__row">
                <td class="table__row-data"><?php echo $_smarty_tpl->tpl_vars['user']->value["korisnicko_ime"];?>
</td>
                <td class="table__row-data"><?php echo $_smarty_tpl->tpl_vars['user']->value["prezime"];?>
</td>
                <td class="table__row-data"><?php echo $_smarty_tpl->tpl_vars['user']->value["ime"];?>
</td>
                <td class="table__row-data"><?php echo $_smarty_tpl->tpl_vars['user']->value["lozinka_sha256"];?>
</td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table><?php }
}
