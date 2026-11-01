<script>
    import {_} from "$lib/lang/lang.js";
    import '../../css/landing/landing.css';
    import LanguageDropdonw from "$components/landing/LanguageDropdown.svelte";

</script>
<header class="site-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand brand" href="/" aria-label="{_("Artemis - Início")}">
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
                    aria-label="{_("Abrir menu")}"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="siteNavigation">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="#inicio">{_("Início")}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sobre">{_("Sobre")}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#recursos">{_("Recursos")}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#planos">{_("Planos")}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contato">{_("Contato")}</a>
                        </li>
                        <li class="nav-item language-selector">
                            <LanguageDropdonw />
                        </li>

                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-artemis-outline" href="/login">
                                {_("Entrar")}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>