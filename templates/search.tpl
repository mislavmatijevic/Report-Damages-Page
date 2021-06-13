<section class="section-search">
    <form class="section-search__form" method="GET" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <label for="search-string">Pretraži po oznakama:</label>
        <input id="search-string" class="input" type="search" name="search-string" placeholder="poplava;voda" />
        <button class="button" type="submit">Traži</button>
    </form>
    {if isset($searchTagsString)}
        <p class="section-search__search-tags">Rezultati pretrage po oznakama:<br><strong>{$searchTagsString}</strong></p>
    {/if}
    {foreach from=$reportedDamages item=$damage}
        <div class="reported-damage">
            <h2>{$damage["naziv"]}</h2>
            <div class="reported-damage__wrapper">
                <div>
                    <p class="reported-damage__descriptor">Prijavio:</p>
                    <p class="reported-damage__content">{$damage["korisnicko_ime"]}</p>
                </div>
                <div>
                    <p class="reported-damage__descriptor">Oznake:</p>
                    <p class="reported-damage__content">{$damage["oznake"]}</p>
                </div>
            </div>
            <div class="reported-damage__description-wrapper">
                <p class="reported-damage__descriptor">Opis:</p>
                <p class="reported-damage__content">{$damage["opis"]}</p>
            </div>
            <div class="reported-damage__wrapper">
                <div>
                    <p class="reported-damage__descriptor">Datum prijave:</p>
                    <p class="reported-damage__content">{$damage["datum_prijave"]}</p>
                </div>
                {if $damage["id_status_stete"] == "2"}
                    <div>
                        <p class="reported-damage__descriptor">Datum potvrde:</p>
                        <p class="reported-damage__content">{$damage["datum_potvrde"]}</p>
                    </div>
                    <div>
                        <p class="reported-damage__descriptor">Dodijeljeno sredstava:</p>
                        <p class="reported-damage__content">{$damage["subvencija_hrk"]} HRK</p>
                    </div>
                </div>
            {else}
            </div>
            <p class="reported-damage__content-error">Nije prihvaćeno!</p>
        {/if}

        <div class="reported-damage__evidence">
            <h4>Dokazni materijali</h4>
            {foreach from=$damage["dokazni_materijali"] item=$evidence}
                <p>{$evidence["naziv"]}</p>
                <p>(postavljeno {$evidence["datum_postavljanja"]})</p>
                <div class="reported-damage__evidence-multimedia">
                    {if $evidence["id_vrsta_materijala"] == 1} {* fotografija *}
                        <img src="./media/evidence/{$evidence["naziv"]}" />

                    {elseif $evidence["id_vrsta_materijala"] == 2} {* video *}
                        <video width="320" height="240" controls>
                            <source src="./media/evidence/{$evidence["naziv"]}" type="video/mp4">
                        </video>

                    {elseif $evidence["id_vrsta_materijala"] == 3} {* audio *}
                        <audio controls>
                            <source src="./media/evidence/{$evidence["naziv"]}" type="audio/mpeg">
                            Vaš preglednik ne podržava reprodukciju zvuka.
                        </audio>
                    {/if}
                </div>
            {/foreach}
        </div>

        </div>
    {/foreach}
</section>