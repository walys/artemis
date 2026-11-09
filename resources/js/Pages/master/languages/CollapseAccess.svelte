<script>
    import {_} from "$lib/lang/lang.js";
    import { route } from 'ziggy-js';
    import { crud } from "$lib/crud/crud.js";

    let loading = $state(false);
    let error = $state('');
    let booleanTextArea = $state('');

    async function getTranslationJson() {
        loading = true;
        error = '';

        try {
            const response = await crud.get(
                route('master.settings.languages.index')
            );

            console.log('response', response);

            if (response?.errors || response?.message) {
                error = response.message || _("Não foi possível carregar as traduções.");
                return;
            }

            booleanTextArea = JSON.stringify(
                response.translations,
                null,
                2
            );

        } catch (err) {
            console.error('Erro ao buscar traduções:', err);

            error = _("Ocorreu um erro ao carregar as traduções.");
        } finally {
            loading = false;
        }
    }
</script>
<div class="card p-3">

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">

        <h5 class="mb-0">
            <i class="bi bi-filetype-json me-2"></i>
            {_("Exibir tradução")}
        </h5>

        <button
            type="button"
            class="btn btn-primary"
            onclick={getTranslationJson}
            disabled={loading}
        >
            <i class="bi bi-arrow-clockwise me-1"></i>
            {loading ? _("Carregando...") : _("Exibir")}
        </button>

    </div>

    {#if error}
        <div class="alert alert-danger" role="alert">
            {error}
        </div>
    {/if}

    <textarea
        class="form-control translation-json"
        id="formControlTextareaAccess"
        rows="15"
        bind:value={booleanTextArea}
        readonly
        placeholder={_("Clique em Exibir para carregar as traduções.")}
    ></textarea>

</div>