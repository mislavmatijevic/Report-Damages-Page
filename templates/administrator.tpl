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

</section>