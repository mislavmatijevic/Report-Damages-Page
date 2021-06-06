<?php
/* Smarty version 3.1.39, created on 2021-06-06 23:29:19
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/pagingControls.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bd3e2f19e625_26524842',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d3fcc1659256c35bfb9aff336cb0bcf858af384' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/pagingControls.tpl',
      1 => 1623014958,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bd3e2f19e625_26524842 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="paging">
    <p class="paging-info"><?php echo $_smarty_tpl->tpl_vars['currentPage']->value+1;?>
/<?php echo $_smarty_tpl->tpl_vars['maxPage']->value+1;?>
</p>
    <form id="paging-controls" name="paging-controls" method="GET" class="paging-controls"
        action="<?php echo $_SERVER['PHP_SELF'];?>
">
        <button id="first" name="page" value="0" type="submit">Prva stranica</button>
        <button id="back" name="page" value="<?php echo $_smarty_tpl->tpl_vars['currentPage']->value-1;?>
" type="submit">⏮️</button>
        <progress name="page" value="<?php echo $_smarty_tpl->tpl_vars['currentPage']->value;?>
" max="<?php echo $_smarty_tpl->tpl_vars['maxPage']->value;?>
">
            <?php echo $_smarty_tpl->tpl_vars['currentPage']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['maxPage']->value;?>

        </progress>
        <button id="next" name="page" value="<?php echo $_smarty_tpl->tpl_vars['currentPage']->value+1;?>
" type="submit">⏭️</button>
        <button id="last" name="page" value="<?php echo $_smarty_tpl->tpl_vars['maxPage']->value;?>
" type="submit">Zadnja stranica</button>
    </form>
</div><?php }
}
