<script>
    import {_} from "$lib/lang/lang.js";
    import { page } from '@inertiajs/svelte';
    import { auth } from "$lib/auth/auth.js";
    import { getData, postData, putData } from "$lib/api/api.js";
    import { crud } from "$lib/crud/crud.js";
    import { createEventDispatcher } from 'svelte';
    import sweetalert from "$lib/sweet/sweetalert.js";

    export let baseUrl = $page.props.app?.baseUrl;
    export let apiBaseUrl = $page.props.app?.apiUrl;

    export let formData = {};
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
  
    let endpointBaseUrl = baseUrl + url;
    let endpointApiBaseUrl = apiBaseUrl + url;

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
        case "normal":
          handleCreateOrUpdate();
          break;
        default:
          break;
      }
    }

    async function handleLogin()
    {
        try {
            console.log('formData', formData);
            data = await auth.login(endpointBaseUrl, formData?.email, formData?.password);
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
            data = await auth.register(endpointBaseUrl, formData);
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

    async function handleCreateOrUpdate() {
      if(formData.id){
        data = await crud.put(`${endpointApiBaseUrl}/update`, formData);
        if(data.sucess === true){
          console.log('else', data);
        }else{
            handleErrors(data)
        }
        console.log('response', data);
      }else{
          await postData(`${endpointApiBaseUrl}/store`, formData).then((response) => {
            console.log('response', response);
          });
      }
    }
  </script>
  
  <form on:submit|preventDefault={handleSubmit} class={classForm} >
    <slot />
    {#if typeForm === "normal"}
      <hr/>
      <div class="card-body pt-4">
          <div class="mt-6">
              <button type="submit" class="btn btn-primary me-3" on::click={handleCreateOrUpdate}>{_("Salvar Alterações")}</button>
              <button type="reset" class="btn btn-secondary">{_("Cancelar")}</button>
          </div>
      </div>
    {/if}
  </form>