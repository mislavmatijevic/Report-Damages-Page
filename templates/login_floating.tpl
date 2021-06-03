<section class="section-login">
    <form id="login" name="login" method="POST" class="section-login_popup" action="{$smarty.server.PHP_SELF}">
        <h1 class="section-login_popup-header">Prijava u sustav</h1>
        <input name="username" placeholder="Korisničko ime" {if isset($loginUser)} value="{$loginUser["username"]}" {/if} />
        <input name="password" type="password" placeholder="Password" {if isset($loginUser)}
            value="{$loginUser["password"]}" {/if} />
        {if isset($message)}<span class={if $messageOK} "info" {else} "error" {/if}>{$message}</span>{/if}
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <input type="submit" name="login" value="Prijava" class="section-login_popup-submit" />
    </form>
    <form id="testing_form" name="testing" method="POST" action="{$smarty.server.PHP_SELF}">
        <input name="testing" type="hidden" value="testing" />
        <input type="submit" name="admin" value="Admin" />
        <input type="submit" name="moderator" value="Moderator" />
        <input type="submit" name="registered" value="Korisnik" />
    </form>
</section>