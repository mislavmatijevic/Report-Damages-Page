<section class="section">
    <h1 class="section__title">Registracija</h1>
    <form id="register" name="register" method="POST" class="section-form" action="{htmlspecialchars($smarty.server.PHP_SELF)}">
        <label for="name">Ime: </label>
        <input id="name" name="name" autofocus type="text" {if isset($newUser)} value="{htmlspecialchars($newUser["name"])}" {/if} />

        <span id="error-name" class="error">{if isset($mistakeField["name"])}{$mistakeField["name"]}{/if}</span>

        <label for="surname">Prezime: </label>
        <input id="surname" name="surname" type="text" {if isset($newUser)} value="{htmlspecialchars($newUser["surname"])}" {/if} />

        <span id="error-surname" class="error">{if isset($mistakeField["surname"])}{$mistakeField["surname"]}{/if}</span>

        <label for="username">Korisničko name: </label>
        <input id="username" name="username" type="text" {if isset($newUser)} value="{htmlspecialchars($newUser["username"])}" {/if} />

        <span id="error-username" class="error">{if isset($mistakeField["username"])}{$mistakeField["username"]}{/if}</span>

        <label for="password">Lozinka: </label>
        <input id="password" name="password" type="password" size="15" {if isset($newUser)}
            value="{htmlspecialchars($newUser["password"])}" {/if} />

        <span id="error-password" class="error">{if isset($mistakeField["password"])}{$mistakeField["password"]}{/if}</span>

        <label for="confirm_pass">Potvrda lozinke: </label>
        <input id="confirm_pass" name="confirm_pass" type="password" size="15" {if isset($newUser)}
            value="{htmlspecialchars($newUser["confirm_pass"])}" {/if} />

        <span id="error-confirm_pass"
            class="error">{if isset($mistakeField["confirm_pass"])}{$mistakeField["confirm_pass"]}{/if}</span>

        <label for="email">Email: </label>
        <input id="email" name="email" type="text" size="15" {if isset($newUser)} value="{htmlspecialchars($newUser["email"])}" {/if} />

        <span id="error-email" class="error">{if isset($mistakeField["email"])}{$mistakeField["email"]}{/if}</span>

        <div class="section-form__submit-wrapper">
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            {if isset($message)}<span class={if $messageOK} "info" {else} "error-captcha" {/if}>{$message}</span>{/if}
            <input id="registerButton" class="form_button button" name="register" type="submit" value="Registriraj me!" />
        </div>
    </form>
</section>