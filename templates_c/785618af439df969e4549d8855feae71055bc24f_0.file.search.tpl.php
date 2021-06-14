<?php
/* Smarty version 3.1.39, created on 2021-06-14 18:11:34
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c77fb6c32984_42604483',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '785618af439df969e4549d8855feae71055bc24f' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/search.tpl',
      1 => 1623687080,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c77fb6c32984_42604483 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section-search">
    <form class="section-search__form" method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
        <label for="search-string">Pretraži po oznakama:</label>
        <input id="search-string" class="input" type="search" name="search-string" placeholder="poplava;voda" />
        <button class="button" type="submit">Traži</button>
    </form>
    <?php if ((isset($_smarty_tpl->tpl_vars['searchTagsString']->value))) {?>
        <p class="section-search__search-tags">Rezultati pretrage po oznakama:<br><strong><?php echo $_smarty_tpl->tpl_vars['searchTagsString']->value;?>
</strong></p>
    <?php }?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reportedDamages']->value, 'damage');
$_smarty_tpl->tpl_vars['damage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['damage']->value) {
$_smarty_tpl->tpl_vars['damage']->do_else = false;
?>
        <div class="reported-damage">
            <h2><?php echo $_smarty_tpl->tpl_vars['damage']->value["naziv"];?>
</h2>
            <div class="reported-damage__wrapper">
                <div>
                    <p class="reported-damage__descriptor">Prijavio:</p>
                    <p class="reported-damage__content"><?php echo $_smarty_tpl->tpl_vars['damage']->value["korisnicko_ime"];?>
</p>
                </div>
                <div>
                    <p class="reported-damage__descriptor">Oznake:</p>
                    <p class="reported-damage__content"><?php echo $_smarty_tpl->tpl_vars['damage']->value["oznake"];?>
</p>
                </div>
            </div>
            <div class="reported-damage__description-wrapper">
                <p class="reported-damage__descriptor">Opis:</p>
                <p class="reported-damage__content"><?php echo $_smarty_tpl->tpl_vars['damage']->value["opis"];?>
</p>
            </div>
            <div class="reported-damage__wrapper">
                <div>
                    <p class="reported-damage__descriptor">Datum prijave:</p>
                    <p class="reported-damage__content"><?php echo $_smarty_tpl->tpl_vars['damage']->value["datum_prijave"];?>
</p>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['damage']->value["id_status_stete"] == "2") {?>
                    <div>
                        <p class="reported-damage__descriptor">Datum potvrde:</p>
                        <p class="reported-damage__content"><?php echo $_smarty_tpl->tpl_vars['damage']->value["datum_potvrde"];?>
</p>
                    </div>
                    <div>
                        <p class="reported-damage__descriptor">Dodijeljeno sredstava:</p>
                        <p class="reported-damage__content-success"><?php echo $_smarty_tpl->tpl_vars['damage']->value["subvencija_hrk"];?>
 HRK</p>
                    </div>
                </div>
            <?php } elseif ($_smarty_tpl->tpl_vars['damage']->value["id_status_stete"] == "1") {?>
                </div>
                <p class="reported-damage__content-warning">Još nije pregledano!</p>
            <?php } else { ?>
            </div>
            <p class="reported-damage__content-error">Nije prihvaćeno!</p>
        <?php }?>

        <div class="reported-damage__evidence">
            <h4>Dokazni materijali</h4>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['damage']->value["dokazni_materijali"], 'evidence');
$_smarty_tpl->tpl_vars['evidence']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['evidence']->value) {
$_smarty_tpl->tpl_vars['evidence']->do_else = false;
?>
                <p><?php echo $_smarty_tpl->tpl_vars['evidence']->value["naziv"];?>
</p>
                <p>(postavljeno <?php echo $_smarty_tpl->tpl_vars['evidence']->value["datum_postavljanja"];?>
)</p>
                <div class="reported-damage__evidence-multimedia">
                    <?php if ($_smarty_tpl->tpl_vars['evidence']->value["id_vrsta_materijala"] == 1) {?>                         <img src="./media/evidence/<?php echo $_smarty_tpl->tpl_vars['evidence']->value["naziv"];?>
" />

                    <?php } elseif ($_smarty_tpl->tpl_vars['evidence']->value["id_vrsta_materijala"] == 2) {?>                         <video width="320" height="240" controls>
                            <source src="./media/evidence/<?php echo $_smarty_tpl->tpl_vars['evidence']->value["naziv"];?>
" type="video/mp4">
                        </video>

                    <?php } elseif ($_smarty_tpl->tpl_vars['evidence']->value["id_vrsta_materijala"] == 3) {?>                         <audio controls>
                            <source src="./media/evidence/<?php echo $_smarty_tpl->tpl_vars['evidence']->value["naziv"];?>
" type="audio/mpeg">
                            Vaš preglednik ne podržava reprodukciju zvuka.
                        </audio>
                    <?php }?>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>

        </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</section><?php }
}
