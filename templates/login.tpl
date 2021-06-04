<section class="section">
    <h1 class="section__title">Prijava</h1>
    <form id="prijava" name="prijava" method="POST" class="section-login_form" action="{$smarty.server.PHP_SELF}">
        <label for="username" class="section-login_form-input">Korisničko ime: </label>
        <input id="username" name="username" {if isset($loginUser)} value="{$loginUser["username"]}" {/if}/>
        <label for="password" class="section-login_form-password">Lozinka: </label>
        <input id="password" name="password" type="password" {if isset($loginUser)} value="{$loginUser["password"]}" {/if}/>
        {if isset($message)}<span class="error">{$message}</span>{/if}
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        {if isset($messageCaptcha)}<span class="error">{$messageCaptcha}</span>{/if}
        <input type="submit" name="login" value="Prijava" class="section-login_form-submit" />
    </form>
</section>