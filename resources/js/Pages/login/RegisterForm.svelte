<script>
    import { getData } from "$lib/api/api.js";
    import Title from "$components/Title/Title.svelte";
    import MaskedInput from '$components/Inputs/MaskedInput.svelte';
    import Select from 'svelte-select';
    import { onMount } from "svelte";
    import Form from "$components/Form/Form.svelte";

    let isLoading = false;
    let errors = [];
    let endpoint = "/register";
    let fomDataRegister = {
        email: '',
        cnpj: '',
        country: '',
        message: '',
    };
    let countryList = [];
    let urlRedirect = "/dashboard";

    onMount(() => {
        getData("api/V1/countries").then((response) => {
            countryList = response;
        });
    });

    function erros(event) {
        errors = [];
        errors = event.detail.errors;
    }

    function loading(event) {
        isLoading = event.detail.isLoading;
    }

</script>
<Title title="Cadastro" />
<Form
    typeForm="register" 
    url={endpoint} 
    urlRedirect={urlRedirect}
    on:errors={erros}
    fomData={fomDataRegister}
    on:isLoading={loading}
>
    <div class="form-group first">
        <span class="text-danger">{errors.email || ""}</span>
        <input
            type="email"
            class="form-control last mb-4"
            id="email"
            bind:value={fomDataRegister.email}
            placeholder="Informe um email válido" 
        />
    </div>

    <div class="form-group first">
        <div class="text-danger">{errors.cnpj  || ""}</div>
        <MaskedInput
            mask="99.999.999/9999-99"
            placeholderText="CNPJ"
            inputClass="form-control last mb-4"
            bind:value={fomDataRegister.cnpj}
        />
    </div>

    <div class="form-group first">
        <div class="text-danger">{errors.country || ""}</div>
        <Select
            class="form-control last mb-4"
            items={countryList} 
            bind:value={fomDataRegister.country}
            placeholder="Selecione um local"
            showChevron 
        />
    </div>

    <div class="d-flex justify-content-end">
        <button
            type="submit"
            class="btn btn-block btn-primary"
            style="width: 100%; background: #87C4BC; border-color: #87C4BC;"
            disabled={isLoading}
        >
            {#if isLoading}
                Carregando...
            {:else}
                Cadastrar
            {/if}
        </button>
    </div>
</Form> 