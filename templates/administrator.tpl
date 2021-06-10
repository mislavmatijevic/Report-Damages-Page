<section class="section">
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
        <li id="real-time">{$realTime}</li>
        <li id="virtual-time">{$virtualTime}</li>
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
    <div id="global-help">
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
    <p>Držati miš nad url-om ili akcijom za pregled detalja.</p>
    <table id="log-entire" class="table">
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
    <canvas id="statisticsCanvas" width="300px" height="100px" style="border:1px solid #d3d3d3;">
Vaš preglednik ne podržava HTML canvas.</canvas>
</section>