<?php
/* Smarty version 3.1.39, created on 2021-06-13 19:50:02
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/report-damage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c6454a6662a5_68993715',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa6b46b5b9aba7da2bfa92daa8ca9a24b2acd6d3' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/report-damage.tpl',
      1 => 1623606593,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c6454a6662a5_68993715 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title">Prijava na javni poziv "<?php echo $_smarty_tpl->tpl_vars['publicCallInfo']->value["naziv"];?>
"</h1>
    <p style="text-align: center;">
        <strong>Moderira </strong><a
            href="mailto:<?php echo $_smarty_tpl->tpl_vars['publicCallInfo']->value["moderator_email"];?>
"><?php echo $_smarty_tpl->tpl_vars['publicCallInfo']->value["moderator"];?>
</a>
    </p>
</section>

<section class="section" style="padding-top: 64px;">
    <h1 class="section__title">Prijavi svoju štetu</h1>

    <button id="button-help" title="Pomoć pri korištenju">?</button>
    <div id="global-help" style="display:none; margin-top:200px;left:30%;right:100px;">
        <p id="global-help-text"></p>
        <button id="button-help__next">Nastavi</button>
    </div>
    
    <form id="register" name="register" method="POST" class="section-form"
        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
" enctype="multipart/form-data">
        <input name="public-call-identifier" type="hidden" value=<?php echo $_smarty_tpl->tpl_vars['publicCallInfo']->value["id_javni_poziv"];?>
 />


        <label for="name">Naslov prijave: </label>
        <input id="name" name="name" autofocus type="text" <?php if ((isset($_smarty_tpl->tpl_vars['newDamage']->value))) {?>
            value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['newDamage']->value["name"]);?>
" <?php }?> />

        <span id="error-name" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["name"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["name"];
}?></span>

        <label for="description">Detaljniji opis: </label>
        <textarea id="description" name="description" type="text" rows="10"
            cols="30"><?php if ((isset($_smarty_tpl->tpl_vars['newDamage']->value))) {
echo $_smarty_tpl->tpl_vars['newDamage']->value["description"];
}?></textarea>

        <span id="error-description"
            class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["description"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["description"];
}?></span>

        <label for="tags">Oznake: </label>
        <input id="tags" name="tags" type="text" placeholder="poplava pomoć ..." <?php if ((isset($_smarty_tpl->tpl_vars['newDamage']->value))) {?>
            value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['newDamage']->value["tags"]);?>
" <?php }?> />

        <span id="error-tags" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["tags"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["tags"];
}?></span>


        <label style="grid-column: 3 / span 5;"><strong>Unesite barem jedan dokazni materijal.</strong></label>
        <label id="error-files" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["files"]))) {
echo $_smarty_tpl->tpl_vars['mistakeField']->value["files"];
}?></label>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['materialTypes']->value, 'type', false, 'key');
$_smarty_tpl->tpl_vars['type']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->do_else = false;
?>
            <label for="file"><?php echo $_smarty_tpl->tpl_vars['type']->value["naziv"];?>
<br>(max <?php echo $_smarty_tpl->tpl_vars['type']->value["najveca_velicina_mb"];?>
MB): </label>
            <input name="file-<?php echo $_smarty_tpl->tpl_vars['type']->value["id_vrsta_materijala"];?>
" type="file" multiple="multiple" />
            <span id="error-file-<?php echo $_smarty_tpl->tpl_vars['type']->value["id_vrsta_materijala"];?>
"
                class="error"><?php ob_start();
echo $_smarty_tpl->tpl_vars['type']->value["id_vrsta_materijala"];
$_prefixVariable1 = ob_get_clean();
if ((isset($_smarty_tpl->tpl_vars['mistakeField']->value["file-"+$_prefixVariable1]))) {
ob_start();
echo $_smarty_tpl->tpl_vars['type']->value["id_vrsta_materijala"];
$_prefixVariable2 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['mistakeField']->value["file-"+$_prefixVariable2];
}?></span>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        <div class="section-form__submit-wrapper">
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            <?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {?><span class=<?php if ($_smarty_tpl->tpl_vars['messageOK']->value) {?> "info" <?php } else { ?> "error-captcha" <?php }?>><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span><?php }?>
            <input id="registerButton" class="button" name="submit" type="submit" value="Prijavi štetu" />
        </div>
    </form>
</section><?php }
}
