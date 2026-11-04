<script>
    import {_} from "$lib/lang/lang.js";
    import { page } from '@inertiajs/svelte';
    import Layout from "$components/landing-master/Layout.svelte";

    let usuario = page.props?.auth?.master;
    let resumo = {
        pacientes: 120,
        exames_pendentes: 35,
        exames_concluidos: 85
    };

</script>

<Layout>
    <!-- Boas-vindas -->
    <section class="welcome-section">
        <div>
            <span class="eyebrow">{_("PAINEL PRINCIPAL")}</span>

            <h1>{_("Olá")}, {usuario.name}!</h1>

            <p>
                {_("Bem-vindo ao Artemis. Acompanhe as informações do seu laboratório em um só lugar.")}
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
                <h2>{_("Resumo do laboratório")}</h2>
                <p>{_("Visão geral dos principais indicadores.")}</p>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-12 col-md-6 col-xl-4">
                <article class="stat-card">
                    <div class="stat-top">
                        <span>{_("Pacientes cadastrados")}</span>

                        <div class="stat-icon icon-blue">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                    </div>

                    <div class="stat-value">
                        {resumo.pacientes}
                    </div>

                    <span class="stat-description">
                        {_("Total de pacientes registrados")}
                    </span>
                </article>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <article class="stat-card">
                    <div class="stat-top">
                        <span>{_("Exames pendentes")}</span>

                        <div class="stat-icon icon-orange">
                            <i class="bi bi-clock-history"></i>
                        </div>
                    </div>

                    <div class="stat-value">
                        {resumo.exames_pendentes}
                    </div>

                    <span class="stat-description">
                        {_("Aguardando processamento")}
                    </span>
                </article>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <article class="stat-card">
                    <div class="stat-top">
                        <span>{_("Exames concluídos")}</span>

                        <div class="stat-icon icon-green">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                    </div>

                    <div class="stat-value">
                        {resumo.exames_concluidos}
                    </div>

                    <span class="stat-description">
                        {_("Exames finalizados")}
                    </span>
                </article>
            </div>

        </div>
    </section>

    <!-- Acesso rápido -->
    <section class="dashboard-section">
        <div class="section-heading">
            <div>
                <h2>{_("Acesso rápido")}</h2>
                <p>{_("(Atalhos para as principais áreas do sistema).")}</p>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-12 col-md-6">
                <article class="shortcut-card">
                    <div class="shortcut-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>

                    <div class="shortcut-content">
                        <h3>{_("Pacientes")}</h3>

                        <p>
                            {_("Área destinada ao cadastro e à consulta de pacientes veterinários.")}
                        </p>

                        <span class="module-status">
                            <i class="bi bi-hourglass-split"></i>
                            {_("Módulo não implementado")}
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
                        <h3>{_("Exames laboratoriais")}</h3>

                        <p>
                            {_("Área destinada à organização e ao acompanhamento dos exames.")}
                        </p>

                        <span class="module-status">
                            <i class="bi bi-hourglass-split"></i>
                            {_("Módulo não implementado")}
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
                        <h3>{_("Resultados")}</h3>

                        <p>
                            {_("Área destinada à consulta dos resultados dos exames laboratoriais.")}
                        </p>

                        <span class="module-status">
                            <i class="bi bi-hourglass-split"></i>
                            {_("Módulo não implementado")}
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
                        <h3>{_("Relatórios")}</h3>

                        <p>
                            {_("Área destinada à visualização de indicadores e relatórios do laboratório.")}
                        </p>

                        <span class="module-status">
                            <i class="bi bi-hourglass-split"></i>
                            {_("Módulo não implementado")}
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
                <h2>{_("Atividades recentes")}</h2>
                <p>{_("Espaço reservado para acompanhar as movimentações.")}</p>
            </div>
        </div>

        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>

            <h3>{_("Nenhuma atividade disponível")}</h3>

            <p>
                {_("Quando os módulos estiverem implementados, as atividades recentes poderão aparecer aqui.")}
            </p>
        </div>
    </section>
</Layout> 