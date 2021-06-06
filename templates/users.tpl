<table class="table">
    {if !isset($minimalniStil)}<caption>Popis prijavljenih šteta</caption>{/if}
    <thead>
        <tr>
            <th class="table__head">Korisničko ime</th>
            <th class="table__head">Prezime</th>
            <th class="table__head">Ime</th>
            <th class="table__head">Lozinka (SHA256)</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$userList item=$user}
            <tr class="table__row">
                <td class="table__row-data">{$user["korisnicko_ime"]}</td>
                <td class="table__row-data">{$user["prezime"]}</td>
                <td class="table__row-data">{$user["ime"]}</td>
                <td class="table__row-data">{$user["lozinka_sha256"]}</td>
            </tr>
        {/foreach}
    </tbody>
</table>