<script>
    import {_} from "$lib/lang/lang.js";
    import Layout from "$tamplete/Layout.svelte";
    import Title from "$components/Title/Title.svelte";
    import { onMount } from "svelte";
    import { page } from '@inertiajs/svelte';
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
    let userDataForma = {
        name: $page.props?.userAccount?.name,
        email: $page.props?.userAccount?.email,
        celular: $page.props?.userAccount?.celular,
        cpf: $page.props?.userAccount?.cpf, 
        foto: $page.props?.userAccount?.foto, 
        email_verified_at: $page.props?.userAccount?.email_verified_at,
        remember_token: $page.props?.userAccount?.remember_token, 
        created_at: $page.props?.userAccount?.created_at, 
        updated_at: $page.props?.userAccount?.updated_at, 
        company_id: $page.props?.userAccount?.company_id, 
        birthday: $page.props?.userAccount?.birthday,
        delete_at: $page.props?.userAccount?.delete_at,
        country_id: $page.props?.userAccount?.country_id,
        language_id: $page.props?.userAccount?.language_id,
        biography: $page.props?.userAccount?.biography,
        phone_mobile: $page.props?.userAccount?.phone_mobile,
        profile_url: $page.props?.userAccount?.profile_url,
        country: {
            value: $page.props?.userAccount?.country.id,
            label: $page.props?.userAccount?.country.name
        }
    }

    onMount(() => {
        toggleForm('account');
        console.log('userDataForma', userDataForma);
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
    <Title title="{_("Configurações da Conta")}" />
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-align-top">
                        <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-md-0 gap-2">
                            <li class="nav-item">
                                <button class="nav-link {accountActive}" href="#!" on:click={() => toggleForm('account')}>
                                    <i class="icon-base bx bx-user icon-sm me-1_5"></i> {_("Conta")}</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {securityActive}" href="#!" on:click={() => toggleForm('security')}>
                                    <i class="icon-base bx bx-lock-alt icon-sm me-1_5"></i> {_("Segurança")}</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {billingPlansActive}" href="#!" on:click={() => toggleForm('billingPlans')}>
                                    <i class="icon-base bx bx-detail icon-sm me-1_5"></i>  {_("Faturamento & Planos")}</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {notificationsActive}" href="#!" on:click={() => toggleForm('notifications')}>
                                    <i class="icon-base bx bx-bell icon-sm me-1_5"></i> {_("Notificações")}</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {connectionsActive}" href="#!" on:click={() => toggleForm('connections')}>
                                    <i class="icon-base bx bx-link-alt icon-sm me-1_5"></i> {_("Conexões")}</button>
                            </li>
                        </ul>
                    </div> 
                    <div class="card mb-6">
                        {#if account}
                            <Account {userDataForma}/>
                        {:else if security}
                            <Security />
                        {:else if billingPlans}
                            <BillingPlans />
                        {:else if notifications}
                            <Notifications />
                        {:else if connections}
                            <Connections />
                        {/if}
                        <hr/>
                        <div class="card-body pt-4">
                            <div class="mt-6">
                                <button type="submit" class="btn btn-primary me-3">{_("Salvar Alterações")}</button>
                                <button type="reset" class="btn btn-secondary">{_("Cancelar")}</button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <!-- / Content -->
         

</Layout>
