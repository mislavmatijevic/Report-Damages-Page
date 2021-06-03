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
        <form id="register" name="register" method="POST" class="section-register__form" action="{$smarty.server.PHP_SELF}">
            <label for="username">Korisničko ime: </label>
            <input id="username" name="username" type="text" size="15" {if isset($username)} value="{$username}" {/if} />
            {if isset($message)}
                <span class="error section-register__form-error">{$message}</span>
            {/if}
            <div style="position:relative; grid-area: 7 / 3 / span 2 / span 3; display: flex; flex-direction: column">
                <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
                <input class="form_button" name="submit" type="submit" value="Generiraj novu zaporku!" />
            </div>
        </form>
    {/if}
</section>