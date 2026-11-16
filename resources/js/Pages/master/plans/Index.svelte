
<script>
    import { _ } from "$lib/lang/lang.js";
    import Layout from "$components/landing-master/Layout.svelte";
    import GridTable from "$components/table/GridTable.svelte";

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

                <button type="button" class="btn btn-primary">
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

<style>
    .card {
        border: 1px solid #e0e9f0;
        border-radius: 14px;
        background: #fff;
        transition: border-color 0.2s;
    }
    .search-box {
        position: relative;
        width: 25%;
    }

    .search-box i {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #6BA3C8;
        z-index: 1;
    }

    .search-box input {
        padding-left: 36px;
        border: 1px solid #B8D4E8;
        border-radius: 8px;
    }

    .search-box input:focus {
        border-color: #2E6B8A;
        box-shadow: 0 0 0 0.2rem rgba(46, 107, 138, 0.12);
    }

    @media (max-width: 576px) {
        .search-box {
            width: 100%;
        }
    }
</style>
