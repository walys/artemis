<script>
    import {_} from "$lib/lang/lang.js";
    import { onMount } from "svelte";
    import Col from "$components/Form/Col.svelte";
    import InputMask from "$components/Inputs/InputMask.svelte";
    import Select from 'svelte-select';
    import { getData } from "$lib/api/api.js";
    import { page } from '@inertiajs/svelte';

    export let userDataForma;
    export let errors = {};

    let apiUrl = $page.props.app?.apiUrl;
    let endPointCountry = apiUrl + "/countries";
    let endPointLanguages = apiUrl + "/languages";
    let languageLists = [];
    let countryList = [];

    let fileInput;

    // Imagem preview
    let imagePreview = userDataForma.profile_url || "/sneat/assets/img/avatars/1.png";

    function handleFileUpload(event) {
        const file = event.target.files[0];
        if (file) {
            // Verifica o tipo do arquivo
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert(_("Tipo de arquivo não permitido. Use JPG, GIF ou PNG."));
                return;
            }

            // Verifica o tamanho do arquivo (800KB)
            if (file.size > 800 * 1024) {
                alert(_("Arquivo muito grande. Tamanho máximo: 800KB para JPG, GIF ou PNG. O tamanho atual: " + (file.size / 1024).toFixed(2) + "KB"));
                return;
            }

            // Cria uma URL para preview
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview = e.target.result;
                userDataForma.profile_url = e.target.result; // Armazena a URL base64
                userDataForma.profile_file = file; // Armazena o arquivo também se precisar
            };
            reader.readAsDataURL(file);
        }
    }

    function resetImage() {
        imagePreview = imagePreview;
        userDataForma.profile_url = null;
        userDataForma.profile_file = null;
        if (fileInput) fileInput.value = '';
    }


    onMount(() => {
        getData(endPointCountry).then((response) => {
            countryList = response;
        });

        getData(endPointLanguages).then((response) => {
            languageLists = response;
        });

        getData(endPointLanguages).then((response) => {
            languageLists = response;
        })
    });


</script>
<!-- Account -->

<div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
        <img src={imagePreview} alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
        <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                <span class="d-none d-sm-block">{_("Carregar nova foto")}</span>
                <i class="icon-base bx bx-upload d-block d-sm-none"></i>
                <input 
                    type="file" 
                    id="upload" 
                    class="account-file-input" 
                    hidden 
                    accept="image/png, image/jpeg, image/jpg, image/gif" 
                    bind:this={fileInput}
                    on:change={handleFileUpload}
                />
            </label>
            <button type="button" class="btn btn-secondary account-image-reset mb-4" on:click={resetImage}>
                <i class="icon-base bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">{_("Redefinir")}</span>
            </button>
            <div>{_("Permitido JPG, GIF ou PNG. Tamanho máximo de 800K")}</div>
        </div>
    </div>
</div>
<div class="card-body pt-4">
    <div class="row g-6">

        <Col title={_("Nome")} forName={_("Nome")} classInput="col-md-6 form-control-validation">
            <InputMask 
                type="text" 
                bind:value={userDataForma.name}
                placeholder={_("Informe o nome")}
                hasError={errors?.name}
                required={false}
            />
            <span class="text-danger">{errors?.name || ""}</span>
        </Col>

        <Col title={_("E-mail")} forName={_("E-mail")} classInput="col-md-6 form-control-validation">
            <InputMask
                type="text" 
                bind:value={userDataForma.email}
                placeholder={_("Informe o E-mail")}
                hasError={errors?.email}
                required={false}
            />
            <span class="text-danger">{errors?.email || ""}</span>
        </Col>

        <Col title="CPF" forName="cpf" classInput="col-md-6 form-control-validation">
            <InputMask
                type="cpf" 
                bind:value={userDataForma.cpf}
                placeholder="00.000.000-00"
                hasError={errors?.cpf}
                required={false}
            />
            <span class="text-danger">{errors?.cpf || ""}</span>
        </Col>

        <Col title="{_("Celular")}" forName="{_("Celular")}" classInput="col-md-6 form-control-validation">
            <InputMask
                type="phone" 
                bind:value={userDataForma.phone_mobile}
                placeholder="(00) 00000-0000"  
                hasError={errors?.phone_mobile}
                required={false}
            />
            <span class="text-danger">{errors?.phone_mobile || ""}</span>
        </Col>

        <Col title={_("Data de Nascimento")} forName={_("Data de Nascimento")} classInput="col-md-4 form-control-validation">
            <InputMask
                type="date" 
                bind:value={userDataForma.birthday}
                placeholder={_("Informe a data de nascimento")}
                hasError={errors?.birthday}
                required={false}
            />
            <span class="text-danger">{errors?.birthday || ""}</span>
        </Col>

        <Col title={_("País")} forName={_("País")} classInput="col-md-4 form-control-validation">
            <Select
                class="form-control last mb-4"
                hasError={errors?.country}
                items={countryList}
                bind:value={userDataForma.country}
                placeholder={_("Selecione um país")}
                showChevron 
            />
            <span class="text-danger">{errors?.country || ""}</span>
        </Col>

        <Col title={_("Idioma")} forName={_("Idioma")} classInput="col-md-4 form-control-validation">
            <Select
                class="form-control last mb-4"
                items={languageLists}
                hasError={errors?.country}
                bind:value={userDataForma.language}
                placeholder={_("Selecione um idioma")}
                showChevron 
            />
            <span class="text-danger">{errors?.language || ""}</span>
        </Col>

        
    </div>
</div>
