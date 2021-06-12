<?php
/* Smarty version 3.1.39, created on 2021-06-12 02:43:42
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/fund-damages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c4033e2b5593_37288683',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '81254c280c88a59d060e2e393aa2d63447a51ddd' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/fund-damages.tpl',
      1 => 1623458621,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c4033e2b5593_37288683 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section" style="display: block">
    <h2 class="section__title">
        Subvencioniranje korisnika
    </h2>
</section>
<section class="section" style="display: block;">
    <h2 class="section__title">
        Kontrola
    </h2>
    <form id="edit-call" method="POST" class="section-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
        <input placeholder="šifra" />
        <input placeholder="iznos subvencije" />
    </form>
</section>
<section class="section_damages" style="display: flex;justify-content: center;">

    <table class="table" style="table-layout: fixed;">
        <caption>Popis prijavljenih šteta na ovom javnom pozivu</caption>
        <thead>
            <tr>
                <th class="table__head">Šifra</th>
                <th class="table__head">Korisničko ime</th>
                <th class="table__head">Naziv</th>
                <th class="table__head">Opis</th>
                <th class="table__head">Oznake</th>
                <th class="table__head">Datum prijave</th>
                <th class="table__head">Akcija</th>
            </tr>
        </thead>
        <tbody>
            <?php if ((isset($_smarty_tpl->tpl_vars['allDamages']->value))) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allDamages']->value, 'damage');
$_smarty_tpl->tpl_vars['damage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['damage']->value) {
$_smarty_tpl->tpl_vars['damage']->do_else = false;
?>
                    <tr class="table__row">
                        <td class="table__row-data"><?php echo $_smarty_tpl->tpl_vars['damage']->value["id_steta"];?>
</td>
                        <td class="table__row-data"><?php echo $_smarty_tpl->tpl_vars['damage']->value["korisnicko_ime"];?>
</td>
                        <td class="table__row-data table__row-data__text"><?php echo $_smarty_tpl->tpl_vars['damage']->value["naziv"];?>
</td>
                        <td class="table__row-data table__row-data__text"><?php echo $_smarty_tpl->tpl_vars['damage']->value["opis"];?>
</td>
                        <td class="table__row-data"><?php echo $_smarty_tpl->tpl_vars['damage']->value["oznake"];?>
</td>
                        <td class="table__row-data"><?php echo $_smarty_tpl->tpl_vars['damage']->value["datum_prijave"];?>
</td>
                        <td class="table__row-data">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
                            <button class="button">Odbij</button>
                            </form>
                        </td>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
        </tbody>
    </table>
</section><?php }
}
