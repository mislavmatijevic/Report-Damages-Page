<section class="section">
    <h1 class="section__title">Registracija</h1>
    <form id="register" name="register" method="POST" class="section-register__form" action="{$smarty.server.PHP_SELF}">
        <label for="name">Ime: </label>
        <input id="name" name="name" autofocus type="text" {if isset($newUser)} value="{$newUser["name"]}" {/if} />
        {if isset($mistakeField["name"])}
            <span class="error section-register__form-error">{$mistakeField["name"]}</span>
        {/if}
        <label for="surname">Prezime: </label>
        <input id="surname" name="surname" type="text" {if isset($newUser)} value="{$newUser["surname"]}" {/if} />
        {if isset($mistakeField["surname"])}
            <span class="error section-register__form-error">{$mistakeField["surname"]}</span>
        {/if}
        <label for="username">Korisničko name: </label>
        <input id="username" name="username" type="text" {if isset($newUser)} value="{$newUser["username"]}" {/if} />
        {if isset($mistakeField["username"])}
            <span class="error section-register__form-error">{$mistakeField["username"]}</span>
        {/if}
        <label for="password">Lozinka: </label>
        <input id="password" name="password" type="password" size="15" {if isset($newUser)}
            value="{$newUser["password"]}" {/if} />
        {if isset($mistakeField["password"])}
            <span class="error section-register__form-error">{$mistakeField["password"]}</span>
        {/if}
        <label for="confirm_pass">Potvrda lozinke: </label>
        <input id="confirm_pass" name="confirm_pass" type="password" size="15" {if isset($newUser)}
            value="{$newUser["confirm_pass"]}" {/if} />
        {if isset($mistakeField["confirm_pass"])}
            <span class="error section-register__form-error">{$mistakeField["confirm_pass"]}</span>
        {/if}
        <label for="email">Email: </label>
        <input id="email" name="email" type="text" size="15" {if isset($newUser)} value="{$newUser["email"]}" {/if} />
        {if isset($mistakeField["email"])}
            <span class="error section-register__form-error">{$mistakeField["email"]}</span>
        {/if}
        <div style="position:relative; grid-area: 7 / 3 / span 2 / span 3; display: flex; flex-direction: column">
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            {if isset($message)}<span class={if $messageOK} "info" {else} "error" {/if}>{$message}</span>{/if}
            <input class="form_button" name="register" type="submit" value="Registriraj me!" />
        </div>
    </form>
</section>