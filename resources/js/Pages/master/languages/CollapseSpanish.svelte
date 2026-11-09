<script>
    import {_} from "$lib/lang/lang.js";
    import saveTranslations from "$lib/helpers/translations.js";

    let jsonDataSpEs = $state('');
    let lang = 'es-ES';
</script>
<div class="card p-3">
    <h5>
        <img src="/lang/es.png" alt="Espanhol" width="20" height="20" class="me-1" />
        {_("Espanhol")}
    </h5>

    <p class="text-muted mb-0">
        {_("Gerenciamento das traduções em espanhol.")}
    </p>

    <textarea
        class="form-control translation-json"
        id="formControlTextareaSpanish"
        rows="15"
        bind:value={jsonDataSpEs}
        placeholder={_("Cole o JSON das traduções em espanhol aqui.")}
    ></textarea>

    <br />

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">

        <button
            type="button"
            class="btn btn-primary"
            onclick={() => saveTranslations(jsonDataSpEs, lang)}
        >
            <i class="bi bi-save me-1"></i>
            {_("Salvar")}
        </button>

    </div>
</div>