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
        clearable = false,
    } = $props();

    let planLists = $state([]);

    async function getPlans() {
        try {
            const response = await crud.get(
                route('master.plans.index')
            );

            planLists.length = 0; // limpa antes
            response.plans.forEach(element => {
                planLists.push({
                    value: element.id,
                    label: element.name
                });
            });
        } catch (err) {
            console.error('Erro ao buscar:', err);
        }
    }

    onMount(async () => {
        await getPlans();
    });
</script>

<Select
    classSelect={classSelect}
    items={planLists}
    {hasError}
    bind:value
    {placeholder}
    {disabled}
    {clearable}
/>