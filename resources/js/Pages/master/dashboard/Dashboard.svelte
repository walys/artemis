<script>
    let usuario = {
        nome: 'Walyson',
        email: 'walyson@example.com'
    };

    let resumo = {
        pacientes: 120,
        exames_pendentes: 35,
        exames_concluidos: 85
    };

    // Estado do menu lateral
    let sidebarCollapsed = $state(false);

    let userMenuOpen = $state(false);

    let idiomaMenuAberto = $state(false);
    let idiomaSelecionado = $state('pt-BR');

    function toggleSidebar() {
        sidebarCollapsed = !sidebarCollapsed;
    }

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
    <aside
        class="sidebar"
        class:collapsed={sidebarCollapsed}
    >
        <!-- Identidade visual -->
        <div class="sidebar-header">
            <a href="/" class="brand" aria-label="Artemis - Início">
                <span class="brand-icon">
                    <i class="bi bi-heart-pulse-fill"></i>
                </span>

                {#if !sidebarCollapsed}
                    <span class="brand-name">Artemis</span>
                {/if}
            </a>
        </div>

        {#if !sidebarCollapsed}
            <div class="sidebar-label">
                MENU PRINCIPAL
            </div>
        {/if}

        <!-- Navegação -->
        <nav class="sidebar-nav" aria-label="Menu principal">
            {#each menu as item}
                <a
                    href="/"
                    class:active={item.ativo}
                    class="sidebar-link"
                    aria-current={item.ativo ? 'page' : undefined}
                    title={sidebarCollapsed ? item.titulo : undefined}
                    onclick={item.ativo ? undefined : (event) => event.preventDefault()}
                >
                    <i class={`bi ${item.icone}`}></i>

                    {#if !sidebarCollapsed}
                        <span class="sidebar-link-title">
                            {item.titulo}
                        </span>

                        {#if !item.ativo}
                            <span class="coming-soon">Em breve</span>
                        {/if}
                    {/if}
                </a>
            {/each}
        </nav>

        <!-- Rodapé do menu -->
        <div class="sidebar-bottom">
            <div class="sidebar-bottom-icon">
                <i class="bi bi-shield-check"></i>
            </div>

            {#if !sidebarCollapsed}
                <div class="sidebar-bottom-info">
                    <strong>Artemis</strong>
                    <span>Gestão laboratorial</span>
                </div>
            {/if}
        </div>
    </aside>

    <!-- Conteúdo principal -->
    <div
        class="main-area"
        class:expanded={sidebarCollapsed}
    >
        <!-- Cabeçalho -->
        <header class="topbar">
            <div class="topbar-left">
                <button
                    type="button"
                    class="sidebar-toggle"
                    onclick={toggleSidebar}
                    aria-label={sidebarCollapsed ? 'Expandir menu' : 'Recolher menu'}
                    aria-expanded={!sidebarCollapsed}
                    title={sidebarCollapsed ? 'Expandir menu' : 'Recolher menu'}
                >
                    <i class={`bi ${sidebarCollapsed ? 'bi-layout-sidebar' : 'bi-layout-sidebar-inset'}`}></i>
                </button>

                <div class="breadcrumb">
                    <span>Artemis</span>
                    <i class="bi bi-chevron-right"></i>
                    <strong>Visão geral</strong>
                </div>
            </div>
            
            <div class="topbar-actions">

                <!-- Seletor de idioma -->
                <div class="language-dropdown">
                    <button
                        type="button"
                        class="language-dropdown-toggle"
                        aria-label="Selecionar idioma"
                        aria-haspopup="true"
                        aria-expanded={idiomaMenuAberto}
                        onclick={() => {
                            idiomaMenuAberto = !idiomaMenuAberto;
                            userMenuOpen = false;
                        }}
                    >
                        {#if idiomaSelecionado === 'pt-BR'}
                            <img src="/lang/pt-BR.png" alt="" width="20" height="20" />
                            <span>Português</span>
                        {:else if idiomaSelecionado === 'en'}
                            <img src="/lang/en.png" alt="" width="20" height="20" />
                            <span>English</span>
                        {:else}
                            <img src="/lang/es.png" alt="" width="20" height="20" />
                            <span>Español</span>
                        {/if}

                        <i class={`bi ${idiomaMenuAberto ? 'bi-chevron-up' : 'bi-chevron-down'}`}></i>
                    </button>

                    {#if idiomaMenuAberto}
                        <div class="language-dropdown-menu" role="menu">

                            <button
                                type="button"
                                class="language-dropdown-item"
                                class:active={idiomaSelecionado === 'pt-BR'}
                                role="menuitem"
                                onclick={() => {
                                    idiomaSelecionado = 'pt-BR';
                                    idiomaMenuAberto = false;
                                }}
                            >
                                <img src="/lang/pt-BR.png" alt="" width="20" height="20" />
                                <span>Português</span>

                                {#if idiomaSelecionado === 'pt-BR'}
                                    <i class="bi bi-check2 ms-auto"></i>
                                {/if}
                            </button>

                            <button
                                type="button"
                                class="language-dropdown-item"
                                class:active={idiomaSelecionado === 'en'}
                                role="menuitem"
                                onclick={() => {
                                    idiomaSelecionado = 'en';
                                    idiomaMenuAberto = false;
                                }}
                            >
                                <img src="/lang/en.png" alt="" width="20" height="20" />
                                <span>English</span>

                                {#if idiomaSelecionado === 'en'}
                                    <i class="bi bi-check2 ms-auto"></i>
                                {/if}
                            </button>

                            <button
                                type="button"
                                class="language-dropdown-item"
                                class:active={idiomaSelecionado === 'es'}
                                role="menuitem"
                                onclick={() => {
                                    idiomaSelecionado = 'es';
                                    idiomaMenuAberto = false;
                                }}
                            >
                                <img src="/lang/es.png" alt="" width="20" height="20" />
                                <span>Español</span>

                                {#if idiomaSelecionado === 'es'}
                                    <i class="bi bi-check2 ms-auto"></i>
                                {/if}
                            </button>

                        </div>
                    {/if}
                </div>

                <!-- Dropdown do usuário -->
                <div class="user-dropdown">
                    <button
                        type="button"
                        class="user-area"
                        onclick={() => {
                            userMenuOpen = !userMenuOpen;
                            idiomaMenuAberto = false;
                        }}
                        aria-expanded={userMenuOpen}
                        aria-label="Abrir menu do usuário"
                    >
                        <img
                            src="/images/users/default-avatar.png"
                            alt="Foto do usuário"
                            class="user-avatar"
                        />

                        <div class="user-info">
                            <strong>{usuario.nome}</strong>
                            <span>Usuário do sistema</span>
                        </div>

                        <i
                            class={`bi ${userMenuOpen ? 'bi-chevron-up' : 'bi-chevron-down'} user-chevron`}
                        ></i>
                    </button>

                    {#if userMenuOpen}
                        <div class="user-menu">
                            <div class="user-menu-header">
                                <strong>{usuario.nome}</strong>
                                <span>{usuario.email}</span>
                            </div>

                            <div class="user-menu-divider"></div>

                            <button type="button" class="user-menu-item">
                                <i class="bi bi-person-circle"></i>
                                <span>Meu perfil</span>
                            </button>

                            <button type="button" class="user-menu-item">
                                <i class="bi bi-gear"></i>
                                <span>Configurações</span>
                            </button>

                            <button type="button" class="user-menu-item">
                                <i class="bi bi-shield-lock"></i>
                                <span>Segurança</span>
                            </button>

                            <div class="user-menu-divider"></div>

                            <button type="button" class="user-menu-item logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sair</span>
                            </button>
                        </div>
                    {/if}
                </div>

            </div>


            <!-- <div class="user-dropdown">
                <button
                    type="button"
                    class="user-area"
                    onclick={() => (userMenuOpen = !userMenuOpen)}
                    aria-expanded={userMenuOpen}
                    aria-label="Abrir menu do usuário"
                >
                    <img
                        src="/images/users/default-avatar.png"
                        alt="Foto do usuário"
                        class="user-avatar"
                    />

                    <div class="user-info">
                        <strong>{usuario.nome}</strong>
                        <span>Usuário do sistema</span>
                    </div>

                    <i
                        class={`bi ${userMenuOpen ? 'bi-chevron-up' : 'bi-chevron-down'} user-chevron`}
                    ></i>
                </button>

                {#if userMenuOpen}
                    <div class="user-menu">
                        <div class="user-menu-header">
                            <strong>{usuario.nome}</strong>
                            <span>{usuario.email}</span>
                        </div>

                        <div class="user-menu-divider"></div>

                        <button type="button" class="user-menu-item">
                            <i class="bi bi-person-circle"></i>
                            <span>Meu perfil</span>
                        </button>

                        <button type="button" class="user-menu-item">
                            <i class="bi bi-gear"></i>
                            <span>Configurações</span>
                        </button>

                        <button type="button" class="user-menu-item">
                            <i class="bi bi-shield-lock"></i>
                            <span>Segurança</span>
                        </button>

                        <div class="user-menu-divider"></div>

                        <button
                            type="button"
                            class="user-menu-item logout"
                        >
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sair</span>
                        </button>
                    </div>
                {/if}
            </div> -->
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

            <!-- Rodapé -->
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
    :global(*) {
        box-sizing: border-box;
    }

    :global(body) {
        margin: 0;
        background: #f7fafc;
        color: #1f3442;
        font-family: Arial, Helvetica, sans-serif;
    }

    .artemis-layout {
        min-height: 100vh;
        background: #f7fafc;
    }

    /* ========================================
       MENU LATERAL
    ======================================== */

    .sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        z-index: 100;

        display: flex;
        width: 255px;
        flex-direction: column;

        padding: 24px 16px 20px;

        border-right: 1px solid #dce7ef;
        background: #fff;

        transition: width 0.25s ease;
    }

    .sidebar.collapsed {
        width: 76px;
        padding-right: 10px;
        padding-left: 10px;
    }

    /* Cabeçalho do menu */

    .sidebar-header {
        display: flex;
        min-height: 42px;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 44px;
    }

    .collapsed .sidebar-header {
        flex-direction: column;
        gap: 16px;
        margin-bottom: 35px;
    }

    .brand {
        display: flex;
        min-width: 0;
        align-items: center;
        gap: 11px;

        padding: 0 8px;

        color: #2e6b8a;
        text-decoration: none;
    }

    .brand-icon {
        display: grid;
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        place-items: center;

        border-radius: 12px;
        background: #e8f0f8;

        font-size: 23px;
    }

    .brand-name {
        overflow: hidden;
        font-size: 25px;
        font-weight: 600;
        letter-spacing: -1px;
        white-space: nowrap;
    }

    .sidebar-toggle {
        display: grid;
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        place-items: center;

        border: 0;
        border-radius: 9px;
        background: transparent;

        color: #718696;
        font-size: 18px;

        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }

    .sidebar-toggle:hover {
        background: #e8f0f8;
        color: #2e6b8a;
    }

    /* Identificação do menu */

    .sidebar-label {
        overflow: hidden;
        padding: 0 12px;
        margin-bottom: 13px;

        color: #8b9ba8;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.3px;
        white-space: nowrap;
    }

    /* Navegação */

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .sidebar-link {
        position: relative;

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
        display: grid;
        width: 20px;
        flex-shrink: 0;
        place-items: center;

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

    .sidebar-link-title {
        overflow: hidden;
        white-space: nowrap;
    }

    .coming-soon {
        margin-left: auto;
        color: #9aabb7;
        font-size: 9px;
        white-space: nowrap;
    }

    /* Menu recolhido */

    .collapsed .brand {
        justify-content: center;
        padding: 0;
    }

    .collapsed .sidebar-link {
        justify-content: center;
        padding: 0;
    }

    .collapsed .sidebar-link > i {
        font-size: 19px;
    }

    /* Rodapé do menu */

    .sidebar-bottom {
        display: flex;
        min-height: 55px;
        align-items: center;
        gap: 11px;

        margin-top: auto;
        padding: 17px 8px 0;

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

    .sidebar-bottom-info {
        overflow: hidden;
        white-space: nowrap;
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

    .collapsed .sidebar-bottom {
        justify-content: center;
        padding-right: 0;
        padding-left: 0;
    }

    /* ========================================
       ÁREA PRINCIPAL
    ======================================== */

    .main-area {
        min-height: 100vh;
        margin-left: 255px;

        transition: margin-left 0.25s ease;
    }

    .main-area.expanded {
        margin-left: 76px;
    }

    /* Cabeçalho */
    .topbar-left {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .sidebar-toggle {
        display: grid;
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        place-items: center;

        border: 1px solid #e0e9f0;
        border-radius: 9px;
        background: #fff;

        color: #63798a;
        font-size: 18px;

        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }

    .sidebar-toggle:hover {
        background: #e8f0f8;
        color: #2e6b8a;
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
        margin: 12px;
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

    /* USER DROPDOWN */
    .user-dropdown {
        position: relative;
    }

    .user-area {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 6px 10px;
        border: 1px solid transparent;
        border-radius: 10px;
        background: transparent;
        cursor: pointer;
        transition: background 0.2s, border-color 0.2s;
        text-align: left;
    }

    .user-area:hover {
        background: #f4f8fb;
        border-color: #e4edf3;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e5edf2;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .user-info strong {
        color: #263b4a;
        font-size: 13px;
        font-weight: 600;
    }

    .user-info span {
        color: #8293a0;
        font-size: 11px;
    }

    .user-chevron {
        margin-left: 5px;
        color: #8293a0;
        font-size: 12px;
    }

    /* MENU */
    .user-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        z-index: 1000;
        width: 245px;
        padding: 8px;
        background: #fff;
        border: 1px solid #e7edf2;
        border-radius: 12px;
        box-shadow: 0 10px 35px rgba(30, 55, 75, 0.12);
        animation: dropdownFade 0.18s ease;
    }

    .user-menu-header {
        display: flex;
        flex-direction: column;
        gap: 5px;
        padding: 12px;
    }

    .user-menu-header strong {
        color: #263b4a;
        font-size: 13px;
    }

    .user-menu-header span {
        color: #8293a0;
        font-size: 11px;
        overflow-wrap: anywhere;
    }

    .user-menu-divider {
        height: 1px;
        margin: 5px 0;
        background: #edf1f4;
    }

    .user-menu-item {
        display: flex;
        align-items: center;
        gap: 11px;
        width: 100%;
        padding: 11px 12px;
        border: none;
        border-radius: 8px;
        background: transparent;
        color: #536879;
        font-size: 13px;
        text-align: left;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }

    .user-menu-item i {
        font-size: 16px;
    }

    .user-menu-item:hover {
        background: #f3f7fa;
        color: #2e6b8a;
    }

    .user-menu-item.logout {
        color: #d9534f;
    }

    .user-menu-item.logout:hover {
        background: #fff1f0;
        color: #c0392b;
    }

    @keyframes dropdownFade {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Conteúdo */

    .page-content {
        width: 100%;
        max-width: 1500px;
        padding: 36px;
        margin: 0 auto;
    }

    /* ========================================
       BOAS-VINDAS
    ======================================== */

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

    /* ========================================
       SEÇÕES
    ======================================== */

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

    /* ========================================
       INDICADORES
    ======================================== */

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

    /* ========================================
       ACESSO RÁPIDO
    ======================================== */

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

    /* ========================================
       ESTADO VAZIO
    ======================================== */

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

    /* ========================================
       RODAPÉ
    ======================================== */

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

    /* ========================================
       RESPONSIVIDADE
    ======================================== */

    @media (max-width: 1199.98px) {
        .sidebar {
            width: 220px;
        }

        .sidebar.collapsed {
            width: 76px;
        }

        .main-area {
            margin-left: 220px;
        }

        .main-area.expanded {
            margin-left: 76px;
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
        .sidebar,
        .sidebar.collapsed {
            position: static;
            width: 100%;
            padding: 16px;

            border-right: 0;
            border-bottom: 1px solid #dce7ef;
        }

        .sidebar-header,
        .collapsed .sidebar-header {
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .collapsed .brand {
            justify-content: flex-start;
            padding: 0 8px;
        }

        .collapsed .brand-name {
            display: inline;
        }

        .sidebar-label {
            display: block;
        }

        .collapsed .sidebar-label {
            display: none;
        }

        .sidebar-nav {
            flex-direction: row;
            gap: 5px;
            overflow-x: auto;
            padding-bottom: 3px;
        }

        .sidebar-link,
        .collapsed .sidebar-link {
            min-height: 40px;
            flex-shrink: 0;
            justify-content: flex-start;
            gap: 7px;
            padding: 0 11px;
            font-size: 11px;
        }

        .sidebar-link > i,
        .collapsed .sidebar-link > i {
            width: auto;
            font-size: 15px;
        }

        .collapsed .sidebar-link-title {
            display: inline;
        }

        .sidebar-bottom,
        .collapsed .sidebar-bottom {
            display: none;
        }

        .main-area,
        .main-area.expanded {
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

    /* Respeita preferência de movimento reduzido */

    @media (prefers-reduced-motion: reduce) {
        .sidebar,
        .main-area,
        .sidebar-link,
        .sidebar-toggle {
            transition: none;
        }
    }




    
/* ÁREA DE AÇÕES DA TOPBAR */
.topbar-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 14px;
}

/* LANGUAGE DROPDOWN */
.language-dropdown {
    position: relative;
}

.language-dropdown-toggle {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    min-height: 42px;
    padding: 0 12px;

    border: 1px solid #e0e9f0;
    border-radius: 9px;
    background: #fff;

    color: #536879;
    font-size: 12px;
    font-weight: 500;

    cursor: pointer;
    transition: background 0.2s, border-color 0.2s;
}

.language-dropdown-toggle:hover {
    background: #f4f8fb;
    border-color: #cbdce8;
}

.language-dropdown-toggle img,
.language-dropdown-item img {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
    border-radius: 50%;
    object-fit: cover;
}

.language-dropdown-toggle i {
    margin-left: 3px;
    color: #8293a0;
    font-size: 11px;
}

/* MENU DE IDIOMAS */
.language-dropdown-menu {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    z-index: 1000;

    width: 185px;
    padding: 7px;

    background: #fff;
    border: 1px solid #e7edf2;
    border-radius: 12px;
    box-shadow: 0 10px 35px rgba(30, 55, 75, 0.12);

    animation: dropdownFade 0.18s ease;
}

.language-dropdown-item {
    display: flex;
    width: 100%;
    align-items: center;
    gap: 10px;

    padding: 10px;
    border: none;
    border-radius: 8px;
    background: transparent;

    color: #536879;
    font-size: 12px;
    text-align: left;

    cursor: pointer;
    transition: background 0.2s, color 0.2s;
}

.language-dropdown-item:hover {
    background: #f3f7fa;
    color: #2e6b8a;
}

.language-dropdown-item.active {
    background: #e8f0f8;
    color: #2e6b8a;
    font-weight: 600;
}

.language-dropdown-item i {
    margin-left: auto;
    font-size: 16px;
    color: #2e6b8a;
}

/* RESPONSIVIDADE */
@media (max-width: 575.98px) {
    .topbar-actions {
        gap: 7px;
    }

    .language-dropdown-toggle {
        gap: 5px;
        padding: 0 8px;
    }

    .language-dropdown-toggle span {
        display: none;
    }

    .language-dropdown-toggle i {
        margin-left: 0;
    }
}

    
</style>
