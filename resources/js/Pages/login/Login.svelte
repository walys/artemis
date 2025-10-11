<script>
    import LoginForm from './LoginForm.svelte';
    import RegisterForm from './RegisterForm.svelte';
    import { getData, postData } from "$lib/api/api.js";
    import { onMount } from "svelte";

    let isLogin = true;
    let isRegister = false;

    // onMount(() => {
    //   if (localStorage.getItem('token')) {
    //       window.location.href = '/dashboard';
    //   }
    // });

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
                src="https://img.freepik.com/vetores-gratis/ilustracao-do-conceito-de-laboratorio-de-quimica_114360-13523.jpg?semt=ais_hybrid"
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
                                src="https://img.freepik.com/vetores-gratis/ilustracao-do-conceito-de-laboratorio-de-quimica_114360-13523.jpg?semt=ais_hybrid"
                                style="border-radius: 50%; width: 35%;"
                                alt="Logo"
                                class="img-fluid mb-2"
                            />
                        </div>
                        <h3>Artemis</h3>
                        
                        <p class="mb-4">
                            Seja bem vindo, espero proporcinar uma boa experiência!
                        </p>
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
</style>
