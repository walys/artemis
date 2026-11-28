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
        planId = $bindable(null),
        onClosed = () => {}
    } = $props();

    let errors = $state({});

    let formData = $state({
        plan_id: null,
        max_exams: 0,
        max_laboratories: 0,
        max_users: 0,
        max_branches: 0,
        reports: null,
        financial_management: null,
        custom_branding: null,
        data_export: null
    });

    // Opções para funcionalidades booleanas
    let booleanOptions = $state([
        { value: true, label: _("Incluído") },
        { value: false, label: _("Não incluído") }
    ]);

    let isEditing = $derived(id !== null);

    // URL da API de funcionalidades
    let url = route('master.plans.feature.index');

    function resetForm() {
        formData = {
            plan_id: planId,
            max_exams: 0,
            max_laboratories: 0,
            max_users: 0,
            max_branches: 0,
            reports: null,
            financial_management: null,
            custom_branding: null,
            data_export: null
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class={icon}></i>
                    {isEditing
                        ? _("Editar funcionalidades")
                        : _("Adicionar funcionalidades")}
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
                formData={formData}
                {url}
                {id}
                responseKey="feature"
                formId="plan-feature-form"
                submitLabel={isEditing ? _("Atualizar") : _("Salvar")}
                onClose={closeModal}
                onSuccess={handleSuccess}
                bind:errors
                buttonDelete={false}
            >
                <div class="row">

                    <!-- Limites do plano -->
                    <div class="col-12 mb-3">
                        <h6 class="fw-semibold">
                            {_('Limites do plano')}
                        </h6>
                        <hr class="mt-2" />
                    </div>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingMaxExams"
                        label={_("Exames por mês")}
                    >
                        <Input
                            type="number"
                            class="form-control"
                            id="floatingMaxExams"
                            hasError={errors?.max_exams}
                            isValid={formData.max_exams !== null}
                            placeholder={_("Exames por mês")}
                            bind:value={formData.max_exams}
                        />

                        {#if errors.max_exams}
                            <div class="text-danger small mt-1">
                                {errors.max_exams[0]}
                            </div>
                        {/if}

                        <div class="form-text">
                            {_('Utilize -1 para ilimitado e 0 para não incluir.')}
                        </div>
                    </Col>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingMaxLaboratories"
                        label={_("Laboratórios")}
                    >
                        <Input
                            type="number"
                            class="form-control"
                            id="floatingMaxLaboratories"
                            hasError={errors?.max_laboratories}
                            isValid={formData.max_laboratories !== null}
                            placeholder={_("Laboratórios")}
                            bind:value={formData.max_laboratories}
                        />

                        {#if errors.max_laboratories}
                            <div class="text-danger small mt-1">
                                {errors.max_laboratories[0]}
                            </div>
                        {/if}
                    </Col>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingMaxUsers"
                        label={_("Usuários")}
                    >
                        <Input
                            type="number"
                            class="form-control"
                            id="floatingMaxUsers"
                            hasError={errors?.max_users}
                            isValid={formData.max_users !== null}
                            placeholder={_("Usuários")}
                            bind:value={formData.max_users}
                        />

                        {#if errors.max_users}
                            <div class="text-danger small mt-1">
                                {errors.max_users[0]}
                            </div>
                        {/if}
                    </Col>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingMaxBranches"
                        label={_("Filiais")}
                    >
                        <Input
                            type="number"
                            class="form-control"
                            id="floatingMaxBranches"
                            hasError={errors?.max_branches}
                            isValid={formData.max_branches !== null}
                            placeholder={_("Filiais")}
                            bind:value={formData.max_branches}
                        />

                        {#if errors.max_branches}
                            <div class="text-danger small mt-1">
                                {errors.max_branches[0]}
                            </div>
                        {/if}
                    </Col>

                    <!-- Funcionalidades adicionais -->
                    <div class="col-12 mt-3 mb-3">
                        <h6 class="fw-semibold">
                            {_('Funcionalidades adicionais')}
                        </h6>
                        <hr class="mt-2" />
                    </div>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-contorol mb-3"
                        forCol="floatingReports"
                        label={_("Relatórios")}
                    >
                        <Select
                            classSelect="form-control"
                            items={booleanOptions}
                            placeholder={_("Relatórios")}
                            bind:value={formData.reports}
                            hasError={errors?.reports}
                            showChevron
                            clearable={false}
                        />

                        {#if errors.reports}
                            <div class="text-danger small mt-1">
                                {errors.reports[0]}
                            </div>
                        {/if}
                    </Col>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-contorol mb-3"
                        forCol="floatingFinancial"
                        label={_("Gestão financeira")}
                    >
                        <Select
                            classSelect="form-control"
                            items={booleanOptions}
                            placeholder={_("Gestão financeira")}
                            bind:value={formData.financial_management}
                            hasError={errors?.financial_management}
                            showChevron
                            clearable={false}
                        />

                        {#if errors.financial_management}
                            <div class="text-danger small mt-1">
                                {errors.financial_management[0]}
                            </div>
                        {/if}
                    </Col>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-contorol mb-3"
                        forCol="floatingBranding"
                        label={_("Identidade visual personalizada")}
                    >
                        <Select
                            classSelect="form-control"
                            items={booleanOptions}
                            placeholder={_("Selecione")}
                            bind:value={formData.custom_branding}
                            hasError={errors?.custom_branding}
                            showChevron
                            clearable={false}
                        />

                        {#if errors.custom_branding}
                            <div class="text-danger small mt-1">
                                {errors.custom_branding[0]}
                            </div>
                        {/if}
                    </Col>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-contorol mb-3"
                        forCol="floatingDataExport"
                        label={_("Exportação de dados")}
                    >
                        <Select
                            classSelect="form-control"
                            items={booleanOptions}
                            placeholder={_("Selecione")}
                            bind:value={formData.data_export}
                            hasError={errors?.data_export}
                            showChevron
                            clearable={false}
                        />

                        {#if errors.data_export}
                            <div class="text-danger small mt-1">
                                {errors.data_export[0]}
                            </div>
                        {/if}
                    </Col>

                </div>
            </Crud>

        </div>
    </div>
</div>
