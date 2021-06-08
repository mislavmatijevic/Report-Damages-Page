<div class="paging">
    <p class="paging-info">{$currentPage+1}/{$maxPage+1}</p>
    <form id="paging-controls" name="paging-controls" method="GET" class="paging-controls"
        action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <button id="first" name="page" value="0" type="submit">Prva stranica</button>
        <button id="back" name="page" value="{$currentPage-1}" type="submit">⏮️</button>
        <progress name="page" value="{$currentPage}" max="{$maxPage}">
            {$currentPage}/{$maxPage}
        </progress>
        <button id="next" name="page" value="{$currentPage+1}" type="submit">⏭️</button>
        <button id="last" name="page" value="{$maxPage}" type="submit">Zadnja stranica</button>
    </form>
</div>