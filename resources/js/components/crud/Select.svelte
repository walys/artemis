<script>
    import { _ } from "$lib/lang/lang.js";
    import Select from "svelte-select";

    let {
        classSelect = "form-control",
        placeholder = _("Selecione ..."),
        items = [],
        value = $bindable(),
        isValid = false,
        hasError = false,
        clearable = false,
        disabled = false,
    } = $props();
</script>

<Select
    class="{classSelect} {hasError ? 'is-invalid' : ''} {isValid ? 'is-valid' : ''}"
    {items}
    {placeholder}
    bind:value
    showChevron
    {clearable}
    {disabled}
/>

<style>
    :global(.svelte-select) {
        position: relative;
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

    :global(.svelte-select.focused) {
        z-index: 100;
    }

    :global(.svelte-select .list) {
        z-index: 9999;
    }
</style>
