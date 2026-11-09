
<script>
    import {_} from "$lib/lang/lang.js";
    import { route } from 'ziggy-js';
    import { crud } from "$lib/crud/crud.js";
    import sweetalert from "$lib/sweet/sweetalert.js";

    let jsonData = $state('');

    async function saveTranslations() {
        let translations;

        // Valida o JSON antes de enviar
        try {
            translations = JSON.parse(jsonData);
        } catch (error) {
            console.error('Erro ao analisar o JSON:', error);

            sweetalert(
                _("Erro"),
                _("O JSON informado é inválido."),
                "error"
            );

            return;
        }

        // Envia as traduções para a API
        try {
            const response = await crud.post(
                route('master.settings.languages.post'),
                {
                    translations: translations
                }
            );

            if (response.success) {
                sweetalert(
                    _("Sucesso"),
                    _("Traduções atualizadas com sucesso!"),
                    "success"
                );
                jsonData = '';
            } else {
                sweetalert(
                    _("Erro"),
                    response.message || _("Ocorreu um erro ao atualizar as traduções."),
                    "error"
                );
            }

        } catch (error) {
            console.error('Erro ao salvar traduções:', error);

            sweetalert(
                _("Erro"),
                _("Ocorreu um erro ao atualizar as traduções."),
                "error"
            );
        } finally {
            // Qualquer ação final, se necessário   

        }
    }
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
        bind:value={jsonData}
        placeholder={_("Cole o JSON das traduções em português aqui.")}
    ></textarea>

    <br />

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">

        <button
            type="button"
            class="btn btn-primary"
            onclick={saveTranslations}
        >
            <i class="bi bi-save me-1"></i>
            {_("Salvar")}
        </button>

    </div>

</div>
