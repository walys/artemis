<script>
    import {_} from "$lib/lang/lang.js";
    import saveTranslations from "$lib/helpers/translations.js";

    let jsonDataEnUs = $state('');
    let lang = 'en-US';
</script>
<div class="card p-3">
    <h5>
        <img src="/lang/en.png" alt="Inglês" width="20" height="20" class="me-1" />
        {_("Inglês")}
    </h5>

    <p class="text-muted mb-0">
        {_("Gerenciamento das traduções em inglês.")}
    </p>

    <textarea
        class="form-control translation-json"
        id="formControlTextareaEnglish"
        rows="15"
        bind:value={jsonDataEnUs}
        placeholder={_("Cole o JSON das traduções em inglês aqui.")}
    ></textarea>

    <br />

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">

        <button
            type="button"
            class="btn btn-primary"
            onclick={() => saveTranslations(jsonDataEnUs, lang)}
        >
            <i class="bi bi-save me-1"></i>
            {_("Salvar")}
        </button>

    </div>
</div>