
<script>
    import {_} from "$lib/lang/lang.js";
    import { route } from 'ziggy-js';
    import { crud } from "$lib/crud/crud.js";
    import Layout from "$components/landing-master/Layout.svelte";
    import CollapseAccess from "$master/languages/CollapseAccess.svelte";
    import CollapsePortuguese from "$master/languages/CollapsePortuguese.svelte";
    import CollapseEnglish from "$master/languages/CollapseEnglish.svelte";
    import CollapseSpanish from "$master/languages/CollapseSpanish.svelte";

    let breadcrumb = _("Idiomas");
    let activeCollapse = $state('access');
    const classPrimary = "btn btn-primary";
    const classLight = "btn btn-light";

    function handleCollapseClick(language) {
        activeCollapse = language;
    }
</script>

<Layout breadcrumb={breadcrumb}>
    <section class="dashboard-section">

        <!-- Cabeçalho do módulo -->
        <div class="row g-3">
            <div class="col-12">
                <article class="shortcut-card">

                    <div class="shortcut-icon">
                        <i class="bi bi-translate"></i>
                    </div>

                    <div class="shortcut-content">
                        <h3>{_("Idiomas")}</h3>

                        <p>
                            {_("Área destinada ao geração de traduções para o sistema.")}
                        </p>
                    </div>

                </article>
            </div>
        </div>

        <!-- Navegação dos idiomas -->
        <div class="row g-3 mt-2">
            <div class="col-12">
                <div class="card p-3">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                        <div>
                            <h5 class="mb-1">
                                <i class="bi bi-translate me-2"></i>
                                {_("Gerenciamento de idiomas")}
                            </h5>

                            <small class="text-muted">
                                {_("Selecione um idioma para visualizar suas traduções.")}
                            </small>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">

                        <!-- Acessar JSON -->
                        <button
                            type="button"
                            class={activeCollapse === 'access' ? classPrimary : classLight}
                            onclick={() => handleCollapseClick('access')}
                        >
                            <i class="bi bi-code-square me-1"></i>
                            {_("Acessar JSON")}
                        </button>

                        <!-- Português -->
                        <button
                            type="button"
                            class={activeCollapse === 'portuguese' ? classPrimary : classLight}
                            onclick={() => handleCollapseClick('portuguese')}
                        >
                            <img src="/lang/pt-BR.png" alt="Português" width="20" height="20" class="me-1" />
                            {_("Português")}
                        </button>

                        <!-- Inglês -->
                        <button
                            type="button"
                            class={activeCollapse === 'english' ? classPrimary : classLight}
                            onclick={() => handleCollapseClick('english')}
                        >
                            <img src="/lang/en.png" alt="Inglês" width="20" height="20" class="me-1" />
                            {_("Inglês")}
                        </button>

                        <!-- Espanhol -->
                        <button
                            type="button"
                            class={activeCollapse === 'spanish' ? classPrimary : classLight}
                            onclick={() => handleCollapseClick('spanish')}
                        >
                             <img src="/lang/es.png" alt="Espanhol" width="20" height="20" class="me-1" />
                            {_("Espanhol")}
                        </button>

                    </div>

                </div>
            </div>
        </div>

        <!-- Conteúdo dos idiomas -->
        <div class="row g-3 mt-2">
            <div class="col-12">

                <!-- JSON -->
                <div
                    class:show={activeCollapse === 'access'}
                    class="collapse"
                    id="collapseAccess"
                >
                    <CollapseAccess />
                </div>

                <!-- Português -->
                <div
                    class:show={activeCollapse === 'portuguese'}
                    class="collapse"
                    id="collapsePortuguese"
                >
                    <CollapsePortuguese />
                </div>

                <!-- Inglês -->
                <div
                    class:show={activeCollapse === 'english'}
                    class="collapse"
                    id="collapseEnglish"
                >
                    <CollapseEnglish />
                </div>

                <!-- Espanhol -->
                <div
                    class:show={activeCollapse === 'spanish'}
                    class="collapse"
                    id="collapseSpanish"
                >
                    <CollapseSpanish />
                </div>

            </div>
        </div>

    </section>
</Layout>

<style>
    .btn-primary {
        background-color: #1F70B2;
        border-color: #2E6B8A;
    }

    .btn-primary:hover {
        background-color: #195D95;
        border-color: #195D95;
    }

    .translation-json {
        font-family: monospace;
        font-size: 13px;
        line-height: 1.6;
        resize: vertical;
        background-color: #f8f9fa;
    }
</style>
