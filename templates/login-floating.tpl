<section class="section-login">
    <form id="login" name="login" method="POST" class="section-login_popup" action="{$smarty.server.PHP_SELF}">
        <h1 class="section-login_popup-header">Prijava u sustav</h1>
        <input name="username" placeholder="Korisničko ime" {if isset($loginUser)} value="{$loginUser["username"]}"
            {/if} />
        <span id="error-username" class="error"></span>
        <input name="password" type="password" placeholder="Password" {if isset($loginUser)}
            value="{$loginUser["password"]}" {/if} />
        <span id="error-password" class="error">{if isset($message)}{$message}{/if}</span>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        {if isset($messageCaptcha)}<span class="error-captcha">{$messageCaptcha}</span>{/if}
        <input id="submitButton" type="submit" name="login" value="Prijava" class="section-login_popup-submit" />
    </form>
    <form id="testing_form" name="testing" method="POST" action="{$smarty.server.PHP_SELF}">
        <input name="testing" type="hidden" value="testing" />
        <input type="submit" name="admin" value="Admin" />
        <input type="submit" name="moderator" value="Moderator" />
        <input type="submit" name="registered" value="Korisnik" />
    </form>
</section>