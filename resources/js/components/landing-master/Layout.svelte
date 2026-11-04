<script>
    import {_} from "$lib/lang/lang.js";
    import { page } from '@inertiajs/svelte';
    import "$css/master/master.css";
    import SelectorLanguage from "$components/landing-master/Seletor-Language.svelte";
    import DropdownUser from "$components/landing-master/Dropdown-User.svelte";
    import Footer from "$components/landing-master/Footer.svelte";

    let user = page.props?.auth?.master;
    let userSettings = page.props?.auth?.userSettings;

    // Estado do menu lateral
    let sidebarCollapsed = $state(false);

    // Função para alternar o estado do menu lateral
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
    <title>{_("Início")} | Artemis</title>
    <meta
        name="description"
        content={_("Painel inicial do sistema de administração de laboratório veterinário Artemis.")}
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
            <a href="/" class="brand" aria-label="Artemis - {_("Início")}">
                <span class="brand-icon">
                    <!-- <i class="bi bi-heart-pulse-fill"></i> -->
                    <img
                        src={"/images/visual/logo-03.png"}
                        style="border-radius: 40%; width: 70%;"
                        alt="Logo"
                        class="img-fluid mb-2"
                    />
                </span>

                {#if !sidebarCollapsed}
                    <span class="brand-name">Artemis</span>
                {/if}
            </a>
        </div>

        {#if !sidebarCollapsed}
            <div class="sidebar-label">
                {_("MENU PRINCIPAL")}
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
                    <span>{_("Gestão laboratorial")}</span>
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
                    aria-label={sidebarCollapsed ? _('Expandir menu') : _('Recolher menu')}
                    aria-expanded={!sidebarCollapsed}
                    title={sidebarCollapsed ? _('Expandir menu') : _('Recolher menu')}
                >
                    <i class={`bi ${sidebarCollapsed ? 'bi-layout-sidebar' : 'bi-layout-sidebar-inset'}`}></i>
                </button>

                <div class="breadcrumb">
                    <span>Artemis</span>
                    <i class="bi bi-chevron-right"></i>
                    <strong>{_("Visão geral")}</strong>
                </div>
            </div>

            <div class="topbar-actions">
                <!-- Seletor de idioma -->
                <SelectorLanguage  bind:userSettings={userSettings}/>
                <!-- Dropdown do usuário -->
                <DropdownUser bind:usuario={user} />
            </div>
        </header>

        <main class="page-content">
             <!--Slot -->
             <slot></slot>
             <!-- Fim do slot -->

            <!-- Rodapé -->
            <Footer />
        </main>
    </div>
</div>