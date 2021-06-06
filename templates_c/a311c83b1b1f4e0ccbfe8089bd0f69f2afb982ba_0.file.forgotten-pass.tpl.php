<?php
/* Smarty version 3.1.39, created on 2021-06-06 15:17:42
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/forgotten-pass.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bccaf65153d9_73117387',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a311c83b1b1f4e0ccbfe8089bd0f69f2afb982ba' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/forgotten-pass.tpl',
      1 => 1622938227,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bccaf65153d9_73117387 (Smarty_Internal_Template $_smarty_tpl) {
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
            <span id="error-username" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {
echo $_smarty_tpl->tpl_vars['message']->value;
}?></span>
            <div style="position:relative; grid-area: 7 / 3 / span 2 / span 3; display: flex; flex-direction: column">
                <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
                <?php if ((isset($_smarty_tpl->tpl_vars['messageCaptcha']->value))) {?><span class="error-captcha"><?php echo $_smarty_tpl->tpl_vars['messageCaptcha']->value;?>
</span><?php }?>
                <input class="form_button" name="submit" type="submit" value="Želim novu zaporku!" />
            </div>
        </form>
    <?php }?>
</section><?php }
}
