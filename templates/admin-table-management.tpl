<section class="section__admin-controls__table-controls">
    {if isset($tableData)}
        <table>
            <caption>{$tableName}</caption>
            <thead>
                {foreach from=$tableHeader item=$tableHeaderInfo key=$index}
                    {if $index == 0}
                        <th>id</th>
                    {else}
                        <th>{$tableHeaderInfo["Field"]} ({$tableHeaderInfo["Type"]})</th>
                    {/if}
                {/foreach}
            </thead>
            <tbody>
                {foreach from=$tableData item=$tableDataInfo}
                    <form method="POST" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
                        <tr>
                            {foreach from=$tableHeader item=$tableHeaderInfo key=$index}
                                <td>
                                    <input {if $index == 0} disabled {/if} name="{$tableHeaderInfo["Field"]}"
                                        value="{$tableDataInfo[$tableHeaderInfo["Field"]]}" />
                                    {if $index == 0}
                                        <button type="submit" style="background-color: green;" name="change"
                                            value="{$tableDataInfo[$tableHeaderInfo["Field"]]}">Promijeni</button>
                                        <button type="submit" style="background-color: red;" name="delete"
                                            value="{$tableHeaderInfo["Field"]}-{$tableDataInfo[$tableHeaderInfo["Field"]]}">Ukloni</button>
                                    {/if}
                                </td>
                            {/foreach}
                        </tr>
                    </form>
                {/foreach}
                <tr>
                    <form method="POST" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
                        {foreach from=$tableHeader item=$tableHeaderInfo key=$index}
                            <td>
                                {if $index != 0}<input style="color: darkgreen" placeholder="NULL" name="{$tableHeaderInfo["Field"]}"
                                        value="Unesite {$tableHeaderInfo["Field"]}" />
                                {else}
                                    <input type="submit" style="background-color: green;" name="new" value="Dodaj" />
                                {/if}
                            </td>
                        {/foreach}
                    </form>
                </tr>
            </tbody>
        </table>
    {/if}

</section>