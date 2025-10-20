<script>
    import Language from "./Language.svelte";
    import Quicklinks from "./Quicklinks.svelte";
    import Notification from "./Notification.svelte";
    import User from "./User.svelte";

    export let appUserData;
    export let languageLists;
</script>
<nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="#">
        <i class="icon-base bx bx-menu icon-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
            <!-- Language -->
            <Language {languageLists} {appUserData}/>
            <!--/ Language -->

            <!-- Quick links  -->
            <Quicklinks />
            <!-- Quick links -->

            <!-- Notification -->
            <Notification />
            <!--/ Notification -->

            <!-- User -->
            <User {appUserData}/>
            <!--/ User -->
        </ul>
    </div>
</nav>