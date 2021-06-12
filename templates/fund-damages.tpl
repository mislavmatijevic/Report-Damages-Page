<section class="section" style="display: block">
    <h2 class="section__title">
        {$callName}
    </h2>
    <h3 class="section__title">
        Preostalo sredstava: {$remainingSubvention} HRK
    </h3>
</section>
<section class="section" style="display: block; padding-top: 16px">
    <h2 class="section__title">
        Kontrola
    </h2>
    <form method="POST" id="fund-damages__form" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <div class="input-wrapper">
            <input hidden name="current-call" value={$currentCallId} />
            <input name="damageId" type="number" placeholder="šifra" />
            <input name="amount" placeholder="iznos subvencije" />
        </div>
        <button class="button" name="fund" type="submit" value="1">Subvencioniraj i zatvori prijavu</button>
    </form>
</section>
<section class="section_damages" style="display: flex;justify-content: center;">

    <table class="table">
        <caption>Popis prijavljenih šteta na ovom javnom pozivu</caption>
        <thead>
            <tr>
                <th class="table__head">Šifra</th>
                <th class="table__head">Korisničko ime</th>
                <th class="table__head">Naziv</th>
                <th class="table__head">Opis</th>
                <th class="table__head">Oznake</th>
                <th class="table__head">Datum prijave</th>
                <th class="table__head">Akcija</th>
            </tr>
        </thead>
        <tbody>
            {if isset($allDamages)}
                {foreach from=$allDamages item=$damage}
                    <tr class="table__row">
                        <td class="table__row-data">{$damage["id_steta"]}</td>
                        <td class="table__row-data">{$damage["korisnicko_ime"]}</td>
                        <td class="table__row-data table__row-data__text">{$damage["naziv"]}</td>
                        <td class="table__row-data table__row-data__text">{$damage["opis"]}</td>
                        <td class="table__row-data">{$damage["oznake"]}</td>
                        <td class="table__row-data">{$damage["datum_prijave"]}</td>
                        <td class="table__row-data">
                            <form method="POST" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
                                <input hidden name="current-call" value={$currentCallId} />
                                <button name="remove" class="button" type="submit" value={$damage["id_steta"]}>Odbij</button>
                            </form>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </tbody>
    </table>
</section>