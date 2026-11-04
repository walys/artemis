<script>
    import {_} from "$lib/lang/lang.js";
    import "$css/master/login.css";
    import { masterAuthService } from '$lib/services/master/auth.service';
    import { router } from '@inertiajs/svelte';

    let email = '';
    let password = '';
    let loading = false;
    let error = '';

    const urlRedirect = '/master/dashboard';

    async function handleLogin() {
        if (loading) return;

        error = '';
        loading = true;

        try {
            await masterAuthService.login({
                email,
                password,
            });

            await masterAuthService.me();

            router.visit(urlRedirect, {
                replace: true,
            });
        } catch (err) {
            console.error('Erro no login:', err);

            error = _("Não foi possível realizar o acesso. Verifique seu e-mail e sua senha.");
        } finally {
            loading = false;
        }
    }
</script>

<svelte:head>
    <title>Acesso Master | Artemis</title>
    <meta
        name="description"
        content="Acesse o painel administrativo Master da plataforma Artemis."
    />
</svelte:head>

<main class="login-page">
    <div class="login-container">

        <!-- Identidade visual -->
        <section class="brand-panel">

            <div class="brand-header">
                <a href="/" class="brand-logo" aria-label="Artemis">
                    <svg
                        viewBox="0 0 64 64"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                    >
                        <ellipse cx="14" cy="15" rx="6" ry="10" fill="#6BA3C8"/>
                        <ellipse cx="32" cy="10" rx="6" ry="10" fill="#6BA3C8"/>
                        <ellipse cx="50" cy="15" rx="6" ry="10" fill="#6BA3C8"/>
                        <ellipse cx="7" cy="34" rx="6" ry="9" transform="rotate(-35 7 34)" fill="#6BA3C8"/>
                        <ellipse cx="57" cy="34" rx="6" ry="9" transform="rotate(35 57 34)" fill="#6BA3C8"/>
                        <path
                            d="M25 25H39V29H36V39L51 53C53 55 51 59 48 59H16C13 59 11 55 13 53L28 39V29H25V25Z"
                            fill="#2E6B8A"
                        />
                        <path
                            d="M17 52C23 49 27 54 32 52C38 49 42 50 48 54L51 57H13L17 52Z"
                            fill="#6BA3C8"
                        />
                    </svg>

                    <span>Artemis</span>
                </a>

                <span class="brand-version">{_("MASTER · ADMINISTRAÇÃO")}</span>
            </div>

            <div class="brand-content">
                <span class="eyebrow">{_("GESTÃO INTELIGENTE")}</span>

                <h1>
                    {_("Precisão de laboratório")},
                    <span>{_("cuidado veterinário.")}</span>
                </h1>

                <p>
                    {_("Uma plataforma desenvolvida para conectar ciência, tecnologia e gestão laboratorial veterinária.")}
                </p>

                <div class="brand-features">
                    <div class="feature-item">
                        <span class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </span>
                        <div>
                            <strong>{_("Ambiente seguro")}</strong>
                            <small>{_("Acesso administrativo protegido")}</small>
                        </div>
                    </div>

                    <div class="feature-item">
                        <span class="feature-icon">
                            <i class="bi bi-diagram-3"></i>
                        </span>
                        <div>
                            <strong>{_("Gestão centralizada")}</strong>
                            <small>{_("Controle da plataforma")} Artemis</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="brand-footer">
                <span>© {new Date().getFullYear()} Artemis</span>
                <span>{_("Precisão que transforma.")}</span>
            </div>
        </section>

        <!-- Área de autenticação -->
        <section class="form-panel">

            <div class="form-content">

                <div class="mobile-logo">
                    <span>Artemis</span>
                    <small>MASTER</small>
                </div>

                <div class="form-heading">
                    <span class="form-label">{_("ÁREA RESTRITA")}</span>

                    <h2>{_("Bem-vindo de volta!")}</h2>

                    <p>
                        {_("Entre com suas credenciais para acessar o painel administrativo.")}
                    </p>
                </div>

                <form onsubmit={(event) => {
                    event.preventDefault();
                    handleLogin();
                }}>
                    <div class="form-group">
                        <label for="email">E-mail</label>

                        <div class="input-wrapper">
                            <i class="bi bi-envelope"></i>

                            <input
                                id="email"
                                type="email"
                                placeholder={_("seu@email.com")}
                                bind:value={email}
                                autocomplete="username"
                                required
                                disabled={loading}
                            />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>

                        <div class="input-wrapper">
                            <i class="bi bi-lock"></i>

                            <input
                                id="password"
                                type="password"
                                placeholder={_("Digite sua senha")}
                                bind:value={password}
                                autocomplete="current-password"
                                required
                                disabled={loading}
                            />
                        </div>
                    </div>

                    {#if error}
                        <div class="error-message" role="alert">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{error}</span>
                        </div>
                    {/if}

                    <button
                        type="submit"
                        class="login-button"
                        disabled={loading}
                    >
                        {#if loading}
                            <span class="spinner"></span>
                            <span>{_("Autenticando")}...</span>
                        {:else}
                            <span>{_("Acessar painel")}</span>
                            <i class="bi bi-arrow-right"></i>
                        {/if}
                    </button>
                </form>

                <div class="security-note">
                    <i class="bi bi-shield-lock"></i>
                    <span>{_("Ambiente administrativo protegido")}</span>
                </div>
            </div>

            <div class="form-footer">
                <span>{_("Artemis · Gestão Laboratorial Veterinária")}</span>
                <span>{_("v1.0")}</span>
            </div>
        </section>
    </div>
</main>