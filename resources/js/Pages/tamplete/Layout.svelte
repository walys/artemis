<script>
    import {_} from "$lib/lang/lang.js";
    import { onMount, afterUpdate } from "svelte";
    import { getData } from "$lib/api/api.js";
    import Navbar from "./Components/Navbar.svelte";
    import Footer from "./Components/Footer.svelte";
    import { page } from '@inertiajs/svelte';

    export let apiUrl = $page.props.app?.apiUrl; // URL base da API 'http://app.artemis.localhost/api/V1'
    export let appUserData = {};
    export let title;
    export let subtitle;
    let menuOpen = false;
    let users = {};
    let endpoint = apiUrl + "/autenticated"; // Endpoint para obter o usuário autenticado 'http://app.artemis.localhost/api/v1/autenticated'
    let endPointLanguages = apiUrl + "/languages";
    let languageLists = [];
    let lang = 'pt-BR';
    let loading = true;
     // Adicione estas variáveis
    let loadingProgress = 0;
    let loadingInterval;

    function toggleMenu() {
        menuOpen = !menuOpen;
    }

    function logout() {
        localStorage.clear();
        window.location.href = "/logout";
    }

    async function handleAutenticated() {
        const token = localStorage.getItem("token");
        try {
            const response = await getData(endpoint, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });

            lang = response.language.code;
            localStorage.setItem("lang", String(lang));
            appUserData = response;
            // console.log("Usuário autenticado:", appUserData);
        } catch (error) {
            localStorage.setItem('lang', lang);
            console.log("Erro ao obter usuário autenticado:", error);
        }
    }

    async function handleLanguage() {
        try {
            getData(endPointLanguages).then((response) => {
                languageLists = response;
            });
        } catch (error) {
            console.log("Error Lista de Linguagens:", error);   
        }
    }

    onMount(async () => {
        // Inicia a barra de progresso
        // loadingInterval = setInterval(() => {
        //     if (loadingProgress < 90) {
        //         // loadingProgress += Math.random() * 15;
        //         loadingProgress = Math.floor(loadingProgress + Math.random() * 15);
        //     }
        // }, 200);

        // Carregar na ordem correta
        await import('../../../../public/sneat/assets/vendor/js/menu.js');
        await import('../../../../public/sneat/assets/js/main.js');
        
        await handleAutenticated();
        await handleLanguage();
        
        // setTimeout(() => {
        //     loadingProgress = 100;
        //     clearInterval(loadingInterval);
            
        //     setTimeout(() => {
        //         loading = true;
        //         handleAutenticated();
        //         handleLanguage();
        //     }, 500);
        // }, 5000);
    });
</script>

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href={"/sneat/logo/log_sf.png"} />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

<link rel="stylesheet" href="/sneat/assets/vendor/fonts/iconify-icons.css" />

<!-- Core CSS -->
<!-- build:css assets/vendor/css/theme.css  -->

<link rel="stylesheet" href="/sneat/assets/vendor/css/core.css" />
<link rel="stylesheet" href="/sneat/assets/css/demo.css" />

<!-- Vendors CSS -->

<link rel="stylesheet" href="/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

<!-- endbuild -->

<link rel="stylesheet" href="/sneat/assets/vendor/libs/apex-charts/apex-charts.css" />
{#if loading}
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="touch-action: none; user-select: none;">
                <div class="app-brand demo">
                    <a href="/dashboard" class="app-brand-link">
                        <div class="mb-0 d-flex justify-content-center">
                            <img
                                src={"/sneat/logo/logo_name_sf.png"}
                                style="border-radius: 40%; width: 70%;"
                                alt="Logo"
                                class="img-fluid mb-2"
                            />
                        </div>
                        <!-- <span class="app-brand-text demo menu-text fw-bold ms-2">Artemis</span> -->
                    </a>
                    <a href="#" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
                    </a>
                </div>

                <div class="menu-divider mt-0"></div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item active open">
                        <a on:click={toggleMenu} href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-home-smile"></i>
                        <div class="text-truncate" data-i18n="Dashboards">{_("Dashboards")}</div>
                        <span class="badge rounded-pill bg-danger ms-auto">5</span>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item active">
                                <a href="/dashboard" class="menu-link">
                                <div class="text-truncate" data-i18n="Analytics">Analytics</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a
                                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/dashboards-crm.html"
                                target="_blank"
                                class="menu-link">
                                <div class="text-truncate" data-i18n="CRM">CRM</div>
                                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a
                                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-ecommerce-dashboard.html"
                                target="_blank"
                                class="menu-link">
                                <div class="text-truncate" data-i18n="eCommerce">eCommerce</div>
                                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a
                                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-logistics-dashboard.html"
                                target="_blank"
                                class="menu-link">
                                <div class="text-truncate" data-i18n="Logistics">Logistics</div>
                                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a
                                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-academy-dashboard.html"
                                target="_blank"
                                class="menu-link">
                                <div class="text-truncate" data-i18n="Academy">Academy</div>
                                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Layouts -->
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-layout"></i>
                        <div class="text-truncate" data-i18n="Layouts">Layouts</div>
                        </a>

                        <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="layouts-without-menu.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Without menu">Without menu</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-without-navbar.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Without navbar">Without navbar</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-fluid.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Fluid">Fluid</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-container.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Container">Container</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="layouts-blank.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Blank">Blank</div>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- Front Pages -->
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-store"></i>
                        <div class="text-truncate" data-i18n="Front Pages">Front Pages</div>
                        <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                        </a>
                        <ul class="menu-sub">
                        <li class="menu-item">
                            <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/landing-page.html"
                            class="menu-link"
                            target="_blank">
                            <div class="text-truncate" data-i18n="Landing">Landing</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/pricing-page.html"
                            class="menu-link"
                            target="_blank">
                            <div class="text-truncate" data-i18n="Pricing">Pricing</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/payment-page.html"
                            class="menu-link"
                            target="_blank">
                            <div class="text-truncate" data-i18n="Payment">Payment</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/checkout-page.html"
                            class="menu-link"
                            target="_blank">
                            <div class="text-truncate" data-i18n="Checkout">Checkout</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/help-center-landing.html"
                            class="menu-link"
                            target="_blank">
                            <div class="text-truncate" data-i18n="Help Center">Help Center</div>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- Apps & Pages -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Apps &amp; Pages</span>
                    </li>

                    <li class="menu-item">
                        <a
                        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-email.html"
                        target="_blank"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-envelope"></i>
                        <div class="text-truncate" data-i18n="Email">Email</div>
                        <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a
                        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-chat.html"
                        target="_blank"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-chat"></i>
                        <div class="text-truncate" data-i18n="Chat">Chat</div>
                        <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a
                        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-calendar.html"
                        target="_blank"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar"></i>
                        <div class="text-truncate" data-i18n="Calendar">Calendar</div>
                        <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a
                        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-kanban.html"
                        target="_blank"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-grid"></i>
                        <div class="text-truncate" data-i18n="Kanban">Kanban</div>
                        <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                        </a>
                    </li>

                    <!-- Pages -->
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-dock-top"></i>
                        <div class="text-truncate" data-i18n="Account Settings">Account Settings</div>
                        </a>
                        <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="pages-account-settings-account.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Account">Account</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-account-settings-notifications.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Notifications">Notifications</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-account-settings-connections.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Connections">Connections</div>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                        <div class="text-truncate" data-i18n="Authentications">Authentications</div>
                        </a>
                        <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="auth-login-basic.html" class="menu-link" target="_blank">
                            <div class="text-truncate" data-i18n="Basic">Login</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-register-basic.html" class="menu-link" target="_blank">
                            <div class="text-truncate" data-i18n="Basic">Register</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                            <div class="text-truncate" data-i18n="Basic">Forgot Password</div>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                        <div class="text-truncate" data-i18n="Misc">Misc</div>
                        </a>
                        <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="pages-misc-error.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Error">Error</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-misc-under-maintenance.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Under Maintenance">Under Maintenance</div>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- Components -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
                    <!-- Cards -->
                    <li class="menu-item">
                        <a href="cards-basic.html" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-collection"></i>
                        <div class="text-truncate" data-i18n="Basic">Cards</div>
                        </a>
                    </li>
                    <!-- User interface -->
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-box"></i>
                        <div class="text-truncate" data-i18n="User interface">User interface</div>
                        </a>
                        <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="ui-accordion.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Accordion">Accordion</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-alerts.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Alerts">Alerts</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-badges.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Badges">Badges</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-buttons.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Buttons">Buttons</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-carousel.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Carousel">Carousel</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-collapse.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Collapse">Collapse</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-dropdowns.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Dropdowns">Dropdowns</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-footer.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Footer">Footer</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-list-groups.html" class="menu-link">
                            <div class="text-truncate" data-i18n="List Groups">List groups</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-modals.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Modals">Modals</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-navbar.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Navbar">Navbar</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-offcanvas.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Offcanvas">Offcanvas</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-pagination-breadcrumbs.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Pagination & Breadcrumbs">Pagination &amp; Breadcrumbs</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-progress.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Progress">Progress</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-spinners.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Spinners">Spinners</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-tabs-pills.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Tabs & Pills">Tabs &amp; Pills</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-toasts.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Toasts">Toasts</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-tooltips-popovers.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Tooltips & Popovers">Tooltips &amp; Popovers</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="ui-typography.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Typography">Typography</div>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- Extended components -->
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-copy"></i>
                        <div class="text-truncate" data-i18n="Extended UI">Extended UI</div>
                        </a>
                        <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Perfect Scrollbar">Perfect Scrollbar</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="extended-ui-text-divider.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Text Divider">Text Divider</div>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="icons-boxicons.html" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-crown"></i>
                        <div class="text-truncate" data-i18n="Boxicons">Boxicons</div>
                        </a>
                    </li>

                    <!-- Forms & Tables -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp; Tables</span></li>
                    <!-- Forms -->
                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div class="text-truncate" data-i18n="Form Elements">Form Elements</div>
                        </a>
                        <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="forms-basic-inputs.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Basic Inputs">Basic Inputs</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="forms-input-groups.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Input groups">Input groups</div>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div class="text-truncate" data-i18n="Form Layouts">Form Layouts</div>
                        </a>
                        <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="form-layouts-vertical.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Vertical Form">Vertical Form</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="form-layouts-horizontal.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Horizontal Form">Horizontal Form</div>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- Form Validation -->
                    <li class="menu-item">
                        <a
                        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/form-validation.html"
                        target="_blank"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-list-check"></i>
                        <div class="text-truncate" data-i18n="Form Validation">Form Validation</div>
                        <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                        </a>
                    </li>

                    <!-- Tables -->
                    <li class="menu-item">
                        <a href="tables-basic.html" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-table"></i>
                        <div class="text-truncate" data-i18n="Tables">Tables</div>
                        </a>
                    </li>

                    <!-- Data Tables -->
                    <li class="menu-item">
                        <a
                        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/tables-datatables-basic.html"
                        target="_blank"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-grid"></i>
                        <div class="text-truncate" data-i18n="Datatables">Datatables</div>
                        <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                        </a>
                    </li>
                    <!-- Misc -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>

                    <li class="menu-item">
                        <a
                        href="https://github.com/themeselection/sneat-bootstrap-html-admin-template-free/issues"
                        target="_blank"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div class="text-truncate" data-i18n="Support">Support</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a
                        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                        target="_blank"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-file"></i>
                        <div class="text-truncate" data-i18n="Documentation">Documentation</div>
                        </a>
                    </li>

                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <Navbar {appUserData} {languageLists}/>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <slot></slot>
                    <!-- Footer -->
                    <Footer />
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
{:else}
    <!-- Tela de Loading -->
    <div class="loading-screen">
        <div class="loading-container">
            <div class="loading-logo">
                <img 
                    src="/sneat/logo/logo_name_sf.png" 
                    alt="Logo" 
                    class="logo-spin"
                />
            </div>
            
            <div class="loading-text">
                <h3>Artemis</h3>
                <p>{_("Carregando sistema")}...</p>
            </div>
            
            <div class="progress-container">
                <div class="progress-bar">
                    <div 
                        class="progress-fill" 
                        style={`width: ${loadingProgress}%`}
                    ></div>
                </div>
                <span class="progress-text">{loadingProgress}%</span>
            </div>
            
            <div class="spinner"></div>
        </div>
    </div>
{/if}
<svelte:head>
  <!-- Helpers -->
  <script src="/sneat/assets/vendor/js/helpers.js"></script>
  
  <!-- Config -->
  <!-- <script src="/sneat/assets/js/config.js"></script> -->

  <!-- Core JS -->
  <script src="/sneat/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="/sneat/assets/vendor/libs/popper/popper.js"></script>
  <script src="/sneat/assets/vendor/js/bootstrap.js"></script>
  <script src="/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <!-- Outros scripts... -->
   <script src="/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
   <script src="/sneat/assets/vendor/libs/apex-charts/apexcharts.js"></script>
   <script src="/sneat/assets/js/dashboards-analytics.js"></script>
   <script async defer src="https://buttons.github.io/buttons.js"></script>
</svelte:head>
<style>
    /* Tela de Loading */
    .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        font-family: 'Public Sans', sans-serif;
    }

    .loading-container {
        text-align: center;
        color: white;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .loading-logo {
        margin-bottom: 2rem;
    }

    .loading-logo img {
        /* width: 190px; */
        height: 190px;
        border-radius: 0%;
        object-fit: cover;
        animation: pulse 2s infinite ease-in-out;
    }

    /* Animação do logo */
    .logo-spin {
        animation: spinAndPulse 3s infinite ease-in-out;
    }

    .loading-text h3 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
        background: linear-gradient(45deg, #fff, #f0f0f0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .loading-text p {
        font-size: 1.1rem;
        opacity: 0.8;
        margin-bottom: 2rem;
    }

    /* Barra de progresso */
    .progress-container {
        width: 300px;
        margin: 0 auto 2rem;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
        border-radius: 10px;
        transition: width 0.3s ease;
        animation: shimmer 2s infinite;
    }

    .progress-text {
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Spinner alternativo */
    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    /* Animações */
    @keyframes spinAndPulse {
        0% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
        50% {
            transform: scale(1.1) rotate(180deg);
            opacity: 0.8;
        }
        100% {
            transform: scale(1) rotate(360deg);
            opacity: 1;
        }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes shimmer {
        0% { background-position: -200px 0; }
        100% { background-position: 200px 0; }
    }

    /* Responsivo */
    @media (max-width: 768px) {
        .loading-container {
            padding: 1.5rem;
            margin: 1rem;
        }

        .loading-logo img {
            width: 100px;
            height: 100px;
        }

        .loading-text h3 {
            font-size: 2rem;
        }

        .progress-container {
            width: 250px;
        }
    }

    /* Garante que os submenus funcionem */
    .menu-sub {
        display: none;
    }
    
    .menu-item.active.open .menu-sub {
        display: block;
    }
    
    /* Remove qualquer estilo que possa estar conflitando */
    .layout-menu .menu-item.active > .menu-link {
        background: rgba(255, 255, 255, 0.1);
    }
</style>