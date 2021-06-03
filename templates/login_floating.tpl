<section class="section-login">
    <form id="prijava" name="prijava" method="POST" class="section-login_popup" action="{$smarty.server.PHP_SELF}">
        <h1 class="section-login_popup-header">Prijava u sustav</h1>
        <input name="email" placeholder="Email" {if isset($loginUser)} value="{$loginUser["email"]}" {/if}/>
        <input name="password" type="password" placeholder="Password" {if isset($loginUser)} value="{$loginUser["password"]}" {/if}/>
        <span class={if $messageOK} "info" {else} "error" {/if}>{$message}</span>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <input type="submit" name="login" value="Prijava" class="section-login_popup-submit" />
    </form>
</section>