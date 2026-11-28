<script>
    import { _ } from "$lib/lang/lang.js";
    import Layout from "$components/landing-master/Layout.svelte";
    import GridTable from "$components/table/GridTable.svelte";
    import ActiveCell from "$master/plan-features/ActiveCell.svelte";
    import ButtonEdit from "$components/table/ButtonEdit.svelte";
    import Form from "$master/plan-prices/Form.svelte";
    import Filter from "$master/plan-prices/Filter.svelte";

    let breadcrumb = _("Preços dos Planos");
    let icon = 'bi bi-currency-dollar';

    let showModal = $state(false);
    let planPriceId = $state(null);

    let filters = $state({
        plan_id: null,
        plan_name: '',
        currency: '',
        billing_interval: null,
        is_active: null
    });

    let gridRef = $state();

    let urlGrid = route('master.plans.price.index');

    let columns = [
        {
            id: "number",
            header: { text: _("#"), css: "center" },
            width: 50,
            resize: false,
            sort: false,
            draggable: false
        },
        {
            id: "plan_name",
            header: _("Plano"),
            width: 220
        },
        {
            id: "currency",
            header: _("Moeda"),
            width: 100
        },
        {
            id: "billing_interval",
            header: _("Periodicidade"),
            width: 150
        },
        {
            id: "amount_formatted",
            header: _("Valor"),
            width: 160
        },
        {
            id: "is_active",
            header: _("Status"),
            width: 120,
            cell: ActiveCell
        },
        {
            id: "edit",
            header: { text: _("Editar"), css: "center" },
            width: 120,
            resize: true,
            sort: false,
            cell: ButtonEdit
        }
    ];

    function handleEdit(id) {
        planPriceId = id;
        showModal = true;
    }

    function handleFormClose() {
        gridRef?.reload();
    }

    async function handleReorder({ event, data }) {
        if (event.inProgress !== false) return;
    }
</script>

<Layout breadcrumb={breadcrumb}>
    <section class="dashboard-section">
        <div class="card p-3">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <h5 class="mb-0 d-flex align-items-center gap-2">
                    <div class="shortcut-icon">
                        <i class={icon}></i>
                    </div>

                    {breadcrumb}
                </h5>
            </div>

            <Filter bind:filters />

            <br />

            <GridTable
                bind:this={gridRef}
                {columns}
                urlGrid={urlGrid}
                dataKey="prices"
                {filters}
                initPagination={5}
                reorder={false}
                onReorder={handleReorder}
                onEdit={handleEdit}
            />

        </div>
    </section>
</Layout>

<Form
    bind:showModal={showModal}
    bind:icon={icon}
    bind:id={planPriceId}
    onClosed={handleFormClose}
/>
