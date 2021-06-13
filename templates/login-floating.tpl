<section class="section-login">
    <form id="login" name="login" method="POST" class="section-login_popup" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <h1 class="section-login_popup-header">Prijava u sustav</h1>
        <input id="username" name="username" placeholder="Korisničko ime" {if isset($loginUser["username"])} value="{htmlspecialchars($loginUser["username"])}"
            {/if} />
        <span id="error-username" class="error"></span>
        <input id="password" name="password" type="password" placeholder="Password" {if isset($loginUser["password"])}
            value="{htmlspecialchars($loginUser["password"])}" {/if} />
        <span id="error-password" class="error">{if isset($message)}{$message}{/if}</span>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        {if isset($messageCaptcha)}<span class="error-captcha">{$messageCaptcha}</span>{/if}
        <div style="text-align: left; margin-left: 15px;">
            <label for="remember">Zapamti me</label>
            <input id="remember" name="remember" type="checkbox" {if isset($setRemember)}checked value="1"{/if} />
        </div>
        <input id="submitButton" type="submit" name="login" value="Prijava" class="section-login_popup-submit button" />
    </form>
    <form id="testing_form" name="testing" method="POST" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <input name="testing" type="hidden" value="testing" />
        <input type="submit" name="admin" value="Admin" />
        <input type="submit" name="moderator" value="Moderator" />
        <input type="submit" name="registered" value="Korisnik" />
    </form>
</section>