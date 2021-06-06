<?php
/* Smarty version 3.1.39, created on 2021-06-04 01:00:17
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/forgottenPass.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b95f01a8fd52_29152114',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12d3874b7495832154bb282c9f1481fa191ceb2e' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/forgotten-pass.tpl',
      1 => 1622761159,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b95f01a8fd52_29152114 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <?php if ($_smarty_tpl->tpl_vars['requestSent']->value) {?>
        <h1 class="section__title"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</h1>
        <p>Ako ste zaboravili Vašu e-poštu, molimo da se javite administratoru ili otvorite novi račun.</p>
        <p>Što brže reagirajte na e-poštu kako si ne biste ugrozili sigurnost računa.</p>
        <p>Vaša stara lozinka još uvijek vrijedi.</p>
        <br>
        <p><strong>Ova se stranica sada može zatvoriti.</strong></p>
    <?php } else { ?>
        <h1 class="section__title">Zaboravljena lozinka</h1>
        <form id="register" name="register" method="POST" class="section-form" action="<?php echo $_SERVER['PHP_SELF'];?>
">
            <label for="username">Korisničko ime: </label>
            <input id="username" name="username" type="text" size="15" <?php if ((isset($_smarty_tpl->tpl_vars['username']->value))) {?> value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" <?php }?> />
            <?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {?> <span class="error"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span> <?php }?>
            <div style="position:relative; grid-area: 7 / 3 / span 2 / span 3; display: flex; flex-direction: column">
                <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
                <?php if ((isset($_smarty_tpl->tpl_vars['messageCaptcha']->value))) {?><span class="error"><?php echo $_smarty_tpl->tpl_vars['messageCaptcha']->value;?>
</span><?php }?>
                <input class="form_button" name="submit" type="submit" value="Želim novu zaporku!" />
            </div>
        </form>
    <?php }?>
</section><?php }
}
