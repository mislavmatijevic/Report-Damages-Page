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
                    <figure class="damages__damage-figure">
                        <img class="damages__damage-image"
                            src="media/{htmlspecialchars($damage["kategorija_ilustracija"])}">
                    </figure>
                    <h3 class="damages__damage-title">
                        {htmlspecialchars($damage["naziv"])}
                    </h3>
                    <p class="damages__damage-description">
                        {htmlspecialchars($damage["opis"])}
                    </p>
                </div>
                <div class="damages__damage-info">
                    <p {if isset($damage["datum_zatvaranja"])}class="damages__damage-dates-ended"
                        {else}class="damages__damage-dates" 
                        {/if}>
                        <strong>Od</strong> {htmlspecialchars($damage["datum_otvaranja"])}
                    </p>
                    <p {if isset($damage["datum_zatvaranja"])}class="damages__damage-dates-ended"
                        {else}class="damages__damage-dates" 
                        {/if}>
                        <strong>Do</strong> {if isset($damage["datum_zatvaranja"])}
                            {htmlspecialchars($damage["datum_zatvaranja"])}
                        {else}
                            <i>Još otvoren</i>
                        {/if}
                    </p>
                </div>
                <a class="button" href="#">Detaljnije</a>
            </div>
        {/foreach}
    </div>
</section>