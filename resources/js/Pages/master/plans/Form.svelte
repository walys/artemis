<script>
    import { _ } from "$lib/lang/lang.js";

    // Props para comunicação com o pai
    let { formData = $bindable(), onSubmit, onCancel } = $props();

    // Estado local do formulário (se não vier via bind)
    let name = $state(formData?.name ?? '');
    let description = $state(formData?.description ?? '');
    let price = $state(formData?.price ?? '');
    let status = $state(formData?.status ?? 'Ativo');

    function handleSubmit(e) {
        e.preventDefault();
        onSubmit?.({
            name,
            description,
            price,
            status
        });
    }
</script>

<form id="plano-form" onsubmit={handleSubmit}>
    <div class="mb-3">
        <label for="plano-name" class="form-label">{_('Nome')}</label>
        <input
            type="text"
            class="form-control"
            id="plano-name"
            bind:value={name}
            required
            placeholder={_('Ex.: Básico')}
        />
    </div>

    <div class="mb-3">
        <label for="plano-description" class="form-label">{_('Descrição')}</label>
        <textarea
            class="form-control"
            id="plano-description"
            bind:value={description}
            rows="3"
            required
            placeholder={_('Descrição do plano...')}
        ></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="plano-price" class="form-label">{_('Valor')}</label>
            <input
                type="text"
                class="form-control"
                id="plano-price"
                bind:value={price}
                required
                placeholder="R$ 0,00"
            />
        </div>

        <div class="col-md-6 mb-3">
            <label for="plano-status" class="form-label">{_('Status')}</label>
            <select class="form-select" id="plano-status" bind:value={status}>
                <option value="Ativo">{_('Ativo')}</option>
                <option value="Inativo">{_('Inativo')}</option>
            </select>
        </div>
    </div>
</form>