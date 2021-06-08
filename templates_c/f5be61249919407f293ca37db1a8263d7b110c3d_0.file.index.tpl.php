<?php
/* Smarty version 3.1.39, created on 2021-06-08 11:50:36
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bf3d6c3a1138_41464886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5be61249919407f293ca37db1a8263d7b110c3d' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/index.tpl',
      1 => 1623110622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:acceptanceStats.tpl' => 1,
  ),
),false)) {
function content_60bf3d6c3a1138_41464886 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section-hero">
    <div class="section-hero__overlay">
        <div class="section-hero__content">
            <h1 class="section-hero__heading">
                Prijave šteta
            </h1>
            <p class="section-hero__subheading">
                Materijalna (imovinska) šteta se sastoji u uništenju neke stvari, onemogućavanju ili otežanju
                upotrebe stvari, u nekoj smetnji zbog čijeg uklanjanja je potrebno napraviti troškove koji inače
                ne bi bili napravljeni.
            </p>
            <p class="section-hero__subheading">
                Ova stranica omogućava osobama koje su doživjele ovakvu tragediju da donacijama ostvare dobit i
                poprave financijsku situaciju i životni standard.
            </p>
        </div>
    </div>
</section>

<section class="section section_damages" style="display: block">
    <?php $_smarty_tpl->_subTemplateRender('file:acceptanceStats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</section>

<section class="section section_damages" style="display: block">
    <h2 class="section__title">
        Javni pozivi
    </h2>
    <div class="section_damages">
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
                    <figure class="damages__damage-figure">
                        <img class="damages__damage-image"
                            src="media/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["kategorija_ilustracija"]);?>
">
                    </figure>
                    <p class="damages__damage-description">
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["opis"]);?>

                    </p>
                </div>
                <div class="damages__damage-info">
                    <p class="damages__damage-dates<?php if ($_smarty_tpl->tpl_vars['damage']->value["zatvoren"] == 1) {?>-ended<?php }?>">
                        <strong>Otvoren:</strong>
                        <?php echo date("d.m. H:i:s",strtotime(htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["datum_otvaranja"])));?>

                        <br>
                        <strong>Rok prijava:</strong>
                        <?php echo date("d.m. H:i:s",strtotime(htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["datum_zatvaranja"])));?>

                    </p>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['damage']->value["zatvoren"] == 0) {?>
                    <a class="button" href="./donate.php?id=<?php echo $_smarty_tpl->tpl_vars['damage']->value["id_javni_poziv"];?>
">Detaljnije</a>
                    <?php } else { ?>
                    <a class="button" href="./search.php?id=<?php echo $_smarty_tpl->tpl_vars['damage']->value["id_javni_poziv"];?>
">Pretraži štete</a>
                <?php }?>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</section><?php }
}
