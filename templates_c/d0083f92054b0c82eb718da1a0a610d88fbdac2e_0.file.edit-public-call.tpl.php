<?php
/* Smarty version 3.1.39, created on 2021-06-13 22:59:32
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/edit-public-call.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c671b45903d0_28669346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0083f92054b0c82eb718da1a0a610d88fbdac2e' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/edit-public-call.tpl',
      1 => 1623602156,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c671b45903d0_28669346 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title">Uređivanje javnog poziva "<?php echo $_smarty_tpl->tpl_vars['currentCall']->value["naziv"];?>
"</h1>
</section>

<section class="section" style="padding-top: 64px;">
    <form id="edit-call" method="POST" class="section-form"
        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">
        <input name="public-call-identifier" type="hidden" value=<?php echo $_smarty_tpl->tpl_vars['currentCall']->value["id_javni_poziv"];?>
 />

        <label for="name">Naziv: </label>
        <input id="name" name="name" autofocus type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentCall']->value["naziv"]);?>
" />

        <label for="description">Opis: </label>
        <textarea id="description" name="description" type="text" rows="10" cols="10"><?php echo $_smarty_tpl->tpl_vars['currentCall']->value["opis"];?>
</textarea>

        <label>Otvoren:</label>
        <div class="date-time__wrapper">
            <input disabled type="date" value=<?php echo $_smarty_tpl->tpl_vars['currentCall']->value["open_date"];?>
 />
            <input disabled type="time" value=<?php echo $_smarty_tpl->tpl_vars['currentCall']->value["open_time"];?>
 />
        </div>
        <label>Rok:</label>
        <div class="date-time__wrapper">
            <input name="deadline-date" type="date" name="deadline" value=<?php echo $_smarty_tpl->tpl_vars['currentCall']->value["close_date"];?>
 />
            <input name="deadline-time" type="time" name="deadline" value=<?php echo $_smarty_tpl->tpl_vars['currentCall']->value["close_time"];?>
 />
        </div>
        <label>Skupljeno do sada:</label>
        <input style="width: 100px;" type="number" disabled value=<?php echo $_smarty_tpl->tpl_vars['currentCall']->value["skupljeno_sredstava"];?>
 />
        <label for="closed">Zatvoren?</label>
        <input id="closed" name="closed" type="checkbox" value="1" style="justify-self: left;" />

        <input class="button" id="submit_button" type="submit" value="Ažuriraj" />
    </form>
</section><?php }
}
