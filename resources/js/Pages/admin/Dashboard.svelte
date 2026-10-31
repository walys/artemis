<script>
    export let usuario;
    export let resumo;

    const menu = [
        {
            titulo: 'Visão geral',
            icone: 'bi-grid-1x2',
            ativo: true,
        },
        {
            titulo: 'Pacientes',
            icone: 'bi-heart-pulse',
            ativo: false,
        },
        {
            titulo: 'Exames',
            icone: 'bi-clipboard2-pulse',
            ativo: false,
        },
        {
            titulo: 'Resultados',
            icone: 'bi-file-earmark-medical',
            ativo: false,
        },
        {
            titulo: 'Relatórios',
            icone: 'bi-bar-chart',
            ativo: false,
        },
    ];
</script>

<svelte:head>
    <title>Início | Artemis</title>
    <meta
        name="description"
        content="Painel inicial do sistema de administração de laboratório veterinário Artemis."
    />
</svelte:head>

<div class="artemis-layout">
    <!-- Menu lateral -->
    <aside class="sidebar">
        <a href="/" class="brand" aria-label="Artemis - Início">
            <span class="brand-icon">
                <i class="bi bi-heart-pulse-fill"></i>
            </span>

            <span class="brand-name">Artemis</span>
        </a>

        <div class="sidebar-label">
            MENU PRINCIPAL
        </div>

        <nav class="sidebar-nav" aria-label="Menu principal">
            {#each menu as item}
                <a
                    href="/"
                    class:active={item.ativo}
                    class="sidebar-link"
                    aria-current={item.ativo ? 'page' : undefined}
                    onclick={item.ativo ? undefined : (event) => event.preventDefault()}
                >
                    <i class={`bi ${item.icone}`}></i>
                    <span>{item.titulo}</span>

                    {#if !item.ativo}
                        <span class="coming-soon">Em breve</span>
                    {/if}
                </a>
            {/each}
        </nav>

        <div class="sidebar-bottom">
            <div class="sidebar-bottom-icon">
                <i class="bi bi-shield-check"></i>
            </div>

            <div>
                <strong>Artemis</strong>
                <span>Gestão laboratorial</span>
            </div>
        </div>
    </aside>

    <!-- Conteúdo principal -->
    <div class="main-area">
        <header class="topbar">
            <div class="breadcrumb">
                <span>Artemis</span>
                <i class="bi bi-chevron-right"></i>
                <strong>Visão geral</strong>
            </div>

            <div class="user-area">
                <div class="user-avatar">
                    <i class="bi bi-person"></i>
                </div>

                <div class="user-info">
                    <strong>{usuario.nome}</strong>
                    <span>Usuário do sistema</span>
                </div>
            </div>
        </header>

        <main class="page-content">
            <!-- Boas-vindas -->
            <section class="welcome-section">
                <div>
                    <span class="eyebrow">PAINEL PRINCIPAL</span>

                    <h1>Olá, {usuario.nome}!</h1>

                    <p>
                        Bem-vindo ao Artemis. Acompanhe as informações
                        do seu laboratório em um só lugar.
                    </p>
                </div>

                <div class="welcome-icon">
                    <i class="bi bi-clipboard2-pulse"></i>
                </div>
            </section>

            <!-- Indicadores -->
            <section class="dashboard-section">
                <div class="section-heading">
                    <div>
                        <h2>Resumo do laboratório</h2>
                        <p>Visão geral dos principais indicadores.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6 col-xl-4">
                        <article class="stat-card">
                            <div class="stat-top">
                                <span>Pacientes cadastrados</span>

                                <div class="stat-icon icon-blue">
                                    <i class="bi bi-heart-pulse"></i>
                                </div>
                            </div>

                            <div class="stat-value">
                                {resumo.pacientes}
                            </div>

                            <span class="stat-description">
                                Total de pacientes registrados
                            </span>
                        </article>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4">
                        <article class="stat-card">
                            <div class="stat-top">
                                <span>Exames pendentes</span>

                                <div class="stat-icon icon-orange">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                            </div>

                            <div class="stat-value">
                                {resumo.exames_pendentes}
                            </div>

                            <span class="stat-description">
                                Aguardando processamento
                            </span>
                        </article>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4">
                        <article class="stat-card">
                            <div class="stat-top">
                                <span>Exames concluídos</span>

                                <div class="stat-icon icon-green">
                                    <i class="bi bi-check2-circle"></i>
                                </div>
                            </div>

                            <div class="stat-value">
                                {resumo.exames_concluidos}
                            </div>

                            <span class="stat-description">
                                Exames finalizados
                            </span>
                        </article>
                    </div>
                </div>
            </section>

            <!-- Acesso rápido -->
            <section class="dashboard-section">
                <div class="section-heading">
                    <div>
                        <h2>Acesso rápido</h2>
                        <p>Atalhos para as principais áreas do sistema.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <article class="shortcut-card">
                            <div class="shortcut-icon">
                                <i class="bi bi-heart-pulse"></i>
                            </div>

                            <div class="shortcut-content">
                                <h3>Pacientes</h3>

                                <p>
                                    Área destinada ao cadastro e à consulta
                                    de pacientes veterinários.
                                </p>

                                <span class="module-status">
                                    <i class="bi bi-hourglass-split"></i>
                                    Módulo não implementado
                                </span>
                            </div>
                        </article>
                    </div>

                    <div class="col-12 col-md-6">
                        <article class="shortcut-card">
                            <div class="shortcut-icon">
                                <i class="bi bi-clipboard2-pulse"></i>
                            </div>

                            <div class="shortcut-content">
                                <h3>Exames laboratoriais</h3>

                                <p>
                                    Área destinada à organização e ao
                                    acompanhamento dos exames.
                                </p>

                                <span class="module-status">
                                    <i class="bi bi-hourglass-split"></i>
                                    Módulo não implementado
                                </span>
                            </div>
                        </article>
                    </div>

                    <div class="col-12 col-md-6">
                        <article class="shortcut-card">
                            <div class="shortcut-icon">
                                <i class="bi bi-file-earmark-medical"></i>
                            </div>

                            <div class="shortcut-content">
                                <h3>Resultados</h3>

                                <p>
                                    Área destinada à consulta dos resultados
                                    dos exames laboratoriais.
                                </p>

                                <span class="module-status">
                                    <i class="bi bi-hourglass-split"></i>
                                    Módulo não implementado
                                </span>
                            </div>
                        </article>
                    </div>

                    <div class="col-12 col-md-6">
                        <article class="shortcut-card">
                            <div class="shortcut-icon">
                                <i class="bi bi-bar-chart"></i>
                            </div>

                            <div class="shortcut-content">
                                <h3>Relatórios</h3>

                                <p>
                                    Área destinada à visualização de
                                    indicadores e relatórios do laboratório.
                                </p>

                                <span class="module-status">
                                    <i class="bi bi-hourglass-split"></i>
                                    Módulo não implementado
                                </span>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <!-- Atividades -->
            <section class="dashboard-section">
                <div class="section-heading">
                    <div>
                        <h2>Atividades recentes</h2>
                        <p>Espaço reservado para acompanhar as movimentações.</p>
                    </div>
                </div>

                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-inbox"></i>
                    </div>

                    <h3>Nenhuma atividade disponível</h3>

                    <p>
                        Quando os módulos estiverem implementados,
                        as atividades recentes poderão aparecer aqui.
                    </p>
                </div>
            </section>

            <footer class="page-footer">
                <span>Artemis</span>

                <span>
                    Precisão de laboratório, cuidado veterinário.
                </span>
            </footer>
        </main>
    </div>
</div>

<style>
    :global(body) {
        margin: 0;
        background: #f7fafc;
        color: #1f3442;
        font-family: Arial, Helvetica, sans-serif;
    }

    :global(*) {
        box-sizing: border-box;
    }

    .artemis-layout {
        min-height: 100vh;
        background: #f7fafc;
    }

    .sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        z-index: 100;
        display: flex;
        width: 255px;
        flex-direction: column;
        padding: 28px 18px 20px;
        border-right: 1px solid #dce7ef;
        background: #fff;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 0 10px;
        margin-bottom: 48px;
        color: #2e6b8a;
        text-decoration: none;
    }

    .brand-icon {
        display: grid;
        width: 39px;
        height: 39px;
        place-items: center;
        border-radius: 12px;
        background: #e8f0f8;
        font-size: 23px;
    }

    .brand-name {
        font-size: 25px;
        font-weight: 600;
        letter-spacing: -1px;
    }

    .sidebar-label {
        padding: 0 12px;
        margin-bottom: 13px;
        color: #8b9ba8;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.3px;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .sidebar-link {
        display: flex;
        min-height: 46px;
        align-items: center;
        gap: 12px;
        padding: 0 12px;
        border-radius: 10px;
        color: #63798a;
        font-size: 13px;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }

    .sidebar-link > i {
        font-size: 18px;
    }

    .sidebar-link:hover {
        background: #f2f6fa;
        color: #2e6b8a;
    }

    .sidebar-link.active {
        background: #e8f0f8;
        color: #2e6b8a;
        font-weight: 600;
    }

    .coming-soon {
        margin-left: auto;
        color: #9aabb7;
        font-size: 9px;
    }

    .sidebar-bottom {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-top: auto;
        padding: 17px 10px 0;
        border-top: 1px solid #e8eef3;
    }

    .sidebar-bottom-icon {
        display: grid;
        width: 37px;
        height: 37px;
        flex-shrink: 0;
        place-items: center;
        border-radius: 10px;
        background: #e8f0f8;
        color: #2e6b8a;
        font-size: 18px;
    }

    .sidebar-bottom strong,
    .sidebar-bottom span {
        display: block;
    }

    .sidebar-bottom strong {
        font-size: 12px;
    }

    .sidebar-bottom span {
        margin-top: 4px;
        color: #7b8e9d;
        font-size: 10px;
    }

    .main-area {
        min-height: 100vh;
        margin-left: 255px;
    }

    .topbar {
        position: sticky;
        top: 0;
        z-index: 50;
        display: flex;
        min-height: 76px;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 0 36px;
        border-bottom: 1px solid #e1eaf1;
        background: rgb(255 255 255 / 95%);
        backdrop-filter: blur(12px);
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #8193a1;
        font-size: 12px;
    }

    .breadcrumb i {
        font-size: 10px;
    }

    .breadcrumb strong {
        color: #1f3442;
        font-weight: 600;
    }

    .user-area {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .user-avatar {
        display: grid;
        width: 39px;
        height: 39px;
        place-items: center;
        border: 1px solid #d5e3ed;
        border-radius: 50%;
        background: #e8f0f8;
        color: #2e6b8a;
        font-size: 19px;
    }

    .user-info strong,
    .user-info span {
        display: block;
    }

    .user-info strong {
        color: #1f3442;
        font-size: 12px;
    }

    .user-info span {
        margin-top: 4px;
        color: #8193a1;
        font-size: 10px;
    }

    .page-content {
        width: 100%;
        max-width: 1500px;
        padding: 36px;
        margin: 0 auto;
    }

    .welcome-section {
        display: flex;
        min-height: 185px;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        padding: 32px;
        border: 1px solid #dce8f1;
        border-radius: 18px;
        background: #e8f0f8;
    }

    .eyebrow {
        color: #2e6b8a;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.7px;
    }

    .welcome-section h1 {
        margin: 12px 0 9px;
        color: #1f3442;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 700;
        letter-spacing: -1.2px;
    }

    .welcome-section p {
        max-width: 560px;
        margin: 0;
        color: #63798a;
        font-size: 13px;
        line-height: 1.8;
    }

    .welcome-icon {
        display: grid;
        width: 90px;
        height: 90px;
        flex-shrink: 0;
        place-items: center;
        border: 1px solid rgb(107 163 200 / 20%);
        border-radius: 24px;
        background: #fff;
        color: #2e6b8a;
        font-size: 39px;
    }

    .dashboard-section {
        margin-top: 35px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .section-heading h2 {
        margin: 0;
        color: #1f3442;
        font-size: 17px;
        font-weight: 700;
        letter-spacing: -0.3px;
    }

    .section-heading p {
        margin: 6px 0 0;
        color: #8193a1;
        font-size: 12px;
    }

    .stat-card {
        height: 100%;
        min-height: 150px;
        padding: 20px;
        border: 1px solid #e0e9f0;
        border-radius: 14px;
        background: #fff;
        transition: border-color 0.2s, transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        border-color: #b8d4e8;
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        color: #63798a;
        font-size: 12px;
    }

    .stat-icon {
        display: grid;
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        place-items: center;
        border-radius: 11px;
        font-size: 19px;
    }

    .icon-blue {
        background: #e8f0f8;
        color: #2e6b8a;
    }

    .icon-orange {
        background: #fff0d7;
        color: #a16d1a;
    }

    .icon-green {
        background: #e2f3e9;
        color: #26724b;
    }

    .stat-value {
        margin-top: 12px;
        color: #1f3442;
        font-size: 30px;
        font-weight: 700;
        letter-spacing: -1px;
    }

    .stat-description {
        display: block;
        margin-top: 4px;
        color: #91a0ac;
        font-size: 10px;
    }

    .shortcut-card {
        display: flex;
        height: 100%;
        gap: 17px;
        padding: 21px;
        border: 1px solid #e0e9f0;
        border-radius: 14px;
        background: #fff;
        transition: border-color 0.2s;
    }

    .shortcut-card:hover {
        border-color: #b8d4e8;
    }

    .shortcut-icon {
        display: grid;
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        place-items: center;
        border-radius: 12px;
        background: #e8f0f8;
        color: #2e6b8a;
        font-size: 22px;
    }

    .shortcut-content {
        min-width: 0;
    }

    .shortcut-content h3 {
        margin: 2px 0 8px;
        color: #1f3442;
        font-size: 14px;
        font-weight: 700;
    }

    .shortcut-content p {
        margin-bottom: 13px;
        color: #8193a1;
        font-size: 11px;
        line-height: 1.8;
    }

    .module-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #8193a1;
        font-size: 10px;
    }

    .empty-state {
        display: flex;
        min-height: 210px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 25px;
        border: 1px dashed #d5e3ed;
        border-radius: 14px;
        background: rgb(255 255 255 / 70%);
        text-align: center;
    }

    .empty-icon {
        display: grid;
        width: 50px;
        height: 50px;
        place-items: center;
        border-radius: 15px;
        background: #e8f0f8;
        color: #6ba3c8;
        font-size: 24px;
    }

    .empty-state h3 {
        margin: 15px 0 7px;
        color: #1f3442;
        font-size: 13px;
        font-weight: 700;
    }

    .empty-state p {
        max-width: 400px;
        margin: 0;
        color: #8193a1;
        font-size: 11px;
        line-height: 1.8;
    }

    .page-footer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 10px;
        padding: 25px 0 5px;
        margin-top: 38px;
        border-top: 1px solid #e0e9f0;
        color: #8193a1;
        font-size: 10px;
    }

    .page-footer span:first-child {
        color: #2e6b8a;
        font-weight: 700;
    }

    @media (max-width: 1199.98px) {
        .sidebar {
            width: 220px;
        }

        .main-area {
            margin-left: 220px;
        }

        .page-content {
            padding: 26px;
        }

        .topbar {
            padding: 0 26px;
        }

        .coming-soon {
            display: none;
        }
    }

    @media (max-width: 767.98px) {
        .sidebar {
            position: static;
            width: 100%;
            padding: 16px;
            border-right: 0;
            border-bottom: 1px solid #dce7ef;
        }

        .brand {
            margin-bottom: 18px;
        }

        .sidebar-label,
        .sidebar-bottom {
            display: none;
        }

        .sidebar-nav {
            flex-direction: row;
            gap: 5px;
            overflow-x: auto;
            padding-bottom: 3px;
        }

        .sidebar-link {
            min-height: 40px;
            flex-shrink: 0;
            gap: 7px;
            padding: 0 11px;
            font-size: 11px;
        }

        .sidebar-link > i {
            font-size: 15px;
        }

        .main-area {
            margin-left: 0;
        }

        .topbar {
            position: static;
            min-height: 65px;
            padding: 0 18px;
        }

        .page-content {
            padding: 22px 16px;
        }

        .welcome-section {
            min-height: 0;
            padding: 24px 20px;
        }

        .welcome-icon {
            width: 57px;
            height: 57px;
            border-radius: 16px;
            font-size: 25px;
        }

        .welcome-section h1 {
            font-size: 25px;
        }

        .welcome-section p {
            font-size: 12px;
        }

        .dashboard-section {
            margin-top: 28px;
        }
    }

    @media (max-width: 420px) {
        .user-info {
            display: none;
        }

        .breadcrumb {
            gap: 7px;
            font-size: 11px;
        }

        .welcome-icon {
            display: none;
        }

        .shortcut-card {
            gap: 12px;
            padding: 16px;
        }
    }
</style>