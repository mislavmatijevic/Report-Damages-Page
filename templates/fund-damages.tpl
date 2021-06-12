<section class="section" style="display: block">
    <h2 class="section__title">
        Subvencioniranje korisnika
    </h2>
</section>
<section class="section" style="display: block;">
    <h2 class="section__title">
        Kontrola
    </h2>
    <form id="edit-call" method="POST" class="section-form" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <input placeholder="šifra" />
        <input placeholder="iznos subvencije" />
    </form>
</section>
<section class="section_damages" style="display: flex;justify-content: center;">

    <table class="table" style="table-layout: fixed;">
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
                            <form action="{htmlspecialchars($smarty.server.PHP_SELF)}">
                            <button class="button">Odbij</button>
                            </form>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </tbody>
    </table>
</section>