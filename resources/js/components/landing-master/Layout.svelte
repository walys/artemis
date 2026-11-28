
<script>
    import {_} from "$lib/lang/lang.js";
    import { Link } from '@inertiajs/svelte';
    import "$css/master/master.css";
    import SelectorLanguage from "$components/landing-master/Seletor-Language.svelte";
    import DropdownUser from "$components/landing-master/Dropdown-User.svelte";
    import Breadcrumb from "$components/landing-master/Breadcrumb.svelte";
    import Footer from "$components/landing-master/Footer.svelte";

    let user = $state(null);
    let userSettings = $state(null);
    let { breadcrumb } = $props();

    // Inicializa os dados do usuário
    // Mantém a leitura original do contexto Inertia
    import { page } from '@inertiajs/svelte';

    user = page.props?.auth?.master;
    userSettings = page.props?.auth?.userSettings;

    // Estado do menu lateral
    let sidebarCollapsed = $state(false);

    // Estado dos submenus expandidos
    let expandedMenus = $state([]);

    let titleTag  = breadcrumb ?? _("Início")

    // Alterna o menu lateral
    function toggleSidebar() {
        sidebarCollapsed = !sidebarCollapsed;
    }

    // Alterna a abertura do submenu
    function toggleSubMenu(title) {
        if (expandedMenus.includes(title)) {
            expandedMenus = expandedMenus.filter(item => item !== title);
        } else {
            expandedMenus = [...expandedMenus, title];
        }
    }

    // Verifica se algum submenu está ativo
    function hasActiveSubMenu(item) {
        return item.subMenu?.some(sub => sub.title === breadcrumb) ?? false;
    }

    // Estrutura do menu
    const menu = [
        {
            title: _('Visão geral'),
            icone: 'bi-grid-1x2',
            active: true,
            url: '/master/dashboard',
        },
        {
            title: _('Planos'),
            icone: 'bi-award-fill',
            active: true,
            subMenu: [
                {
                    title: _('Planos'),
                    icone: 'bi-award',
                    active: true,
                    url: '/master/plans',
                },
                {
                    title: _('Descrições dos Planos'),
                    icone: 'bi-award',
                    active: true,
                    url: '/master/plans-description',
                },
                {
                    title: _('Funcionalidades dos Planos'),
                    icone: 'bi-award',
                    active: true,
                    url: '/master/plans-features',
                },
                {
                    title: _('Preços dos Planos'),
                    icone: 'bi-award',
                    active: true,
                    url: '/master/plans-prices',
                },
            ],
        },
        {
            title: _('Configurações'),
            icone: 'bi-gear-wide-connected',
            active: true,
            subMenu: [
                {
                    title: _('Idiomas'),
                    icone: 'bi-translate',
                    active: true,
                    url: '/master/languages',
                },
            ],
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

    // Abre automaticamente o submenu da página atual
    $effect(() => {
        const activeMenu = menu.find(item => hasActiveSubMenu(item));
        if (activeMenu && !expandedMenus.includes(activeMenu.title)) {
            expandedMenus = [...expandedMenus, activeMenu.title];
        }
    });
</script>

<svelte:head>
    <title>{titleTag} | Artemis</title>
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

                {#if item.subMenu}

                    <!-- Menu expansível -->
                    <button
                        type="button"
                        class="sidebar-link submenu-toggle"
                        class:active={hasActiveSubMenu(item)}
                        title={sidebarCollapsed ? item.title : undefined}
                        aria-expanded={!sidebarCollapsed && expandedMenus.includes(item.title)}
                        onclick={() => {
                            if (sidebarCollapsed) {
                                sidebarCollapsed = false;

                                if (!expandedMenus.includes(item.title)) {
                                    expandedMenus = [...expandedMenus, item.title];
                                }
                            } else {
                                toggleSubMenu(item.title);
                            }
                        }}
                    >
                        <i class={`bi ${item.icone}`}></i>

                        {#if !sidebarCollapsed}
                            <span class="sidebar-link-title">
                                {item.title}
                            </span>

                            <i class={`bi ms-auto ${
                                expandedMenus.includes(item.title)
                                    ? 'bi-chevron-up'
                                    : 'bi-chevron-down'
                            }`}></i>
                        {/if}
                    </button>

                    <!-- Submenu -->
                    {#if !sidebarCollapsed && expandedMenus.includes(item.title)}
                        <div class="sidebar-submenu">

                            {#each item.subMenu as sub}
                                <Link
                                    href={sub.url}
                                    class={`sidebar-link sidebar-sublink ${
                                        sub.title === breadcrumb ? 'active' : ''
                                    }`}
                                    onclick={sub.active ? undefined : (event) => event.preventDefault()}
                                >
                                    <i class={`bi ${sub.icone}`}></i>

                                    <span class="sidebar-link-title">
                                        {sub.title}
                                    </span>

                                    {#if !sub.active}
                                        <span class="coming-soon">
                                            Em breve
                                        </span>
                                    {/if}
                                </Link>
                            {/each}

                        </div>
                    {/if}

                {:else}

                    <!-- Menu normal -->
                    <Link
                        href={item.url}
                        class={`sidebar-link ${item.title === breadcrumb ? 'active' : ''}`}
                        title={sidebarCollapsed ? item.title : undefined}
                        onclick={item.active ? undefined : (event) => event.preventDefault()}
                    >
                        <i class={`bi ${item.icone}`}></i>

                        {#if !sidebarCollapsed}
                            <span class="sidebar-link-title">
                                {item.title}
                            </span>

                            {#if !item.active}
                                <span class="coming-soon">
                                    Em breve
                                </span>
                            {/if}
                        {/if}
                    </Link>

                {/if}

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
                <SelectorLanguage bind:userSettings={userSettings}/>

                <!-- Dropdown do usuário -->
                <DropdownUser bind:usuario={user}/>

            </div>

        </header>

        <main class="page-content">

            <slot></slot>

            <Footer />

        </main>
    </div>
</div>
