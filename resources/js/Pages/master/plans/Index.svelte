
<script>
    import { _ } from "$lib/lang/lang.js";
    import Layout from "$components/landing-master/Layout.svelte";
    import GridTable from "$components/table/GridTable.svelte";
    import Form from "$master/plans/Form.svelte";

    let breadcrumb = _("Planos");

    let showOverlay = $state(false);
    let search = $state('');
    let columns = $state([
        {
            id: "id",
            header: _("#"),
            width: 50,
            resize: true,
            css: "center",
            sort: true,
        },
        {
            id: "name",
            header: _("Nome"),
            width: 350,
            resize: true,
            css: "center",
            sort: true,
        },
        {
            id: "description",
            header: _("Descrição"),
            width: 350,
            resize: true,
            css: "center",
            sort: true,
        },
        {
            id: "price",
            header: _("Valor"),
            width: 120,
            resize: true,
            css: "center",
            sort: true,
        },
        {
            id: "status",
            header: _("Status"),
            width: 120,
            resize: true,
            css: "center",
            sort: true,
        },
    ]);
    let data = $state([
        {
            id: 1,
            name: _("Básico"),
            description: _("Plano para pequenos laboratórios."),
            price: "R$ 99,90",
            status: _("Ativo"),
        },
        {
            id: 2,
            name: _("Profissional"),
            description: _("Plano para laboratórios em crescimento."),
            price: "R$ 199,90",
            status: _("Ativo"),
        },
        {
            id: 3,
            name: _("Básico"),
            description: _("Plano para pequenos laboratórios."),
            price: "R$ 99,90",
            status: _("Ativo"),
        },
        {
            id: 4,
            name: _("Profissional"),
            description: _("Plano para laboratórios em crescimento."),
            price: "R$ 199,90",
            status: _("Ativo"),
        },
        {
            id: 5,
            name: _("Básico"),
            description: _("Plano para pequenos laboratórios."),
            price: "R$ 99,90",
            status: _("Ativo"),
        },
        {
            id: 6,
            name: _("Profissional"),
            description: _("Plano para laboratórios em crescimento."),
            price: "R$ 199,90",
            status: _("Ativo"),
        },
        {
            id: 7,
            name: _("Básico"),
            description: _("Plano para pequenos laboratórios."),
            price: "R$ 99,90",
            status: _("Ativo"),
        },
        {
            id: 8,
            name: _("Profissional"),
            description: _("Plano para laboratórios em crescimento."),
            price: "R$ 199,90",
            status: _("Ativo"),
        },
        {
            id: 9,
            name: _("Básico"),
            description: _("Plano para pequenos laboratórios."),
            price: "R$ 99,90",
            status: _("Ativo"),
        },
        {
            id: 10,
            name: _("Profissional"),
            description: _("Plano para laboratórios em crescimento."),
            price: "R$ 199,90",
            status: _("Ativo"),
        },
    ]);

     // Controle da modal
    let showModal = $state(false);
    let modalInstance = null;

     // Dados do formulário
    let formData = $state({
        name: '',
        description: '',
        price: '',
        status: 'Ativo'
    });

    function openModal() {
        formData = { name: '', description: '', price: '', status: 'Ativo' };
        showModal = true;
    }

    function closeModal() {
        showModal = false;
    }

    function handleSubmit(payload) {
        // Aqui você adiciona o novo plano
        const newId = Math.max(0, ...data.map(d => d.id)) + 1;
        data = [
            ...data,
            {
                id: newId,
                name: payload.name,
                description: payload.description,
                price: payload.price,
                status: payload.status
            }
        ];

        closeModal();
    }

</script>

<Layout breadcrumb={breadcrumb}>
    <section class="dashboard-section">
        <div class="card p-3">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <h5 class="mb-0 d-flex align-items-center gap-2">
                    <div class="shortcut-icon">
                        <i class="bi bi-briefcase"></i>
                    </div>

                    {_('Gerenciamento de planos')}
                </h5>

                <button type="button" class="btn btn-primary" onclick={openModal}>
                    <i class="bi bi-plus-lg me-1"></i>
                    {_('Novo plano')}
                </button>
            </div>

            <div class="d-flex align-items-center gap-2 flex-wrap">

                <div class="search-box">
                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        class="form-control"
                        placeholder={_("Pesquisar plano...")}
                        bind:value={search}
                    />
                </div>

            </div>
            <br />
            <GridTable
                columns={columns}
                bind:data={data}
                initPagination={5}
                showOverlay={showOverlay}
                {search}
            />

        </div>
    </section>
</Layout>
<!-- MODAL -->
{#if showModal}
    <div
        class="modal fade show d-block"
        tabindex="-1"
        style="background: rgba(0,0,0,0.5);"
        role="dialog"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {_('Novo plano')}
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        aria-label="Close"
                        onclick={closeModal}
                    ></button>
                </div>

                <div class="modal-body">
                    <Form {formData} onSubmit={handleSubmit} onCancel={closeModal} />
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        onclick={closeModal}
                    >
                        {_('Cancelar')}
                    </button>

                    <!-- Botão vinculado ao form pelo atributo form="id" -->
                    <button
                        type="submit"
                        class="btn btn-primary"
                        form="plano-form"
                    >
                        {_('Salvar')}
                    </button>
                </div>
            </div>
        </div>
    </div>
{/if}