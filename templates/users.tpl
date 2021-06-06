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
            <tr>
                <td class="table__row">{$user["korisnicko_ime"]}</td>
                <td class="table__row">{$user["prezime"]}</td>
                <td class="table__row">{$user["ime"]}</td>
                <td class="table__row">{$user["lozinka_sha256"]}</td>
            </tr>
        {/foreach}
    </tbody>
</table>