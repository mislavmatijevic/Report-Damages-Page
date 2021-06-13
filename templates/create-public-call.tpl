<section class="section">
    <h1 class="section__title">Otvaranje javnog poziva</h1>
</section>

<section class="section" style="padding-top: 64px;">


    <button id="button-help" title="Pomoć pri korištenju">?</button>
    <div id="global-help" style="display:none; margin-top:100px;left:40%;right:100px;">
        <p id="global-help-text"></p>
        <button id="button-help__next">Nastavi</button>
    </div>

    <form id="public-call" method="POST" class="section-form" action="{htmlspecialchars($smarty.server.PHP_SELF)}">

        <select name="category" class="select_pubCall_category">
            {foreach from=$allowedCategories item=$category}
                <option value={$category["id_kategorija_stete"]}
                    {if $category["id_kategorija_stete"] === $newCall["category"]} selected {/if}>
                    Kategorija: {$category["naziv"]}
                </option>
            {/foreach}
        </select>

        <label for="name">Naziv: </label>
        <input id="name" name="name" autofocus type="text" value="{htmlspecialchars($newCall["name"])}" />

        <label for="description">Opis: </label>
        <textarea id="description" name="description" type="text" rows="10"
            cols="10">{$newCall["description"]}</textarea>

        <label>Rok:</label>
        <div class="date-time__wrapper">
            <input name="deadline-date" type="date" name="deadline"
                value={htmlspecialchars($newCall["deadlineDate"])} />
            <input name="deadline-time" type="time" name="deadline"
                value={htmlspecialchars($newCall["deadlineTime"])} />
        </div>

        <input class="button" id="submit_button" name="submit" type="submit" value="Otvori javni poziv" />
    </form>
</section>