<section class="section">
    <h1 class="section__title">{$publicCallInfo["naziv"]}</h1>

    <div class="section__damage">

        <p>
            <strong>Moderator: </strong>{$publicCallInfo["moderator"]}
        </p>

        <figure class="section__damage-figure">
            <img src="media/{$publicCallInfo["kategorija_ilustracija"]}" />
        </figure>

        <p class="section__damage-description">
            {$publicCallInfo["opis"]}
        </p>

        <p class="section__damage-info">
            Skupljeno: <strong>{$publicCallInfo["skupljeno_sredstava"]} HRK</strong>
        </p>

</section>

<section class="section__donation">
    <p class="section__donation__wanna-help">
        Želite pomoći? 🙂
    </p>

    <form class="donate-form" name="donate-form" method="POST" class="section-form" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <input name="public-call-identifier" type="hidden" value={$publicCallInfo["id_javni_poziv"]} />
        <label id="label-amount" for="amount">Moja donacija (HRK):</label>
        <input id="amount" name="amount" type="text" placeholder="750.50" />
        <div class="donate-form__submit-wrapper">
            <span id="error-amount" class="error">{if isset($message)}{$message}{/if}</span> 
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            {if isset($messageCaptcha)}<span class="error-captcha">{$messageCaptcha}</span>{/if}
            <button id="button-donate" name="submit" type="submit" value="donate">Doniraj! 💰</button>
        </div>
    </form>
    </div>
</section>