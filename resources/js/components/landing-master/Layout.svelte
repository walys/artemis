<script>
    import {_} from "$lib/lang/lang.js";
    import { page, Link } from '@inertiajs/svelte';
    import "$css/master/master.css";
    import SelectorLanguage from "$components/landing-master/Seletor-Language.svelte";
    import DropdownUser from "$components/landing-master/Dropdown-User.svelte";
    import Breadcrumb from "$components/landing-master/Breadcrumb.svelte";
    import Footer from "$components/landing-master/Footer.svelte";

    let user = page.props?.auth?.master;
    let userSettings = page.props?.auth?.userSettings;
    let { breadcrumb } = $props();

    // Estado do menu lateral
    let sidebarCollapsed = $state(false);

    // Função para alternar o estado do menu lateral
    function toggleSidebar() {
        sidebarCollapsed = !sidebarCollapsed;
    }

    
    const menu = [
        {
            title: _('Visão geral'),
            icone: 'bi-grid-1x2',
            active: true,
            url: '/master/dashboard',
        },
        {
            title: _('Idiomas'),
            icone: 'bi-translate',
            active: true,
            url: '/master/languages',
        },
        {
            title: _('Planos'),
            icone: 'bi-briefcase',
            active: true,
            url: '/master/plans',
        },
        {
            title: _('Pacientes'),
            icone: 'bi-heart-pulse',
            active: false,
            url: '/master/pacientes',
        },
        {
            title: _('Exames'),
            icone: 'bi-clipboard2-pulse',
            active: false,
            url: '/master/exames',
        },
        {
            title: _('Resultados'),
            icone: 'bi-file-earmark-medical',
            active: false,
            url: '/master/resultados',
        },
        {
            title: _('Relatórios'),
            icone: 'bi-bar-chart',
            active: false,
            url: '/master/relatorios',
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
                <Link
                    href={item.url}
                    class="sidebar-link {item.title === breadcrumb ? 'active' : ''}"
                    title={sidebarCollapsed ? item.title : undefined}
                    onclick={item.active ? undefined : (event) => event.preventDefault()}
                >
                    <i class={`bi ${item.icone}`}></i>

                    {#if !sidebarCollapsed}
                        <span class="sidebar-link-title">{item.title}</span>

                        {#if !item.active}
                            <span class="coming-soon">Em breve</span>
                        {/if}
                    {/if}
                </Link>
                <!-- <a
                    href={item.url}
                    class:active={item.title == breadcrumb ? true : false}
                    class="sidebar-link"
                    aria-current={item.active ? 'page' : undefined}
                    title={sidebarCollapsed ? item.title : undefined}
                    onclick={item.active ? undefined : (event) => event.preventDefault()}
                >
                    <i class={`bi ${item.icone}`}></i>

                    {#if !sidebarCollapsed}
                        <span class="sidebar-link-title">
                            {item.title}
                        </span>

                        {#if !item.active}
                            <span class="coming-soon">Em breve</span>
                        {/if}
                    {/if}
                </a> -->
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

                <Breadcrumb breadcrumb={breadcrumb} />
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