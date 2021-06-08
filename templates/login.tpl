<section class="section">
    <h1 class="section__title">Prijava</h1>
    <form id="login" name="login" method="POST" class="section-login_form" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        {if isset($messageCaptcha)}<span class="error-captcha">{$messageCaptcha}</span>{/if}
        <label for="username" class="section-login_form-input">Korisničko ime: </label>
        <input id="username" name="username" {if isset($loginUser["username"])} value="{$loginUser["username"]}" {/if} />
        <span id="error-username" class="error"></span>
        <label for="password" class="section-login_form-password">Lozinka: </label>
        <input id="password" name="password" type="password" {if isset($loginUser["password"])} value="{$loginUser["password"]}"
            {/if} />
        <span id="error-password" class="error">{if isset($message)}{$message}{/if}</span>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <div style="text-align: left; margin-left: 15px;">
            <label for="remember">Zapamti me</label>
            <input id="remember" name="remember" type="checkbox" {if isset($setRemember)}checked value="1" {/if} />
        </div>
        <input id="submitButton" type="submit" name="login" value="Prijava" class="section-login_form-submit" />
    </form>
</section>