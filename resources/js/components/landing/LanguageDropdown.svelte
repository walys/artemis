<script>
    import { onMount } from 'svelte';
    import { _ } from '$lib/lang/lang.js';
    import { listLanguages } from '$lib/services/site/language.service.js';

    let idiomas = $state([]);
    let selectedLanguage = $state('pt-BR');
    let languageMenuOpen = $state(false);
    let loadingLanguages = $state(true);
    let errorLanguages = $state(false);

    const currentLanguage = $derived(
        idiomas.find((idioma) => idioma.code === selectedLanguage)
    );

    function getFlag(code) {
        const flags = {
            'pt-BR': '/lang/pt-BR.png',
            'en-US': '/lang/en.png',
            'es-ES': '/lang/es.png',
        };

        return flags[code] ?? '';
    }

    /**
     * Identifica o idioma preferido do navegador.
     */
    function detectBrowserLanguage() {
        const browserLanguages = navigator.languages?.length
            ? navigator.languages
            : [navigator.language];

        for (const browserLanguage of browserLanguages) {
            const normalizedLanguage = browserLanguage.toLowerCase();

            const exactMatch = idiomas.find(
                (idioma) => idioma.code.toLowerCase() === normalizedLanguage
            );

            if (exactMatch) {
                return exactMatch.code;
            }

            const languagePrefix = normalizedLanguage.split('-')[0];

            const partialMatch = idiomas.find(
                (idioma) =>
                    idioma.code.split('-')[0].toLowerCase() === languagePrefix
            );

            if (partialMatch) {
                return partialMatch.code;
            }
        }

        return 'pt-BR';
    }

    /**
     * Seleciona e salva o idioma escolhido.
     */
    function selecionarIdioma(code) {
        selectedLanguage = code;

        localStorage.setItem('lang', code);

        languageMenuOpen = false;

        window.location.reload();
    }

    /**
     * Carrega os idiomas e identifica a preferência do usuário.
     */
    async function loadLanguages() {
        try {
            idiomas = await listLanguages();

            const savedLanguage = localStorage.getItem('lang');

            if (
                savedLanguage &&
                idiomas.some((idioma) => idioma.code === savedLanguage)
            ) {
                selectedLanguage = savedLanguage;
            } else {
                selectedLanguage = detectBrowserLanguage();

                localStorage.setItem('lang', selectedLanguage);
            }
        } catch (error) {
            console.error('Erro ao carregar idiomas:', error);
            errorLanguages = true;
        } finally {
            loadingLanguages = false;
        }
    }

    onMount(() => {
        loadLanguages();
    });
</script>

{#if !loadingLanguages && !errorLanguages && currentLanguage}
    <div class="language-dropdown">
        <button
            type="button"
            class="language-dropdown-toggle"
            aria-label="Selecionar idioma"
            aria-haspopup="true"
            aria-expanded={languageMenuOpen}
            onclick={() => (languageMenuOpen = !languageMenuOpen)}
        >
            <img
                src={getFlag(currentLanguage.code)}
                alt=""
                width="20"
                height="20"
            />

            <span>{_(currentLanguage.name)}</span>

            <i class={`bi ${languageMenuOpen ? 'bi-chevron-up' : 'bi-chevron-down'}`}></i>
        </button>

        {#if languageMenuOpen}
            <div class="language-dropdown-menu" role="menu">
                {#each idiomas as idioma (idioma.id)}
                    <button
                        type="button"
                        class="language-dropdown-item"
                        class:active={selectedLanguage === idioma.code}
                        role="menuitem"
                        onclick={() => selecionarIdioma(idioma.code)}
                    >
                        <img
                            src={getFlag(idioma.code)}
                            alt=""
                            width="20"
                            height="20"
                        />

                        <span>{_(idioma.name)}</span>

                        {#if selectedLanguage === idioma.code}
                            <i class="bi bi-check2 ms-auto"></i>
                        {/if}
                    </button>
                {/each}
            </div>
        {/if}
    </div>
{/if}