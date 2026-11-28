<script>
    import { _ } from "$lib/lang/lang.js";
    import Select from "$components/crud/Select.svelte";
    import { onMount } from "svelte";
    import { crud } from "$lib/crud/crud.js";

    let {
        classSelect = "form-control",
        placeholder = _("Selecione ..."),
        value = $bindable(),
        hasError = false,
        disabled = false,
        clearable = false
    } = $props();

    let languageLists = $state([]);

    async function getLanguages() {
        try {
            const response = await crud.get(
                route('master.settings.languages-list')
            );
            languageLists = response;
            
        } catch (err) {
            console.error('Erro ao buscar:', err);
        } 
    }

    onMount(async () => {
        await getLanguages();
    });
</script>

<Select
    classSelect={classSelect}
    items={languageLists}
    {hasError}
    bind:value
    {placeholder}
    {disabled}
    {clearable}
/>