<script>
    import { cleave } from 'svelte-cleavejs';
    import "cleave.js/dist/addons/cleave-phone.br";

    let {
        numeralDecimalScale = 2,
        hasError = false,
        disabled = false,
        placeholder = '',
        max = undefined,
        min = undefined,
        isValid = false,
        required = false,
        classCol,
        onChange = () => {},
        onKeyup = () => {},
        classInput = "form-control",
        value = $bindable(),
        type
    } = $props();

    $effect(() => {
        if (type === "decimal" && value != null && value !== "") {
            const formatted = String(value).replace(".", ",");

            if (formatted !== String(value)) {
                value = formatted;
            }
        }
    });
</script>

{#if type === "text" || type === "email"}
    <input
        type={type}
        class={classInput}
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        {disabled}
        {required}
        onchange={onChange}
        onkeyup={onKeyup}
    />
{:else if type == "number"}
    <input
        type={type}
        class={classInput}
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        {disabled}
        {required}
        onchange={onChange}
        onkeyup={onKeyup}
        max={max}
        min={min}
    />
{/if}