<section class="section">
    <h1 class="section__title">Prijava na javni poziv "{$publicCallInfo["naziv"]}"</h1>

    <div class="section__damage">

        <p>
            <strong>Moderira </strong><a
                href="mailto:{$publicCallInfo["moderator_email"]}">{$publicCallInfo["moderator"]}</a>
        </p>

</section>

<section class="section" style="padding-top: 64px;">
    <h1 class="section__title">Prijavi svoju štetu</h1>
    <form id="register" name="register" method="POST" class="section-form"
        action="{htmlspecialchars($smarty.server.PHP_SELF)}" enctype="multipart/form-data">
        <input name="public-call-identifier" type="hidden" value={$publicCallInfo["id_javni_poziv"]} />

        <label for="name">Naslov prijave: </label>
        <input id="name" name="name" autofocus type="text" {if isset($newDamage)} value="{$newDamage["name"]}" {/if} />

        <span id="error-name" class="error">{if isset($mistakeField["name"])}{$mistakeField["name"]}{/if}</span>

        <label for="description">Detaljniji opis: </label>
        <textarea id="description" name="description" type="text" rows="10"
            cols="30">{if isset($newDamage)}{$newDamage["description"]}{/if}</textarea>

        <span id="error-description"
            class="error">{if isset($mistakeField["description"])}{$mistakeField["description"]}{/if}</span>

        <label for="tags">Oznake: </label>
        <input id="tags" name="tags" type="text" placeholder="poplava pomoć ..." {if isset($newDamage)}
            value="{$newDamage["tags"]}" {/if} />

        <span id="error-tags" class="error">{if isset($mistakeField["tags"])}{$mistakeField["tags"]}{/if}</span>


        <label style="grid-column: 3 / span 5;"><strong>Unesite barem jedan dokazni materijal.</strong></label>
        <label id="error-files" class="error">{if isset($mistakeField["files"])}{$mistakeField["files"]}{/if}</label>
        {foreach from=$materialTypes item=$type key=$key}
            <label for="file">{$type["naziv"]}<br>(max {$type["najveca_velicina_mb"]}MB): </label>
            <input name="file-{$type["id_vrsta_materijala"]}" type="file" multiple="multiple" />
            <span id="error-file-{$type["id_vrsta_materijala"]}"
                class="error">{if isset($mistakeField["file-"+{$type["id_vrsta_materijala"]}])}{$mistakeField["file-"+{$type["id_vrsta_materijala"]}]}{/if}</span>
        {/foreach}

        <div class="section-form__submit-wrapper">
            <div class="g-recaptcha" data-sitekey="6Lf1IQwbAAAAANr0dqL1d4BFHSNrquwodjOfunFW"></div>
            {if isset($message)}<span class={if $messageOK} "info" {else} "error-captcha" {/if}>{$message}</span>{/if}
            <input id="registerButton" class="button" name="submit" type="submit" value="Prijavi štetu" />
        </div>
    </form>
</section>