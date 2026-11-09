
<script>
    import {_} from "$lib/lang/lang.js";
    import { route } from 'ziggy-js';
    import { crud } from "$lib/crud/crud.js";
    import sweetalert from "$lib/sweet/sweetalert.js";
    import saveTranslations from "$lib/helpers/translations.js";

    let jsonDataPtBr = $state('');
    let lang = 'pt-BR';

</script>

<div class="card p-3">

    <h5>
        <img
            src="/lang/pt-BR.png"
            alt="Português"
            width="20"
            height="20"
            class="me-1"
        />

        {_("Português")}
    </h5>

    <p class="text-muted mb-0">
        {_("Gerenciamento das traduções em português.")}
    </p>

    <textarea
        class="form-control translation-json"
        id="formControlTextareaPortuguese"
        rows="15"
        bind:value={jsonDataPtBr}
        placeholder={_("Cole o JSON das traduções em português aqui.")}
    ></textarea>

    <br />

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">

        <button
            type="button"
            class="btn btn-primary"
            onclick={() => saveTranslations(jsonDataPtBr, lang)}
        >
            <i class="bi bi-save me-1"></i>
            {_("Salvar")}
        </button>

    </div>

</div>
