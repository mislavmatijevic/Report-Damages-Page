<div class="paging">
    <p class="paging-info">{$currentPage+1}/{$maxPage+1}</p>
    <form id="paging-controls" name="paging-controls" method="GET" class="paging-controls"
        action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <button id="first" name="page" value="0" type="submit">Prva stranica</button>
        <button id="back" name="page" value="{htmlspecialchars($currentPage-1)}" type="submit">⏮️</button>
        <progress name="page" value="{htmlspecialchars($currentPage)}" max="{$maxPage}">
            {$currentPage}/{$maxPage}
        </progress>
        <button id="next" name="page" value="{htmlspecialchars($currentPage+1)}" type="submit">⏭️</button>
        <button id="last" name="page" value="{htmlspecialchars($maxPage)}" type="submit">Zadnja stranica</button>
    </form>
</div>