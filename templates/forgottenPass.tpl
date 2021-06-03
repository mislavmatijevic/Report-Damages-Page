<section class="section">
    <h1 class="section__title">Prijava</h1>
    <form id="prijava" name="prijava" method="POST" class="section-login_form" action="{$smarty.server.PHP_SELF}">
        <label for="email" class="section-login_form-input">Email: </label>
        <input id="email" name="email" {if isset($loginUser)} value="{$loginUser["email"]}" {/if}/>
        <span class={if $messageOK} "info" {else} "error" {/if}>{$message}</span>
        <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
        <input id="newPass" type="submit" name="newPass" value="Generiraj novu zaporku" class="section-login_form-submit" />
    </form>
</section>