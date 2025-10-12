<script>
    import { getData, postData } from "$lib/api/api.js";
    import { page } from '@inertiajs/svelte';
    import { auth } from "$lib/auth/auth.js";
    import { createEventDispatcher } from 'svelte';
    import sweetalert from "$lib/sweet/sweetalert.js";

    export let baseUrl = $page.props.app?.baseUrl;

    export let fomData = {};
    export let onSubmit;
    export let loading = false;
    export let disabled = false;
    export let classForm = "";
    export let typeForm = "";
    export let isLoading = false;
    export let showButton = false;
    export let url = "";
    export let urlRedirect = "";
    export let errors = [];
    export let errorMessage = "";
    let data = {};
  
    let endpoint = baseUrl + url;

    const dispatch = createEventDispatcher();

    function handleSubmit(event) {
      event.preventDefault();
      handleIsloading(true);
      switch (typeForm) {
        case "login":
          handleLogin();
          break;
        case "register":
          handleRegister();
          break;
        default:
          break;
      }
    }

    async function handleLogin()
    {
        try {
            console.log('fomData', fomData);
            data = await auth.login(endpoint, fomData?.email, fomData?.password);
            console.log('data', data);

            if(data?.authorized === true){
              console.log('else', data);
              handleSetItemStorage(data)
            }
            else if(data?.authorized === false){
              console.log('if', data);
              if(data?.status === "422"){
                  sweetalert('Atenção', data?.errors, 'error');
              }
            }else{
              handleErrors(data)
            }
        } catch (err) {
          console.log('err', err);
        }finally {
            handleIsloading(false);
        }
    }

    async function handleRegister()
    {
        try {
            data = await auth.register(endpoint, fomData);
            console.log('data', data);
            if(data?.Authorized === true){
              handleSetItemStorage(data)
            } else if(data?.authorized === false){
              console.log('if', data);
              if(data?.status === "422"){
                  sweetalert('Atenção', data?.errors, 'error');
              }
            }else{
              handleErrors(data)
            }
        } catch (err) {
          console.log('err', data);
        }finally {
          console.log('finally');
            handleIsloading(false);
        }
    }

    function handleErrors(data) {
      const err = {};
      for (const key in data.errors) {
          console.log('for', data.errors[key]);
          err[key] = data.errors[key][0];
      }
      errors = err;
      dispatch('errors', { errors: errors });
    }

    function handleIsloading(isLoading){
        dispatch('isLoading', { isLoading: isLoading });
    }

    function handleSetItemStorage(data) 
    {
      console.log('data', data);
      localStorage.setItem("token", data.token);
      localStorage.setItem("name", data.name);
      localStorage.setItem("email", data.email);
      localStorage.setItem("id", data.id);
      handleRedict();
    }

    function handleRedict() 
    {
      console.log('urlRedirect', urlRedirect);
        if (data) {
            window.location.href = urlRedirect;
        }
    }
  </script>
  
  <form on:submit|preventDefault={handleSubmit} class={classForm} >
    <slot />
  </form>