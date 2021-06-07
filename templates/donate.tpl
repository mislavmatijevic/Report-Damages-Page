<section class="section">
    <h1 class="section__title">{$donationInfo["naziv"]}</h1>

    <div class="section__damage">

        <p>
            <strong>Moderator: </strong>{$donationInfo["moderator"]}
        </p>

        <figure class="section__damage-figure">
            <img src="media/{$donationInfo["kategorija_ilustracija"]}" />
        </figure>

        <p class="section__damage-description">
            {$donationInfo["opis"]}
        </p>

        <p class="section__damage-info">
            Skupljeno sredstava do sada: <strong>{$donationInfo["skupljeno_sredstava"]} HRK</strong>
        </p>

</section>

<section class="section__donation">
    <p class="section__donation__wanna-help">
        Želite pomoći? 🙂
    </p>

    <form id="donate-form" name="donate-form" method="POST" class="section-form" action="{$smarty.server.PHP_SELF}">
        <input name="donation-identifier" type="hidden" value={$donationInfo["id_javni_poziv"]} />
        <label for="amount">Doniram </label>
        <div style="display: flex; align-items: center;">
            <input name="amount" type="number" />
            <span>HRK</span>
        </div>
        <div class="section-form__submit-wrapper">
            {if isset($message)} <span class="error">{$message}</span> {/if}
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            {if isset($messageCaptcha)}<span class="error">{$messageCaptcha}</span>{/if}
            <input class="form_button" name="submit" type="submit" value="Doniraj sredstva" />
        </div>
    </form>
    </div>
</section>