<section class="section">
    {if isset($requestDone)}
        <h1 class="section__title">{$message}</h1>
        <p><strong>{$additionalInfo}</strong></p>
    {else}
        <h1 class="section__title">Nova lozinka</h1>
        <form id="newPassword" name="newPassword" method="POST" class="section-form"
            action="{$smarty.server.PHP_SELF}">

            <input name="identifier" type="hidden" value={$identifier} />

            <label for="newPassword">Nova lozinka: </label>
            <input id="newPassword" name="newPassword" type="password" size="15" {if isset($newPassword)}
                value="{$newPassword}" {/if} />

            <label for="newPasswordRepeat">Ponovi novu lozinku: </label>
            <input id="newPasswordRepeat" name="newPasswordRepeat" type="password" size="15" {if isset($newPasswordRepeat)}
            value="{$newPasswordRepeat}" {/if} />

            {if isset($message)} <span class="error">{$message}</span> {/if}
            <div style="position:relative; grid-area: 7 / 3 / span 2 / span 3; display: flex; flex-direction: column">
                <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
                {if isset($messageCaptcha)}<span class="error">{$messageCaptcha}</span>{/if}
                <input class="form_button" name="submit" type="submit" value="Postavi novu zaporku" />
            </div>
        </form>
    {/if}
</section>