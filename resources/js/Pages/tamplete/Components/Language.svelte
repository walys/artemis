<script>
    import { postData } from "$lib/api/api.js";
    import { page } from '@inertiajs/svelte';

    export let languageLists;
    export let appUserData;

    let apiUrl = $page.props.app?.apiUrl;
    let endpointChangeLanguage = apiUrl + `/change-language`;

    async function handleLanguage(language) {
        try {
            const response = await postData(endpointChangeLanguage, {language: language});

            const newLanguage = response?.language?.code;
            localStorage.removeItem("lang");
            localStorage.setItem("lang", newLanguage);            
            // Recarrega apenas se a requisição foi bem-sucedida
            location.reload();
        } catch (error) {
            console.error('Erro ao alterar idioma:', error);
            // Opcional: mostrar mensagem de erro para o usuário
        }
    }
</script>
<!-- Language -->
<li class="nav-item dropdown-language dropdown me-2 me-xl-0">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
    <i class="icon-base bx bx-globe icon-md"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        {#each languageLists as language}
            <li>
                <a class="dropdown-item" href="javascript:void(0);" on:click={() => handleLanguage(language)}>
                    <span>
                        {#if language.value == appUserData.language.id}
                            <i class="icon-base bx bx-check icon-md" style='color:#0de020'></i>
                        {:else }
                            <i class="icon-base bx bx-x icon-md"></i>
                        {/if}
                        {language.label}
                    </span>
                </a>
            </li>
        {/each}
    </ul>
</li>
<!--/ Language -->