<section class="section-login">
    <form id="prijava" name="prijava" method="POST" class="section-login_popup">
        <h1 class="section-login_popup-header">Prijava u sustav</h1>
        <input name="email" placeholder="Email" />
        <input name="password" placeholder="Password" />
        <span class={if $messageOK} "info" {else} "error" {/if}>{$message}</span>

        <input type="submit" name="login" value="Prijava" class="section-login_popup-submit" />
    </form>
</section>