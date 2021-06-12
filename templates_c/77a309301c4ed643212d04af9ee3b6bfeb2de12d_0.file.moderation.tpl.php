<?php
/* Smarty version 3.1.39, created on 2021-06-12 02:03:06
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/moderation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c3f9badf8a28_27472999',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77a309301c4ed643212d04af9ee3b6bfeb2de12d' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/moderation.tpl',
      1 => 1623456186,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c3f9badf8a28_27472999 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section" style="display: block">
    <h2 class="section__title">
        Uređivanje javnih poziva
    </h2>
    <a class="button" href="./create-public-call.php">Novi javni poziv</a>
</section>
<section class="section_damages" style="display: flex;justify-content: center;">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['javniPozivi']->value, 'damage', false, 'key');
$_smarty_tpl->tpl_vars['damage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['damage']->value) {
$_smarty_tpl->tpl_vars['damage']->do_else = false;
?>
        <div class="damages__damage">
            <div>
                <h3 class="damages__damage-title">
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["naziv"]);?>

                </h3>
                <p class="damages__damage-description">
                    <strong>Kategorija: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["kategorija_naziv"]);?>
</strong>
                </p>
            </div>
            <div>
                <div class="damages__damage-info">
                    <p class="damages__damage-dates<?php if ($_smarty_tpl->tpl_vars['damage']->value["zatvoren"] == 1) {?>-ended<?php }?>">
                        <strong>Broj prijava:</strong>

                        <strong>Otvoren:</strong>
                        <?php echo date("d.m.y. H:i:s",strtotime(htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["datum_otvaranja"])));?>

                        <br>
                        <strong>Rok prijava:</strong>
                        <?php echo date("d.m.y. H:i:s",strtotime(htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["datum_zatvaranja"])));?>

                    </p>
                </div>
                <a class="button-damage" href="./edit-public-call.php?id=<?php echo $_smarty_tpl->tpl_vars['damage']->value["id_javni_poziv"];?>
">Uredi</a>
                <a class="button-damage" href="./fund-damages.php?id=<?php echo $_smarty_tpl->tpl_vars['damage']->value["id_javni_poziv"];?>
">Pregledaj prijave</a>
            </div>
        </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</section>
<section class="section" style="display: block">
</section><?php }
}
