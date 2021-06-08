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

    <form class="donate-form" name="donate-form" method="POST" class="section-form" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <input name="donation-identifier" type="hidden" value={$donationInfo["id_javni_poziv"]} />
        <label id="label-amount" for="amount">Moja donacija (HRK):</label>
        <input id="amount" name="amount" type="number" placeholder="750.50" />
        <div class="donate-form__submit-wrapper">
            <span id="error-amount" class="error">{if isset($message)}{$message}{/if}</span> 
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            {if isset($messageCaptcha)}<span class="error-captcha">{$messageCaptcha}</span>{/if}
            <button id="button-donate" name="submit" type="submit" value="donate">Doniraj! 💰</button>
        </div>
    </form>
    </div>
</section>