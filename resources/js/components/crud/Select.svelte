
<script>
    import Select from "svelte-select";

    let {
        classSelect = "form-control",
        placeholder = _("Selecione ..."),
        items,
        value = $bindable(),
        isValid = false,
        hasError = false,
        clearable = false
    } = $props();
</script>

<Select
    class="{classSelect} {hasError ? 'is-invalid' : ''} {isValid ? 'is-valid' : ''}"
    {items}
    {placeholder}
    bind:value
    showChevron
    {clearable}
/>

<style>
    :global(.svelte-select .selection) {
        min-height: 50px;
    }

    :global(.svelte-select .value-container) {
        min-height: 40px;
    }

    :global(.svelte-select) {
        position: relative;
        z-index: 1000;
    }

    :global(.svelte-select .list) {
        z-index: 9999 !important;
    }

    :global(.svelte-select .selection) {
        min-height: 50px;
    }

    :global(.svelte-select .value-container) {
        min-height: 30px;
    }
</style>
