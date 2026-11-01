
<script>
    import '../../../css/landing/landing.css'; 
    import { masterAuthService } from '$lib/services/master/auth.service';

    let email = ''
    let password = ''
    let loading = false;
    let error = '';
    let urlRedirect = '/master/dashboard'; // URL de redirecionamento após o login bem-sucedido

    async function handleLogin() {
        error = '';
        loading = true;

        try {
            const response = await masterAuthService.login({
                email,
                password,
            });

            console.log('Login realizado:', response.user);

            const authenticatedUser = await masterAuthService.me();

            console.log('Usuário autenticado na sessão:', authenticatedUser);
        } catch (err) {
            console.error('Erro no login:', err);
            error = 'Não foi possível realizar o login. Verifique suas credenciais.';
        } finally {
            loading = false;
        }
    }
</script>

<svelte:head>
    <title>Acesso Master | Artemis</title>
</svelte:head>

<main>
    <h1>Acesso Master</h1>

    <form onsubmit={(event) => {
        event.preventDefault();
        handleLogin();
    }}>
        <div>
            <label for="email">E-mail</label>
            <input
                id="email"
                type="email"
                bind:value={email}
                required
            />
        </div>

        <div>
            <label for="password">Senha</label>
            <input
                id="password"
                type="password"
                bind:value={password}
                required
            />
        </div>

        {#if error}
            <p>{error}</p>
        {/if}

        <button type="submit" disabled={loading}>
            {loading ? 'Autenticando...' : 'Entrar'}
        </button>
    </form>
</main>
