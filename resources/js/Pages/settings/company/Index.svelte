<script>
    import Layout from "$tamplete/Layout.svelte";
    import Title from "$components/Title/Title.svelte";
    import PageTitle from "$components/Page-title/Page-title.svelte";
    import { getData, postData, getDataParams } from "$lib/api/api.js";
    import { inertia, Link, page, useForm } from "@inertiajs/svelte";
    import MaskInput from "svelte-input-mask";
    import { createEventDispatcher, onMount } from "svelte";
    import Select from 'svelte-select';
    import Form from "$components/Form/Form.svelte";
    import Col from "$components/Form/Col.svelte";

    const dispatch = createEventDispatcher();

    let data;
    let errors;
    let countryList = [];
    let country = {value: $page.props.company?.country.id, label: $page.props.company?.country.name};

    export let companyData = {
        country_id: $page.props.company?.country_id ?? '',
        name: $page.props.company?.name ?? '',
        cnpj: $page.props.company?.cnpj ?? '',
        email: $page.props.company?.email ?? '',
        phone: $page.props.company?.phone ?? '',
        website: $page.props.company?.website ?? '',
        description: $page.props.company?.description ?? '',
        street: $page.props.company?.street ?? '',
        number: $page.props.company?.number ?? '',
        district: $page.props.company?.district ?? '',
        city: $page.props.company?.city ?? '',
        details: $page.props.company?.details ?? '',
        cep: $page.props.company?.cep ?? '',
        description: $page.props.company?.description ?? '',
        country: country ?? '',
        state: $page.props.company?.state ?? '',
        slug: $page.props.company?.slug ?? '',
    };

    onMount(() => {
        const fetchCountryList = async () => {
            try {
                const response = await getData("/V1/countries");
                countryList = response;
                console.log('countryList', $page.props.company);
            } catch (error) {
                console.error('Erro ao carregar lista de países:', error);
            }
        };
        fetchCountryList();
    });

    function consultaCep(event) {
        const cep = event.detail.inputState.unmaskedValue;
        getDataParams("/V1/cep", {cep: cep}).then((response) => {
            console.log('CEP', response);
            // companyData.logradouro = response.logradouro;
            // companyData.bairro = response.bairro;
            // companyData.cidade = response.localidade;
            // companyData.estado = response.uf;
        });
    }

    //  function consultaCep(event) {
    //     const cep = event.detail.inputState.unmaskedValue;
    //     const url = `https://viacep.com.br/ws/${cep}/json/`;
    //     try {
    //         const response = getData(url);
    //         const data = response.data;
    //         console.log('CEP', data);
    //         companyData.logradouro = data.logradouro;
    //         companyData.bairro = data.bairro;
    //         companyData.cidade = data.cidade;
    //         companyData.estado = data.estado;
    //     } catch (error) {
    //         console.error('Erro ao consultar CEP:', error);
    //     }
    // }
</script>

<Layout title="settings" subtitle="Empresa">
    <Title title="Empresa"/>
    <PageTitle icon="fa fa-building" title="Empresa" />

    <div class="x_panel">
        <div class="x_title">
            <h2>Dados da <small>Empresa</small></h2>
            <div class="clearfix"></div>
        </div>

        <div class="clearfix"></div>

        <div class="x_content">
            <Form formData={companyData}>
                

                <Col title="Nome da empresa *" forName="name_empresa" classInput="col-md-9 col-sm-9 form-group">
                    <input 
                        type="text" 
                        id="name" 
                        placeholder="Digite o nome da empresa" 
                        bind:value={companyData.name} 
                        class="form-control" 
                        required
                    >
                </Col>

                <Col title="CNPJ *" forName="cnpj" classInput="col-md-3 col-sm-3 form-group">
                    <MaskInput 
                        class='form-control' 
                        alwaysShowMask 
                        maskChar="_" 
                        mask="00.000.000/0000-00" 
                        size={20}
                        showMask
                        bind:value={companyData.cnpj}
                    />
                </Col>

                <Col title="Telefone :" forName="phone" classInput="col-md-3 col-sm-3 form-group">
                    <MaskInput 
                        class='form-control'
                        alwaysShowMask
                        maskChar="_" 
                        mask="(00) 00000-0000" 
                        bind:value={companyData.phone}
                    />
                </Col>

                <Col title="E-mail :" forName="email" classInput="col-md-3 col-sm-3 form-group">
                    <input type="email" name="email" id="email" bind:value={companyData.email} placeholder="Digite o email" class="form-control" required>
                </Col>

                <Col title="Website :" forName="Website" classInput="col-md-5 col-sm-5 form-group">
                    <input type="text" name="website" id="website" bind:value={companyData.website} placeholder="Digite o email" class="form-control" required>
                </Col>

                <Col title="Slug :" forName="Slug" classInput="col-md-4 col-sm-4 form-group">
                    <input type="text" name="slug" id="slug" bind:value={companyData.slug} placeholder="Digite o email" class="form-control" required>
                </Col>

                <Col title="Pais :" forName="country" classInput="col-md-3 col-sm-3 form-group"> 
                    <Select
                        class="form-control last mb-4"
                        items={countryList} 
                        value={country}
                        placeholder="Selecione um pais"
                    />
                </Col>

                <Col title="Cep *:" forName="cep" classInput="col-md-3 col-sm-3 form-group">
                    <MaskInput
                        on:change={consultaCep}
                        class='form-control' 
                        alwaysShowMask
                        maskChar="_" 
                        mask="00000-000" 
                        bind:value={companyData.cep}
                        />
                </Col>

                <Col title="Estado :" forName="state" classInput="col-md-3 col-sm-3 form-group"> 
                    <input type="text" name="state" id="state" bind:value={companyData.state} placeholder="Digite o Estado" class="form-control" required>
                </Col>

                <Col title="Endereço :" forName="endereco" classInput="col-md-3 col-sm-3 form-group"> 
                    <input type="text" name="street" id="street" bind:value={companyData.street} placeholder="Digite o Endereço" class="form-control">
                </Col>

                <Col title="Nº :" forName="number" classInput="col-md-3 col-sm-3 form-group"> 
                    <input type="text" name="number" id="number" bind:value={companyData.number} placeholder="Digite o Nº" class="form-control" required>
                </Col>
            </Form>
        </div>
    </div>        
</Layout>