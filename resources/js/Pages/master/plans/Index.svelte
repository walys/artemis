<script>
    import { _ } from "$lib/lang/lang.js";
    import Layout from "$components/landing-master/Layout.svelte";
    import GridTable from "$components/table/GridTable.svelte";
    import ActiveCell from "$components/table/ActiveCell.svelte";
    import ButtonEdit from "$components/table/ButtonEdit.svelte";
    import { crud } from "$lib/crud/crud.js";
    import sweetalert from "$lib/sweet/sweetalert.js";
    import Form from "$master/plans/Form.svelte";
    import Filter from "$master/plans/Filter.svelte";

    let breadcrumb = _("Planos");
    let icon = 'bi bi-briefcase';

    let showModal = $state(false);
    let planId = $state(null);

    let columns = $state([
        {
            id: "number",
            header: { text: _("#"), css: "center" },
            width: 50,
            resize: true,
            sort: false,
            draggable: true
        },
        {
            id: "name",
            header: { text: _("Nome"), css: "center" },
            width: 350,
            resize: true,
            sort: true
        },
        {
            id: "is_active",
            header: { text: _("Status"), css: "center" },
            width: 200,
            resize: true,
            sort: true,
            cell: ActiveCell
        },
        {
            id: "sort_order",
            header: { text: _("Ordem"), css: "center" },
            width: 200,
            resize: true,
            sort: true
        },
        {
            id: "edit",
            header: { text: _("Editar"), css: "center" },
            width: 200,
            resize: true,
            sort: false,
            cell: ButtonEdit,
        }
    ]);

    let gridRef = $state(); 
    let urlGrid = route('master.plans.index');
    
    let filters = $state({
        name: '',
        is_active: '',
        sort_order: ''
    });    

    function openModal() {
        planId = null;
        showModal = true;
    }

    function handleEdit(id) {
        console.log("ID recebido:", id);

        planId = id;
        showModal = true;
    }

    async function handleReorder({ event, data }) {
        if (event.inProgress !== false) return;
        await handleUpdateOrder(data);
    }

    async function handleUpdateOrder(data) {
        const plans = data.map((plan, index) => ({
            id: plan.id,
            sort_order: index + 1
        }));

        try {
            const response = await crud.post(
                route('master.plans.update-order'),
                { plans }
            );
            sweetalert(
                _("Sucesso"),
                response.message,
                "success"
            );
            await gridRef?.reload();
        } catch (error) {
            console.error('Erro ao atualizar ordem dos planos:', error);
        }
    }

    function handleFormClose() {
        gridRef?.reload();
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
                    {_('Gerenciamento de planos')}
                </h5>

                <button type="button" class="btn btn-primary" onclick={openModal}>
                    <i class="bi bi-plus-lg me-1"></i>
                    {_('Novo plano')}
                </button>
            </div>

            <Filter bind:filters />
            <br />
            <GridTable
                bind:this={gridRef}  
                columns={columns}
                urlGrid={urlGrid}
                dataKey="plans"
                {filters}
                initPagination={5}
                reorder={true}
                onReorder={handleReorder}
                onEdit={handleEdit}
                tree={false}
            />

        </div>
    </section>
</Layout>

<Form
    bind:showModal={showModal}
    bind:icon={icon}
    bind:id={planId}
    onClosed={handleFormClose}
/>
