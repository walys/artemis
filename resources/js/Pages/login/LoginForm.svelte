<script>
    import Title from "$components/Title/Title.svelte";
    import Form from "$components/Form/Form.svelte";

    let isLoading = false;
    let errors = [];
    let endpoint = "/auth";
    let urlRedirect = "/dashboard";
    let fomDataLogin = {
        email: "",
        password: "",
    };

    function erros(event) {
        errors = [];
        errors = event.detail.errors;
    }

    function loading(event) {
        isLoading = event.detail.isLoading;
    }

</script>
<Title title="Login" />
<Form 
    typeForm="login" 
    url={endpoint} 
    urlRedirect={urlRedirect}
    on:errors={erros}
    formData={fomDataLogin}
    on:isLoading={loading}
>
    <div class="form-group first">
        <input
            type="text"
            class="form-control"
            id="email"
            bind:value={fomDataLogin.email}
            placeholder="E-mail"
        />
        <span class=text-danger>{errors?.email || ""}</span>
    </div>
    <br />
    <div class="form-group last mb-4">
        <input
            type="password"
            class="form-control"
            id="password"
            bind:value={fomDataLogin.password}
            placeholder="Senha"
        />
        <span class=text-danger>{errors?.password || ""}</span>
    </div>

    <div class="d-flex justify-content-end">
        <button
            type="submit"
            class="btn btn-block btn-success"
            disabled={isLoading}
        >
            {#if isLoading}
                Carregando...
            {:else}
                Entrar
            {/if}
        </button>
    </div>
</Form>
<style>
    .btn-success{
        background: #B5E4E6;
        border-color: #B5E4E6;
        width: 100%;
    }
</style>