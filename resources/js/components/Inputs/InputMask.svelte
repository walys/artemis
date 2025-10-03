<script>
    import { onMount } from 'svelte';
    import { cleave } from 'svelte-cleavejs';
    import "cleave.js/dist/addons/cleave-phone.br";

    // docs: https://nosir.github.io/cleave.js/

    export let value;
    export let type = "text";
    export let hasError = false;
    export let numeralDecimalScale = 2;
    export let disabled = false;
    export let placeholder = "";
    export let max = undefined;
    export let isValid = false;
    export let onChange = () => {};
    export let onKeyup = () => {};

    // converte numero americano para brasileiro
    if(type == "decimal") {
        value = value ? value.toString().replace(".", ",") : "";
    }
</script>


{#if type == "decimal"}

    <!-- número -->
    <input
        type="text"
        use:cleave={{
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            numeralDecimalScale: numeralDecimalScale,
            rawValueTrimPrefix: true
        }}
        max={max}
        class="form-control "
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        disabled={disabled}
        on:change={onChange}
        on:keyup={onKeyup}
    />

{:else if type == "phone"}

    <!-- telefone -->
    <input
        type="text"
        use:cleave={{
            blocks: [0, 2, 5, 4],
            delimiters: ['(', ') ', '-'],
            numericOnly: true
        }}
        class="form-control"
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        disabled={disabled}
        on:change={onChange}
    />

{:else if type == "cep"}

    <!-- cep -->
    <input
        type="text"
        use:cleave={{
            blocks: [5, 3],
            delimiter: '-',
            numericOnly: true
        }}
        class="form-control"
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        disabled={disabled}
        on:change={onChange}
        on:keyup={onKeyup}
    />

{:else if type == "cpf"}

    <!-- cpf -->
    <input
        type="text"
        use:cleave={{
            blocks: [3, 3, 3, 2],
            delimiters: ['.', '.', '-'],
            numericOnly: true
        }}
        class="form-control"
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        disabled={disabled}
        on:change={onChange}
    />
{:else if type == "cnpj"}

    <!-- cnpj -->
    <input
        type="text"
        use:cleave={{
            blocks: [2, 3, 3,4, 2],
            delimiters: ['.', '.','/', '-'],
            numericOnly: true
        }}
        class="form-control"
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        disabled={disabled}
        on:change={onChange}
    />

{:else if type == "rg"}

    <!-- rg -->
    <input
        type="text"
        use:cleave={{
            blocks: [2, 3, 3, 1],
            delimiters: ['.', '.', '-'],
            numericOnly: true
        }}
        class="form-control"
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        disabled={disabled}
        on:change={onChange}
    />

{:else if type == "titulo_eleitor"}

<!-- título de eleitor -->
<input
    type="text"
    use:cleave={{
        blocks: [3, 3, 3, 2],
        delimiters: ['.', '.', '-'],
        numericOnly: true
    }}
    class="form-control"
    class:is-invalid={hasError}
    class:is-valid={isValid}
    {placeholder}
    bind:value
    disabled={disabled}
    on:change={onChange}
/>

{:else if type == "cnh" || type == "nis"}

    <!-- CNH -->
    <input
        type="text"
        use:cleave={{
            blocks: [3, 3, 3, 2],
            delimiters: ['.', '.', '.', '-'],
            numericOnly: true
        }}
        class="form-control"
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        disabled={disabled}
        on:change={onChange}
    />

{:else if type == "ctps"}

<!-- CTPS -->
<input
    type="text"
    use:cleave={{
        blocks: [3, 5, 1],
        delimiters: ['.', '.', '.'],
        numericOnly: true
    }}
    class="form-control"
    class:is-invalid={hasError}
    class:is-valid={isValid}
    {placeholder}
    bind:value
    disabled={disabled}
    on:change={onChange}
/>

{:else if type == "pis" || type == "pasep"}

<!-- PIS/PASEP -->
<input
    type="text"
    use:cleave={{
        blocks: [3, 5, 2, 2],
        delimiters: ['.', '.', '-', '.'],
        numericOnly: true
    }}
    class="form-control"
    class:is-invalid={hasError}
    class:is-valid={isValid}
    {placeholder}
    bind:value
    disabled={disabled}
    on:change={onChange}
/>

{:else if type == "date"}

    <!-- cpf -->
    <input
        type="text"
        use:cleave={{
            blocks: [2, 2, 4],
            delimiter: '/',
            numericOnly: true
        }}
        class="form-control"
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        disabled={disabled}
        on:change={onChange}
    />

{:else if type == "datetime"}

    <!-- cpf -->
    <input
        type="text"
        use:cleave={{
            blocks: [2, 2, 4, 2, 2, 2],
            delimiters: ['/', '/', ' ', ':', ':'],
            numericOnly: true
        }}
        class="form-control"
        class:is-invalid={hasError}
        class:is-valid={isValid}
        {placeholder}
        bind:value
        disabled={disabled}
        on:change={onChange}
    />

{/if}

