<script>
    import { getData, postData } from "$lib/api/api.js";

    export let fomData = {};
    export let onSubmit;
    export let loading = false;
    export let disabled = false;
    export let data = {};

    function handleSubmit(event) {
      event.preventDefault();
      onSubmit(formData);
    }
  </script>
  
  <form on:submit|preventDefault={handleSubmit} >
    <slot />
    <div class="row">
                    
    </div>
  </form>