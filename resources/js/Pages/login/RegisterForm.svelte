<script>
    import { getData, postData } from "$lib/api/api.js";
    import Title from "$components/Title/Title.svelte";
    import MaskedInput from '$components/Inputs/MaskedInput.svelte';
    import Select from 'svelte-select';
    import { page } from '@inertiajs/svelte';
    import { onMount } from "svelte";
    import { auth } from "$lib/auth/auth.js";
    
    export let baseUrl = $page.props.app?.baseUrl;
    export let csrfToken = $page.props.app?.csrfToken;
    let errorInput;
    let error;
    let errorMessage = {
        email: '',
        cnpj: '',
        country: '',
        message: '',
    };
    let isLoading;
    let email = '';
    let countryList = [];
    let country = '';
    let cnpj = '';
    let endpoint = "/register";

    onMount(() => {
        getData("api/V1/countries").then((response) => {
            countryList = response;
        });
    });

    const registerCompany = async () => {
        isLoading = true;
        errorInput = {};
        try {
            const data = {
                email,
                cnpj,
                country,
            };
            const registerData = await auth.register(endpoint, data);
            
            if(registerData?.errors){
                if (registerData?.errors?.email) {
                    errorMessage.email = registerData?.errors?.email[0] || '';
                }
                if (registerData?.errors?.cnpj) {
                    errorMessage.cpf = registerData?.errors?.cnpj[0] || '';
                }
                if(registerData?.errors?.country){
                    errorMessage.country = registerData?.errors?.country[0] || '';
                }
                errorMessage.message = registerData.message || registerData?.error?.message;
            }

            if(registerData?.error){
                console.log('register', registerData.error);
                errorMessage.message = registerData?.error?.message;
            }

            if (registerData[0]?.Authorized === true) {
                console.log('entrei', registerData[0].token);
                // localStorage.setItem("token", registerData[0].token);
                // localStorage.setItem("name", registerData[0].name);
                // localStorage.setItem("email", registerData[0].email);
                // localStorage.setItem("id", registerData[0].id);
                confirmPassword(registerData[0].token);
            }
        }finally {
            isLoading = false;
        }
    }

    function confirmPassword(data) {
        if (data) {
            window.location.href = "/dashboard";
        }
    }
</script>

<Title title="Cadastro" />
<form on:submit|preventDefault={registerCompany}>

    <div class="form-group first">
        <span class="text-danger">{errorMessage.email || ""}</span>
        <input
            type="email"
            class="form-control last mb-4"
            id="email"
            bind:value={email}
            placeholder="Informe um email válido" 
        />
    </div>

    <div class="form-group first">
        <div class="text-danger">{errorMessage.cpf  || ""}</div>
        <MaskedInput
            mask="99.999.999/9999-99"
            placeholderText="CNPJ"
            inputClass="form-control last mb-4"
            bind:value={cnpj}
        />
    </div>

    <div class="form-group first">
        <div class="text-danger">{errorMessage.country || ""}</div>
        <Select
            class="form-control last mb-4"
            items={countryList} 
            bind:value={country}
            placeholder="Selecione um local"
            showChevron 
            />
    </div>

    <!-- <br /> -->
    {#if errorMessage.message}
        <div class="alert alert-danger" role="alert">
            {errorMessage.message}
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
                Cadastrar
            {/if}
        </button>
    </div>
</form>
