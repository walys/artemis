
<script>
    import { _ } from "$lib/lang/lang.js";
    import Crud from "$components/crud/Crud.svelte";
    import Col from "$components/crud/Col.svelte";
    import Input from "$components/crud/Input.svelte";
    import Select from "$components/crud/Select.svelte";

    let {
        showModal = $bindable(false),
        icon = $bindable(''),
        id = $bindable(null),
        onClosed = () => {}
    } = $props();

    let errors = $state({});

    let formDataPlan = $state({
        name: "",
        code: "",
        is_active: null
    });

    let status = $state([
        { value: true, label: _("Ativo") },
        { value: false, label: _("Inativo") }
    ]);

    let isEditing = $derived(id !== null);

    // URL da coleção: GET e POST
    let url = route('master.plans.index');

    function resetForm() {
        formDataPlan = {
            name: "",
            code: "",
            is_active: null
        };

        errors = {};
    }

    function closeModal() {
        showModal = false;
        id = null;
        resetForm();

        onClosed();
    }

    function handleSuccess(response) {
        console.log("Operação realizada:", response);
    }
</script>

<div
    class="modal modal-lg {showModal ? 'show d-block' : ''}"
    tabindex="-1"
    style="background: rgba(0,0,0,0.5);"
    role="dialog"
    aria-modal="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class={icon}></i>
                    {isEditing ? _("Editar plano") : _("Novo plano")}
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    aria-label="Close"
                    onclick={closeModal}
                ></button>
            </div>

            <Crud
                classForm="form-floating"
                formData={formDataPlan}
                {url}
                {id}
                responseKey="plan"
                formId="plan-form"
                submitLabel={isEditing ? _("Atualizar") : _("Salvar")}
                onClose={closeModal}
                onSuccess={handleSuccess}
                bind:errors
            >
                <div class="row">

                    <Col
                        classCol="col-md-12"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputName"
                        label={_("Insira o nome do plano")}
                    >
                        <Input
                            type="text"
                            class="form-control"
                            id="floatingInputName"
                            hasError={errors?.name}
                            isValid={formDataPlan?.name}
                            placeholder={_("Insira o nome do plano")}
                            bind:value={formDataPlan.name}
                        />

                        {#if errors.name}
                            <div class="text-danger small mt-1">
                                {errors.name[0]}
                            </div>
                        {/if}
                    </Col>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputCode"
                        label={_("Insira o código")}
                    >
                        <Input
                            type="text"
                            class="form-control"
                            id="floatingInputCode"
                            hasError={errors?.code}
                            isValid={formDataPlan?.code}
                            placeholder={_("Insira o código")}
                            bind:value={formDataPlan.code}
                        />

                        {#if errors.code}
                            <div class="text-danger small mt-1">
                                {errors.code[0]}
                            </div>
                        {/if}
                    </Col>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputStatus"
                        label={_("Status")}
                    >
                        <Select
                            classSelect="form-control"
                            items={status}
                            placeholder={_("Selecione um status")}
                            bind:value={formDataPlan.is_active}
                            isValid={formDataPlan?.is_active?.value}
                            hasError={errors?.is_active}
                            showChevron
                            clearable={false}
                        />

                        {#if errors.is_active}
                            <div class="text-danger small mt-1">
                                {errors.is_active[0]}
                            </div>
                        {/if}
                    </Col>

                </div>
            </Crud>

        </div>
    </div>
</div>
