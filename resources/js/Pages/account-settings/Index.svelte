<script>
    import Layout from "$tamplete/Layout.svelte";
    import Title from "$components/Title/Title.svelte";
    import { onMount } from "svelte";
    import { page } from '@inertiajs/svelte';
    import { getData, postData, getDataParams } from "$lib/api/api.js";
    import Account from "./Components/Account.svelte";
    import Security from "./Components/Security.svelte";
    import BillingPlans from "./Components/BillingPlans.svelte";
    import Notifications from "./Components/Notifications.svelte";
    import Connections from "./Components/Connections.svelte";

    let account = true;
    let security = false;
    let billingPlans = false;
    let notifications = false;
    let connections = false;
    let accountActive = "active";
    let securityActive = "";
    let billingPlansActive = "";
    let notificationsActive = "";
    let connectionsActive = "";

    onMount(() => {
        toggleForm('account');
    });

    function toggleForm(params) {
        switch(params) {
            case 'account':
                account = true;
                security = false;
                billingPlans = false;
                notifications = false;
                connections = false;
                accountActive = "active";
                securityActive = "";
                billingPlansActive = "";
                notificationsActive = "";
                connectionsActive = "";
                break;
            case 'security':
                account = false;
                security = true;
                billingPlans = false;
                notifications = false;
                connections = false;
                securityActive = "active";
                accountActive = "";
                billingPlansActive = "";
                notificationsActive = "";
                connectionsActive = "";
                break;
            case 'billingPlans':
                account = false;
                security = false;
                billingPlans = true;
                notifications = false;
                connections = false;
                securityActive = "";
                accountActive = "";
                billingPlansActive = "active";
                notificationsActive = "";
                connectionsActive = "";
                break;
            case 'notifications':
                account = false;
                security = false;
                billingPlans = false;
                notifications = true;
                connections = false;
                accountActive = "";
                securityActive = "";
                billingPlansActive = "";
                notificationsActive = "active";
                connectionsActive = "";
                break;
            case 'connections':
                account = false;
                security = false;
                billingPlans = false;
                notifications = false;
                connections = true;
                accountActive = "";
                securityActive = "";
                billingPlansActive = "";
                notificationsActive = "";
                connectionsActive = "active";
                break;
        }
    }

    let accountData = {
        
    }

</script>

<Layout>
    <Title title="Account Settings" />
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-align-top">
                        <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-md-0 gap-2">
                            <li class="nav-item">
                                <button class="nav-link {accountActive}" href="#!" on:click={() => toggleForm('account')}>
                                    <i class="icon-base bx bx-user icon-sm me-1_5"></i> Conta</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {securityActive}" href="#!" on:click={() => toggleForm('security')}>
                                    <i class="icon-base bx bx-lock-alt icon-sm me-1_5"></i> Seguranca</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {billingPlansActive}" href="#!" on:click={() => toggleForm('billingPlans')}>
                                    <i class="icon-base bx bx-detail icon-sm me-1_5"></i>  Faturamento & Planos</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {notificationsActive}" href="#!" on:click={() => toggleForm('notifications')}>
                                    <i class="icon-base bx bx-bell icon-sm me-1_5"></i> Notificações</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {connectionsActive}" href="#!" on:click={() => toggleForm('connections')}>
                                    <i class="icon-base bx bx-link-alt icon-sm me-1_5"></i> Conexões</button>
                            </li>
                        </ul>
                    </div> 
                    {#if account}
                        <Account />
                    {:else if security}
                        <Security />
                    {:else if billingPlans}
                        <BillingPlans />
                    {:else if notifications}
                        <Notifications />
                    {:else if connections}
                        <Connections />
                    {/if}
                </div>    
            </div>
        </div>
        <!-- / Content -->
         

</Layout>
