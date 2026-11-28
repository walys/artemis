<script>
    import { _ } from "$lib/lang/lang.js";
    import { crud } from "$lib/crud/crud.js";
    import sweetalert, { confirmAlert, alertTimer } from "$lib/sweet/sweetalert.js";

    let {
        formData,
        classForm = "",
        formId = "crud-form",
        url,
        id = null,
        responseKey = "data",
        submitLabel = _("Salvar"),
        onClose = () => {},
        onSuccess = () => {},
        errors = $bindable({}),
        buttonDelete = true
    } = $props();

    let loading = $state(false);
    let generalError = $state("");

    const isEditing = $derived(id !== null);
    const recordUrl = $derived(
        isEditing
            ? `${url.replace(/\/$/, "")}/${id}`
            : null
    );

    async function load() {
        if (!recordUrl) return;

        loading = true;
        errors = {};
        generalError = "";

        try {
            const response = await crud.get(recordUrl);

            const record = response?.[responseKey]
                ?? response?.data
                ?? response;

            if (record && typeof record === "object") {
                Object.assign(formData, record);
            }

        } catch (error) {
            handleError(error);
        } finally {
            loading = false;
        }
    }

    function handleError(error) {
        errors = error?.errors ?? {};

        generalError = error?.errors
            ? ""
            : error?.message ?? _("Ocorreu um erro inesperado.");
    }

    async function handleSubmit(event) {
        event.preventDefault();

        if (loading) return;

        loading = true;
        errors = {};
        generalError = "";

        try {
            const response = isEditing
                ? await crud.put(recordUrl, formData)
                : await crud.post(url, formData);

            await onSuccess(response);

            const result = await alertTimer(
                "top-end",
                "success",
                response.message ?? _("Registro processado com sucesso!"),
                1500
            );
            setTimeout(() => {
                onClose();
            }, 2000);

        } catch (error) {
            handleError(error);
        } finally {
            setTimeout(() => {
                loading = false;
            }, 2000);
        }
    }

    async function handleDelete() {
        if (loading || !recordUrl) return;

        const result = await confirmAlert(
            _("Excluir registro?"),
            _("Esta ação não poderá ser desfeita."),
            {
                confirmButtonText: _("Sim, excluir!"),
                cancelButtonText: _("Cancelar")
            }
        );

        if (!result.isConfirmed) return;

        loading = true;
        errors = {};
        generalError = "";

        try {
            const response = await crud.delete(recordUrl);

            await sweetalert(
                _("Excluído!"),
                response?.message ?? _("Registro excluído com sucesso."),
                "success"
            );

            await onSuccess(response);
            onClose();

        } catch (error) {
            handleError(error);

            await sweetalert(
                _("Erro!"),
                error?.message ?? _("Não foi possível excluir o registro."),
                "error"
            );

        } finally {
            loading = false;
            onClose();
        }
    }

    $effect(() => {
        if (id !== null) {
            load();
        }
    });
</script>

<div class="modal-body">

    {#if generalError}
        <div class="alert alert-danger" role="alert">
            {generalError}
        </div>
    {/if}

    {#if loading && isEditing}
        <div class="text-center py-3">
            <span class="spinner-border spinner-border-sm"></span>
            {_('Carregando...')}
        </div>
    {:else}
        <form
            id={formId}
            class={classForm}
            onsubmit={handleSubmit}
        >
            <slot {errors} />
        </form>
    {/if}

</div>

<div class="modal-footer">

    {#if isEditing && buttonDelete}
        <button
            type="button"
            class="btn btn-danger me-auto"
            onclick={handleDelete}
            disabled={loading}
        >
            <i class="bi bi-trash me-1"></i>
            {_('Excluir')}
        </button>
    {/if}

    <button
        type="button"
        class="btn btn-secondary"
        onclick={onClose}
        disabled={loading}
    >
        {_('Cancelar')}
    </button>

    <button
        type="submit"
        class="btn btn-primary"
        form={formId}
        disabled={loading}
    >
        {#if loading}
            <span class="spinner-border spinner-border-sm me-1"></span>
        {/if}

        {submitLabel}
    </button>

</div>
