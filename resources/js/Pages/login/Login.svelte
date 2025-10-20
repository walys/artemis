<script>
    import LoginForm from './LoginForm.svelte';
    import RegisterForm from './RegisterForm.svelte';

    let isLogin = true;
    let isRegister = false;

    function toggleForm() {
        isLogin = !isLogin;
        isRegister = !isRegister;
    }
</script>

<div>
    <div class="row">
        <div class="col-md-7">
            <!-- svelte-ignore a11y-img-redundant-alt -->
            <img
                src="https://img.freepik.com/vetores-gratis/palavra-de-ciencia-com-estilo-de-microscopio_23-2148540553.jpg"
                alt="Image"
                class="img-fluid"
            />
        </div>

        <div class="col-md-5 contents">
            <div class="row justify-content-center" style="margin-top: 5%;">
                <div class="col-md-8">
                    <div class="mb-4">
                        <div class="mb-4 d-flex justify-content-center">
                            <img
                                src={"/sneat/logo/logo_name_sf.png"}
                                style="border-radius: 40%; width: 75%;"
                                alt="Logo"
                                class="img-fluid mb-2"
                            />
                        </div>
                    </div>
                    {#if isLogin}
                        <LoginForm />
                    {:else}
                        <RegisterForm />
                    {/if}
                    <br />
                    <div class="d-flex justify-content-end">
                        <a
                            href="#!"
                            class="btn btn-block btn-secondary"
                            style="width: 100%;"
                            on:click={toggleForm}
                            >
                            {#if isLogin}
                                Cadastre-se
                            {:else}
                                Voltar para login
                            {/if}
                        </a>
                    </div>
                    <br />
                    <!-- svelte-ignore a11y-invalid-attribute -->
                    <a href="#" class="already" style="text-decoration: none;">Esqueceu sua senha?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import "../../../css/login.css";
    .col-md-7 {
        padding: 0;
        margin: 0;
        height: 100vh; /* ou altura desejada */
        overflow: hidden;
    }

    .img-fluid {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .btn-secondary {
        background-color: #87C4BC !important;
        border-color: #87C4BC !important;
    }
</style>
