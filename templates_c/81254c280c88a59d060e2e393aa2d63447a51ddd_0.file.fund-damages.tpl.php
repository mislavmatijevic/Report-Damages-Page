<?php
/* Smarty version 3.1.39, created on 2021-06-12 03:06:47
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/fund-damages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c408a79c4572_78885807',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '81254c280c88a59d060e2e393aa2d63447a51ddd' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/fund-damages.tpl',
      1 => 1623459954,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c408a79c4572_78885807 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section" style="display: block">
    <h2 class="section__title">
        <?php echo $_smarty_tpl->tpl_vars['callName']->value;?>

    </h2>
    <h3 class="section__title">
        Preostalo sredstava: <?php echo $_smarty_tpl->tpl_vars['remainingSubvention']->value;?>
 HRK
    </h3>
</section>
<section class="section" style="display: block; padding-top: 16px">
    <h2 class="section__title">
        Kontrola
    </h2>
    <form method="POST" id="fund-damages__form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
        <div class="input-wrapper">
            <input hidden name="current-call" value=<?php echo $_smarty_tpl->tpl_vars['currentCallId']->value;?>
 />
            <input name="damageId" type="number" placeholder="šifra" />
            <input name="amount" placeholder="iznos subvencije" />
        </div>
        <button class="button" name="fund" type="submit" value="1">Subvencioniraj i zatvori prijavu</button>
    </form>
</section>
<section class="section_damages" style="display: flex;justify-content: center;">

    <table class="table">
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
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
                                <input hidden name="current-call" value=<?php echo $_smarty_tpl->tpl_vars['currentCallId']->value;?>
 />
                                <button name="remove" class="button" type="submit" value=<?php echo $_smarty_tpl->tpl_vars['damage']->value["id_steta"];?>
>Odbij</button>
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
