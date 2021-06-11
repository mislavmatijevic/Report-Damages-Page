<?php
/* Smarty version 3.1.39, created on 2021-06-06 14:15:52
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/html/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bcbc78c0d228_61730342',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa4968847ea908ac657487e7cac5e88a5fb3b9cd' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/html/templates/index.tpl',
      1 => 1622977768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bcbc78c0d228_61730342 (Smarty_Internal_Template $_smarty_tpl) {
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
    <h2 class="section__title">
        Javni pozivi
    </h2>
    <?php if ((isset($_smarty_tpl->tpl_vars['errorGlobal']->value))) {?>
        <p><?php echo $_smarty_tpl->tpl_vars['errorGlobal']->value;?>
</p>
    <?php }?>
    <div class="section_damages">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['javniPozivi']->value, 'damage', false, 'key');
$_smarty_tpl->tpl_vars['damage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['damage']->value) {
$_smarty_tpl->tpl_vars['damage']->do_else = false;
?>
            <div class="damages__damage">
                <div>
                    <figure class="damages__damage-figure">
                        <img class="damages__damage-image"
                            src="media/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["kategorija_ilustracija"]);?>
">
                    </figure>
                    <h3 class="damages__damage-title">
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["naziv"]);?>

                    </h3>
                    <p class="damages__damage-description">
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["opis"]);?>

                    </p>
                </div>
                <div class="damages__damage-info">
                    <p <?php if ((isset($_smarty_tpl->tpl_vars['damage']->value["datum_zatvaranja"]))) {?>class="damages__damage-dates-ended"
                        <?php } else { ?>class="damages__damage-dates" 
                        <?php }?>>
                        <strong>Od</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["datum_otvaranja"]);?>

                    </p>
                    <p <?php if ((isset($_smarty_tpl->tpl_vars['damage']->value["datum_zatvaranja"]))) {?>class="damages__damage-dates-ended"
                        <?php } else { ?>class="damages__damage-dates" 
                        <?php }?>>
                        <strong>Do</strong> <?php if ((isset($_smarty_tpl->tpl_vars['damage']->value["datum_zatvaranja"]))) {?>
                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['damage']->value["datum_zatvaranja"]);?>

                        <?php } else { ?>
                            <i>Još otvoren</i>
                        <?php }?>
                    </p>
                </div>
                <a class="button" href="#">Detaljnije</a>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</section><?php }
}
