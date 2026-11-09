<script>
    import { _ } from '$lib/lang/lang.js';
    import { router } from '@inertiajs/svelte';
    import { masterAuthService } from '$lib/services/master/auth.service.js';

    let { usuario } = $props();

    let resumo = {
        pacientes: 120,
        exames_pendentes: 35,
        exames_concluidos: 85
    };

    let userMenuOpen = $state(false);
    let loggingOut = $state(false);

    /**
     * Encerra a sessão do usuário Master.
     */
    async function logout() {
        if (loggingOut) return;

        loggingOut = true;

        try {
            await masterAuthService.logout();

            userMenuOpen = false;

            router.visit('/master/login', {
                replace: true,
            });

        } catch (error) {
            console.error('Erro ao realizar logout:', error);

            loggingOut = false;
        }
    }
</script>

<div class="user-dropdown">
    <button
        type="button"
        class="user-area"
        onclick={() => {
            userMenuOpen = !userMenuOpen;
            idiomaMenuAberto = false;
        }}
        aria-expanded={userMenuOpen}
        aria-label={_('Abrir menu do usuário')}
    >
        <img
            src="/images/users/default-avatar.png"
            alt="Foto do usuário"
            class="user-avatar"
        />

        <div class="user-info">
            <strong>{usuario.nome}</strong>
            <span>{_('Usuário do sistema')}</span>
        </div>

        <i
            class={`bi ${userMenuOpen ? 'bi-chevron-up' : 'bi-chevron-down'} user-chevron`}
        ></i>
    </button>

    {#if userMenuOpen}
        <div class="user-menu">
            <div class="user-menu-header">
                <strong>{usuario.nome}</strong>
                <span>{usuario.email}</span>
            </div>

            <div class="user-menu-divider"></div>

            <button type="button" class="user-menu-item">
                <i class="bi bi-person-circle"></i>
                <span>{_("Meu perfil")}</span>
            </button>

            <button type="button" class="user-menu-item">
                <i class="bi bi-gear"></i>
                <span>{_("Configurações")}</span>
            </button>

            <button type="button" class="user-menu-item">
                <i class="bi bi-shield-lock"></i>
                <span>{_("Segurança")}</span>
            </button>

            <div class="user-menu-divider"></div>

            <button
                type="button"
                class="user-menu-item logout"
                onclick={logout}
                disabled={loggingOut}
            >
                <i class="bi bi-box-arrow-right"></i>

                <span>
                    {loggingOut ? _("Saindo...") : _("Sair")}
                </span>
            </button>
        </div>
    {/if}
</div>