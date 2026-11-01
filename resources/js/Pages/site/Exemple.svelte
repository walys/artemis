<script>
    let nome = '';
    let email = '';
    let mensagem = '';

    function enviarFormulario(event) {
        event.preventDefault();

        mensagem = `Bootstrap funcionando! Bem-vindo, ${nome}.`;
    }
</script>

<svelte:head>
    <title>Artemis | Identidade Visual</title>
    <meta
        name="description"
        content="Artemis — precisão de laboratório, cuidado veterinário."
    />
</svelte:head>

<div class="artemis-page">
    <div class="container py-5">
        <!-- Cabeçalho -->
        <header class="d-flex justify-content-between align-items-center mb-5">
            <a href="/" class="artemis-brand" aria-label="Artemis - Início">
                <i class="bi bi-droplet-half"></i>
            </a>

            <span class="artemis-version">
                Ambiente de desenvolvimento · v1.0
            </span>
        </header>

        <!-- Apresentação -->
        <section class="row align-items-center g-5 artemis-hero">
            <div class="col-12 col-lg-6">
                <span class="artemis-eyebrow">
                    IDENTIDADE VISUAL
                </span>

                <h1 class="artemis-title mt-3">
                    Precisão de laboratório,
                    <span>cuidado veterinário.</span>
                </h1>

                <p class="artemis-description mt-4">
                    A Artemis une ciência e cuidado animal em uma marca
                    clara, confiável e técnica.
                </p>
            </div>

            <div class="col-12 col-lg-6">
                <div class="artemis-logo-panel">
                    <div class="artemis-logo-symbol">
                        <i class="bi bi-heart-pulse-fill"></i>
                    </div>

                    <span class="artemis-logo-name">Artemis</span>
                </div>
            </div>
        </section>

        <hr class="artemis-divider" />

        <!-- Identidade -->
        <section class="artemis-section">
            <div class="artemis-section-heading">
                <span class="artemis-section-number">01</span>
                <h2>Identidade da marca</h2>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="artemis-logo-showcase">
                        <div class="artemis-logo-symbol">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>

                        <span class="artemis-logo-name">Artemis</span>
                    </div>

                    <p class="artemis-caption mt-3">
                        Uma identidade que representa ciência, precisão
                        e cuidado com a saúde animal.
                    </p>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="artemis-symbol-showcase">
                        <i class="bi bi-heart-pulse-fill"></i>
                    </div>

                    <p class="artemis-caption mt-3">
                        Símbolo para espaços reduzidos e elementos de navegação.
                    </p>
                </div>
            </div>
        </section>

        <hr class="artemis-divider" />

        <!-- Paleta de cores -->
        <section class="artemis-section">
            <div class="artemis-section-heading">
                <span class="artemis-section-number">02</span>
                <h2>Paleta de cores</h2>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-xl-5 g-3">
                <div class="col">
                    <article class="artemis-color-card">
                        <div class="artemis-color-preview frost"></div>

                        <div class="artemis-color-info">
                            <strong>Frost</strong>
                            <code>#E8F0F8</code>
                            <span>Fundos e superfícies</span>
                        </div>
                    </article>
                </div>

                <div class="col">
                    <article class="artemis-color-card">
                        <div class="artemis-color-preview mist"></div>

                        <div class="artemis-color-info">
                            <strong>Mist</strong>
                            <code>#B8D4E8</code>
                            <span>Destaques suaves</span>
                        </div>
                    </article>
                </div>

                <div class="col">
                    <article class="artemis-color-card">
                        <div class="artemis-color-preview sky"></div>

                        <div class="artemis-color-info">
                            <strong>Sky</strong>
                            <code>#6BA3C8</code>
                            <span>Elementos secundários</span>
                        </div>
                    </article>
                </div>

                <div class="col">
                    <article class="artemis-color-card">
                        <div class="artemis-color-preview steel">
                            <strong>Steel</strong>
                        </div>

                        <div class="artemis-color-info">
                            <strong>Steel</strong>
                            <code>#2E6B8A</code>
                            <span>Cor principal e ações</span>
                        </div>
                    </article>
                </div>

                <div class="col">
                    <article class="artemis-color-card">
                        <div class="artemis-color-preview ink">
                            <strong>Ink</strong>
                        </div>

                        <div class="artemis-color-info">
                            <strong>Ink</strong>
                            <code>#1F3442</code>
                            <span>Textos e títulos</span>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <hr class="artemis-divider" />

        <!-- Componentes Bootstrap -->
        <section class="artemis-section">
            <div class="artemis-section-heading">
                <span class="artemis-section-number">03</span>
                <h2>Componentes da interface</h2>
            </div>

            <p class="artemis-description mb-4">
                Elementos que servirão de base para as telas administrativas.
            </p>

            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="artemis-demo-card">
                        <h3>Botões</h3>

                        <p class="artemis-caption">
                            Ações principais e secundárias.
                        </p>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button class="btn btn-artemis" type="button">
                                <i class="bi bi-plus-lg me-2"></i>
                                Nova ação
                            </button>

                            <button class="btn btn-artemis-outline" type="button">
                                Ação secundária
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="artemis-demo-card">
                        <h3>Status</h3>

                        <p class="artemis-caption">
                            Indicadores de situações do sistema.
                        </p>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <span class="badge artemis-badge-success">
                                <i class="bi bi-check-circle me-1"></i>
                                Concluído
                            </span>

                            <span class="badge artemis-badge-pending">
                                <i class="bi bi-clock me-1"></i>
                                Em análise
                            </span>

                            <span class="badge artemis-badge-neutral">
                                Pendente
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="artemis-demo-card">
                        <h3>Formulários</h3>

                        <p class="artemis-caption mb-4">
                            Campos com espaçamento e contraste consistentes.
                        </p>

                        <form onsubmit={enviarFormulario}>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="nome" class="form-label">
                                        Nome
                                    </label>

                                    <input
                                        id="nome"
                                        class="form-control artemis-input"
                                        type="text"
                                        bind:value={nome}
                                        placeholder="Digite seu nome"
                                        required
                                    />
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">
                                        E-mail
                                    </label>

                                    <input
                                        id="email"
                                        class="form-control artemis-input"
                                        type="email"
                                        bind:value={email}
                                        placeholder="seu@email.com"
                                        required
                                    />
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-artemis" type="submit">
                                        Testar formulário
                                    </button>
                                </div>
                            </div>
                        </form>

                        {#if mensagem}
                            <div
                                class="alert alert-success mt-3 mb-0"
                                role="status"
                            >
                                {mensagem}
                            </div>
                        {/if}
                    </div>
                </div>

                <div class="col-12">
                    <div class="artemis-demo-card">
                        <h3>Menu interativo</h3>

                        <p class="artemis-caption mb-3">
                            Teste do JavaScript do Bootstrap.
                        </p>

                        <div class="dropdown">
                            <button
                                class="btn btn-artemis-outline dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Opções do sistema
                            </button>

                            <ul class="dropdown-menu">
                                <li>
                                    <button class="dropdown-item" type="button">
                                        Configurações
                                    </button>
                                </li>

                                <li>
                                    <button class="dropdown-item" type="button">
                                        Meu perfil
                                    </button>
                                </li>

                                <li>
                                    <hr class="dropdown-divider" />
                                </li>

                                <li>
                                    <button class="dropdown-item" type="button">
                                        Ajuda
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="artemis-footer">
            <span>Artemis</span>
            <span>Precisão de laboratório, cuidado veterinário.</span>
        </footer>
    </div>
</div>

<style>
    :global(body) {
        margin: 0;
        background: #e8f0f8;
        color: #1f3442;
        font-family: Arial, Helvetica, sans-serif;
    }

    :global(*) {
        box-sizing: border-box;
    }

    .artemis-page {
        min-height: 100vh;
        background: #f7fafc;
    }

    .artemis-brand {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #2e6b8a;
        font-size: 2rem;
        text-decoration: none;
    }

    .artemis-version {
        color: #63798a;
        font-size: 0.8rem;
    }

    .artemis-hero {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .artemis-eyebrow {
        color: #2e6b8a;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.2em;
    }

    .artemis-title {
        max-width: 650px;
        color: #1f3442;
        font-size: clamp(2.5rem, 5vw, 4.3rem);
        font-weight: 750;
        letter-spacing: -0.055em;
        line-height: 1.12;
    }

    .artemis-title span {
        display: block;
        color: #6ba3c8;
    }

    .artemis-description {
        max-width: 520px;
        color: #63798a;
        font-size: 1rem;
        line-height: 1.8;
    }

    .artemis-logo-panel {
        display: flex;
        min-height: 220px;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        padding: 2rem;
        border-radius: 24px;
        background: #e8f0f8;
    }

    .artemis-logo-symbol {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2e6b8a;
        font-size: 3.8rem;
    }

    .artemis-logo-name {
        color: #2e6b8a;
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        font-weight: 400;
        letter-spacing: -0.04em;
    }

    .artemis-divider {
        margin: 2.5rem 0 3.5rem;
        border-color: #d5e3ed;
        opacity: 1;
    }

    .artemis-section {
        margin-bottom: 3.5rem;
    }

    .artemis-section-heading {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .artemis-section-number {
        color: #6ba3c8;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .artemis-section-heading h2 {
        margin: 0;
        color: #1f3442;
        font-size: 1.65rem;
        font-weight: 700;
        letter-spacing: -0.035em;
    }

    .artemis-logo-showcase,
    .artemis-symbol-showcase {
        display: flex;
        min-height: 270px;
        align-items: center;
        justify-content: center;
        border: 1px solid #d5e3ed;
        border-radius: 20px;
    }

    .artemis-logo-showcase {
        gap: 0.75rem;
        background: #fff;
    }

    .artemis-symbol-showcase {
        background: #e8f0f8;
        color: #2e6b8a;
        font-size: 5rem;
    }

    .artemis-caption {
        color: #63798a;
        font-size: 0.88rem;
        line-height: 1.7;
    }

    .artemis-color-card {
        overflow: hidden;
        height: 100%;
        border: 1px solid #d5e3ed;
        border-radius: 17px;
        background: #fff;
    }

    .artemis-color-preview {
        display: flex;
        min-height: 125px;
        align-items: flex-end;
        padding: 0.85rem;
    }

    .artemis-color-preview strong {
        font-size: 0.9rem;
    }

    .frost {
        background: #e8f0f8;
        color: #1f3442;
    }

    .mist {
        background: #b8d4e8;
        color: #1f3442;
    }

    .sky {
        background: #6ba3c8;
        color: #1f3442;
    }

    .steel {
        background: #2e6b8a;
        color: #fff;
    }

    .ink {
        background: #1f3442;
        color: #fff;
    }

    .artemis-color-info {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        padding: 0.85rem;
    }

    .artemis-color-info strong {
        color: #1f3442;
        font-size: 0.88rem;
    }

    .artemis-color-info code {
        color: #2e6b8a;
        font-size: 0.78rem;
    }

    .artemis-color-info span {
        color: #63798a;
        font-size: 0.75rem;
        line-height: 1.5;
    }

    .artemis-demo-card {
        height: 100%;
        padding: 1.75rem;
        border: 1px solid #d5e3ed;
        border-radius: 18px;
        background: #fff;
    }

    .artemis-demo-card h3 {
        color: #1f3442;
        font-size: 1.1rem;
        font-weight: 700;
    }

    .btn-artemis {
        border: 1px solid #2e6b8a;
        background: #2e6b8a;
        color: #fff;
    }

    .btn-artemis:hover,
    .btn-artemis:focus-visible {
        border-color: #1f526b;
        background: #1f526b;
        color: #fff;
    }

    .btn-artemis-outline {
        border: 1px solid #2e6b8a;
        background: transparent;
        color: #2e6b8a;
    }

    .btn-artemis-outline:hover,
    .btn-artemis-outline:focus-visible {
        background: #e8f0f8;
        color: #1f526b;
    }

    .artemis-badge-success {
        background: #e2f3e9;
        color: #216b45;
    }

    .artemis-badge-pending {
        background: #fff0d7;
        color: #865b12;
    }

    .artemis-badge-neutral {
        background: #e8f0f8;
        color: #1f3442;
    }

    .artemis-input {
        min-height: 45px;
        border-color: #d5e3ed;
        border-radius: 9px;
    }

    .artemis-input:focus {
        border-color: #6ba3c8;
        box-shadow: 0 0 0 0.2rem rgb(107 163 200 / 20%);
    }

    .artemis-footer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.5rem 0;
        border-top: 1px solid #d5e3ed;
        color: #63798a;
        font-size: 0.82rem;
    }

    .artemis-footer span:first-child {
        color: #2e6b8a;
        font-weight: 700;
    }

    @media (max-width: 575.98px) {
        .artemis-logo-panel {
            min-height: 170px;
            gap: 0.5rem;
            padding: 1rem;
        }

        .artemis-logo-symbol {
            font-size: 2.7rem;
        }

        .artemis-logo-name {
            font-size: 2.5rem;
        }

        .artemis-logo-showcase,
        .artemis-symbol-showcase {
            min-height: 200px;
        }

        .artemis-demo-card {
            padding: 1.25rem;
        }
    }
</style>