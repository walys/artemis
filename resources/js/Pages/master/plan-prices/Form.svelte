<script>
    import { _ } from "$lib/lang/lang.js";
    import Crud from "$components/crud/Crud.svelte";
    import Col from "$components/crud/Col.svelte";
    import Input from "$components/crud/Input.svelte";
    import SelectPlan from "$components/crud/SelectPlan.svelte";

    let {
        showModal = $bindable(false),
        icon = $bindable(''),
        id = $bindable(null),
        onClosed = () => {}
    } = $props();

    let errors = $state({});

    let formData = $state({
        plan_id: '',
        plan: null,
        currency: 'BRL',
        billing_interval: 'monthly',
        amount: 0,
        is_active: true
    });

    let isEditing = $derived(id !== null);

    let url = route('master.plans.price.index');

    // Mantém o ID do plano sincronizado com o SelectPlan.
    $effect(() => {
        formData.plan_id = formData.plan?.value ?? '';
    });

    function resetForm() {
        formData = {
            plan_id: '',
            plan: null,
            currency: 'BRL',
            billing_interval: 'monthly',
            amount: 0,
            is_active: true
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
                    {isEditing ? _("Editar preço") : _("Novo preço")}
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
                {formData}
                {url}
                {id}
                responseKey="price"
                formId="plan-price-form"
                submitLabel={isEditing ? _("Atualizar") : _("Salvar")}
                onClose={closeModal}
                onSuccess={handleSuccess}
                bind:errors
                buttonDelete={true}
            >
                <div class="row">

                    <!-- Plano -->
                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputPlan"
                        label={_("Plano")}
                    >
                        <SelectPlan
                            classSelect="form-control"
                            hasError={errors?.plan_id}
                            bind:value={formData.plan}
                            placeholder={_("Selecione um plano")}
                            disabled={false}
                        />

                        {#if errors.plan_id}
                            <div class="text-danger small mt-1">
                                {errors.plan_id[0]}
                            </div>
                        {/if}
                    </Col>

                    <!-- Moeda -->
                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputCurrency"
                        label={_("Moeda")}
                    >
                        <Input
                            type="text"
                            class="form-control"
                            placeholder="BRL"
                            bind:value={formData.currency}
                        />

                        {#if errors.currency}
                            <div class="text-danger small mt-1">
                                {errors.currency[0]}
                            </div>
                        {/if}
                    </Col>

                    <!-- Periodicidade -->
                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputInterval"
                        label={_("Periodicidade")}
                    >
                        <select
                            id="floatingInputInterval"
                            class="form-select"
                            bind:value={formData.billing_interval}
                        >
                            <option value="monthly">{_("Mensal")}</option>
                            <option value="yearly">{_("Anual")}</option>
                        </select>

                        {#if errors.billing_interval}
                            <div class="text-danger small mt-1">
                                {errors.billing_interval[0]}
                            </div>
                        {/if}
                    </Col>

                    <!-- Valor -->
                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputAmount"
                        label={_("Valor em centavos")}
                    >
                        <Input
                            type="number"
                            class="form-control"
                            placeholder={_("Informe o valor")}
                            bind:value={formData.amount}
                        />

                        {#if errors.amount}
                            <div class="text-danger small mt-1">
                                {errors.amount[0]}
                            </div>
                        {/if}
                    </Col>

                    <!-- Status -->
                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputStatus"
                        label={_("Status")}
                    >
                        <select
                            id="floatingInputStatus"
                            class="form-select"
                            bind:value={formData.is_active}
                        >
                            <option value={true}>{_("Ativo")}</option>
                            <option value={false}>{_("Inativo")}</option>
                        </select>

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