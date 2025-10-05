<script>
    import Title from "$components/Title/Title.svelte";
    import { getData, postData } from "$lib/api/api.js";
    import { page } from '@inertiajs/svelte';
    import { auth } from "$lib/auth/auth.js";

    let email;
    let password;
    let error;
    let errorMessage;
    let isLoading;
    export let baseUrl = $page.props.app?.baseUrl;
    export let csrfToken = $page.props.app?.csrfToken;
    let endpoint = "/auth";

    const login = async () => {
        if (!email && !password) {
            errorMessage = "O campo email e senha são obrigatórios.";
        } else if (!email) {
            errorMessage = "O campo email é obrigatório.";
        } else if (!password) {
            errorMessage = "O campo senha é obrigatório.";
        } else {
            errorMessage = "";
        }

        if (errorMessage) {
            return;
        }

        isLoading = true;
        
        try {
            console.log(`${email} - ${password} - ${csrfToken}`);
            const data = await postData(`${baseUrl}`,`${endpoint}`, {
                email,
                password,
            });
            const userData = data;
            if (userData.token) {
                console.log(userData);
                localStorage.setItem("token", userData.token);
                localStorage.setItem("name", userData.name);
                localStorage.setItem("email", userData.email);
                localStorage.setItem("id", userData.id);
                confirmPassword(userData.token);
            } else {
                error = userData.error;
            }
        } catch (error) {
            console.log('error', error);
            errorMessage = "Email ou senha incorretos.";
        } finally {
            isLoading = false;
        }
    };

     async function handleSubmit(event) {
        event.preventDefault();

        if (!email && !password) {
            errorMessage = "O campo email e senha são obrigatórios.";
        } else if (!email) {
            errorMessage = "O campo email é obrigatório.";
        } else if (!password) {
            errorMessage = "O campo senha é obrigatório.";
        } else {
            errorMessage = "";
        }

        if (errorMessage) {
            return;
        }

        isLoading = true;
        
        try {
            const data = await auth.login(baseUrl, email, password);
            isLoading = false;
            if(data.message !== "Authorized") {
                errorMessage = "Email ou senha incorretos.";
            }else{
                localStorage.setItem("token", data.token);
                localStorage.setItem("name", data.name);
                localStorage.setItem("email", data.email);
                localStorage.setItem("id", data.id);
                confirmPassword(data.token);
            }
        } catch (err) {
            isLoading = false;
            // Erro já está definido na store
            console.log(err);
        }
    }

    function confirmPassword(data) {
        if (data) {
            window.location.href = "/dashboard";
        }
    }
</script>
    <Title title="Login" />
{#if error}
    <div class="alert alert-danger" role="alert">
        {error}
    </div>
{/if}
<form on:submit|preventDefault={handleSubmit}>
    <div class="form-group first">
        <input
            type="text"
            class="form-control"
            id="email"
            bind:value={email}
            placeholder="E-mail"
        />
    </div>
    <br />
    <div class="form-group last mb-4">
        <input
            type="password"
            class="form-control"
            id="password"
            bind:value={password}
            placeholder="Senha"
        />
    </div>
    {#if errorMessage}
        <div class="alert alert-danger" role="alert">
            {errorMessage}
        </div>
    {/if}

    <div class="d-flex justify-content-end">
        <button
            type="submit"
            class="btn btn-block btn-primary"
            style="width: 100%; background: #2A3F54; border-color: #2A3F54;"
            disabled={isLoading}
        >
            {#if isLoading}
                Carregando...
            {:else}
                Entrar
            {/if}
        </button>
    </div>
</form>
