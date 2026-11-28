<script>
    import { _ } from "$lib/lang/lang.js";
    import Crud from "$components/crud/Crud.svelte";
    import Col from "$components/crud/Col.svelte";
    import Input from "$components/crud/Input.svelte";
    import Select from "$components/crud/Select.svelte";
    import SelectPlan from "$components/crud/SelectPlan.svelte";
    import SelectLanguage from "$components/crud/SelectLanguage.svelte";
    import { crud } from "$lib/crud/crud.js";
    import { onMount } from "svelte";

    let {
        showModal = $bindable(false),
        icon = $bindable(''),
        id = $bindable(null),
        onClosed = () => {}
    } = $props();
    let errors = $state({});
    let formData = $state({
        plan_id : "",
        language_id: "",
        description: "",
    });
    let languageLists = $state([]);
    let isEditing = $derived(id !== null);
    let url = route('master.plans.description.index');

    function resetForm() {
        formData = {
            plan_id : "",
            language_id: "",
            description: "",
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

    async function getLanguages() {
        try {
            const response = await crud.get(
                route('master.settings.languages-list')
            );
            languageLists = response;
        } catch (err) {
            console.error('Erro ao buscar:', err);
            error = _("Ocorreu um erro ao carregar as language.");
        } 
    }


    onMount(async () => {
        await getLanguages();
    });
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
                    {isEditing ? _("Editar descrição") : _("Novo descrição")}
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
                responseKey="description"
                formId="plan-form"
                submitLabel={isEditing ? _("Atualizar") : _("Salvar")}
                onClose={closeModal}
                onSuccess={handleSuccess}
                bind:errors
                buttonDelete={false}
            >
                <div class="row">

                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputplan"
                        label={_("Insira o nome do plano")}
                    >
                        <SelectPlan
                            classSelect="form-control last mb-4"
                            hasError={errors?.plan_id}
                            bind:value={formData.plan}
                            placeholder={_("Selecione um Plano")}
                            disabled={true}
                        />

                        {#if errors.plan}
                            <div class="text-danger small mt-1">
                                {errors.plan[0]}
                            </div>
                        {/if}
                    </Col>

                    <Col
                        classCol="col-md-6"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputLanguage"
                        label={_("Insira um idioma")}
                    >
                        <SelectLanguage
                            classSelect="form-control last mb-4"
                            hasError={errors?.language_id}
                            bind:value={formData.language}
                            placeholder={_("Selecione um Plano")}
                            disabled={true}
                        />

                        {#if errors.language}
                            <div class="text-danger small mt-1">
                                {errors.language[0]}
                            </div>
                        {/if}
                    </Col>


                    <Col
                        classCol="col-md-12"
                        classDiv="form-floating mb-3"
                        forCol="floatingInputDecription"
                        label={_("Descrição")}
                    >
                        <textarea
                            class="form-control"
                            style="height: 100px;"
                            bind:value={formData.description}
                        ></textarea>

                        {#if errors.description}
                            <div class="text-danger small mt-1">
                                {errors.description[0]}
                            </div>
                        {/if}
                    </Col>

                </div>
            </Crud>

        </div>
    </div>
</div>