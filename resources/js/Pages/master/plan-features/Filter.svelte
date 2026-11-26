<script>
    import { _ } from "$lib/lang/lang.js";
    import Select from "$components/crud/Select.svelte";
    import Input from "$components/crud/Input.svelte";
    import Col from "$components/crud/Col.svelte";

    let {
        filters = $bindable({
            name: '',
            is_active: [{ value: '', label: _("Todos") }],
            sort_order: ''
        })
    } = $props();

    let status = $state([
        { value: true, label: _("Ativo") },
        { value: false, label: _("Inativo") }
    ]);
</script>

<div class="d-flex align-items-end gap-3 flex-wrap">

    <div class="filter-item">
        <Col
            classCol="col-md-12"
            classDiv="form-floating mb-3"
            forCol="floatingInputName"
            label={_("Nome do plano")}
        >
            <Input
                type="text"
                class="form-control"
                placeholder={_("Pesquisar por nome...")}
                bind:value={filters.name}
            />
        </Col>
    </div>

    <div class="filter-item">
        <Col
            classCol="col-md-12"
            classDiv="form-floating mb-3"
            forCol="floatingInputStatus"
            label={_("Status")}
        >
            <Select
                classSelect="form-control"
                items={status}
                placeholder={_("Selecione um status")}
                bind:value={filters.is_active}
                isValid={filters?.is_active?.value}
                showChevron
                clearable={true}
            />
        </Col>
    </div>

</div>
<style>
    .filter-item {
        flex: 1 1 180px;
        min-width: 180px;
        max-width: 100%;
    }

    .filter-item .form-label {
        font-weight: 500;
        margin-bottom: 0.4rem;
    }

    @media (max-width: 576px) {
        .filter-item {
            flex: 1 1 100%;
            min-width: 100%;
        }
    }
</style>