<section class="section">
    {if $requestSent}
        <h1 class="section__title">{$message}</h1>
        <p>Ako ste zaboravili Vašu e-poštu, molimo da se javite administratoru ili otvorite novi račun.</p>
        <p>Što brže reagirajte na e-poštu kako si ne biste ugrozili sigurnost računa.</p>
        <p>Vaša stara lozinka još uvijek vrijedi.</p>
        <br>
        <p><strong>Ova se stranica sada može zatvoriti.</strong></p>
    {else}
        <h1 class="section__title">Zaboravljena lozinka</h1>
        <form id="register" name="register" method="POST" class="section-form" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
            <label for="username">Korisničko ime: </label>
            <input id="username" name="username" type="text" size="15" {if isset($username)} value="{$username}" {/if} />
            <span id="error-username" class="error">{if isset($message)}{$message}{/if}</span>
            <div style="position:relative; grid-area: 7 / 3 / span 2 / span 3; display: flex; flex-direction: column">
                <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
                {if isset($messageCaptcha)}<span class="error-captcha">{$messageCaptcha}</span>{/if}
                <input class="form_button" name="submit" type="submit" value="Želim novu zaporku!" />
            </div>
        </form>
    {/if}
</section>