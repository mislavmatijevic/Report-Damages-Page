<section class="section">
    <h1 class="section__title">Prijava</h1>
    <form id="prijava" name="prijava" method="POST" class="section-login_form" action="{$smarty.server.PHP_SELF}">
        <label for="email" class="section-login_form-input">Email: </label>
        <input id="email" name="email" {if isset($loginUser)} value="{$loginUser["email"]}" {/if}/>
        <label for="password" class="section-login_form-password">Lozinka: </label>
        <input id="password" name="password" type="password" {if isset($loginUser)} value="{$loginUser["password"]}" {/if}/>
        <span class={if $messageOK} "info" {else} "error" {/if}>{$message}</span>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <input type="submit" name="login" value="Prijava" class="section-login_form-submit" />
    </form>
</section>