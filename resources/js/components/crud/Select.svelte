
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
    :global(.svelte-select) {
        position: relative;
        z-index: 1000;
        color: #1F3442;
        font-size: 13px;
    }

    :global(.svelte-select .selection) {
        min-height: 50px;
        border-color: #B8D4E8;
        border-radius: 8px;
    }

    :global(.svelte-select .value-container) {
        min-height: 30px;
    }

    :global(.svelte-select .list) {
        z-index: 9999 !important;
    }
</style>
