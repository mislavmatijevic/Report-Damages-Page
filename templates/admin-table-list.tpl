<section class="section__admin-controls">
    <h2 class="section__admin-controls__title">Blokiranje korisnika</h2>


    <ul>
        {foreach from=$allTableNames item=$tableName}
            <li class="table__row">
                <a
                    href="{htmlspecialchars($smarty.server.PHP_SELF)}?table-name={$tableName["TABLE_NAME"]}">{$tableName["TABLE_NAME"]}</a>
            </li>
        {/foreach}
    </ul>
</section>