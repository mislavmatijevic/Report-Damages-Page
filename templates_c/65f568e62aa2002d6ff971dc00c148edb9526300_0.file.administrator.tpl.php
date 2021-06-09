<?php
/* Smarty version 3.1.39, created on 2021-06-09 20:49:29
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/administrator.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c10d39d5d156_08101990',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65f568e62aa2002d6ff971dc00c148edb9526300' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/administrator.tpl',
      1 => 1623264569,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c10d39d5d156_08101990 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <h1 class="section__title">Administriranje stranice</h1>
    <nav id="admin_control_panel">
        <ul>
            <li><a href="#virtualno_vrijeme">Virtualno vrijeme</a></li>
            <li><a href="#blokiranje">Blokiranje korisnika</a></li>
            <li><a href="#konfiguracija">Konfiguracija sustava</a></li>
            <li><a href="#pregled_dnevnika">Pregled dnevnika</a></li>
            <li><a href="#kreiranje_moderatora">Kreiranje moderatora</a></li>
            <li><a href="#sigurnosna_kopija">Sigurnosna kopija</a></li>
            <li><a href="#statistika_sustava">Statistika sustava</a></li>
        </ul>
    </nav>

</section>
<section id="virtualno_vrijeme" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Virtualno vrijeme</h2>
    <ol>
        <li id="real-time"><?php echo $_smarty_tpl->tpl_vars['realTime']->value;?>
</li>
        <li id="virtual-time"><?php echo $_smarty_tpl->tpl_vars['virtualTime']->value;?>
</li>
    </ol>
    <a class="button" href="http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html" target="_blank">Postavi virtualno
        vrijeme</a>
    <button id="virtual-button" class="button">Preuzmi virtualno vrijeme</button>
</section>

<section id="blokiranje" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Blokiranje korisnika</h2>
    <table class="table">
        <thead>
            <tr>
                <th class="table__head">Šifra</th>
                <th class="table__head">Email</th>
                <th class="table__head">Korisničko ime</th>
                <th class="table__head">Akcija</th>
            </tr>
        </thead>
        <tbody id="body-blocked">
        </tbody>
    </table>


    <input id="block-input" type="text" class="input-text" placeholder="Korisničko ime za blokiranje" />
    <button id="block-button" class="button">Blokiraj korisnika</button>

</section>
<section id="konfiguracija" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Konfiguracija sustava</h2>
    <div class="input_wrapper">
        <label for="">Najviše neuspjelih logiranja:</label>
        <input id="maxFailedLogins" class="input-text" type="number" />
    </div>

    <div class="input_wrapper">
        <label for="">Rok za aktivaciju računa:</label>
        <input id="maxHoursToAccept" class="input-text" type="number" placeholder="u satima" />
    </div>

    <div class="input_wrapper">
        <label for="">Najviše stavki po stranici:</label>
        <input id="maxItemsPerPage" class="input-text" type="number" />
    </div>

    <div class="input_wrapper">
        <label for="">Trajanje kolačića:</label>
        <input id="cookieDurationDays" class="input-text" type="number" placeholder="u danima" />
    </div>

    <div class="input_wrapper">
        <label for="">Najduže trajanje sesije:</label>
        <input id="maxSessionLengthMinutes" class="input-text" type="number" placeholder="u minutama" />
    </div>

    <button class="button">Primjeni</button>
</section>

<section id="pregled_dnevnika" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Pregled dnevnika</h2>

</section>

<section id="kreiranje_moderatora" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Kreiranje moderatora</h2>

</section>

<section id="sigurnosna_kopija" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Sigurnosna kopija</h2>

</section>

<section id="statistika_sustava" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Statistika sustava</h2>

</section><?php }
}
