<?php
/* Smarty version 3.1.39, created on 2021-06-14 18:36:01
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/administrator.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c78571c08a31_37582878',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65f568e62aa2002d6ff971dc00c148edb9526300' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/administrator.tpl',
      1 => 1623684155,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c78571c08a31_37582878 (Smarty_Internal_Template $_smarty_tpl) {
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

    <label for="block-input">Korisničko ime za blokirati:</label>
    <input id="block-input" name="block-input" type="text" class="input-text" />
    <button id="block-button" class="button">Blokiraj korisnika</button>

</section>
<section id="konfiguracija" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Konfiguracija sustava</h2>

    <button id="button-help" title="Pomoć pri korištenju">?</button>
    <div id="global-help" style="display: none;">
        <p id="global-help-text">Nakon ovoliko puta korisniku se račun blokira i na ovoj stranici treba ga se
            odblokirati.</p>
        <button id="button-help__next">Nastavi</button>
    </div>

    <div class="input-wrapper">
        <label for="">Najviše neuspjelih logiranja:</label>
        <input id="maxFailedLogins" class="input-number" type="number" />
    </div>

    <div class="input-wrapper">
        <label for="">Rok za aktivaciju računa:</label>
        <input id="maxHoursToAccept" class="input-number" type="number" placeholder="u satima" />
    </div>

    <div class="input-wrapper">
        <label for="">Najviše stavki po stranici:</label>
        <input id="maxItemsPerPage" class="input-number" type="number" />
    </div>

    <div class="input-wrapper">
        <label for="">Trajanje kolačića:</label>
        <input id="cookieDurationDays" class="input-number" type="number" placeholder="u danima" />
    </div>

    <div class="input-wrapper">
        <label for="">Najduže trajanje sesije:</label>
        <input id="maxSessionLengthMinutes" class="input-number" type="number" placeholder="u minutama" />
    </div>

    <div class="input-wrapper">
        <label for="">ReCaptcha tajni ključ:</label>
        <input id="captchaSecretKey" class="input-text" type="password" />
    </div>

    <button id="config-button" class="button">Primjeni</button>
</section>

<section id="pregled_dnevnika" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Pregled dnevnika</h2>
    <table id="log-freq" class="table" style="display: none">
        <caption>Frekvencija akcija i korisnika</caption>
        <thead>
            <tr>
                <th class="table__head">Korisničko ime</th>
                <th class="table__head">Naziv radnje</th>
                <th class="table__head">Količina radnje</th>
            </tr>
        </thead>
        <tbody id="body-log-freq">
        </tbody>
    </table>
    <table id="log-entire" class="table">
        <input id="log-entire__input-date" type="date" class="input-text" placeholder="Filtriraj po datumu..." />
        <button id="log-entire__button-filter-date" class="button">Filtriraj po datumu</button>
        <p>Držati miš nad nazivom datoteke ili akcijom za pregled detalja.</p>
        <caption>Cijeli dnevnik</caption>
        <thead>
            <tr>
                <th class="table__head">Br.</th>
                <th class="table__head">Datum</th>
                <th class="table__head">Datoteka</th>
                <th class="table__head">Korisničko ime</th>
                <th class="table__head">Akcija</th>
            </tr>
        </thead>
        <tbody id="body-log">
        </tbody>
    </table>
    <div class="paging-log">
        <p class="paging-info"></p>
        <div class="paging-log-controls">
            <button id="first-log">Prva stranica</button>
            <button id="back-log">⏮️</button>
            <progress id="progress-log">
                currentPage/maxPage
            </progress>
            <button id="next-log">⏭️</button>
            <button id="last-log">Zadnja stranica</button>
        </div>
    </div>
    <input id="input-log" type="text" class="input-text" placeholder="Filtriraj po korisniku..." />
    <button id="button-filter-user" class="button">Filtriraj po korisniku</button>
    <button id="button-filter-freq" class="button">Pregledaj frekvenciju rada</button>
    <button id="button-filter-reset" class="button">Resetiraj filter</button>

</section>

<section id="kreiranje_moderatora" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Kreiranje moderatora</h2>

    <table class="table">
        <caption>Moderatori</caption>
        <thead>
            <tr>
                <th class="table__head">Šifra</th>
                <th class="table__head">Email</th>
                <th class="table__head">Korisničko ime</th>
                <th class="table__head">Kategorije</th>
                <th class="table__head">Akcija</th>
            </tr>
        </thead>
        <tbody id="body-moderators">
        </tbody>
    </table>

    <label for="moderator-input">Korisničko ime za promoviranje u moderatora:</label>
    <input id="moderator-input" name="moderator-input" type="text" class="input-text" />
    <button id="moderator-button" class="button">Dodaj moderatora</button>
</section>

<section id="sigurnosna_kopija" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Sigurnosna kopija</h2>
    <button id="copy_create" class="button">Izradi sigurnosnu kopiju</button>
    <button id="copy_retrieve" class="button">Vrati sigurnosnu kopiju</button>
</section>

<section id="statistika_sustava" class="section__admin-controls">
    <h2 class="section__admin-controls__title">Statistika sustava</h2>
    <div style="height: 25px;"></div>
    <p id="statistics-text__1" class="statistics-text"></p>
    <canvas id="statistics-canvas__1" class="statistics-canvas" width="300px" height="75px"
        style="border:1px solid #d3d3d3;">
        Vaš preglednik ne podržava HTML canvas.</canvas>
    <div style="height: 25px;"></div>
    <p id="statistics-text__2" class="statistics-text"></p>
    <canvas id="statistics-canvas__2" class="statistics-canvas" width="300px" height="75px"
        style="border:1px solid #d3d3d3;">
        Vaš preglednik ne podržava HTML canvas.</canvas>
    <div style="height: 25px;"></div>
    <p id="statistics-text__3" class="statistics-text"></p>
    <canvas id="statistics-canvas__3" class="statistics-canvas" width="300px" height="75px"
        style="border:1px solid #d3d3d3;">
        Vaš preglednik ne podržava HTML canvas.</canvas>
    <div style="height: 25px;"></div>
    <p id="statistics-text__4" class="statistics-text"></p>
    <canvas id="statistics-canvas__4" class="statistics-canvas" width="300px" height="75px"
        style="border:1px solid #d3d3d3;">
        Vaš preglednik ne podržava HTML canvas.</canvas>
    <div style="height: 25px;"></div>
    <p id="statistics-text__5" class="statistics-text"></p>
    <canvas id="statistics-canvas__5" class="statistics-canvas" width="300px" height="75px"
        style="border:1px solid #d3d3d3;">
        Vaš preglednik ne podržava HTML canvas.</canvas>
    <div style="height: 25px;"></div>
    <p id="statistics-text__6" class="statistics-text"></p>
    <canvas id="statistics-canvas__6" class="statistics-canvas" width="300px" height="75px"
        style="border:1px solid #d3d3d3;">
        Vaš preglednik ne podržava HTML canvas.</canvas>
    <button id="button-stats__print" class="button">Isprintaj</button>
    <button id="button-stats__pdf" class="button">PDF</button>
</section><?php }
}
