<script>
    import { _ } from "$lib/lang/lang.js";
    import Layout from "$components/landing-master/Layout.svelte";
    import GridTable from "$components/table/GridTable.svelte";
    import ActiveCell from "$master/plan-features/ActiveCell.svelte";
    import ButtonEdit from "$components/table/ButtonEdit.svelte";
    import Form from "$master/plan-descriptions/Form.svelte";
    import Filter from "$master/plan-descriptions/Filter.svelte";

    let breadcrumb = _("Descrições dos Planos");
    let icon = 'bi bi-briefcase';

    let showModal = $state(false);
    let planDescriptionId = $state(null);

    let filters = $state({
        name: '',
        is_active: null,
        language: null,
        plan: null
    });
    let gridRef = $state(); 
    let urlGrid = route('master.plans.description.index');
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
            id: "language",
            header: _("Idioma"),
            width: 150,
        },
        {
            id: "description",
            header: _("Descrição"),
            width: 800,
            resize: true,
        },
        {
            id: "edit",
            header: { text: _("Editar"), css: "center" },
            width: 120,
            resize: true,
            sort: false,
            cell: ButtonEdit,
        }
    ];

    function handleEdit(id) {
        // console.log("ID recebido:", id);

        planDescriptionId = id;
        showModal = true;
    }
  
    async function handleReorder({ event, data }) {
        if (event.inProgress !== false) return;
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
                    {breadcrumb}
                </h5>
            </div>

            <Filter bind:filters />
            <br />
            <GridTable
                bind:this={gridRef}  
                columns={columns}
                urlGrid={urlGrid}
                dataKey="descriptions"
                {filters}
                initPagination={5}
                reorder={false}
                onReorder={handleReorder}
                onEdit={handleEdit}
                tree={true}
                treeKey="descriptions"
                filterRelations={{
                    language: {
                        key: 'descriptions',
                        field: 'language_id',
                        filterData: true
                    }
                }}
            />

        </div>
    </section>
</Layout>
<Form
    bind:showModal={showModal}
    bind:icon={icon}
    bind:id={planDescriptionId}
    onClosed={handleFormClose}
/>