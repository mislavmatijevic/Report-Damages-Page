<section class="section-hero">
    <div class="section-hero__overlay">
        <div class="section-hero__content">
            <h1 class="section-hero__heading">
                Prijave šteta
            </h1>
            <p class="section-hero__subheading">
                Materijalna (imovinska) šteta se sastoji u uništenju neke stvari, onemogućavanju ili otežanju
                upotrebe stvari, u nekoj smetnji zbog čijeg uklanjanja je potrebno napraviti troškove koji inače
                ne bi bili napravljeni.
            </p>
            <p class="section-hero__subheading">
                Ova stranica omogućava osobama koje su doživjele ovakvu tragediju da donacijama ostvare dobit i
                poprave financijsku situaciju i životni standard.
            </p>
        </div>
    </div>
</section>

<section class="section section_damages" style="display: block">
    <h2 class="section__title">
        Javni pozivi
    </h2>
    {if isset($messageGlobal)}
        <p>{$messageGlobal}</p>
    {/if}
    <div class="section_damages">
        {foreach from=$javniPozivi item=$damage key=$key}
            <div class="damages__damage">
                <div>
                    <h3 class="damages__damage-title">
                        {htmlspecialchars($damage["naziv"])}
                    </h3>
                    <figure class="damages__damage-figure">
                        <img class="damages__damage-image"
                            src="media/{htmlspecialchars($damage["kategorija_ilustracija"])}">
                    </figure>
                    <p class="damages__damage-description">
                        {htmlspecialchars($damage["opis"])}
                    </p>
                </div>
                <div class="damages__damage-info">
                    {if isset($damage["datum_zatvaranja"])}
                        <p class="damages__damage-dates-ended">
                            <strong>Trajao do:</strong>
                            {date("d.m. H:i:s", strtotime(htmlspecialchars($damage["datum_zatvaranja"])))}
                        </p>
                    {else}
                        <p class="damages__damage-dates"> <strong>Otvoren od:</strong>
                            {date("d.m. H:i:s", strtotime(htmlspecialchars($damage["datum_zatvaranja"])))}
                        </p>
                    {/if}
                </div>
                <a class="button" href="#">Detaljnije</a>
            </div>
        {/foreach}
    </div>
</section>