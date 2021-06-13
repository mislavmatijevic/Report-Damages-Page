<section class="section">
    <h1 class="section__title">Uređivanje javnog poziva "{$currentCall["naziv"]}"</h1>
</section>

<section class="section" style="padding-top: 64px;">
    <form id="edit-call" method="POST" class="section-form"
        action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <input name="public-call-identifier" type="hidden" value={$currentCall["id_javni_poziv"]} />

        <label for="name">Naziv: </label>
        <input id="name" name="name" autofocus type="text" value="{htmlspecialchars($currentCall["naziv"])}" />

        <label for="description">Opis: </label>
        <textarea id="description" name="description" type="text" rows="10" cols="10">{$currentCall["opis"]}</textarea>

        <label>Otvoren:</label>
        <div class="date-time__wrapper">
            <input disabled type="date" value={$currentCall["open_date"]} />
            <input disabled type="time" value={$currentCall["open_time"]} />
        </div>
        <label>Rok:</label>
        <div class="date-time__wrapper">
            <input name="deadline-date" type="date" name="deadline" value={$currentCall["close_date"]} />
            <input name="deadline-time" type="time" name="deadline" value={$currentCall["close_time"]} />
        </div>
        <label>Skupljeno do sada:</label>
        <input style="width: 100px;" type="number" disabled value={$currentCall["skupljeno_sredstava"]} />
        <label for="closed">Zatvoren?</label>
        <input id="closed" name="closed" type="checkbox" value="1" style="justify-self: left;" />

        <input class="button" id="submit_button" type="submit" value="Ažuriraj" />
    </form>
</section>