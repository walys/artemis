<script>
    import { getData, postData } from "$lib/api/api.js";
    import Title from "$components/Title/Title.svelte";
    import MaskedInput from '$components/Inputs/MaskedInput.svelte';
    import Select from 'svelte-select';
    import { onMount } from "svelte";
    

    let errorInput;
    let error;
    let errorMessage;
    let isLoading;
    let email;
    let countryList = [];
    let country = '';
    let cnpj = '';

    onMount(() => {
        getData("/V1/countries").then((response) => {
            countryList = response;
        });
    });

    const registerCompany = async () => {
        isLoading = true;
        errorInput = {};
        try {
            const data = await postData("/V1/register", {
                email,
                cnpj,
                country
            });
            const regiterData = data;
            console.log(regiterData[0].Authorized);
            if (regiterData[0].Authorized === true) {
                console.log('entrei', regiterData[0].token);
                localStorage.setItem("token", regiterData[0].token);
                localStorage.setItem("name", regiterData[0].name);
                localStorage.setItem("email", regiterData[0].email);
                localStorage.setItem("id", regiterData[0].id);
                confirmPassword(regiterData[0].token);
            }

            if(regiterData?.error?.details){
                error = true;
                errorMessage = regiterData?.error?.details;
                errorInput = {};
            }
            else {
                console.log('Ois', regiterData)
                 errorInput = {...regiterData.errors}
                 errorMessage = '';
            }
        } catch (error) {
            errorMessage = "Dados inseridos incorretamente. Por favor, verifique e tente novamente.";
        } finally {
            isLoading = false;
        }
    };

    function confirmPassword(data) {
        if (data) {
            window.location.href = "/dashboard";
        }
    }
</script>

<Title title="Cadastro" />
<form on:submit|preventDefault={registerCompany}>

    <div class="form-group first">
        <span class="text-danger">{errorInput?.email || ""}</span>
        <input
            type="email"
            class="form-control last mb-4"
            id="email"
            bind:value={email}
            placeholder="Informe um email válido" 
        />
        <!-- <div class="text-danger">{error?.email[0] || ""}</div> -->
    </div>

    <div class="form-group first">
        <div class="text-danger">{errorInput?.cnpj || ""}</div>
        <MaskedInput
            mask="99.999.999/9999-99"
            placeholderText="CNPJ"
            inputClass="form-control last mb-4"
            bind:value={cnpj}
        />
    </div>

    <div class="form-group first">
        <div class="text-danger">{errorInput?.country || ""}</div>
        <!-- <Select
            class="form-control last mb-4"
            items={countryList} 
            bind:value={country}
            placeholder="Selecione um local"
            multiple
            showChevron 
            /> -->
        <Select
            class="form-control last mb-4"
            items={countryList} 
            bind:value={country}
            placeholder="Selecione um local"
            showChevron 
            />
    </div>

    <!-- <br /> -->
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
                Cadastrar
            {/if}
        </button>
    </div>
</form>
