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
    fomData={fomDataLogin}
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
</Form>
