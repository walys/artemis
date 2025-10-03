<!-- MaskedInput.svelte -->
<script>
  import MaskInput from 'svelte-input-mask/MaskInput.svelte';
  
  export let mask = '0000-0000-0000-0000';
  export let type = '';
  
  const handleChange = ({ detail }) => {
    console.log(detail.inputState.maskedValue); // Armazena o valor do input

    if (detail.inputState.maskedValue.indexOf('34') === 0 || detail.inputState.maskedValue.indexOf('37') === 0) {
      mask = '0000-000000-00000';
      return;
    }

    mask = '0000-0000-0000-0000';
  };
</script>

<MaskInput alwaysShowMask maskChar="_" {mask} on:change={handleChange} />