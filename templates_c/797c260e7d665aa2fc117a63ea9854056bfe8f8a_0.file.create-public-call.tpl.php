<?php
/* Smarty version 3.1.39, created on 2021-06-12 01:55:45
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/create-public-call.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c3f80113bd88_60439907',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '797c260e7d665aa2fc117a63ea9854056bfe8f8a' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/create-public-call.tpl',
      1 => 1623455744,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c3f80113bd88_60439907 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title">Otvaranje javnog poziva</h1>
</section>

<section class="section" style="padding-top: 64px;">
    <form id="public-call" method="POST" class="section-form"
        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
">

        <select name="category" class="select_pubCall_category">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allowedCategories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
                <option value=<?php echo $_smarty_tpl->tpl_vars['category']->value["id_kategorija_stete"];?>

                <?php if ($_smarty_tpl->tpl_vars['category']->value["id_kategorija_stete"] === $_smarty_tpl->tpl_vars['newCall']->value["category"]) {?>
                    selected
                <?php }?>>
                    Kategorija: <?php echo $_smarty_tpl->tpl_vars['category']->value["naziv"];?>

                </option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </select>

        <label for="name">Naziv: </label>
        <input id="name" name="name" autofocus type="text" value="<?php echo $_smarty_tpl->tpl_vars['newCall']->value["name"];?>
" />

        <label for="description">Opis: </label>
        <textarea id="description" name="description" type="text" rows="10"
            cols="10"><?php echo $_smarty_tpl->tpl_vars['newCall']->value["description"];?>
</textarea>

        <label>Rok:</label>
        <div class="date-time__wrapper">
            <input name="deadline-date" type="date" name="deadline" value=<?php echo $_smarty_tpl->tpl_vars['newCall']->value["deadlineDate"];?>
 />
            <input name="deadline-time" type="time" name="deadline" value=<?php echo $_smarty_tpl->tpl_vars['newCall']->value["deadlineTime"];?>
 />
        </div>

        <input class="button" id="submit_button" name="submit" type="submit" value="Otvori javni poziv" />
    </form>
</section><?php }
}
