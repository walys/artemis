<script>
    import '../../css/landing/landing.css';
    let idiomaSelecionado = 'pt-BR';
    let idiomaMenuAberto = false;
</script>
<header class="site-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand brand" href="/" aria-label="Artemis - Início">
                    <span class="brand-icon">
                        <i class="bi bi-heart-pulse-fill"></i>
                    </span>
                    <span>Artemis</span>
                </a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#siteNavigation"
                    aria-controls="siteNavigation"
                    aria-expanded="false"
                    aria-label="Abrir menu"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="siteNavigation">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="#inicio">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sobre">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#recursos">Recursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#planos">Planos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contato">Contato</a>
                        </li>
                        <li class="nav-item language-selector">
                            <div class="language-dropdown">
                                <button
                                    type="button"
                                    class="language-dropdown-toggle"
                                    aria-label="Selecionar idioma"
                                    aria-haspopup="true"
                                    aria-expanded={idiomaMenuAberto}
                                    onclick={() => (idiomaMenuAberto = !idiomaMenuAberto)}
                                >
                                    {#if idiomaSelecionado === 'pt-BR'}
                                        <img src="/lang/pt-BR.png" alt="" width="20" height="20" />
                                        <span>Português</span>
                                    {:else if idiomaSelecionado === 'en'}
                                        <img src="/lang/en.png" alt="" width="20" height="20" />
                                        <span>English</span>
                                    {:else}
                                        <img src="/lang/es.png" alt="" width="20" height="20" />
                                        <span>Español</span>
                                    {/if}

                                    <i class={`bi ${idiomaMenuAberto ? 'bi-chevron-up' : 'bi-chevron-down'}`}></i>
                                </button>

                                {#if idiomaMenuAberto}
                                    <div class="language-dropdown-menu" role="menu">
                                        <button
                                            type="button"
                                            class="language-dropdown-item"
                                            class:active={idiomaSelecionado === 'pt-BR'}
                                            role="menuitem"
                                            onclick={() => {
                                                idiomaSelecionado = 'pt-BR';
                                                idiomaMenuAberto = false;
                                            }}
                                        >
                                            <img src="/lang/pt-BR.png" alt="" width="20" height="20" />
                                            <span>Português</span>
                                            {#if idiomaSelecionado === 'pt-BR'}
                                                <i class="bi bi-check2 ms-auto"></i>
                                            {/if}
                                        </button>

                                        <button
                                            type="button"
                                            class="language-dropdown-item"
                                            class:active={idiomaSelecionado === 'en'}
                                            role="menuitem"
                                            onclick={() => {
                                                idiomaSelecionado = 'en';
                                                idiomaMenuAberto = false;
                                            }}
                                        >
                                            <img src="/lang/en.png" alt="" width="20" height="20" />
                                            <span>English</span>
                                            {#if idiomaSelecionado === 'en'}
                                                <i class="bi bi-check2 ms-auto"></i>
                                            {/if}
                                        </button>

                                        <button
                                            type="button"
                                            class="language-dropdown-item"
                                            class:active={idiomaSelecionado === 'es'}
                                            role="menuitem"
                                            onclick={() => {
                                                idiomaSelecionado = 'es';
                                                idiomaMenuAberto = false;
                                            }}
                                        >
                                            <img src="/lang/es.png" alt="" width="20" height="20" />
                                            <span>Español</span>
                                            {#if idiomaSelecionado === 'es'}
                                                <i class="bi bi-check2 ms-auto"></i>
                                            {/if}
                                        </button>
                                    </div>
                                {/if}
                            </div>
                        </li>

                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-artemis-outline" href="/login">
                                Entrar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>