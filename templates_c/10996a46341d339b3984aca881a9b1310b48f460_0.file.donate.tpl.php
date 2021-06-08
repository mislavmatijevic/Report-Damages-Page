<?php
/* Smarty version 3.1.39, created on 2021-06-09 00:58:54
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/donate.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60bff62eba8577_64715525',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10996a46341d339b3984aca881a9b1310b48f460' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/donate.tpl',
      1 => 1623193128,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bff62eba8577_64715525 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title"><?php echo $_smarty_tpl->tpl_vars['donationInfo']->value["naziv"];?>
</h1>

    <div class="section__damage">

        <p>
            <strong>Moderator: </strong><?php echo $_smarty_tpl->tpl_vars['donationInfo']->value["moderator"];?>

        </p>

        <figure class="section__damage-figure">
            <img src="media/<?php echo $_smarty_tpl->tpl_vars['donationInfo']->value["kategorija_ilustracija"];?>
" />
        </figure>

        <p class="section__damage-description">
            <?php echo $_smarty_tpl->tpl_vars['donationInfo']->value["opis"];?>

        </p>

        <p class="section__damage-info">
            Skupljeno sredstava do sada: <strong><?php echo $_smarty_tpl->tpl_vars['donationInfo']->value["skupljeno_sredstava"];?>
 HRK</strong>
        </p>

</section>

<section class="section__donation">
    <p class="section__donation__wanna-help">
        Želite pomoći? 🙂
    </p>

    <form class="donate-form" name="donate-form" method="POST" class="section-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
        <input name="donation-identifier" type="hidden" value=<?php echo $_smarty_tpl->tpl_vars['donationInfo']->value["id_javni_poziv"];?>
 />
        <label id="label-amount" for="amount">Moja donacija (HRK):</label>
        <input id="amount" name="amount" type="text" placeholder="750.50" />
        <div class="donate-form__submit-wrapper">
            <span id="error-amount" class="error"><?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {
echo $_smarty_tpl->tpl_vars['message']->value;
}?></span> 
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            <?php if ((isset($_smarty_tpl->tpl_vars['messageCaptcha']->value))) {?><span class="error-captcha"><?php echo $_smarty_tpl->tpl_vars['messageCaptcha']->value;?>
</span><?php }?>
            <button id="button-donate" name="submit" type="submit" value="donate">Doniraj! 💰</button>
        </div>
    </form>
    </div>
</section><?php }
}
