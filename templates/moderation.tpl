<section class="section" style="display: block">
    <h2 class="section__title">
        Uređivanje javnih poziva
    </h2>
    <a class="button" href="./create-public-call.php">Novi javni poziv</a>
</section>
<section class="section_damages" style="display: flex;justify-content: center;">
    {foreach from=$javniPozivi item=$damage key=$key}
        <div class="damages__damage">
            <div>
                <h3 class="damages__damage-title">
                    {htmlspecialchars($damage["naziv"])}
                </h3>
                <p class="damages__damage-description">
                    <strong>Kategorija: {htmlspecialchars($damage["kategorija_naziv"])}</strong>
                </p>
            </div>
            <div>
                <div class="damages__damage-info">
                    <p class="damages__damage-dates{if $damage["zatvoren"] == 1}-ended{/if}">
                        <strong>Broj prijava:</strong>

                        <strong>Otvoren:</strong>
                        {date("d.m.y. H:i:s", strtotime(htmlspecialchars($damage["datum_otvaranja"])))}
                        <br>
                        <strong>Rok prijava:</strong>
                        {date("d.m.y. H:i:s", strtotime(htmlspecialchars($damage["datum_zatvaranja"])))}
                    </p>
                </div>
                <a class="button-damage" href="./edit-public-call.php?id={$damage["id_javni_poziv"]}">Uredi</a>
                <a class="button-damage" href="./fund-damages.php?id={$damage["id_javni_poziv"]}">Pregledaj prijave</a>
            </div>
        </div>
    {/foreach}
</section>
<section class="section" style="display: block">
</section>