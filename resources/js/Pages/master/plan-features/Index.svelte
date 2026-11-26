<script>
    import { _ } from "$lib/lang/lang.js";
    import Layout from "$components/landing-master/Layout.svelte";
    import GridTable from "$components/table/GridTable.svelte";
    import ActiveCell from "$master/plan-features/ActiveCell.svelte";
    import ButtonEdit from "$components/table/ButtonEdit.svelte";
    import { crud } from "$lib/crud/crud.js";
    import sweetalert from "$lib/sweet/sweetalert.js";
    import Form from "$master/plan-features/Form.svelte";
    import Filter from "$master/plan-features/Filter.svelte";

    let breadcrumb = _("Planos e funcionalidades");
    let icon = 'bi bi-briefcase';

    let showModal = $state(false);
    let planFeatureId = $state(null);

    let filters = $state({
        name: ''
    });
    let gridRef = $state(); 
    let urlGrid = route('master.plans.feature.index');
    let columns = [
        {
            id: "max_exams",
            header: _("Exames/mês"),
            width: 140,
        },
        {
            id: "max_laboratories",
            header: _("Laboratórios"),
            width: 140,
        },
        {
            id: "max_users",
            header: _("Usuários"),
            width: 120,
        },
        {
            id: "max_branches",
            header: _("Filiais"),
            width: 120,
        },
        {
            id: "reports",
            header: _("Relatórios"),
            width: 140,
            cell: ActiveCell
        },
        {
            id: "financial_management",
            header: _("Gestão financeira"),
            width: 160,
            cell: ActiveCell
        },
        {
            id: "custom_branding",
            header: _("Identidade visual"),
            width: 160,
            cell: ActiveCell
        },
        {
            id: "data_export",
            header: _("Exportação"),
            width: 140,
            cell: ActiveCell
        },
        {
            id: "edit",
            header: { text: _("Editar"), css: "center" },
            width: 200,
            resize: true,
            sort: false,
            cell: ButtonEdit,
        }
    ];

    function handleEdit(id) {
        console.log("ID recebido:", id);

        planFeatureId = id;
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
                    {_('Planos e funcionalidades')}
                </h5>

                <!-- <button type="button" class="btn btn-primary" onclick={openModal}>
                    <i class="bi bi-plus-lg me-1"></i>
                    {_('Novo plano')}
                </button> -->
            </div>

            <Filter bind:filters />
            <br />
            <GridTable
                bind:this={gridRef}  
                columns={columns}
                urlGrid={urlGrid}
                dataKey="features"
                {filters}
                initPagination={5}
                reorder={true}
                onReorder={handleReorder}
                onEdit={handleEdit}
                tree={true}
                treeKey="features"
            />

        </div>
    </section>
</Layout>
<Form
    bind:showModal={showModal}
    bind:icon={icon}
    bind:id={planFeatureId}
    onClosed={handleFormClose}
/>