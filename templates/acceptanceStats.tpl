<table class="table" style="display: table;">
    <caption>Stanje kategorija</caption>
    <thead>
        <tr>
            <th class="table__head">Naziv kategorije</th>
            <th class="table__head">Status</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$acceptanceStats item=$row key=$key}
            <tr class="table__row">
                {if !isset($acceptanceStats[$key-1]["naziv"]) || (isset($acceptanceStats[$key-1]["naziv"]) && $acceptanceStats[$key-1]["naziv"] != $row["naziv"])}
                    <td class="table__row-data"
                        {if isset($acceptanceStats[$key+1]["naziv"]) && $acceptanceStats[$key+1]["naziv"] == $row["naziv"]}
                            {if isset($acceptanceStats[$key+2]["naziv"]) && $acceptanceStats[$key+2]["naziv"] == $row["naziv"]}
                            rowspan="3" {else} rowspan="2" 
                            {/if} 
                        {/if}>{$row["naziv"]}</td>
                {/if}
                <td class="table__row-data">{$row["count"]} {$row["status"]}</td>
            </tr>
        {/foreach}
    </tbody>
</table>