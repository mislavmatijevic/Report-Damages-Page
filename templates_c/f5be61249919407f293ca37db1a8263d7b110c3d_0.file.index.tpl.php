<?php
/* Smarty version 3.1.39, created on 2021-06-06 11:39:56
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bc97ec5778d6_66240348',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5be61249919407f293ca37db1a8263d7b110c3d' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/index.tpl',
      1 => 1622972394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bc97ec5778d6_66240348 (Smarty_Internal_Template $_smarty_tpl) {
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
    <?php if ((isset($_smarty_tpl->tpl_vars['messageGlobal']->value))) {?>
        <p><?php echo $_smarty_tpl->tpl_vars['messageGlobal']->value;?>
</p>
    <?php }?>
    <div class="section_damages">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['javniPozivi']->value, 'damage', false, 'key');
$_smarty_tpl->tpl_vars['damage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['damage']->value) {
$_smarty_tpl->tpl_vars['damage']->do_else = false;
?>
            <div class="damage-card">
                <div class="damage__damage">
                    <figure class="damages__damage-figure">
                        <img class="damages__damage-image" src="media/<?php echo $_smarty_tpl->tpl_vars['damage']->value["kategorija_ilustracija"];?>
">
                    </figure>
                    <h3 class="damages__damage-title">
                        <?php echo $_smarty_tpl->tpl_vars['damage']->value["naziv"];?>

                    </h3>
                    <p class="damages__damage-description">
                        <?php echo $_smarty_tpl->tpl_vars['damage']->value["opis"];?>

                    </p>
                    <div class="damage-card__info">
                        <p class="damages__damage-description">
                            <strong>Od</strong> <?php echo $_smarty_tpl->tpl_vars['damage']->value["datum_otvaranja"];?>

                        </p>
                        <p class="damages__damage-description">
                            <strong>Do</strong> <?php if ((isset($_smarty_tpl->tpl_vars['damage']->value["datum_zatvaranja"]))) {?>
                                <?php echo $_smarty_tpl->tpl_vars['damage']->value["datum_zatvaranja"];?>

                            <?php } else { ?>
                                <i>Još otvoren</i>
                            <?php }?>
                        </p>
                    </div>
                </div>
                <a class="button" href="#">Detaljnije</a>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</section><?php }
}
